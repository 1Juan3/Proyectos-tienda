<x-layout titulo="Crear producto" >

    <x-slot name="css">
        <link rel="stylesheet" href="">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css"> --}}
    </x-slot>
    <section style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px">
     
{{-- 
        <button type="button" class="btn btn-success mt-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Pasar Producto a tienda
        </button> --}}

        <!-- Button trigger modal -->
        <button type="button"  style="color: white; background-color: rgb(240, 46, 3); border-radius: 10px; border: none; padding: 10px; margin-top: 30px" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                                <input type="text" class="form-control" id="floatingInput2"placeholder="Codigo"
                                    name="codigo">
                                <label>Codigo</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput1" name="nombre"
                                    placeholder="Nombre del producto ">
                                <label for="floatingInput">Nombre del producto</label>
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
                                <input type="text" class="form-control"
                                    id="floatingInput2"placeholder="Cantidad unidades" name="stock">
                                <label>Inventario inicial</label>
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
    <div class="bd-example">
        <table class="table table-striped table-hover table-bordered " id="productos">

            <thead class="table-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nombe </th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Precio compra</th>
                    <th scope="col">Precio venta</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nombre </th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Precio compra</th>
                    <th scope="col">Precio venta</th>
                    <th scope="col">Stock</th>
                    <th scope="col">editar</th>
                    <th scope="col">eliminar</th>
                </tr>
            </tfoot>
            <tbody>

                @foreach ($productos as $producto)
                    <tr>
                        <td>

                            <img src="{{ route('verImagen', $producto->imagen) }}" alt="imagen equipo"
                                style="max-height: 50px">

                        </td>
                        <td>
                            <a href="{{ route('product.formulario', $producto->codigo) }}" style="color: rgb(240, 46, 3);">
                                {{ $producto->nombre }}
                            </a>
                           </td>
                        <td>{{ $producto->codigo }}</td>
                        <td>${{ number_format($producto->precio_compra) }}</td>
                        <td>${{ number_format($producto->precio_venta) }}</td>
                        @if ($producto->stock > 0)
                            <td style="color: green;">{{ $producto->stock }}</td>
                        @else
                            <td style="color: red;">Producto Agotado</td>
                            
                        @endif
                        
                        <td> <a href="{{ route('verActualizarPorduct', $producto->id) }}" style="color:black;"><i class="fa-solid fa-user-pen"></i></a></td>
                        <td>
                            <a href="{{ route('deletePorduct', $producto->id) }}" style="color:red;"><i class="fa-solid fa-trash"></i></a>
                        </td>
                @endforeach
                </tr>
            </tbody>


        </table>

    </div>

    <style>
        #productos tfoot input {
            width: 100% !important;
        }

        #productos tfoot {
            display: table-header-group !important;
        }
    </style>

    </div>






    <x-slot name="scripts">
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
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
            $(document).ready(function() {

                // Setup - add a text input to each footer cell
                $('#productos tfoot th').each(function() {
                    var title = $(this).text();
                    $(this).html('<input type="text" placeholder="Buscar ' + title + '" />');
                });
                $('#productos').DataTable({
                    responsive: true,
                    autoWidth: false,
                    fixedHeader: true,
                    processing: true,

                    "language": {
                        "lengthMenu": "Mostrar _MENU_ productos por pagina",
                        "zeroRecords": "No se encontraron productos - Lo siento",
                        "info": "Mostrando la pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "No se encontro resultado para su busqueda",
                        "infoFiltered": "(filtrado de _MAX_ total clientes totales)",
                        'search': 'Buscar',
                        'paginate': {
                            'next': 'siguiente',
                            'previous': 'anterior'
                        }
                    },
                    initComplete: function() {
                        // Apply the search
                        this.api()
                            .columns()
                            .every(function() {
                                var that = this;

                                $('input', this.footer()).on('keyup change clear', function() {
                                    if (that.search() !== this.value) {
                                        that.search(this.value).draw();
                                    }
                                });
                            });
                    },


                });


            });
        </script>
    </x-slot>

</x-layout>
