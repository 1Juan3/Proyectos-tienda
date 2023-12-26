<x-layout titulo="Detalle proveedor">

				<x-slot name="css">
								<link rel="stylesheet" href="">
								<link rel="stylesheet"
												href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
								<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
								<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
								<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
								{{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css"> --}}
				</x-slot>
				<div class="bd-example">
								<table class="table-striped table-hover table-bordered table" id="proveedor">

												<thead class="table-dark">
																<tr>
																				<th scope="col">Codigo</th>
																				<th scope="col">Nombre producto</th>
																				<th scope="col">Precio compra</th>
																				<th scope="col">Precio venta</th>
																				<th scope="col">Cantidad agregada</th>
																				<th scope="col">Fecha entrada</th>
																</tr>
												</thead>
												<tfoot>
																<tr>
																				<th scope="col">Codigo</th>
																				<th scope="col">Nombre producto</th>
																				<th scope="col">Precio compra</th>
																				<th scope="col">Precio venta</th>
																				<th scope="col">Cantidad agregada</th>
																				<th scope="col">Fecha entrada</th>
																</tr>
												</tfoot>
												<tbody>

																@foreach ($entradas as $entrada)
																				<tr>
																								<td scope="row">{{ $entrada->codigo }}</td>
																								<td>{{ $entrada->nombre }}</td>
																								<td>{{ $entrada->precio_compra }}</td>
																								<td>{{ $entrada->precio_venta }}</td>
																								<td>{{ $entrada->cantidad }}</td>
																								<td>{{ $entrada->created_at }}</td>
																@endforeach
																</tr>
												</tbody>

								</table>

				</div>

				<style>
								#entradas tfoot input {
												width: 100% !important;
								}

								#entradas tfoot {
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
																$('#proveedor tfoot th').each(function() {
																				var title = $(this).text();
																				$(this).html('<input type="text" placeholder="Buscar ' + title + '" />');
																});
																$('#proveedor').DataTable({
																				responsive: true,
																				autoWidth: false,
																				fixedHeader: true,
																				processing: true,

																				"language": {
																								"lengthMenu": "Mostrar _MENU_ proveedor por pagina",
																								"zeroRecords": "No se encontraron entradas - Lo siento",
																								"info": "Mostrando la pagina _PAGE_ de _PAGES_",
																								"infoEmpty": "No se encontro resultado para su busqueda",
																								"infoFiltered": "(filtrado de _MAX_ total entradas totales)",
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
