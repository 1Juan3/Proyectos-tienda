<?php

namespace App\Http\Controllers;

use App\Models\Entradas;
use Illuminate\Http\Request;
use    App\Models\Proveedor;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedor.crear', compact('proveedores'));
    }

    public function store(Request $request)
    {

        $proveedor = new Proveedor();
        $proveedor->fill($request->all());

        // Guardar el cliente en la base de datos
        $proveedor->save();
        toastr()->success('¡El proveedor  se agrego con exito !', 'Creado');
        return redirect()->route('indexProveedore');
    }

    public function showEdit($id)
    {
        $proveedor = Proveedor::find($id);

        return view('proveedor.edit', compact('proveedor'));
    }
    public function edit(Request $request, $id)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            abort(404); // Maneja el caso de que no se encuentre cliente
        }

        $proveedor->update($request->all());
        toastr()->success('¡El proveedor  se actualizo con exito !', 'Actualizado');
        return view('proveedor.crear', compact('proveedor'));
    }

    public function delete($id)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            abort(404); // Maneja el caso de que no se encuentre cliente
        }
        $proveedor->delete();
        toastr()->error('¡El proveedor se elimino con exito!', 'Actualizado');
        return redirect()->route('indexProveedore');
    }
    public function showDetalle($id_provedor)
    {
        // Obtén el proveedor
        $entradas = Entradas::where('id_provedor', $id_provedor)->with('proveedor')->get();
    
        // Obtén las entradas relacionadas con ese proveedor
       
    
        // Puedes acceder a la información del proveedor directamente
        
    
        return view('proveedor.detalle', compact( 'entradas'));
    }
    
}
