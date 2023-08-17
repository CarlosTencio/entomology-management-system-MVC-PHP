<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<title>SGCE</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link href="public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="public/css/styleform.css" rel="stylesheet" type="text/css" />
	<link href="public/css/body.css" rel="stylesheet" type="text/css" />
	<script src="public/js/jquery.js" type="text/javascript"></script>
	<script src="public/js/popper.min.js" type="text/javascript"></script>
	<script src="public/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="public/js/functionsSpecimenRegister.js" type="text/javascript"></script>
	<script src="public/js/validationFunctions.js" type="text/javascript"></script>
	<script src="public/js/userFunctions.js" type="text/javascript"></script>
	<script src="public/js/pagination.js" type="text/javascript"></script>
	<script src="public/js/updateFunctions.js" type="text/javascript"></script>
</head>

<body>
	<header class="container-fluid">
		<div class="container">
			<div>
				<h1 class="headTitle">Sistema de Gestión para la Colección de Entomología</h1>
			</div>
			<h2 class="title">Módulo Administrativo</h2>
			<nav class="navbar navbar-expand-lg menu border-bottom border-bottom-dark" data-bs-theme="dark">
				<div class="container-fluid d-flex menu">
					<button class="navbar-toggler button-toggle" type="button" data-bs-toggle="offcanvas"
						data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-expanded="false"
						aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
						aria-labelledby="offcanvasNavbarLabel">
						<div class="offcanvas-header">
							<h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menú</h5>
							<button type="button" class="btn-close" data-bs-dismiss="offcanvas"
								aria-label="Close"></button>
						</div>
						<div class="offcanvas-body">
							<ul class="navbar-nav flex-grow-1 pe-3">
								<li class="nav-item dropdown mx-3 ">
									<button class="btn btn-secondary dropdown-toggle button-toggle" type="button"
										data-bs-toggle="dropdown" aria-expanded="false">
										Registrar
									</button>
									<ul class="dropdown-menu ">
										<li><a class="dropdown-item"
												href="?controller=Order&action=showRegisterOrderAdmin">Orden</a>
										</li>
										<li><a class="dropdown-item"
												href="?controller=Family&action=showRegisterFamilyAdmin">Familia</a>
										</li>
										<li><a class="dropdown-item"
												href="?controller=Subfamily&action=showRegisterSubfamilyAdmin">Subfamilia</a>
										</li>
										<li><a class="dropdown-item"
												href="?controller=Gender&action=showRegisterGenderAdmin">Género</a>
										</li>
										<li><a class="dropdown-item"
												href="?controller=Species&action=showRegisterSpeciesAdmin">Especie</a>
										</li>
										<li><a class="dropdown-item"
												href="?controller=Specimen&action=showRegisterSpecimenAdmin">Asociar
												Espécimen</a>
										</li>
										<li><a class="dropdown-item"
												href="?controller=Plant&action=showRegisterPlantAdmin">Planta
												Hospedadora</a>
										</li>
									</ul>
								</li>
								<li class="nav-item dropdown  ">
									<button class="btn btn-secondary dropdown-toggle button-toggle" type="button"
										data-bs-toggle="dropdown" aria-expanded="false">
										Buscar

									</button>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item"
												href="?controller=Gender&action=showSearchGenderSpecies">Por Especie o
												Género</a></li>
										<li><a class="dropdown-item"
												href="?controller=Plant&action=showListGenderPlant">Por
												planta hospedadora</a></li>
										<li><a class="dropdown-item"
												href="?controller=Order&action=showListOrders">Buscar
												Ordenes</a></li>
										<li><a class="dropdown-item"
												href="?controller=Family&action=showListFamilies">Buscar Familias</a>
										</li>
										<li><a class="dropdown-item"
												href="?controller=Subfamily&action=showListSubfamilies">Por
												Subfamilias</a>
										</li>
									</ul>
								</li>
								<li class="nav-item dropdown  ">
									<button class="btn btn-secondary dropdown-toggle button-toggle  mx-3" type="button"
										data-bs-toggle="dropdown" aria-expanded="false">
										Usuarios
									</button>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item"
												href="?controller=User&action=showRegisterUser">Registrar
												Usuario</a></li>
										<li><a class="dropdown-item"
												href="?controller=Audit&action=showListAudit">Registros</a></li>
									</ul>
								</li>
								<li class="nav-item dropdown">
									<button class="btn btn-secondary dropdown-toggle button-toggle" type="button"
										data-bs-toggle="dropdown" aria-expanded="false">
										Gestionar
									</button>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item"
												href="?controller=Gender&action=showSearchGenderSpeciesForUpdate">Especimen
												por
												Género/Especie</a></li>
										<li><a class="dropdown-item"
												href="?controller=Plant&action=showSearchPlantForUpdate">Planta
												hospedadora</a>
										</li>
										<li><a class="dropdown-item"
												href="?controller=Order&action=showSearchOrderForUpdate">Orden</a>
										</li>
										<li><a class="dropdown-item"
												href="?controller=Family&action=showSearchFamilyForUpdate">Familia</a>
										</li>
										<li><a class="dropdown-item"
												href="?controller=Subfamily&action=showSearchSubfamilyForUpdate">Subfamilia</a>
										</li>
									</ul>
								</li>
							</ul>
							<ul class="navbar-nav menu d-flex ms-auto">
								<li class="nav-item">
									<form action="?controller=User&action=showInit" method="post">
										<button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top"
											data-bs-title="Inicio">
											<img src="public/img/home.png" alt="User">
										</button>
									</form>
								</li>
								<li class="nav-item">
									<form action="?controller=Car&action=seeCar" method="post">
										<input id="user" name="user" value="<?php echo $_SESSION['username'] ?>"
											hidden></input>
										<button class="btn btn-link" type="submit" data-bs-toggle="tooltip"
											data-bs-placement="top" data-bs-title="Ver carrito">
											<img src="public/img/car.png" alt="Carrito">
										</button>
									</form>
								</li>
								<li class="nav-item">
									<form action="?controller=Car&action=getViews" method="post">
										<input id="user" name="user" value="<?php echo $_SESSION['username'] ?>"
											hidden></input>
										<button class="btn btn-link" type="submit" data-bs-toggle="tooltip"
											data-bs-placement="top" data-bs-title="Ver vistos">
											<img src="public/img/eye.png" alt="Vistos">
										</button>
									</form>
								</li>
								<li class="nav-item">
									<form action="?controller=Index&action=showIndex" method="post">
										<input id="superuser" name="superuser"
											value="<?php echo $_SESSION['username'] ?>" hidden></input>
										<button class="btn btn-link" type="submit" data-bs-toggle="tooltip"
											data-bs-placement="top" data-bs-title="Cerrar sesión">
											<img src="public/img/exit.png" alt="Salir">
										</button>
									</form>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</nav>
		</div>
	</header>

	<script>
		$(document).ready(function () {
			$('[data-bs-toggle="tooltip"]').tooltip();
		});	</script>

	<section id="contenido" class="contenido">
		<section id="principal">