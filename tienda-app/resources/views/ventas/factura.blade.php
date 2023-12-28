<x-layout titulo="Factura">
    <div class="text-center mt-4">
        <button class="btn btn-primary mb-4" onclick="imprimirFactura()">Imprimir Factura</button>
    </div>

    <!-- Datos de la Tienda -->
    <div class="container-fluid">
        <div class="row">
            <div class="container-flid">
                
                <p><strong>Nombre:</strong> {{ $tienda->nombre_tienda }}</p>
                <p><strong>Dirección:</strong> {{ $tienda->direccion_tienda }}</p>
                <p><strong>Teléfono:</strong> {{ $tienda->telefono_tienda }}</p>
                <p><strong>Email:</strong> {{ $tienda->email_tienda }}</p>
                <p><strong>NIT:</strong> {{ $tienda->nit_tienda }}</p>
            </div>
        </div>
    </div>

    <div class="bd-example">
        <!-- Tabla de Detalles de la Factura -->
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Descuento</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp

                @foreach ($ventas as $item)
                    <tr>
                        <th scope="row"></th>
                        <td>{{ $item->producto->nombre }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>${{ number_format($item->producto->precio_venta) }}</td>
                        <td>{{ number_format($item->descuento) }}</td>
                        @php
                            $subtotal = $item->subtotal;
                            $total += $subtotal;
                        @endphp
                        <td>{{ number_format($subtotal) }}</td>
                    </tr>
                @endforeach

                <!-- Total -->
                <tr>
                    <th></th>
                    <th></th>
                    <th colspan="4" class="text-end">Total: ${{ number_format($total) }}</th>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Estilos para impresión -->
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
           
            .table, .table * {
                visibility: visible;
            }
            .table {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>

    <!-- Script para imprimir -->
    <script>
        function imprimirFactura() {
            window.print();
        }
    </script>
</x-layout>
