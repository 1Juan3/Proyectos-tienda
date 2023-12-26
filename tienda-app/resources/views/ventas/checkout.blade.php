<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 bg-light">
                @if (count($productosEnCarrito))
                    <table class="table table-striped">
                        <thead>
                            <th></th>
                            <th>Nombre</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Eliminar</th>
                        </thead>
                        <tbody>
                            @foreach ($productosEnCarrito as $item)
                                <tr>
                                    <th>
                                        <img src="{{ $item->options->urlfoto }}" alt="foto producto"
                                            style="max-height: 30px">
                                    </th>

                                    <td>{{ $item->name }}</td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <form action="{{ route('cart.incrementar') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->rowId }}">
                                                <button type="submit"
                                                    class="btn btn-link btn-sm text-danger">+</button>
                                            </form>
                                            {{ $item->qty }}
                                            <form action="{{ route('cart.decrementar') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->rowId }}">
                                                <button type="submit"
                                                    class="btn btn-link btn-sm text-danger">-</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.removeitem') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->rowId }}">
                                            <button type="submit" class="btn btn-link btn-sm text-danger">x</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-end">Subtotal</td>
                                <td class="text-end">${{ number_format(Cart::subtotal()) }}</td>

                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('cart.clear') }}">Limpiar el carrito</a>
                @else
                    <p>Carrito vacio</p>
                @endif

            </div>

        </div>
    </div>
</x-layout>
