<?php

namespace App\Http\Controllers;

use App\Models\Tiendas;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function index()
    {
        $tiendas = Tiendas::all();
        return view('tienda.mostrar', compact('tiendas'));
    }
    public function store(Request $request)
    {

        $nombre_tienda = $request->input('nombre_tienda');
        $logo = $request->file('logo');
        $nit = $request->input('nit');
        $email_tienda = $request->input('email_tienda');
        $telefono_tienda = $request->input('telefono_tienda');
        $direccion_tienda = $request->input('direccion_tienda');


        if ($logo) {
            $ruta_imagen_logo = $logo->storeAs('', $logo . '.webp', 'disco_imagenes');
            $tienda = new Tiendas;
            $tienda->nombre_tienda = $nombre_tienda;
            $tienda->logo = $ruta_imagen_logo;
            $tienda->nit = $nit;
            $tienda->email_tienda = $email_tienda;
            $tienda->telefono_tienda = $telefono_tienda;
            $tienda->direccion_tienda = $direccion_tienda;
            $tienda->save();
            return redirect()->route('tienda.index')->whit('creado', 'Tienda Creada Correctamente');
        }
    }

    public function verLogo($path)
    {
        // Cambiar a disco E cuando esté en el servidor.
        $rutaLogo = 'C:\images_productos_tienda\\' . $path;
        return response()->file($rutaLogo);
    }

    public function edit($id)
    {
        $tienda = Tiendas::find($id);
        return view('tienda.editar', compact('tienda'));
    }

  
    public function seleccionarTienda($id)
{
    session(['tienda_seleccionada' => $id]);
    return redirect()->route('indexPorduct', $id);

    // Resto del código
}
}
