<?php

namespace App\Exports;

use App\Models\Nomina;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class NominaExport implements FromArray, WithStyles, WithColumnFormatting
{
    protected $nomina;

    // Contenedores para filas / rangos
    protected $rows = [];
    protected $tableRanges = []; // array de ['start' => int, 'end' => int]

    public function __construct(Nomina $nomina)
    {
        // aseguramos traer lineas
        $this->nomina = $nomina->load('lineas');
    }

    /**
     * Construye el array con todas las filas (una sola hoja).
     * Todas las cantidades/importes van en la columna D para consistencia.
     */
    public function array(): array
    {
        $rows = [];
        $r = 1; // fila actual (1-indexed)
        $nom = $this->nomina;

        // --- REMUNERATIVOS ---
        $startRemunerativos = $r;
        $rows[] = array_pad(['REMUNERATIVOS'], 5, ''); // fila 1
        $r++;

        $rows[] = array_pad(['Nombre', 'Cantidad', 'Valor unitario', 'Importe'], 5, ''); // fila 2
        $r++;

        $startDataRemunerativos = $r; // fila 3

        // Sueldo básico como primera fila
        $sueldo = (float) ($nom->sueldo_basico_snapshot ?? 0);
        $rows[] = array_pad(['Sueldo básico', 1, $sueldo, $sueldo, ''], 5, '');
        $r++;

        // Otras lineas remunerativas
        $lineasRem = $nom->lineas->where('tipo', 'remunerativo')->filter(function ($l) {
            return mb_strtolower(trim($l->nombre)) !== 'sueldo básico';
        });

        foreach ($lineasRem as $l) {
            $rows[] = array_pad([
                $l->nombre,
                (float)$l->cantidad,
                (float)$l->valor_unitario,
                (float)$l->importe,
                $l->porcentaje !== null ? (float)$l->porcentaje : ''
            ], 5, '');
            $r++;
        }

        $endDataRemunerativos = $r - 1;

        // Subtotal remunerativo
        if ($endDataRemunerativos >= $startDataRemunerativos) {
            $rows[] = array_pad(['', '', 'Subtotal remunerativo', "=SUM(D{$startDataRemunerativos}:D{$endDataRemunerativos})", ''], 5, '');
        } else {
            $rows[] = array_pad(['', '', 'Subtotal remunerativo', 0, ''], 5, '');
        }
        $subtotalRemunerativosRow = $r;
        $r++;

        $endRemunerativos = $r - 1;
        $this->tableRanges['remunerativos'] = ['start' => $startRemunerativos, 'end' => $endRemunerativos];

        // --- DESCUENTOS / RETENCIONES ---

        $startDescuentos = $r;
        $rows[] = array_pad(['DESCUENTOS / RETENCIONES'], 5, '');
        $r++;

        // Header alineado con las demás tablas
        $rows[] = array_pad(['Nombre', 'Porcentaje', '', 'Importe'], 5, '');
        $r++;

        $startDataDescuentos = $r;

        $lineasDesc = $nom->lineas->where('tipo', 'descuento');
        foreach ($lineasDesc as $d) {
            if (!empty($d->porcentaje) && $subtotalRemunerativosRow) {
                $percent = (float)$d->porcentaje;
                $formula = "=D{$subtotalRemunerativosRow}*{$percent}/100";
                $rows[] = array_pad([
                    $d->nombre,
                    $percent,
                    '',
                    $formula,
                    ''
                ], 5, '');
            } elseif (!empty($d->porcentaje)) {
                $importe = round(($nom->subtotal_remunerativo ?? 0) * ((float)$d->porcentaje / 100.0), 2);
                $rows[] = array_pad([
                    $d->nombre,
                    (float)$d->porcentaje,
                    '',
                    $importe,
                    ''
                ], 5, '');
            } else {
                $rows[] = array_pad([
                    $d->nombre,
                    '',
                    '',
                    (float)$d->importe,
                    ''
                ], 5, '');
            }
            $r++;
        }

        $endDataDescuentos = $r - 1;

        // Total descuentos (cuidando que no se incluya su propia fila en la SUMA)
        if ($endDataDescuentos >= $startDataDescuentos) {
            $formula = "=SUM(D{$startDataDescuentos}:D{$endDataDescuentos})";
            $rows[] = array_pad(['', '', 'Total descuentos', $formula, ''], 5, '');
        } else {
            $rows[] = array_pad(['', '', 'Total descuentos', 0, ''], 5, '');
        }
        $totalDescuentosRow = $r; // ahora guarda la fila correcta
        $r++;

        $endDescuentos = $r - 1;
        $this->tableRanges['descuentos'] = ['start' => $startDescuentos, 'end' => $endDescuentos];

        // separador antes de subtotal2
        $rows[] = array_fill(0, 5, '');
        $r++;

        // Subtotal2 (Remunerativo - Descuentos) - FUERA de cualquier tabla
        // FIX: Usar la fila correcta del total descuentos
        $rows[] = array_pad(['', '', 'Subtotal2 (Remunerativo - Descuentos)', "=D{$subtotalRemunerativosRow}-D{$totalDescuentosRow}", ''], 5, '');
        $r++;

        // --- NO REMUNERATIVOS ---
        $startNoRemunerativos = $r;
        $rows[] = array_pad(['NO REMUNERATIVOS / VIÁTICOS'], 5, '');
        $r++;

        $rows[] = array_pad(['Nombre', 'Cantidad', 'Valor unitario', 'Importe'], 5, '');
        $r++;

        $startDataNoRemunerativos = $r;

        $lineasNoRem = $nom->lineas->where('tipo', 'no_remunerativo');
        foreach ($lineasNoRem as $n) {
            $rows[] = array_pad([
                $n->nombre,
                (float)$n->cantidad,
                (float)$n->valor_unitario,
                (float)$n->importe,
                ''
            ], 5, '');
            $r++;
        }

        $endDataNoRemunerativos = $r - 1;

        if ($endDataNoRemunerativos >= $startDataNoRemunerativos) {
            $rows[] = array_pad(['', '', 'Subtotal no remunerativo', "=SUM(D{$startDataNoRemunerativos}:D{$endDataNoRemunerativos})", ''], 5, '');
        } else {
            $rows[] = array_pad(['', '', 'Subtotal no remunerativo', 0, ''], 5, '');
        }
        $subtotalNoRemunerativosRow = $r;
        $r++;

        $endNoRemunerativos = $r - 1;
        $this->tableRanges['noremunerativos'] = ['start' => $startNoRemunerativos, 'end' => $endNoRemunerativos];

        // --- GASTOS EXTRA & TOTALES FINALES ---
        $startGastos = $r;
        $rows[] = array_pad(['GASTOS EXTRA & TOTALES'], 5, '');
        $r++;

        $rows[] = [];
        $r++;

        // Gastos individuales (en columna D)
        $rows[] = array_pad(['Adelantos', '', '', (float)($nom->adelantos ?? 0), ''], 5, '');
        $r++;
        $rows[] = array_pad(['Celular', '', '', (float)($nom->celular ?? 0), ''], 5, '');
        $r++;
        $rows[] = array_pad(['Gastos', '', '', (float)($nom->gastos ?? 0), ''], 5, '');
        $r++;

        $rows[] = array_fill(0, 5, '');
        $r++;

        // TOTALES FINALES: Referenciamos las filas específicas
        $rows[] = array_pad(['', '', 'Subtotal remunerativo', "=D{$subtotalRemunerativosRow}", ''], 5, '');
        $subtotalRemFinalRow = $r;
        $r++;

        $rows[] = array_pad(['', '', 'Subtotal no remunerativo', "=D{$subtotalNoRemunerativosRow}", ''], 5, '');
        $subtotalNoRemFinalRow = $r;
        $r++;

        $rows[] = array_pad(['', '', 'Total descuentos', "=D{$totalDescuentosRow}", ''], 5, '');
        $totalDescFinalRow = $r;
        $r++;

        // Neto a depositar = SubRem + SubNoRem - TotalDescuentos
        $rows[] = array_pad(['', '', 'Neto a depositar', "=D{$subtotalRemFinalRow}+D{$subtotalNoRemFinalRow}-D{$totalDescFinalRow}", ''], 5, '');
        $r++;

        $endGastos = $r - 1;
        $this->tableRanges['gastos'] = ['start' => $startGastos, 'end' => $endGastos];

        // ---- Normalizar largo de filas: asegurar que todas tengan 5 columnas ----
        $normalized = [];
        foreach ($rows as $rIndex => $row) {
            // Asegurarnos que sea un array indexado
            $row = array_values($row ?: []);
            // Rellenar hasta 5 columnas (A..E)
            $row = array_pad($row, 5, '');
            $normalized[$rIndex] = $row;
        }
        $rows = $normalized;

        // Guardamos filas
        $this->rows = $rows;

        return $rows;
    }

    /**
     * Estilos y formatos (bordes por tabla, encabezados en negrita, fondos, alineaciones)
     */
    public function styles(Worksheet $sheet)
    {
        $lastRow = count($this->rows);

        // Anchos de columnas
        $sheet->getColumnDimension('A')->setWidth(40);
        $sheet->getColumnDimension('B')->setWidth(12);
        $sheet->getColumnDimension('C')->setWidth(18);
        $sheet->getColumnDimension('D')->setWidth(18);

        // Formato general: alineación para importes
        $sheet->getStyle("B1:B{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle("C1:C{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle("D1:D{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        // Estilizar cada tabla
        foreach ($this->tableRanges as $key => $range) {
            $s = $range['start'];
            $e = $range['end'];

            // Título (fila s) - SIEMPRE en negrita
            $sheet->getStyle("A{$s}:E{$s}")->getFont()->setBold(true)->setSize(12);
            $sheet->getStyle("A{$s}:E{$s}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

            // Sub-encabezado (fila s+1) si existe y es diferente del título
            $subHeaderRow = $s + 1;
            if ($subHeaderRow <= $e) {
                $sheet->getStyle("A{$subHeaderRow}:E{$subHeaderRow}")->getFont()->setBold(true);
                $sheet->getStyle("A{$subHeaderRow}:E{$subHeaderRow}")->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFF3F4F6');
                $sheet->getStyle("A{$subHeaderRow}:E{$subHeaderRow}")->getBorders()
                    ->getBottom()->setBorderStyle(Border::BORDER_THIN);

                // Borde alrededor de la tabla (desde subheader hasta end)
                $boxStart = $subHeaderRow;
                $boxEnd = $e;
                if ($boxStart <= $boxEnd) {
                    $sheet->getStyle("A{$boxStart}:E{$boxEnd}")->getBorders()
                        ->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                }
            }
        }

        // Resaltar filas de totales y subtotal2 (que está fuera de las tablas)
        for ($i = 1; $i <= $lastRow; $i++) {
            // Obtener el valor de la celda C para verificar si es una fila de total
            $cellCValue = '';
            if (isset($this->rows[$i - 1][2])) {
                $cellCValue = $this->rows[$i - 1][2];
            }

            if (is_string($cellCValue) && (
                stripos($cellCValue, 'subtotal') !== false ||
                stripos($cellCValue, 'total') !== false ||
                stripos($cellCValue, 'neto') !== false
            )) {
                $sheet->getStyle("A{$i}:E{$i}")->getFont()->setBold(true);
                $sheet->getStyle("A{$i}:E{$i}")->getBorders()
                    ->getTop()->setBorderStyle(Border::BORDER_THIN);
                // Fondo ligeramente diferente para totales fuera de tablas
                if (stripos($cellCValue, 'subtotal2') !== false) {
                    $sheet->getStyle("A{$i}:E{$i}")->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('FFFEF7CD'); // amarillo muy suave
                }
            }
        }

        // Wrap text in column A
        $sheet->getStyle("A1:A{$lastRow}")->getAlignment()->setWrapText(true);
    }

    /**
     * Formatos numéricos por columna
     */
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER_00, // Cantidad
            'C' => NumberFormat::FORMAT_NUMBER_00, // Valor unitario
            'D' => NumberFormat::FORMAT_NUMBER_00, // Importe / totales
        ];
    }
}
