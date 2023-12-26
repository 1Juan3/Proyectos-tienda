<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventas;
use App\Models\Abonos;
class LayoutController extends Controller
{
    public function index($id)
    {
        return view('components.layout', compact('id'));
    }

    public function historialAbonos($id)
    {
        $abonos = Abonos::where('venta_id', $id)->get();
    
        // Iterar sobre la colección de abonos y cargar la relación 'venta' para cada uno
     
    
        return view('ventas.tablaabonos', compact('abonos'));
    }
}
