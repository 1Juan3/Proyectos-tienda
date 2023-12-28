<x-layout titulo="Crear Usuarios" >

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
            Crear usuario
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('crear.users') }}"method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput2"placeholder="Nombre completo"
                                    name="name">
                                <label>Nombre Completo</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput1" name="username"
                                    placeholder="User name ">
                                <label for="floatingInput">User name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput1" name="email"
                                    placeholder="Correo electronico ">
                                <label for="floatingInput">Correo electronico</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingInput1" name="contraseña"
                                    placeholder="Contraseña ">
                                <label for="floatingInput">Contraseña</label>
                            </div>


                            {{-- @foreach ($tiendas as $tienda)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $tienda->id }}" id="flexCheckDefault{{ $tienda->id }}" name='tienda_id[]'>
                                <label class="form-check-label" for="flexCheckDefault{{ $tienda->id }}">
                                    <b>{{ $tienda->nombre_tienda }}</b>
                                </label>
                            </div>
                        @endforeach --}}
                        





                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear usuario</button>
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
                    <th scope="col">#</th>
                    <th scope="col">Nombre usuario </th>
                    <th scope="col">Username</th>
                    <th scope="col">Correo electronico</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Asignar rol</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre usuario </th>
                    <th scope="col">Username</th>
                    <th scope="col">Correo electronico</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Asignar rol</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </tfoot>
            <tbody>

                @foreach ($users as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->name }}</td>
                        <td>{{ $cliente->username }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->roles->pluck('name')->first()}}</td>

    
                        <td>
                           <a href="{{route('asignar.rol', $cliente->id)}}" style="color:rgb(240, 46, 3);"><i class="fa-solid fa-user-tie"></i></a> 
                        </td>
                      
                        <td> 
                            {{-- <a href="{{ route('actualizar.client', $cliente->id) }}" style="color:black;"><i class="fa-solid fa-user-pen"></i></a></td> --}}
                        <td>
                            {{-- <a href="{{ route('delete.client', $cliente->id) }}" style="color:red;"><i class="fa-solid fa-trash"></i></a> --}}
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
