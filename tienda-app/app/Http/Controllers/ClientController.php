<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        $clientes = Client::all();
        return view('clientes.crear', compact('clientes'));
    }
    public function crearCliente(Request $request)
    {
        $cliente = new Client;
        $cliente->fill($request->all());

        // Guardar el cliente en la base de datos
        $cliente->save();
        toastr()->success('¡El Cliente  se agrego con exito correctamente!', 'Creado');
        return redirect()->route('indexClient');
    }

    public function verActualizar($id)
    {
        $cliente = Client::find($id);
        if (!$cliente) {
            abort(404); // Maneja el caso de que no se encuentre cliente
        }
        return view('clientes.editar', compact('cliente'));
    }
    public function updateCliente(Request $request, $id)
    {
        $cliente = Client::find($id);
        if (!$cliente) {
            abort(404); // Maneja el caso de que no se encuentre equipo
        }
        $cliente->update($request->all());
        toastr()->warning('¡El cliente se actualizo con exito!', 'Actualizado');
        return redirect()->route('indexClient');
    }
    public function delete($id)
    {
        $cliente = Client::find($id);
        if (!$cliente) {
            abort(404); // Maneja el caso de que no se encuentre cliente
        }
        $cliente->delete();
        toastr()->error('¡El cliente se elimino con exito!', 'Actualizado');
        return redirect()->route('indexClient');
    }
}
