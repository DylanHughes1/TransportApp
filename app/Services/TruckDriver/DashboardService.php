<?php

namespace App\Services\TruckDriver;

use App\Models\{TruckDriver, Solicitudes};


class DashboardService
{
    //use UtilTrait;

    private static $instances = [];

    protected function __construct()
    {
    }

    public static function getInstance(): DashboardService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function index()
    {
        $solicitudes = Solicitudes::where('truckdriver_id', auth()->user()->id)->get();
        $cantidadSolicitudes = $solicitudes->count();

        return [
            'solicitudes' => $solicitudes, 
            'cantidadSolicitudes' => $cantidadSolicitudes,
        ];
    }

    public function quitarEmpresa($id)
    {
        $truck_driver = TruckDriver::findOrFail($id);
        $truck_driver->empresa = null;

        return $truck_driver->save();
    }
}