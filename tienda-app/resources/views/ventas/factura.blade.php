<x-layout titulo="Factura">
    <div class="text-center mt-4">
        <button class="btn btn-primary mb-4" onclick="imprimirFactura()">Imprimir Factura</button>
    </div>
    <div class="bd-example">
        <table class="table table-striped table-hover table-bordered ">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Descuento</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Debe</th>
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
                        <td>${{ number_format($item->producto->precio_venta, 2) }}</td>
                        <td>{{ number_format($item->descuento) }}</td>
                        @php
                            $subtotal = $item->subtotal;
                            $total += $subtotal;
                        @endphp
                        <td>{{ number_format($subtotal) }}</td>
                        <td>{{number_format($item->total)}}</td>
                    </tr>
                @endforeach

                <tr>
                    <th></th>
                    <th></th>
                    <th colspan="4" class="text-end">Total:{{ number_format($total) }}</th>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <style>
        /* Estilos para impresión */
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
    <script>
        function imprimirFactura() {
            window.print();
        }
    </script>
</x-layout>
