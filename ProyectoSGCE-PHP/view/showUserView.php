<?php
include_once './public/headerUser.php';
?>

<div class="container my-4 content">
	<div class="row g-3 form-input">
		<div class="text-center">
			<h1 class="title">Entomología</h1>
			<hr class="border-success  border-3">
		</div>
		<div class="col-12 mb-3 d-flex justify-content-center">
			<div class="col-xl-12 col-md-12 col-sm-12 carrousel">
				<div id="carouselExample" class="carousel slide">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="./public/img/imagen1.jpg" class="img-fluid" alt="Imagen 1">
						</div>
						<div class="carousel-item">
							<img src="./public/img/imagen2.jpg" class="img-fluid" alt="Imagen 2">
						</div>
						<div class="carousel-item">
							<img src="./public/img/imagen3.jpg" class="img-fluid" alt="Imagen 3">
						</div>
						<div class="carousel-item">
							<img src="./public/img/imagen4.jpg" class="img-fluid" alt="Imagen 3">
						</div>
						<div class="carousel-item">
							<img src="./public/img/imagen5.jpg" class="img-fluid" alt="Imagen 3">
						</div>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
						data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
						data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
		</div>
		<p>La entomología es la rama de la zoología que se encarga del estudio de los insectos. Estos organismos,
			con más de un millón de especies descritas, son de gran importancia en el ecosistema y desempeñan
			diversos roles en la naturaleza.</p>
		<p>Nuestro sistema se dedica a la preservación de colecciones de insectos, garantizando su conservación a lo
			largo del tiempo y facilitando el estudio y la investigación en el campo de la entomología.</p>
	</div>
</div>


<?php
include_once './public/footer.php';
?>