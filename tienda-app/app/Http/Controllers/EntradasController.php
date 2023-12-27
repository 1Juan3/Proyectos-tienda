<?php

namespace App\Http\Controllers;

use App\Models\Entradas;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EntradasController extends Controller
{
    /**
     * Muestra el formulario para una entrada específica.
     *
     * @param  string  $codigo
     * @return \Illuminate\View\View
     */
    public function formulario($codigo)
    {
        // Obtiene la entrada con el código proporcionado y carga la relación con el producto asociado
        $entrada = Entradas::where('codigo', $codigo)->with('producto')->first();

        // Obtiene todos los proveedores
        $proveedores = Proveedor::all();

        // Retorna la vista con los datos de la entrada y la lista de proveedores
        return view('productos.formulario', compact('entrada', 'proveedores'));
    }

    /**
     * Almacena la información del formulario para una entrada específica.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $codigo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeformulario(Request $request, $codigo)
    {
        // Busca el producto con el código proporcionado
        $producto = Producto::where('codigo', $codigo)->first();
        $cantidad = $request->input('cantidad');

        // Verifica si el producto existe antes de intentar crear una nueva entrada
        if ($producto) {
            // Actualiza los valores del producto según lo ingresado en $request
            $producto->update([
                'stock' => $producto->stock + $cantidad,
                'precio_compra' => $request->input('precio_compra'),
                'precio_venta' => $request->input('precio_venta'),
            ]);

            // Crea y guarda la nueva entrada asociada al producto
            $entrada = new Entradas($request->all());
            $producto->entradas()->save($entrada);

            return redirect()->route('product.entradas')->with('success', 'Entrada ingresada exitosamente');
        } else {
            return redirect()->route('product.entradas')->with('error', 'No se encontró el producto con el código proporcionado');
        }
    }

    /**
     * Muestra la lista de entradas agrupadas por código.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene las entradas agrupadas por código, seleccionando el máximo id, nombre y created_at
        $entradas = Entradas::select('codigo', DB::raw('MAX(id) as id'), DB::raw('MAX(nombre) as nombre'), DB::raw('MAX(created_at) as created_at'))
            ->groupBy('codigo')
            ->get();

        // Retorna la vista con la lista de entradas agrupadas
        return view('productos.entradas', compact('entradas'));
    }

    /**
     * Busca las entradas asociadas a un código específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $codigo
     * @return \Illuminate\View\View
     */
    public function buscar(Request $request, $codigo)
    {
        // Busca las entradas asociadas al código proporcionado
        $tiendaIdDefault = session('tienda_seleccionada');
        $entradas = Entradas::where('codigo', $codigo)
            ->where('tienda_id', $tiendaIdDefault)
            ->get();
        

        // Retorna la vista con las entradas encontradas
        return view('productos.viewentradas', compact('entradas'));
    }
}
