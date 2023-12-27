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
				<section style="display: flex; justify-content: center; align-items: baseline; margin-bottom: 20px">
								<!-- Modal -->
								<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog">
																<div class="modal-content">
																				<div class="modal-header">
																								<h1 class="modal-title fs-5" id="exampleModalLabel">Crear entradas</h1>
																								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																				</div>
																				<div class="modal-body">
																								<form action="{{ route("postPorduct") }}"method="POST" enctype="multipart/form-data">
																												@csrf

																												<div class="form-floating mb-3">
																																<input type="text" class="form-control" id="floatingInput2"placeholder="Codigo"
																																				name="codigo" value="">
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
																																				id="floatingInput2"placeholder="Cantidad unidades">
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
																												<input type="hidden" name="tienda_id" value="{{ session('tienda_seleccionada') }}">

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
								<table class="table-striped table-hover table-bordered table" id="productos">

												<thead class="table-dark">
																<tr>

																				<th scope="col">Nombe </th>
																				<th scope="col">Codigo</th>
																				<th scope="col">Fecha ultima entrada</th>
																				<th scope="col">Agregar entrada</th>

																</tr>
												</thead>
												<tfoot>
																<tr>

																				<th scope="col">Nombre </th>
																				<th scope="col">Codigo</th>
																				<th scope="col">Fecha ultima entrada</th>
																				<th scope="col">Agregar entrada</th>
																</tr>
												</tfoot>
												<tbody>

																@foreach ($entradas as $producto)
																				<tr>

																								<td>
																												<a href="{{ route("product.buscar", $producto->codigo) }}" style="color: rgb(240, 46, 3);">
																																{{ $producto->nombre }}
																												</a>
																								</td>
																								<td>{{ $producto->codigo }}</td>
																								<td>{{ $producto->created_at }}</td>

																								<td> <a href="{{ route("product.formulario", $producto->codigo) }}"
																																style="color:rgb(240, 46, 3);"><i class="fa-solid fa-cart-plus"
																																				style="font-size: 30px"></i></a>
																								</td>
																								{{-- <td>
                                <a href="{{ route('deletePorduct', $producto->id) }}" style="color:red;"><i
                                        class="bi bi-trash"></i></a>
                            </td> --}}
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
																								"lengthMenu": "Mostrar _MENU_ Entradas por pagina",
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
