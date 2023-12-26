<x-layout titulo="Ventas">
    <div class="container">
        <form action="{{ route('indexVentas') }}" method="GET" class="mb-4">
            <div class="input-group mt-3">
                <input type="text" class="form-control" name="query" id="searchQuery" placeholder="Buscar productos...">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </div>
        </form>

        <form action="{{ route('cart.barcode') }}" method="POST" id="barcodeForm" class="mb-4">
            @csrf
            <!-- Campo de entrada oculto para almacenar el valor leído por el escáner -->
            <input type="hidden" name="scannerBarcode" id="scannerBarcode">
        </form>
    </div>

    <div >
        <div class="row" >
            <div class="col-md-6 " style="background-color: rgba(242, 242, 242)">
                <div class="row">
                    @forelse ($productos as $item)
                    @if ($item->stock >0)
                    <div class=" col-2 col-md-4 c col-lg-3 col-sm-3 col-12 mb-1">
                        <form action="{{ route('cart.add') }}" method="post">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-link"
                                style="text-decoration: none; color: inherit; padding: 0; border: none; background: none;">
                                <div class="card  " style="width: 140px; height: 180px;">
                                    <div class="imagen">
                                        <img src="{{ route('verImagen', $item->imagen) }}" alt="imagen equipo"
                                            class="card-img-top" style="max-height: 100px; object-fit: contain;">
                                    </div>
                                    <div class="card-body text-center d-flex flex-column" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        <h5 class="card-title">{{ $item->nombre }}</h5>
                                        {{-- <p class="card-text"><b>Precio de venta:</b> {{ $item->precio_venta }}</p>
                                        <p class="card-text"><b>Codigo:</b> {{ $item->codigo }}</p>
                                        <p class="card-text"><b>Unidades:</b> {{ $item->stock }}</p> --}}
                                    </div>
                                </div>
                            </button>
                        </form>
                    </div>             
                    @endif
            
                    @empty
                        <p>No hay productos disponibles.</p>
                    @endforelse
                </div>
            </div>

            <div class="col-md-6" >
                <div class="col-sm-12 ">
                    @if (count($productosEnCarrito))
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Valor Und</th>
                                <th>Cant</th>
                                <th>Sub Total</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($productosEnCarrito as $item)

                                    <tr>
                                        <th>
                                            {{$item->options->codigo}}
                                        </th>
                                        <td>{{ $item->name }}</td>
                                        <td>${{ number_format($item->price) }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <form action="{{ route('cart.actualizar', ['id' => $item->rowId]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="text" name="qty" style="width: 50px"
                                                        value="{{ $item->qty }}" min="1">
                                                    <button type="submit" name="accion" value="incrementar"
                                                        class="btn btn-link btn-sm text-danger" style="text-decoration: none; font-size: 30px">+</button>
                                                    <button type="submit" name="accion" value="decrementar"style="text-decoration: none; font-size: 30px"
                                                        class="btn btn-link btn-sm text-danger">-</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            ${{ number_format($item->price * $item->qty) }}
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.removeitem') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->rowId }}">
                                                <button type="submit"
                                                    class="btn btn-link btn-sm text-danger"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3"></td>
                                    
                                    <td class="text-end"> <b>Total</b> </td>
                                    <td class="text-end">${{ number_format(Cart::subtotal()) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('cart.clear') }}" style="color: rgb(240, 46, 3);">Limpiar el carrito</a>
                            <a href="{{ route('facturacion') }}"  style="color: white; background-color: rgb(240, 46, 3); border-radius: 10px; border: none; padding: 10px; text-decoration: none;">Facturar</a>
                        </div>
                        
                    @else
                        <p>Carrito vacío</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enfocar el campo oculto para que cualquier escaneo se dirija a él
            document.getElementById('scannerBarcode').focus();

            // Detectar cambios en el campo oculto
            document.getElementById('scannerBarcode').addEventListener('input', function() {
                // Enviar el formulario automáticamente cuando se detecta un cambio en el campo oculto
                document.getElementById('barcodeForm').submit();
            });
        });
    </script>

</x-layout>
