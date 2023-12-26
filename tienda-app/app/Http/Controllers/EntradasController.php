<?php

namespace App\Http\Controllers;

use App\Models\Entradas;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class EntradasController extends Controller

{
   public function formulario($codigo){
    $entrada = Entradas::where('codigo', $codigo)->with('producto')->first();
    $proveedores = Proveedor::all();
        return view('productos.formulario', compact('entrada', 'proveedores'));
    }
    public function storeformulario(Request $request, $codigo) {
        $producto = Producto::where('codigo', $codigo)->first();
        $cantidad = $request->input('cantidad');
        // Verifica si el producto existe antes de intentar crear una nueva entrada
        if ($producto) {
            // Actualiza los valores según lo que se ingresa en $request
            $producto->update([
                'stock' => $producto->stock + $cantidad,
                'precio_compra' => $request->input('precio_compra'),
                'precio_venta' => $request->input('precio_venta'),
            ]);
    
            // Crea y guarda la nueva entrada
            $entrada = new Entradas($request->all());
            $producto->entradas()->save($entrada);
    
            return redirect()->route('product.entradas')->with('success', 'Entrada ingresada exitosamente');
        } else {
            return redirect()->route('product.entradas')->with('error', 'No se encontró el producto con el código proporcionado');
        }
    }
    
    public function index(){
        
        
        $entradas = Entradas::select('codigo', DB::raw('MAX(id) as id'), DB::raw('MAX(nombre) as nombre'), DB::raw('MAX(created_at) as created_at'))
        ->groupBy('codigo')
        ->get();
       
        return view('productos.entradas', compact('entradas'));

    }
    public function buscar(Request $request, $codigo){
        
        
        $entradas = Entradas::where('codigo', $codigo)->get();
        
        return view('productos.viewentradas', compact('entradas'));
    }

}
