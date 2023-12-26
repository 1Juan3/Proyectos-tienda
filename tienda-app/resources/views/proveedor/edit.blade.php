<x-layout titulo="Editar proveedor">
				<div class="container mx-auto">
								<h4 class="text-center">Actualizar proveedor {{ $proveedor->nombre_proveedor }}</h4>
								<div class="row">
												<div class="col-6 mx-auto">
																<form action="{{ route("update.proveedore", $proveedor->id) }}"method="POST"
																				enctype="multipart/form-data">
																				@csrf
																				<div class="form-floating mb-3">
																								<input type="text" class="form-control" id="floatingInput1" name="nombre_proveedor"
																												value="{{ $proveedor->nombre_proveedor }}" placeholder="Nombre completo del proveedor ">
																								<label for="floatingInput">Nombre completo del proveedor </label>
																				</div>
																				<div class="form-floating mb-3">
																								<input type="text" class="form-control" id="floatingInput2"placeholder="Razon social"
																												value="{{ $proveedor->razon_social }}" name="razon_social">
																								<label>Razon social</label>
																				</div>
																				<div class="form-floating mb-3">
																								<input type="text" class="form-control" id="floatingInput2"placeholder="Correo electronico"
																												value="{{ $proveedor->correo_electronico }}" name="correo_electronico">
																								<label>Correo electronico</label>
																				</div>
																				<div class="form-floating mb-3">
																								<input type="text" class="form-control" id="floatingInput2"placeholder="Nit"
																												value="{{ $proveedor->nit }}" name="nit">
																								<label>Nit</label>
																				</div>
																				<div class="form-floating mb-3">
																								<input type="text" class="form-control" id="floatingInput2"placeholder="Direccion"
																												value="{{ $proveedor->direccion }}" name="direccion">
																								<label>Dirección del proveedor</label>
																				</div>

																				<div class="form-floating mb-3">
																								<input type="phone" class="form-control" id="floatingInput2"placeholder="Celular"
																												value="{{ $proveedor->celular }}" name="celular">
																								<label>Celular</label>
																				</div>
																				<div class="container">
																								<div class="row">
																												<div class="col-3">
																																<a href="{{ route("indexProveedore") }}">regresar</a>
																												</div>
																												<div class="col-3">
																																<button type="submit" class="btn btn-info">Actualizar</button>
																												</div>
																								</div>
																				</div>
																</form>
												</div>
								</div>
</x-layout>
