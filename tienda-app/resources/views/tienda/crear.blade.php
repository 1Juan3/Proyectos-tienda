<x-layout>
				<div class="container mt-3" style="display: flex; justify-content: center; align-items: center">
								<form action="POST" enctype="multipart/form-data" style="width: 50%">
												@csrf
												<div class="form-floating mb-3">
																<input type="text" class="form-control" id="floatingInput2"placeholder="Nombre de la tienda"
																				name="nombre_tienda">
																<label>Nombre de la tienda</label>
												</div>
												<div class="form-floating mb-3">
																<input type="text" class="form-control" id="floatingInput2"placeholder="Direcccion de la tienda"
																				name="direccion_tienda">
																<label>Direccion tienda</label>
												</div>
												<div class="form-floating mb-3">
																<input type="text" class="form-control" id="floatingInput2"placeholder="Telefono"
																				name="telefono_tienda">
																<label>Telefoo </label>
												</div>
												<div class="form-floating mb-3">
																<input type="text" class="form-control" id="floatingInput2"placeholder="Correo electronico"
																				name="email_tienda">
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
												<button class="btn btn-primary"> Crear Tienda</button>
								</form>
				</div>

</x-layout>
