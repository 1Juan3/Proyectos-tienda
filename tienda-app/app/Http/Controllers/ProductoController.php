<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Entradas;
use App\Models\Tiendas;

use function Laravel\Prompts\alert;
use Cart;


class ProductoController extends Controller
{
    public function index(Request $request)
    {    
        $query = $request->input('query');

        if ($query) {
            $productos = Producto::where('nombre', 'LIKE', '%' . $query . '%')->get();
        } else {

        
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
            $producto->tienda_id = null;
            $producto->nombre = $request->input('nombre');
            $producto->codigo = $request->input('codigo');
            $producto->category_id = $request->input('category_id');
            $producto->precio_venta =  $request->input('precio_venta');
            $producto->precio_compra = $request->input('precio_compra');
            $producto->stock = $request->input('stock');
            $producto->imagen = $ruta_imagen_equipo;
            $producto->save();
            $entrada = new Entradas;
            $entrada ->codigo = $request->input('codigo');
            $entrada ->producto_id = $request->input('codigo');
            $entrada ->nombre = $request->input('nombre');
            $entrada ->precio_compra = $request->input('precio_compra');
            $entrada ->precio_venta = $request->input('precio_venta');
            $entrada ->cantidad = $request->input('stock');
            $entrada ->save();
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
    public function pasarProducto(Request $request, $producto_id)
    {
        $tienda_id = $request->input('tienda_id');
        $cantidad = $request->input('cantidad');
        // Obtener el producto original
        $productoOriginal = Producto::find($producto_id);
    
        // Duplicar el producto original con replicate
        $nuevoProducto = $productoOriginal->replicate();
    
        // Asignar la nueva tienda al nuevo producto
        $nuevoProducto->tienda_id = $tienda_id;
    
        // Guardar el nuevo producto
        $nuevoProducto->save();
    
        // Restar la cantidad del producto original
        $cantidadADescontar = 1; // Puedes ajustar esto según tus necesidades
        $productoOriginal->decrement('cantidad', $cantidadADescontar);
    
        // Redireccionar o mostrar la vista
        return view('productos.pasar', compact('nuevoProducto'));
    }
    public function delete($id)
    {

        Producto::where('id', $id)->delete();

        return redirect()->route('indexPorduct')->with('eliminar', 'ok');
    }
}
