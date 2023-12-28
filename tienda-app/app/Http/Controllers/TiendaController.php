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
    public function indexTienda()
    {
        $tiendas = Tiendas::all();
        return view('tienda.crear', compact('tiendas'));
    }
    public function store(Request $request)
    {
        $nombre_tienda = $request->input('nombre_tienda');
        $logo_tienda = $request->file('logo');
        $nit = $request->input('nit_tienda');
        $email_tienda = $request->input('email_tienda');
        $telefono_tienda = $request->input('telefono_tienda');
        $direccion_tienda = $request->input('direccion_tienda');
    
        if ($logo_tienda) {
            // Genera un nombre único para el archivo
            $ruta_imagen_tienda = $logo_tienda->storeAs('', $nombre_tienda . '_tienda_'  . '.webp', 'disco_imagenes');
            // Almacena la imagen con el nombre único
           
    
            $tienda = new Tiendas;
            $tienda->nombre_tienda = $nombre_tienda;
            $tienda->logo_tienda = $ruta_imagen_tienda;
            $tienda->nit_tienda = $nit;
            $tienda->email_tienda = $email_tienda;
            $tienda->telefono_tienda = $telefono_tienda;
            $tienda->direccion_tienda = $direccion_tienda;
            $tienda->save();
    
            return redirect()->route('index.tiendas')->with('creado', 'Tienda Creada Correctamente');
        }
    }
    

    public function verLogo($path)
    {
        // Cambiar a disco E cuando esté en el servidor.
        $rutaLogo = 'C:\images_productos_tienda\\' . $path;
        return response()->file($rutaLogo);
    }

    public function edit(Request $request, $id)
    {
            
        $tienda = Tiendas::find($id);
    
        if (!$tienda) {
            abort(404); // Maneja el caso de que no se encuentre la tienda
        }
        
        $tienda->update($request->all());
            toastr()->warning('¡La tienda se actualizó correctamente!', 'Actualizado');
       
    
        return redirect()->route('index.tiendas');
     
    }

    public function update(Request $request, $id) {
       
        $tienda = Tiendas::find($id);
        return view('tienda.editar', compact('tienda'));
    }
    
    public function destroy($id){
        $tienda = Tiendas::find($id);
        $tienda->delete();
        return redirect()->route('index.tiendas')->with('eliminar', 'ok');
    }

  
    public function seleccionarTienda($id)
{
    session(['tienda_seleccionada' => $id]);
    return redirect()->route('indexPorduct', $id);

    // Resto del código
}
}
