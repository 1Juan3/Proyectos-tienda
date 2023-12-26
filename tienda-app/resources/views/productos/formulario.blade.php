<x-layout titulo="Agregar Entradas">
				<div class="container mt-3">
								<div class="row">
												<div class="col-6 mx-auto text-center">
																<h1>Entradas para el producto {{ $entrada->nombre }} </h1>
																<form action="{{ route("product.store", $entrada->codigo) }}"method="POST" enctype="multipart/form-data">
																				@csrf
																				<select class="form-select" name="id_provedor">
																								<option disabled>Seleccione el provveedor a comprar</option>
																								@foreach ($proveedores as $provedor)
																												<option value="{{ $provedor->id }}" selected>{{ $provedor->nombre_proveedor }}
																												</option>
																								@endforeach
																				</select>
																				<div class="form-floating mb-3">
																								<input type="text" class="form-control" id="floatingInput2" placeholder="Codigo"
																												value="{{ $entrada->codigo }}" name="codigo" readonly>
																								<label>Codigo</label>
																				</div>

																				<div class="form-floating mb-3">
																								<input type="text" class="form-control" id="floatingInput1" name="nombre"
																												value="{{ $entrada->nombre }} "readonly placeholder="Nombre del producto ">
																								<label for="floatingInput">Nombre del producto</label>
																				</div>
																				<div class="form-floating mb-3">
																								<input type="text" class="form-control" id="floatingInput2"placeholder="Cantidad unidades"
																												value="{{ $entrada->producto->stock }}" readonly>
																								<label>Inventario actual</label>
																				</div>
																				<div class="form-floating mb-3">
																								<input type="text" class="form-control"
																												id="floatingInput2"placeholder="Precio al que se compra" name="precio_compra"
																												value="{{ $entrada->precio_compra }}">
																								<label>Precio al que se compra</label>
																				</div>

																				<div class="form-floating mb-3">
																								<input type="text" class="form-control"
																												id="floatingInput2"placeholder="Precio al que se vende" name="precio_venta"
																												value="{{ $entrada->precio_venta }}">
																								<label>Precio al que se vende</label>
																				</div>
																				<div class="form-floating mb-3">
																								<input type="text" class="form-control" id="floatingInput2"placeholder="Cant a agregar"
																												name="cantidad">
																								<label>Cant a agregar</label>
																				</div>

																				<div class="modal-footer">
																								<a href="{{ route("product.entradas") }}" class="btn btn-secondary">Volver</a>
																								<button type="submit" class="btn btn-primary">Registrar entrada</button>
																				</div>
												</div>

												</form>
								</div>
				</div>
				</div>
</x-layout>
