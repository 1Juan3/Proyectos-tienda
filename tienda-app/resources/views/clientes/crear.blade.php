<x-layout titulo="Crear cliente">
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
        

        <!-- Button trigger modal -->
        <button type="button"  style="color: white; background-color: rgb(240, 46, 3); border-radius: 10px; border: none; padding: 10px; margin-top: 30px" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Crear cliente
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear cliente</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('postClient') }}"method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput1" name="nombre_completo"
                                    placeholder="Nombre completo del cliente ">
                                <label for="floatingInput">Nombre completo del cliente </label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput2"placeholder="Razon social"
                                    name="razon_social">
                                <label>Razon social</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput2"placeholder="Correo electronico"
                                    name="correo">
                                <label>Correo electronico</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput2"placeholder="Nit"
                                    name="nit">
                                <label>Nit</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput2"placeholder="Direccion"
                                    name="direccion">
                                <label>Dirección del cliente</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="phone" class="form-control" id="floatingInput2"placeholder="Celular"
                                    name="celular">
                                <label>Celular</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput2"placeholder="Categoria"
                                    name="category_id">
                                <label>Categoria</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput2"placeholder="porcentaje"
                                    name="porcentaje">
                                <label>Porcentaje</label>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear cliente</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="bd-example">
        <table class="table table-striped table-hover table-bordered " id="clientes">

            <thead class="table-dark">
                <tr>
                    <th scope="col">Nombe  cliente</th>
                    <th scope="col">Razon social</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Nit</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col">Nombe del cliente</th>
                    <th scope="col">Razon social</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Nit</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">editar</th>
                    <th scope="col">eliminar</th>
                </tr>
            </tfoot>
            <tbody>

                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nombre_completo }}</td>
                        <td>{{ $cliente->razon_social }}</td>
                        <td>{{ $cliente->direccion }}</td>
                        <td>{{ $cliente->correo }}</td>
                        <td>{{ $cliente->nit }}</td>
                        <td>{{ $cliente->celular }}</td>
                        <td>{{ $cliente->categoria }}</td>
                        <td> <a href="{{ route('verActualizar', $cliente->id) }}" style="color:black;"><i class="fa-solid fa-user-pen"></i></a></td>
                        <td>
                            <a href="{{ route('deleteClient', $cliente->id) }}" style="color:red;"><i class="fa-solid fa-trash"></i></a>
                        </td>
                @endforeach
                </tr>
            </tbody>


        </table>

    </div>

    <x-slot name="scripts">
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function() {

                // Setup - add a text input to each footer cell
                $('#clientes tfoot th').each(function() {
                    var title = $(this).text();
                    $(this).html('<input type="text" placeholder="Buscar ' + title + '" />');
                });
                $('#clientes').DataTable({
                    responsive: true,
                    autoWidth: false,
                    fixedHeader: true,
                    processing: true,

                    "language": {
                        "lengthMenu": "Mostrar _MENU_ clientes por pagina",
                        "zeroRecords": "No se encontraron clientes - Lo siento",
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
    <style>
        #clientes tfoot input {
            width: 100% !important;
        }

        #clientes tfoot {
            display: table-header-group !important;
        }
    </style>
</x-layout>
