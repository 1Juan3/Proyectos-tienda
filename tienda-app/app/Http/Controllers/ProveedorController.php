<?php

namespace App\Http\Controllers;

use App\Models\Entradas;
use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Tiendas;

class ProveedorController extends Controller
{
    public function index()
    {
        // Obtener todos los proveedores
        $tiendaId = session('tienda_seleccionada');
        $proveedores = Proveedor::where('tienda_id', $tiendaId)->get();
        
        $tiendas = Tiendas::where('id', '!=', $tiendaId)->get();

        return view('proveedor.crear', compact('proveedores', 'tiendas'));
    }

    public function store(Request $request)
    {
        // Crear un nuevo proveedor con los datos del formulario
        $proveedorData = $request->except('tiendas_id');
        $proveedor = new Proveedor();
        $proveedor->fill($proveedorData);

        // Guardar el proveedor en la base de datos
        $proveedor->save();

        // Verificar si se seleccionaron tiendas adicionales
        if ($request->has('tiendas_id')) {
            foreach ($request->tiendas_id as $tiendaId) {
                // Crear un nuevo provedor para cada tienda seleccionada
                $provedorTienda = new Proveedor;

                // Llenar datos del proveedor
                $provedorTienda->fill($proveedorData);

                // Asignar la tienda_id específica
                $provedorTienda->tienda_id = $tiendaId;

                // Guardar el nuevo proveedor
                $provedorTienda->save();
            }
        }


        toastr()->success('¡El proveedor se agregó con éxito!', 'Creado');
        return redirect()->route('indexProveedore');
    }

    public function showEdit($id)
    {
        // Obtener el proveedor por su ID
        $proveedor = Proveedor::find($id);

        return view('proveedor.edit', compact('proveedor'));
    }

    public function edit(Request $request, $id)
    {
        // Obtener el proveedor por su ID
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            abort(404); // Manejar el caso de que no se encuentre el proveedor
        }

        // Actualizar la información del proveedor con los datos del formulario
        $proveedor->update($request->all());

        toastr()->success('¡El proveedor se actualizó con éxito!', 'Actualizado');
        return view('proveedor.crear', compact('proveedor'));
    }

    public function delete($id)
    {
        // Obtener el proveedor por su ID
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            abort(404); // Manejar el caso de que no se encuentre el proveedor
        }

        // Eliminar el proveedor
        $proveedor->delete();

        toastr()->error('¡El proveedor se eliminó con éxito!', 'Eliminado');
        return redirect()->route('indexProveedore');
    }

    public function showDetalle($id_proveedor)
    {
        // Obtener las entradas relacionadas con ese proveedor
        $entradas = Entradas::where('id_provedor', $id_proveedor)->with('proveedor')->get();

        // Puedes acceder a la información del proveedor directamente
        return view('proveedor.detalle', compact('entradas'));
    }
}
