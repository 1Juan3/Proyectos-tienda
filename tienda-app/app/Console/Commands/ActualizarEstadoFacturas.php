<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ventas;
use Carbon\Carbon;

class ActualizarEstadoFacturas extends Command
{
    protected $signature = 'facturas:actualizar-estado';
    protected $description = 'Actualizar estado de facturas vencidas';

    public function handle()
    {
        $facturas = Ventas::all();

        foreach ($facturas as $factura) {
            if (Carbon::now() > $factura->fecha_limite) {
                $factura->estado = 'pendiente';
                $factura->save();
            }
        }

        $this->info('Estado de facturas actualizado correctamente.');
    }
}
