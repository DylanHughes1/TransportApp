<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PlanillaExport;
use App\Exports\PlanillaFiltradaExport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ViajeInicial;
use App\Models\TruckDriver;
use App\Models\Solicitudes;
use App\Models\viajes;
use App\Models\InputsEditables;
use Maatwebsite\Excel\Facades\Excel;
use \Carbon\Carbon;
use App\Services\Admin\DashboardService;
use Exception;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $registro_combustible_id;
    public function __construct()
    {
        /*
         * Uncomment the line below if you want to use verified middleware
         */
        //$this->middleware('verified:admin.verification.notice');
    }

    /**
     * Muestra el inicio del admin.
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function showChoferes()
    {
        $truck_drivers_A = TruckDriver::where('empresa', 'A')->orderBy('name')->get();
        $truck_drivers_B = TruckDriver::where('empresa', 'B')->orderBy('name')->get();
        $truck_drivers_sin_empresa = TruckDriver::where('empresa', null)->orderBy('name')->get();;

        return view('admin.choferes.indexChoferes')
            ->with('truck_drivers_A', $truck_drivers_A)
            ->with('truck_drivers_B', $truck_drivers_B)
            ->with('truck_drivers_sin_empresa', $truck_drivers_sin_empresa);
    }

    public function eliminarChofer($id)
    {

        $truck_driver = TruckDriver::find($id);
        $truck_driver->delete();

        return redirect('/admin/truck-drivers');
    }

    public function asignarEmpresa(Request $request, $id)
    {

        $truck_driver = TruckDriver::find($id);
        $empresa_seleccionada = $request->get('company_name');

        if ($empresa_seleccionada === "Don Mario")
            $truck_driver->empresa = 'A';
        else if ($empresa_seleccionada === "Cereal Flet Sur")
            $truck_driver->empresa = 'B';

        $truck_driver->p_chasis = $request->get('p_chasis');
        $truck_driver->p_batea = $request->get('p_batea');

        $truck_driver->save();

        return redirect('/admin/truck-drivers');
    }

    public function autoSavePatente(Request $request, $id)
    {
        $truckDriver = TruckDriver::findOrFail($id);

        $truckDriver->{$request->input('field')} = $request->input('value');
        $truckDriver->save();

        return response()->json(['success' => true]);
    }
}
