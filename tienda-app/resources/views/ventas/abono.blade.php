<x-layout titulo="Realizar abonos">
				<div class="fluid container mx-auto mt-4" style="width: 400px">
								<form action="{{ route("Abono", $venta_id) }}" method="POST">
												@csrf

												<div class="mb-3">

																<div class="form-floating mb-3">
																				<input type="number" class="form-control" id="floatingInput2"placeholder="Ingrese el valor del abono"
																								name="pago">
																				<label>Ingrese el valor del abono</label>
																</div>

												</div>
												<button type="submit" class="btn btn-primary">Generar abono</button>
								</form>

				</div>

</x-layout>
