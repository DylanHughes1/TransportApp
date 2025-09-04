<?php

namespace App\Services\Admin;

use App\Models\{TruckDriver, Admin};

class DashboardService
{
    //use UtilTrait;

    private static $instances = [];

    protected function __construct() {}

    public static function getInstance(): DashboardService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function showChoferes()
    {
        $truck_drivers_A = TruckDriver::where('empresa', 'A')->orderBy('name')->get();
        $truck_drivers_B = TruckDriver::where('empresa', 'B')->orderBy('name')->get();
        $truck_drivers_sin_empresa = TruckDriver::where('empresa', null)->orderBy('name')->get();;

        return
            [
                'truck_drivers_A' => $truck_drivers_A,
                'truck_drivers_B' => $truck_drivers_B,
                'truck_drivers_sin_empresa' => $truck_drivers_sin_empresa
            ];
    }

    public function showPermisos()
    {

        $admins = Admin::select('id', 'name', 'subrole')->get();
        $truck_drivers = TruckDriver::select('id', 'name')->get();

        return
            [
                'admins' => $admins,
                'truck_drivers' => $truck_drivers
            ];
    }

    public function updateAdminSubrol($data, $id)
    {

        $admin = Admin::findOrFail($id);
        $admin->subrole = $data->subrol;
        $admin->save();
    }

    public function destroyTruckDriver($id)
    {
        $driver = TruckDriver::findOrFail($id);
        $driver->delete();
    }

    public function eliminarChofer($id)
    {
        $truck_driver = TruckDriver::find($id);
        $truck_driver->empresa = null;
        $truck_driver->save();
    }

    public function asignarEmpresa($data, $id)
    {

        $truck_driver = TruckDriver::find($id);
        $empresa_seleccionada = $data->get('company_name');

        if ($empresa_seleccionada === "Don Mario")
            $truck_driver->empresa = 'A';
        else if ($empresa_seleccionada === "Cereal Flet Sur")
            $truck_driver->empresa = 'B';

        $truck_driver->p_chasis = $data->get('p_chasis');
        $truck_driver->p_batea = $data->get('p_batea');

        $truck_driver->save();
    }

    public function autoSavePatente($data, $id)
    {
        $truckDriver = TruckDriver::findOrFail($id);

        $truckDriver->{$data->input('field')} = $data->input('value');
        $truckDriver->save();
    }
}
