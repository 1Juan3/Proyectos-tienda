<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Entradas;
use App\Models\Tiendas;
use App\Models\User;
use App\Models\Tranferencias;
class ProductoController extends Controller
{
    public function index(Request $request)
    {    
        $query = $request->input('query');

        // Filtrar productos por nombre si se proporciona una consulta
        if ($query) {
            $productos = Producto::where('nombre', 'LIKE', '%' . $query . '%')->get();
        } else {
            // Obtener todos los productos
            // Obtén el id de la tienda desde la sesión
            $tiendaId = session('tienda_seleccionada');

            $tiendas = Tiendas::where('id', '!=', $tiendaId)->get();

            // Filtra los productos por el id de la tienda
            $productos = Producto::where('tienda_id', $tiendaId)->get();
            
        }

        return view('productos.agregar', compact('productos', 'tiendas'));
    }

    public function crearProducto(Request $request)
    {
        // Obtener datos del formulario
        $nombre = $request->input('nombre');
        $codigo = $request->input('codigo');
        $category_id = $request->input('category_id');
        $precio_venta = $request->input('precio_venta');
        $precio_compra = $request->input('precio_compra');
        $stock = $request->input('stock');
        $imagen = $request->file('imagen');
    
        // Procesar imagen y crear producto para la tienda por defecto
        $tiendaIdDefault = session('tienda_seleccionada');
        $productoDefault = new Producto;
        $productoDefault->tienda_id = $tiendaIdDefault;
        $productoDefault->nombre = $nombre;
        $productoDefault->codigo = $codigo;
        $productoDefault->category_id = $category_id;
        $productoDefault->precio_venta = $precio_venta;
        $productoDefault->precio_compra = $precio_compra;
        $productoDefault->stock = $stock;
        
        if ($imagen) {
            $ruta_imagen_default = $imagen->storeAs('', $nombre . '.webp', 'disco_imagenes');
            $productoDefault->imagen = $ruta_imagen_default;
        }
    
        $productoDefault->save();
    
        // Crear una entrada para el nuevo producto en la tienda por defecto
        $entradaDefault = new Entradas;
        $entradaDefault->codigo = $codigo;
        $entradaDefault->tienda_id = $tiendaIdDefault;
        $entradaDefault->producto_id = $codigo;
        $entradaDefault->nombre = $nombre;
        $entradaDefault->precio_compra = $precio_compra;
        $entradaDefault->precio_venta = $precio_venta;
        $entradaDefault->cantidad = $stock;
        $entradaDefault->save();
    
        // Verificar si se seleccionó alguna tienda adicional
        if ($request->has('tienda_id')) {
            
            
            foreach ($request->tienda_id as $tiendaId) {
                // Procesar imagen y crear producto para tiendas seleccionadas
                $productoTiendaSeleccionada = new Producto;
                $productoTiendaSeleccionada->tienda_id = $tiendaId;
                $productoTiendaSeleccionada->nombre = $nombre;
                $productoTiendaSeleccionada->codigo = $codigo;
                $productoTiendaSeleccionada->category_id = $category_id;
                $productoTiendaSeleccionada->precio_venta = $precio_venta;
                $productoTiendaSeleccionada->precio_compra = $precio_compra;
                $productoTiendaSeleccionada->stock = $stock;
    
                if ($imagen) {
                    $ruta_imagen_tienda = $imagen->storeAs('', $nombre . '_tienda_' . $tiendaId . '.webp', 'disco_imagenes');
                    $productoTiendaSeleccionada->imagen = $ruta_imagen_tienda;
                }
    
                $productoTiendaSeleccionada->save();
    
                // Crear una entrada para el nuevo producto en tiendas seleccionadas
                $entradaTiendaSeleccionada = new Entradas;
                $entradaTiendaSeleccionada->codigo = $codigo;
                $entradaTiendaSeleccionada->tienda_id = $tiendaId;
                $entradaTiendaSeleccionada->producto_id = $codigo;
                $entradaTiendaSeleccionada->nombre = $nombre;
                $entradaTiendaSeleccionada->precio_compra = $precio_compra;
                $entradaTiendaSeleccionada->precio_venta = $precio_venta;
                $entradaTiendaSeleccionada->cantidad = $stock;
                $entradaTiendaSeleccionada->save();
            }
        }
    
        toastr()->success('¡El producto se creó correctamente!', 'Producto nuevo');
        return redirect()->route('indexPorduct', $tiendaIdDefault);
    }
    

    public function verImagen($path)
    {
        // Cambiar a disco E cuando esté en el servidor.
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
        $tiendaIdDefault = session('tienda_seleccionada');
        $producto = Producto::find($id);
        if (!$producto) {
            abort(404); // Maneja el caso de que no se encuentre el producto
        }
        $producto->update($request->all());
        toastr()->warning('¡El producto se actualizó correctamente!', 'Actualizado');
        return redirect()->route('indexPorduct', $tiendaIdDefault);
    }

    public function transferirProducto(Request $request, $producto_id)
    {
        $tiendaIds = $request->input('tienda_id');
        $stock = $request->input('stock');
        $productoOriginal = Producto::find($producto_id);
    
        foreach ($tiendaIds as $tiendaId) {
            // Verificar si el producto ya existe en la tienda
            $productoExistente = Producto::where('tienda_id', $tiendaId)
                ->where('nombre', $productoOriginal->nombre)
                ->first();
    
            if ($productoExistente) {
                // Si el producto ya existe, simplemente actualiza la cantidad
                $productoExistente->increment('stock', $stock);
            } else {
                // Si el producto no existe, duplica el producto original
                $nuevoProducto = $productoOriginal->replicate();
                $nuevoProducto->tienda_id = $tiendaId;
                $nuevoProducto->stock = $stock;
                $nuevoProducto->save();
            }
            $tiendaIdDefault = session('tienda_seleccionada');
            $tiendaPrincipal = Tiendas::find($tiendaIdDefault);
            $tiendaTrasfe = Tiendas::find($tiendaId);
            $nombre_tienda1= $tiendaTrasfe->nombre_tienda;
            $nombre_producto = $productoOriginal->nombre;
            $transferencia = New Tranferencias();
            $transferencia->nombre_producto = $nombre_producto;
            $transferencia->nombre_tienda = $tiendaPrincipal->nombre_tienda;
            $transferencia->nombre_tienda1 = $nombre_tienda1;
            $transferencia->stock = $stock;
            $transferencia->save();

        }
    
        // Restar la cantidad del producto original
        $productoOriginal->decrement('stock', $stock);
    
        // Redireccionar o mostrar la vista
        $tiendaIdDefault = session('tienda_seleccionada');
        return redirect()->route('indexPorduct', $tiendaIdDefault);
    }

    public function historialPasar(){
        $transferencias = Tranferencias::all();
        return view('productos.viewpasar', compact('transferencias'));
    }
    

    public function viewPasar($id){
        $producto = Producto::find($id);
        $tiendaId = session('tienda_seleccionada');

        $tiendas = Tiendas::where('id', '!=', $tiendaId)->get();
        
        return view('productos.tranferir', compact('tiendas', 'producto'));
    }
    

    public function delete($id)
    {
        Producto::where('id', $id)->delete();
        return redirect()->route('indexPorduct')->with('eliminar', 'ok');
    }
}
