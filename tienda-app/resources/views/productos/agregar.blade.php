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
    <section style="display: flex; justify-content: center; align-items: baseline">
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
                                    name="categoria">
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
    @foreach ($productos as $producto)
        <div class="bd-example m-0 border-0">
            <div class="card" style="width: 18rem;">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="180"
                    xmlns="http://www.w3.org/2000/svg" role="img"
                    aria-label="Marcador de posición: límite de imagen" preserveAspectRatio="xMidYMid slice"
                    focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6"
                        dy=".3em">Image cap</text>
                </svg>
                <div class="card-body">
                    <h5 class="card-title">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">{{ $producto->nombre }}</font>
                        </font>
                    </h5>
                    <p class="card-text">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Un texto de ejemplo rápido para desarrollar el
                                título de
                                la tarjeta y constituir la mayor parte del contenido de la tarjeta.</font>
                        </font>
                    </p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">un artículo</font>
                        </font>
                    </li>
                    <li class="list-group-item">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">un segundo elemento</font>
                        </font>
                    </li>
                    <li class="list-group-item">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">un tercer elemento</font>
                        </font>
                    </li>
                </ul>
                <div class="card-body">
                    <a href="#" class="card-link">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Enlace de tarjeta </font>
                        </font>
                    </a>
                    <a href="#" class="card-link">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Otro enlace</font>
                        </font>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</x-layout>
