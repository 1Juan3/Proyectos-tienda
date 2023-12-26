<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Cart;

class VentasController extends Controller
{
    // public function index(Request $request)
    // {


    //     return view('ventas.productos', );
    // }

    public function add(Request $request)
    {
        $producto = Producto::find($request->producto_id);
        

        Cart::add(
            $producto->id,
            $producto->nombre,
            1,
            $producto->precio_venta,
            array("codigo" => $producto->codigo)
        );
        $stock = $producto->stock - 1;
        $producto->update(['stock' => $stock]);

        return back()->with('success', "$producto->nombre ¡se ha agregado con éxito al carrito!");
    }
    public function barcode(Request $request)
    {
        // Buscar el producto por el código escaneado
        $producto = Producto::where('codigo', $request->scannerBarcode)->first();
        $rutaImagen = 'http://127.0.0.1:8000/imagenproducto\\' . $producto->imagen;
        if ($producto) {
            // Agregar el producto al carrito u realizar otras acciones según tus necesidades
            // Por ejemplo, puedes usar el método Cart::add() para agregarlo al carrito
            Cart::add([
                $producto->id,
                $producto->nombre,
                1,
                $producto->precio_venta,
                array("urlfoto" => $rutaImagen)
                // Otras propiedades del producto que desees agregar al carrito
            ]);

            return back()->with('success', 'Producto agregado al carrito.');
        } else {
            return back()->with('error', 'Producto no encontrado.');
        }
    }

    public function cart(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $productos = Producto::where('nombre', 'LIKE', '%' . $query . '%')->get();
        } else {
            // Si no se proporciona un término de búsqueda, obtener todos los productos
            $productos = Producto::all();
        }
        $productosEnCarrito = Cart::content();
        // dd($productosEnCarrito);
        return view('ventas.productos', ['productos' => $productos], compact('productosEnCarrito'));
    }

    public function removeitem(Request $request)
    {
        $rowId = $request->id;
        $productosEnCarrito = Cart::content();
        $stock = $productosEnCarrito[$rowId]->qty;
        $productId = $productosEnCarrito[$rowId]->id;
        $product = Producto::find($productId);
         $stock = $product->stock + $stock;
        $product->update(['stock' => $stock]);
        
        Cart::remove($rowId);

        return back()->with('error', "Producto eliminado con éxito de su carrito.");
    }

    public function clear()
    {   
        $productosEnCarrito = Cart::content();
    
        foreach ($productosEnCarrito as $producto) {
            $productId = $producto->id;
            $qty = $producto->qty;
    
            $product = Producto::find($productId);
    
            // Ajustar el stock en el modelo Producto
            $product->stock += $qty;
            $product->save();
        }
    
        // Limpiar el carrito
        Cart::destroy();
    
        return back()->with('success', "El carrito se vació con éxito y los productos se devolvieron al stock.");
    }
    

    // public function incrementar(Request $request)
    // {
    //     $rowId = $request->id;
    //     $item = Cart::get($rowId);
    //     $qty = $item->qty + 1;

    //     Cart::update($rowId, $qty);

    //     return back()->with('success', "Cantidad actualizada con éxito.");
    // }

    // public function decrementar(Request $request)
    // {
    //     $rowId = $request->id;
    //     $item = Cart::get($rowId);
    //     $qty = $item->qty - 1;

    //     Cart::update($rowId, $qty);

    //     return back()->with('success', "Cantidad actualizada con éxito.");
    // }
    public function Quantyti(Request $request, $rowId)
    {
        $item = Cart::get($rowId);
        $qty = floatval($request->qty);
    
        $producId = $item->id;
        $product = Producto::find($producId);
    
        // Verificar si estamos incrementando o decrementando
        if ($request->accion == 'incrementar') {
            $stock = $product->stock - $qty;
            $qty = $item->qty + $qty;
           
        } elseif ($request->accion == 'decrementar') {
            $stock = $product->stock + $qty;
            $qty = $item->qty - $qty;
            
        }
    
        Cart::update($rowId, $qty);
    
        // Actualizar el modelo Producto con el nuevo valor de stock
        $product->update(['stock' => $stock]);
    
        return back()->with('success', "Cantidad actualizada con éxito.");
    }
    
}
