<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Tiendas;

class ClientController extends Controller
{
    /**
     * Muestra la lista de clientes.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        // Obtiene todos los clientes desde la base de datos
        $tiendaId = session('tienda_seleccionada');
        $clientes = Client::where('tienda_id', $tiendaId)->get();
        $tiendaId = session('tienda_seleccionada');

        $tiendas = Tiendas::where('id', '!=', $tiendaId)->get();

        // Retorna la vista con la lista de clientes
        return view('clientes.crear', compact('clientes', 'tiendas'));
    }

    /**
     * Crea un nuevo cliente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function crearCliente(Request $request)
    {
        // Obtener datos del formulario excepto tienda_id
        $clienteData = $request->except('tiendas_id');

        // Guardar el cliente principal
        $cliente = new Client;
        $cliente->fill($clienteData);
        $cliente->save();

        // Verificar si se seleccionaron tiendas adicionales
        if ($request->has('tiendas_id')) {
            foreach ($request->tiendas_id as $tiendaId) {
                // Crear un nuevo cliente para cada tienda seleccionada
                $clienteTienda = new Client;

                // Llenar datos del cliente
                $clienteTienda->fill($clienteData);

                // Asignar la tienda_id específica
                $clienteTienda->tienda_id = $tiendaId;

                // Guardar el nuevo cliente
                $clienteTienda->save();
            }
        }

        // Redirige a la página de la lista de clientes
        return redirect()->route('indexClient');
    }


    /**
     * Muestra el formulario de actualización para un cliente específico.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function verActualizar($id)
    {
        // Busca el cliente por su ID
        $cliente = Client::find($id);

        // Si no se encuentra el cliente, muestra un error 404
        if (!$cliente) {
            abort(404);
        }

        // Retorna la vista de edición con los datos del cliente
        return view('clientes.editar', compact('cliente'));
    }

    /**
     * Actualiza la información de un cliente específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCliente(Request $request, $id)
    {
        // Busca el cliente por su ID
        $cliente = Client::find($id);

        // Si no se encuentra el cliente, muestra un error 404
        if (!$cliente) {
            abort(404);
        }

        // Actualiza los atributos del cliente con los nuevos datos del formulario
        $cliente->update($request->all());

        // Muestra un mensaje de advertencia
        toastr()->warning('¡El cliente se actualizó con éxito!', 'Actualizado');

        // Redirige a la página de la lista de clientes
        return redirect()->route('indexClient');
    }

    /**
     * Elimina un cliente específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        // Busca el cliente por su ID
        $cliente = Client::find($id);

        // Si no se encuentra el cliente, muestra un error 404
        if (!$cliente) {
            abort(404);
        }

        // Elimina el cliente de la base de datos
        $cliente->delete();

        // Muestra un mensaje de error
        toastr()->error('¡El cliente se eliminó con éxito!', 'Actualizado');

        // Redirige a la página de la lista de clientes
        return redirect()->route('indexClient');
    }
}
