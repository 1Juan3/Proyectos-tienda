<x-layout titulo="Crear Tiendas">

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
								<button type="button"
												style="color: white; background-color: rgb(240, 46, 3); border-radius: 10px; border: none; padding: 10px; margin-top: 30px"
												data-bs-toggle="modal" data-bs-target="#exampleModal">
												Crear Tienda
								</button>

								<!-- Modal -->
								<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog">
																<div class="modal-content">
																				<div class="modal-header">
																								<h1 class="modal-title fs-5" id="exampleModalLabel">Crear tienda</h1>
																								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																				</div>
																				<div class="modal-body">
																								<form action="{{ route("storeTienda") }}" enctype="multipart/form-data" method="POST" >
																												@csrf
																												<div class="form-floating mb-3">
																																<input type="text" class="form-control"
																																				id="floatingInput2"placeholder="Nombre de la tienda" name="nombre_tienda">
																																<label>Nombre de la tienda</label>
																												</div>
																												<div class="form-floating mb-3">
																																<input type="text" class="form-control"
																																				id="floatingInput2"placeholder="Direcccion de la tienda" name="direccion_tienda">
																																<label>Direccion tienda</label>
																												</div>
																												<div class="form-floating mb-3">
																																<input type="text" class="form-control" id="floatingInput2"placeholder="Telefono"
																																				name="telefono_tienda">
																																<label>Telefoo </label>
																												</div>
																												<div class="form-floating mb-3">
																																<input type="text" class="form-control"
																																				id="floatingInput2"placeholder="Correo electronico" name="email_tienda">
																																<label>Correo electronico</label>
																												</div>
																												<div class="form-floating mb-3">
																																<input type="text" class="form-control" id="floatingInput2"placeholder="Nit tienda"
																																				name="nit_tienda">
																																<label>Nit tienda</label>
																												</div>
																												<div class="form-floating mb-3">
																																<input type="file" class="form-control" placeholder="Logo tienda" name="logo">
																																<label>Logo tienda</label>
																												</div>

																				</div>
																				<div class="modal-footer">
																								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
																								<button type="submit" class="btn btn-primary">Crear Tienda</button>
																				</div>
																				</form>
																</div>
												</div>
								</div>
				</section>
				<div class="bd-example">
								<table class="table-striped table-hover table-bordered table" id="tiendas">

												<thead class="table-dark">
																<tr>
																				<th scope="col">#</th>
																				<th scope="col">Nombre tienda </th>
																				<th scope="col">Direccion</th>
																				<th scope="col">Telefono</th>
																				<th scope="col">Correo</th>
																				<th scope="col">nit</th>
																				<th scope="col">Editar</th>
																				<th scope="col">Eliminar</th>
																</tr>
												</thead>
												<tfoot>
																<tr>
																				<th scope="col">#</th>
																				<th scope="col">Nombre tienda </th>
																				<th scope="col">Direccion</th>
																				<th scope="col">Telefono</th>
																				<th scope="col">Correo</th>
																				<th scope="col">nit</th>
																				<th scope="col">Editar</th>
																				<th scope="col">Eliminar</th>
																</tr>
												</tfoot>
												<tbody>

																@foreach ($tiendas as $tienda)
																				<tr>
																								<td>
																												{{ $tienda->id }}
																								</td>
																								<td>
																												{{ $tienda->nombre_tienda }}
																								</td>
																								<td>
																												{{ $tienda->direccion_tienda }}
																								</td>
																								<td>
																												{{ $tienda->telefono_tienda }}
																								</td>
																								<td>
																												{{ $tienda->email_tienda }}
																								</td>
																								<td>
																												{{ $tienda->nit_tienda }}
																								</td>
																								<td> <a href="{{ route("edit.tienda", $tienda->id) }}" style="color:black;"><i
																																				class="fa-solid fa-user-pen"></i></a></td>
																								<td>
																												<a href="{{ route("destroy.tienda", $tienda->id) }}" style="color:red;"><i
																																				class="fa-solid fa-trash"></i></a>
																								</td>
																@endforeach
																</tr>
												</tbody>

								</table>

				</div>

				<style>
								#tiendas tfoot input {
												width: 100% !important;
								}

								#tiendas tfoot {
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
												$(document).ready(function() {

																// Setup - add a text input to each footer cell
																$('#tiendas tfoot th').each(function() {
																				var title = $(this).text();
																				$(this).html('<input type="text" placeholder="Buscar ' + title + '" />');
																});
																$('#tiendas').DataTable({
																				responsive: true,
																				autoWidth: false,
																				fixedHeader: true,
																				processing: true,

																				"language": {
																								"lengthMenu": "Mostrar _MENU_ tiendas por pagina",
																								"zeroRecords": "No se encontraron tiendas - Lo siento",
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
