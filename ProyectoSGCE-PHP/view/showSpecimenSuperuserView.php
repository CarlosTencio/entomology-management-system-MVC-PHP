<?php
include_once './public/headerSuperuser.php';
?>

<div class="container my-4 content">
    <div class="row g-3 form-input">
        <div class="text-center">
            <h2 class="title">Espécimen</h2>
            <hr class="border-success  border-3">
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-12 col-md-12 col-sm-12 carrousel">
                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner ">
                            <?php
                            foreach ($vars['img'] as $value) {
                                ?>
                                <div class="carousel-item active">
                                    <img src="<?php echo $value['ruta_imagen']; ?>" class="" alt="especimen.jpg">
                                </div>
                            <?php }
                            ?>
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
            <?php
            foreach ($vars['specimen'] as $value) {
                ?>
                <div class="col-12 mb-3  d-flex justify-content-center row">

                    <div class="col-xl-4 col-sm-8 col-md-12 mb-3">
                        <div class="col-md-12 " class="card">
                            <div class="card" style="border-radius: 0.5em;">
                                <div class="card-header  font-card" style="color:black">
                                    Información recolección
                                </div>
                                <ul class="list-group list-group-flush" style="border-radius:0.5em;">
                                    <li class="list-group-item">
                                        <?php echo "País: " . $value['pais']; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php echo "Provincia: " . $value['provincia']; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php echo "Cantón: " . $value['canton']; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php echo "Distrito: " . $value['distrito']; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php echo "Recolector: " . $value['recolector']; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php echo "Fecha de recolección: " . $value['fecha']; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-8 col-md-12 mb-3">
                        <div class="col-md-12" class="card">
                            <div class="card" style="border-radius: 0.5em;">
                                <div class="card-header font-card" style="color:black">
                                    Información taxonómica
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item text-start">
                                        <pre class="indent "><?php echo "Orden: " . $value['orden']; ?></pre>
                                    </li>
                                    <li class="list-group-item text-start">
                                        <pre class="indent"><?php echo "           ﹂Familia: " . $value['familia']; ?></pre>
                                    </li>
                                    <li class="list-group-item text-start">
                                        <pre
                                            class="indent"><?php echo "                       ﹂Subfamilia: " . $value['subfamilia']; ?></pre>
                                    </li>
                                    <li class="list-group-item text-start">
                                        <pre
                                            class="indent"><?php echo "                                  ﹂Género: " . $value['genero']; ?></pre>
                                    </li>
                                    <li class="list-group-item text-start">
                                        <pre
                                            class="indent"><?php echo "                                                   ﹂Especie: " . $value['especie']; ?></pre>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
        <div class="col-12 mb-3 d-flex justify-content-center">
            <div class="col-md-3" class="card">
                <div class="card" style="border-radius: 0.5em;">
                    <div class="card-header  font-card" style="color:black">
                        Plantas hospedadoras
                    </div>
                    <ul class="list-group list-group-flush" style="border-radius:0.5em;">
         
                            <?php
                            foreach ($vars['plants'] as $value) {
                                ?>
                            <li class="list-group-item">
                                <?php echo $value['nombre_planta']; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once './public/footer.php';
?>