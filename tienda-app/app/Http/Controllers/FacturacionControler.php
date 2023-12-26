<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
Use App\Models\Client;
use App\Models\Ventas;
use Illuminate\Support\Facades\DB;
use App\Models\Abonos;
use Illuminate\Support\Str; // Importa la clase Str para generar UUID
class FacturacionControler extends Controller
{
    public function store (Request $request){
        $productosEnCarrito = Cart::content();

        $clientes = Client::all();
        
        return view('ventas.tablacarrito', compact('productosEnCarrito', 'clientes'));
    }

    public function facturacion(Request $request)
    {
        // Obtener los datos del formulario
        $cliente_id = $request->input('id');
        $tiempo = $request->input('tiempo');
        $tipo_venta = $request->input('tipo_venta');
        if ($tipo_venta == 'Contado') {
            $estado = 'Pagado';
        } elseif ($tipo_venta == 'Credito') {
            $estado = 'Proceso';
        }
        // Obtener el cliente
        $cliente = Client::find($cliente_id);
    
        // Obtener los productos en el carrito
        $productosEnCarrito = Cart::content();
    
        // Generar un identificador único para la venta

        $uuid = Str::uuid();
        $ventaId = substr($uuid, 0, 6);
        // Procesar cada producto en el carrito
        $totalVenta = 0;

        foreach ($productosEnCarrito as $producto) {
            // Calcular descuentos y precios con descuento
            $descuentoProducto = $producto->price * $producto->qty * ($cliente->porcentaje / 100);
            $precioConDescuento = $producto->price - ($producto->price * ($cliente->porcentaje / 100));
            $subtotalConDescuento = $precioConDescuento * $producto->qty;
            $totalVenta += $subtotalConDescuento;
            // Crear una nueva venta para cada producto
            if($tipo_venta == 'Contado '){
                $totalVenta= 0;
            }
            $venta = new Ventas;
            $venta->venta_id = $ventaId;
            $venta->cliente_id = $cliente_id;
            $venta->producto_id = $producto->id;
            $venta->cantidad = $producto->qty;
            $venta->fecha_limite = $tiempo;
            $venta->tipo_venta = $tipo_venta;
            $venta->estado = $estado;
            $venta->descuento = $descuentoProducto;
            $venta->subtotal = $subtotalConDescuento;
            $venta->total = $totalVenta;
            $venta->save();
    
           

        }
        Cart::destroy();
    
    
        

        // Redirigir con un mensaje de éxito y los datos necesarios
        return redirect()->route('historial')->with([
            'success' => 'Factura generada exittosamente',
        ]);
    }
    

    public function facturaIndex($id){
        $ventas = Ventas::where('venta_id', $id)->distinct('venta_id')->get();
        
        return view('ventas.factura', compact('ventas'));
    }

    public function indexVentas()
    {
        $ventas = Ventas::all()->unique('venta_id');
        
    
        return view('ventas.historial', compact('ventas'));
    }
    public function abono(Request $request, $venta_id)
    {
        $pago = $request->input('pago');
    
        // Actualizar todos los registros con el mismo venta_id
        Ventas::where('venta_id', $venta_id)->update(['total' => DB::raw('total - ' . $pago)]);
    
        $venta = Ventas::where('venta_id', $venta_id)->first();
    
        if ($venta->estado != 'pagado' && $venta->total <= 0) {
            $venta->estado = 'pagado';
            $venta->save();
        }
        $abono = new Abonos;
        $abono->monto = $pago;
        $abono->venta_id = $venta_id;
        $abono->total = $venta->total;
        $abono->save();
        return redirect()->route('historial')->with([
            'success' => 'Abono o pago realizado exitosamente ',
        ]);
    }
    
    public function abonoView($venta_id){
    
        return view('ventas.abono', compact('venta_id'));
    }
    
    public function historialAbonos($id){
    
       $ventas = Ventas::where('venta_id', $id)->get();
       return view('ventas.tablaabonos', compact('ventas'));
    }
    
}
