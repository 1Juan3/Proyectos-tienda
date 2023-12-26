<?php

namespace App\Http\Controllers;

use App\Models\Tiendas;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function index()
    {   $tiendas = Tiendas::all();
        return view('tienda.crear' , compact('tiendas'));
    }
    public function store(Request $request){

        $tienda = new Tiendas;
        $tienda->nombre = $request->nombre;
        $tienda->save();
        return redirect()->route('tienda.index')->whit('creado', 'Tienda Creada Correctamente');
    }
    
}
