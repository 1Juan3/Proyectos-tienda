<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								{{ $css ?? "" }}
								<meta http-equiv="X-UA-Compatible" content="ie=edge">
								<link rel="stylesheet"
												href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
								<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
								<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
								<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
								<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
												integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
								<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
								<link rel="icon">
								<title>Inicio - {{ $titulo ?? "" }}</title>
				</head>

				<body style=" font-family: Arial, sans-serif;">

								@auth

												<nav style="background-color: rgb(240, 46, 3); ">
																<ul>
																				<li>
																								<strong>
																												<a href="{{ route("indexTienda") }}">
																																<i class="fa-solid fa-shop" style="font-size: 20px"></i>
																																<p style="margin: 0;">Add tiendas</p>
																												</a>
																								</strong>
																				</li>

																				<li>
																								<strong>
																												<a href="{{ route("indexVentas") }}">
																																<i class="bi bi-cart-plus-fill" style="font-size: 20px; "></i>
																																<p style="margin: 0;">Facturacion</p>
																												</a>
																								</strong>
																				</li>

																				<li>
																								<strong> <a href="{{ route("indexProveedore") }}"style="">
																																<i class="fa-solid fa-dolly" style="font-size: 25px; pading-top: 1px"></i>
																																<p style="margin: 0;">Proveedores</p>
																												</a></strong>
																				</li>
																				<li>
																					<strong>
																						<a href="{{ route('indexPorduct', ['id' => session('tienda_seleccionada')]) }}" style="">
																							<i class="bi bi-basket3-fill" style="font-size: 20px;"></i>
																							<p style="margin: 0;">Productos</p>
																						</a>
																					</strong>
																				</li>
																				
																				<li>
																								<strong> <a href="{{ route("indexClient") }}">
																																<i class="bi bi-people-fill" style="font-size: 20px;"></i>
																																<p style="margin: 0;">Clientes</p>
																												</a></strong>
																				</li>
																				{{-- <li>
																								<strong> <a href="{{ route("product.entradas") }}">
																																<i class="bi bi-house-add-fill" style="font-size: 20px;"></i>
																																<p style="margin: 0;">Entradas</p>
																												</a></strong>
																				</li> --}}

																				<li>
																								<strong> <a href="{{ route("historial") }}">
																																<i class="bi bi-card-checklist" style="font-size: 20px;"></i>
																																<p style="margin: 0;">Historial</p>
																												</a></strong>
																				</li>

																				<li>
																								<form action="{{ route("logout") }}" method="POST">
																												@csrf
																												<button type="submit" style="border:none; background-color: transparent; color:white;">
																																<strong><i class="bi bi-box-arrow-right" style="font-size: 30px;"></i></strong></button>
																								</form>
																				</li>

																</ul>
												</nav>
								@endauth

								{{ $slot }}
								{{ $scripts ?? "" }}

								<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
												integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
								</script>
								<script src="https://kit.fontawesome.com/206f222453.js" crossorigin="anonymous"></script>

								<style>
												ul {
																display: flex;
																justify-content: center;
																align-items: center;
																flex-direction: row;
												}

												ul {
																list-style: none;
																margin: 0;
																padding: 0;
																gap: 10px;
												}

												a {
																text-decoration: none;
																display: flex;
																justify-content: center;
																align-items: center;
																flex-direction: column;
																text-decoration: none;
																color: white;
												}
								</style>

				</body>

</html>
