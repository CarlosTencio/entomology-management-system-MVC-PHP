<?php
include_once './public/header.php';
?>

<div class="container">
	<form action="?controller=User&action=initSessionSuperuser" method="post">
		<div class="container py-3 h-50">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-8 col-md-6 col-lg-4">
					<div class="card bg-dark text-white" style="border-radius: 1rem;">
						<div class="card-body p-2 text-center">
							<div class="mb-md-2 mt-md-1 pb-2">
								<h2 class="fw-bold mb-1 text-uppercase">Ingresar</h2>
								<p class="text-white-50 mb-2">Por favor ingrese su usuario y contraseña del
									superusuario</p>
								<div class="form-outline form-white mb-2">
									<input type="text" id="username" name="username"
										class="form-control form-control-sm" />
									<label class="form-label" for="username">Usuario</label>
								</div>
								<div class="form-outline form-white mb-2">
									<input type="password" id="password" name="password"
										class="form-control form-control-sm" />
									<label class="form-label" for="password">Contraseña</label>
								</div>
								<button class="btn btn-outline-light btn-sm px-2" type="submit">Ingresar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>

	<div class="col-12 mb-3 d-flex justify-content-center">
		<?php if (isset($vars['error'])) { ?>
			<div class="alert alert-danger" role="alert">
				Usuario o contraseña incorrecto
			</div>
		<?php } ?>
	</div>
</div>
<?php
include_once './public/footer.php';
?>