<x-layout titulo="historial abonos">

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
								<table class="table-striped table-hover table-bordered table" id="abonos">

												<thead class="table-dark">
																<tr>
																				<th scope="col">Venta</th>
																				<th scope="col">Nombre cliente</th>
																				<th scope="col">Sub total</th>
																				<th scope="col">Monto abonado</th>
																				<th scope="col">Total</th>
																				<th scope="col">Fecha abono</th>
																</tr>
												</thead>
												<tfoot>
																<tr>
																				<th scope="col">Venta</th>
																				<th scope="col">Nombre cliente</th>
																				<th scope="col">Sub total</th>
																				<th scope="col">Monto abonado</th>
																				<th scope="col">Total</th>
																				<th scope="col">Fecha abono</th>
																</tr>
												</tfoot>
												<tbody>

																@foreach ($abonos as $abono)
																				<tr>
																								<td scope="row">{{ $abono->venta_id }}</td>
																								<td>{{ $abono->venta->cliente->nombre_completo }}</td>
																								<td>{{ $abono->venta->subtotal }}</td>
																								<td>{{ $abono->monto }} </td>
																								<td>{{ $abono->total }}</td>
																								<td>{{ $abono->created_at }}</td>
																@endforeach
																</tr>
												</tbody>

								</table>

				</div>

				<style>
								#abonos tfoot input {
												width: 100% !important;
								}

								#abonos tfoot {
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
																$('#entradas tfoot th').each(function() {
																				var title = $(this).text();
																				$(this).html('<input type="text" placeholder="Buscar ' + title + '" />');
																});
																$('#entradas').DataTable({
																				responsive: true,
																				autoWidth: false,
																				fixedHeader: true,
																				processing: true,

																				"language": {
																								"lengthMenu": "Mostrar _MENU_ entradas por pagina",
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
