<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Cart;

class VentasController extends Controller
{
    public function add(Request $request)
    {
        // Buscar el producto por su ID
        $producto = Producto::find($request->producto_id);

        // Agregar el producto al carrito
        Cart::add(
            $producto->id,
            $producto->nombre,
            1,
            $producto->precio_venta,
            array("codigo" => $producto->codigo)
        );

        // Actualizar el stock del producto
        $stock = $producto->stock - 1;
        $producto->update(['stock' => $stock]);

        return back()->with('success', "$producto->nombre ¡se ha agregado con éxito al carrito!");
    }

    public function barcode(Request $request)
    {
        // Buscar el producto por el código escaneado
        $producto = Producto::where('codigo', $request->scannerBarcode)->first();

        if ($producto) {
            // Agregar el producto al carrito u realizar otras acciones según tus necesidades
            Cart::add([
                $producto->id,
                $producto->nombre,
                1,
                $producto->precio_venta,
                array("urlfoto" => $producto->imagen)
            ]);

            return back()->with('success', 'Producto agregado al carrito.');
        } else {
            return back()->with('error', 'Producto no encontrado.');
        }
    }

    public function cart(Request $request)
    {
        // Obtener todos los productos o buscar por término de búsqueda
        $query = $request->input('query');
        $productos = $query ? Producto::where('nombre', 'LIKE', '%' . $query . '%')->get() : Producto::all();

        // Obtener los productos en el carrito
        $productosEnCarrito = Cart::content();

        return view('ventas.productos', compact('productos', 'productosEnCarrito'));
    }

    public function removeitem(Request $request)
    {
        // Obtener el ID del elemento a eliminar del carrito
        $rowId = $request->id;

        // Obtener información del producto en el carrito
        $productosEnCarrito = Cart::content();
        $stock = $productosEnCarrito[$rowId]->qty;
        $productId = $productosEnCarrito[$rowId]->id;

        // Actualizar el stock del producto en la base de datos
        $product = Producto::find($productId);
        $stock = $product->stock + $stock;
        $product->update(['stock' => $stock]);

        // Eliminar el producto del carrito
        Cart::remove($rowId);

        return back()->with('error', "Producto eliminado con éxito de su carrito.");
    }

    public function clear()
    {
        // Devolver los productos al stock y limpiar el carrito
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

    public function Quantyti(Request $request, $rowId)
    {
        // Obtener el item del carrito
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

        // Actualizar el carrito con la nueva cantidad
        Cart::update($rowId, $qty);

        // Actualizar el modelo Producto con el nuevo valor de stock
        $product->update(['stock' => $stock]);

        return back()->with('success', "Cantidad actualizada con éxito.");
    }
}
