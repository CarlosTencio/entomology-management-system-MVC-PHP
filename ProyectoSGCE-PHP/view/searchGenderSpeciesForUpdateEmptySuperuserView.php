<?php
include_once './public/headerSuperuser.php';
?>
<div class="container my-4 content">
    <form class="row g-1 form-input" action="?controller=Gender&action=listGenderSpeciesForUpdate" method="post">
        <div class="col-12 mb-3 my-4 text-center">
            <h2 class="title">Actualizar Género/Especie</h2>
            <hr class="border-success  border-3">
        </div>
        <div class="col-xl-3 col-md-12 col-sm-12 ">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="inputSearch"
                    placeholder="genero o especie" required>
                <label for="floatingInput" style="color:black">Ingrese genero o especie</label>
            </div>
        </div>
        <div class="col-xl-2 col-md-12 col-sm-12 mx-1">
            <input type="submit" class="btn btn-secondary" id="search" name="search" value="Buscar">
        </div>
        <?php
        if (isset($vars['species-updated'])) { ?>
            <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                <div class="alert alert-success" role="alert">
                    <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                    Se actualizó correctamente la especie<br>
                    En el orden:
                    <?php
                    echo $vars['order-updated']; ?> <br>
                    En la familia:
                    <?php
                    echo $vars['family-updated']; ?> <br>
                    En la subfamilia:
                    <?php
                    echo $vars['subfamily-updated']; ?> <br>
                    En el género:
                    <?php
                    echo $vars['gender-updated']; ?> <br>
                    Con el nombre de:
                    <?php
                    echo $vars['species-updated']; ?> <br>
                </div>
            </div>

            <?php
        } else if (isset($vars['gender-updated'])) { ?>
                <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                        Se actualizó correctamente la especie<br>
                        En el orden:
                        <?php
                        echo $vars['order-updated']; ?> <br>
                        En la familia:
                        <?php
                        echo $vars['family-updated']; ?> <br>
                        En la subfamilia:
                        <?php
                        echo $vars['subfamily-updated']; ?> <br>
                        Con el nombre de:
                        <?php
                        echo $vars['gender-updated']; ?> <br>
                    </div>
                </div>
            <?php } ?>
    </form>
    <hr class="border-light  border-2">
</div>

<?php
include_once './public/footer.php';
?>