<x-layout titulo="Crear producto">

    <x-slot name="css">
        <link rel="stylesheet" href="">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css"> --}}
    </x-slot>
    <section style="display: flex; justify-content: center; align-items: baseline; margin-bottom: 20px">
        <strong style="width: 50%">Productos</strong>



        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success mt-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Crear producto
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear porducto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('postPorduct') }}"method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput1" name="nombre"
                                    placeholder="Nombre del producto ">
                                <label for="floatingInput">Nombre del producto</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control"
                                    id="floatingInput2"placeholder="Cantidad unidades" name="stock">
                                <label>Unidades</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput2"placeholder="Codigo"
                                    name="codigo">
                                <label>Codigo</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control"
                                    id="floatingInput2"placeholder="Precio al que se compra" name="precio_compra">
                                <label>Precio al que se compra</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control"
                                    id="floatingInput2"placeholder="Precio al que se vende" name="precio_venta">
                                <label>Precio al que se vende</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput2"placeholder="Categoria"
                                    name="category_id">
                                <label>Categoria</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="file" class="form-control" placeholder="imagen" name="imagen">
                                <label>Imagen del producto</label>
                            </div>





                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear producto</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <form action="{{ route('indexPorduct') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" name="query" id="searchQuery"
                    placeholder="Buscar productos...">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </div>
        </form>

        <div id="resultados"></div>
    </div>
    <div class="container fluid mx-auto">
        <div class="row">
            @foreach ($productos as $producto)
                <div class="bd-example  border-1 col-sm-10  col-md-8 col-lg-6    col-xl-3 col-xxl-2 mx-auto  mb-4"
                    id="producto_{{ $producto->id }}">
                    <div class="card" style="width: 15rem;">
                        <img src="{{ route('verImagen', $producto->imagen) }}" alt="imagen equipo"
                            style="height: 300px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">

                                <p><b>Precio de venta: </b> {{ $producto->precio_venta }}</p>
                                <p><b>Precio de compra: </b> {{ $producto->precio_compra }}</p>
                                <p><b>Codigo: </b> {{ $producto->codigo }}</p>
                                <p><b>Unidades</b> {{ $producto->stock }}</p>
                            </li>
                        </ul>
                        <div class="card-body container-fluid mx-auto">
                            <a class="btn btn-warning mt-5 "
                                href="{{ route('verActualizarPorduct', $producto->id) }}">
                                Actualizar información
                            </a>
                            <form action="{{ route('deletePorduct', $producto->id) }}" class="eliminar">
                                @csrf
                                @method('POST')
                                <button class="btn btn-danger mt-5" type="submit" id="deleteItem">Eliminar</button>
                            </form>


                        </div>
                    </div>


                </div>
            @endforeach
        </div>

    </div>
    <x-slot name="scripts">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $('#deleteItem').click(function(e) {
                e.preventDefault();

                var form = $(this).parents('form');
                swal({
                    title: "¿Estás seguro?",
                    text: "Al eliminar esto se borrarán todos los registros.",
                    icon: "info",
                    buttons: {
                        cancel: "Cancelar",
                        confirm: "Confirmar",
                    },
                }).then((willDelete) => {
                    if (willDelete) form.submit();
                });
            });
        </script>
        <script>
            const imputs = document.getElementById('searchQuery');
            inputs.addEventListener('keyup', (e) => {

            })
        </script>
    </x-slot>

</x-layout>
