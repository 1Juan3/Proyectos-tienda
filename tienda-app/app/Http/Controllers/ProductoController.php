<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        $rutaImagen = 'E:\imagenes_productos_tienda\\';
        return view('productos.agregar', compact('productos'), ['rutaImagen' => $rutaImagen]);
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
            $producto->categoria = $request->input('categoria');
            $producto->precio_venta =  $request->input('precio_venta');
            $producto->precio_compra = $request->input('precio_compra');
            $producto->stock = $request->input('stock');
            $producto->imagen = $ruta_imagen_equipo;
            $producto->save();
            session()->flash('status', 'Producto guardado exitosamente');
            return redirect()->route('indexPorduct');
        } else {
            session()->flash('status1', 'No se pudo guardar el producto');
            return redirect()->route('indexPorduct');
        }
    }
}
