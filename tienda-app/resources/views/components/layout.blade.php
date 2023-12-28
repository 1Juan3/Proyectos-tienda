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
																<ul
																				style="list-style: none; padding: 0; display: flex; justify-content: space-around; align-items: center; height: 100%;">
																				<li style="text-align: center; flex: 1;">
																								<strong>
																												<a href="{{ route("index.tiendas") }}" style="text-decoration: none; ">
																																<i class="fa-solid fa-shop" style="font-size: 30px;"></i>
																																<p style="margin: 0; font-size: 12px;">Tiendas</p>
																												</a>
																								</strong>
																				</li>

																				<li style="text-align: center; flex: 1;">
																								<strong>
																												<a href="{{ route("indexVentas") }}" style="text-decoration: none; ">
																																<i class="fa-solid fa-cart-plus" style="font-size: 30px;"></i>
																																<p style="margin: 0; font-size: 12px;">Facturacion</p>
																												</a>
																								</strong>
																				</li>

																				<li style="text-align: center; flex: 1;" >
																								<strong>
																												<a href="{{ route("indexProveedore") }}" style="text-decoration: none; ">
																																<i class="fa-solid fa-dolly" style="font-size: 30px;"></i>
																																<p style="margin: 0; font-size: 12px;">Proveedores</p>
																												</a>
																								</strong>
																				</li>

																				<li style="text-align: center; flex: 1;">
																								<strong>
																												<a href="{{ route("indexPorduct", ["id" => session("tienda_seleccionada")]) }}"
																																style="text-decoration: none; ">
																																<i class="fa-solid fa-boxes-stacked" style="font-size: 30px;"></i>
																																<p style="margin: 0; font-size: 12px;">Productos</p>
																												</a>
																								</strong>
																				</li>
																				<li style="text-align: center; flex: 1;">
																					<strong>
																									<a href="{{ route('producto.transferencias') }}"
																													style="text-decoration: none; ">
																													<i class="fa-solid fa-truck-arrow-right" style="font-size: 30px;" ></i>
																													<p style="margin: 0; font-size: 12px;">Tranferencias</p>
																									</a>
																					</strong>
																	</li>

																				<li style="text-align: center; flex: 1;"  class="nav-item active">
																								<strong>
																												<a href="{{ route("indexClient") }}" style="text-decoration: none; ">
																																<i class="fa-solid fa-users" style="font-size: 30px;"></i>
																																<p style="margin: 0; font-size: 12px;">Clientes</p>
																												</a>
																								</strong>
																				</li>
																				<li style="text-align: center; flex: 1;">
																								<strong>
																												<a href="{{ route("users") }}" style="text-decoration: none; ">
																																<i class="fa-solid fa-user-plus" style="font-size: 30px;"></i>
																																<p style="margin: 0; font-size: 12px;">Usuarios</p>
																												</a>
																								</strong>
																				</li>
																				<li style="text-align: center; flex: 1;">
																								<strong>
																												<a href="{{ route("historial") }}" style="text-decoration: none; ">
																																<i class="fa-solid fa-scale-unbalanced-flip" style="font-size: 30px;"></i>
																																<p style="margin: 0; font-size: 12px;">Historial</p>
																												</a>
																								</strong>
																				</li>

																				<li style="text-align: center; flex: 1;">
																								<form action="{{ route("logout") }}" method="POST">
																												@csrf
																												<button type="submit" style="border:none; background-color: transparent; color:white;">
																																<strong><i class="bi bi-box-arrow-right" style="font-size: 30px;"></i></strong>
																												</button>
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

												a:hover {
																color: rgb(255, 111, 0);
												}
											
								</style>

				</body>

</html>
