<x-layout titulo="Entradas">


    <x-slot name="css">
        <link rel="stylesheet" href="">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css"> --}}
    </x-slot>
<div class="container">
    <strong style="width: 50%">Entradas </strong>



    <div class="bd-example">
        <table class="table table-striped table-hover table-bordered " id="productos">

            <thead>
                <tr>
                    
                    <th scope="col">Nombe </th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Precio compra</th>
                    <th scope="col">Precio venta</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Fecha </th>
                    
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col">Nombe </th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Precio compra</th>
                    <th scope="col">Precio venta</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Fecha y hora</th>
                </tr>
            </tfoot>
            <tbody>

                @foreach ($entradas as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->codigo }}</td>
                        <td>{{ $producto->precio_compra }}</td>
                        <td>{{ $producto->precio_venta }}</td>
                        <td>{{ $producto->cantidad }}</td>
                        <td>{{ $producto->created_at }}</td>
{{-- 
                        <td> <a href="{{ route('verActualizarPorduct', $producto->id) }}" style="color:black;"><i
                                    class="bi bi-pencil-square"></i></a>
                        </td> --}}
                        {{-- <td>
                            <a href="{{ route('deletePorduct', $producto->id) }}" style="color:red;"><i
                                    class="bi bi-trash"></i></a>
                        </td> --}}
                @endforeach
                </tr>
            </tbody>


        </table>

    </div>

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


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select[name="producto_id"]').on('change', function() {
                // Envía automáticamente el formulario cuando cambia el valor del select
                $('#miFormulario').submit();
            });
        });
    </script>



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
                        "lengthMenu": "Mostrar _MENU_ clientes por pagina",
                        "zeroRecords": "No se encontraron registros - Lo siento",
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