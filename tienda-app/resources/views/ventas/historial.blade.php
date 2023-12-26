<x-layout titulo="Historial de ventas">
				<x-slot name="css">
								<link rel="stylesheet" href="">
								<link rel="stylesheet"
												href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
								<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
								<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
								<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
								{{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css"> --}}
				</x-slot>
				<div class="bd-example mt-5">
								<table class="table-striped table-hover table-bordered table" id="historial">
												<thead class="table-dark">
																<tr>
																				<th scope="col">#</th>
																				<th scope="col">Fecha de venta</th>
																				<th scope="col">Fecha limite de pago</th>
																				<th scope="col">Nombre del cliente</th>
																				<th scope="col">Tipo de venta</th>
																				<th scope="col">Estado</th>
																				<th scope="col">Historial</th>
																				<th scope="col">Abonar</th>
																</tr>
												</thead>
												<tfoot>
																<tr>
																				<th scope="col">#</th>
																				<th scope="col">Fecha de venta</th>
																				<th scope="col">Fecha limite de pago</th>
																				<th scope="col">Nombre del cliente</th>
																				<th scope="col">Tipo de venta</th>
																				<th scope="col">Estado</th>
																				<th scope="col">Historial</th>
																				<th scope="col">Abonar</th>
																</tr>
												</tfoot>
												<tbody>
																@foreach ($ventas as $venta)
																				<tr>
																								<th>
																												<a href="{{ route("factura", $venta->venta_id) }}"
																																style="color:rgb(240, 46, 3);">{{ $venta->venta_id }}</a>
																								</th>
																								<th>{{ $venta->created_at }} </th>
																								<td style="color: @if ($venta->estado == "Pagado") green @else red @endif">
																												{{ $venta->fecha_limite }}
																								</td>
																								<td>{{ $venta->cliente->nombre_completo }}</td>
																								<td>{{ $venta->tipo_venta }}</td>
																								<td>{{ $venta->estado }}</td>
																								<td>
																												@if ($venta->tipo_venta !== "Contado")
																																<a href="{{ route("tabla.abonos", $venta->venta_id) }}" style="color:rgb(255, 217, 0);">
																																				<i class="fa-solid fa-eye"></i>
																																</a>
																												@endif
																								</td>
																								<td>
																												@if ($venta->tipo_venta !== "Contado")
																																<a href="{{ route("abonar", $venta->venta_id) }}"
																																				style="color: white; background-color: rgb(240, 46, 3); border-radius: 10px; border: none; padding: 10px; text-decoration: none; ">Abonar/Pagar</a>
																												@endif
																								</td>
																				</tr>
																@endforeach
												</tbody>

								</table>
				</div>
				<style>
								#historial tfoot input {
												width: 100% !important;
								}

								#historial tfoot {
												display: table-header-group !important;
								}

								.verde {
												color: green;
								}

								.rojo {
												color: red;
								}
				</style>

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
																$('#historial tfoot th').each(function() {
																				var title = $(this).text();
																				$(this).html('<input type="text" placeholder="Buscar ' + title + '" />');
																});
																$('#historial').DataTable({
																				responsive: true,
																				autoWidth: false,
																				fixedHeader: true,
																				processing: true,

																				"language": {
																								"lengthMenu": "Mostrar _MENU_ facturas por pagina",
																								"zeroRecords": "No se encontraron facturas - Lo siento",
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
