<x-layout titulo="Facturar">
  <div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="bd-example">
                <table class="table table-dark table-hover">
                    <thead class="table-warning">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productosEnCarrito as $index => $producto)
                            <tr>
                                <th scope="row"></th>
                                <td>{{ $producto->name }}</td>
                                <td>{{ $producto->qty }}</td>
                                <td>{{number_format($producto->price, 2) }}</td>
                                <td>{{ number_format($producto->price * $producto->qty, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            
            <form action="{{ route('facturacion') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="cliente" class="form-label">Seleccione el cliente a facturar</label>
                    <select class="form-select"  name="id">
                        <option disabled >Seleccione el cliente a facturar</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}" selected>{{ $cliente->nombre_completo }}</option>
                        @endforeach
                    </select>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control"
                            id="floatingInput2"placeholder="Precio al que se vende" name="tiempo" >
                        <label>Ingrese la fecha limite de pago</label>
                    </div>
                    <select class="form-select" name="tipo_venta">
                        <option disabled >Seleccione el tipo de venta</option>
                        <option value="Contado" selected>Contado</option>
                        <option value="Credito">Crédito</option>
                    </select>
                </div>
                <button type="submit"   style="color: white; background-color: rgb(240, 46, 3); border-radius: 10px; border: none; padding: 10px; ">Generar Factura</button>
            </form>
        </div>
    </div>
  </div>
  
</x-layout>
