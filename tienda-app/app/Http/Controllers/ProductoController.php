<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

use function Laravel\Prompts\alert;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $productos = Producto::where('nombre', 'LIKE', '%' . $query . '%')->get();
        } else {
            // Si no se proporciona un término de búsqueda, obtener todos los productos
            $productos = Producto::all();
        }

        return view('productos.agregar', compact('productos'));
    }
    public function crearProducto(Request $request)
    {
        $nombre = $request->input('nombre');

        $imagen = $request->file('imagen');
        if ($imagen) {
            $ruta_imagen_equipo = $imagen->storeAs('', $nombre . '.webp', 'disco_imagenes');
            $producto = new Producto;
            $producto->nombre = $request->input('nombre');
            $producto->codigo = $request->input('codigo');
            $producto->category_id = $request->input('category_id');
            $producto->precio_venta =  $request->input('precio_venta');
            $producto->precio_compra = $request->input('precio_compra');
            $producto->stock = $request->input('stock');
            $producto->imagen = $ruta_imagen_equipo;
            $producto->save();
            toastr()->success('¡El prducto se creo correctamente!', 'Producto nuevo');
            return redirect()->route('indexPorduct');
        } else {
            toastr()->error('El product no se agrego', 'Error');
            return redirect()->route('indexPorduct');
        }
    }
    public function verImagen($path)
    {
        //cambiar a disco E cuando este en el servidor.
        $rutaImagen = 'C:\images_productos_tienda\\' . $path;
        return response()->file($rutaImagen);
    }

    public function actualizarProducto($id)

    {

        $item = Producto::find($id);

        return view('productos.editar', compact('item'));
    }
    public function updateProducto(Request $request, $id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            abort(404); // Maneja el caso de que no se encuentre equipo
        }
        $producto->update($request->all());
        toastr()->warning('¡El prducto se actualizo correctamente!', 'Actualizado');
        return redirect()->route('indexPorduct');
    }
    public function delete($id)
    {

        Producto::where('id', $id)->delete();

        return redirect()->route('indexPorduct')->with('eliminar', 'ok');
    }
}
