<?php
include_once './public/headerAdmin.php';
?>

<div class="container my-4 content">
    <form class="row g-1 form-input" action="?controller=Plant&action=searchPlantForUpdate" method="post">
        <div class="col-12 mb-3 my-4 text-center">
            <h2 class="title">Actualizar Planta Hospedadora</h2>
            <hr class="border-success  border-3">
        </div>
        <div class="col-xl-3 col-md-12 col-sm-12">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="plant" name="plant" class="col-sm-2"
                    placeholder="Planta hospedadora" required>
                <label for="floatingInput" style="color:black">Nombre de la planta hospedadora</label>
            </div>
        </div>
        <div class="col-xl-2 col-md-12 col-sm-12 mx-1">
            <input type="submit" class="btn btn-secondary" id="search" name="search" value="Buscar">
        </div>
        <?php if (isset($vars['plant-updated'])) { ?>
            <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                <div class="alert alert-success" role="alert">
                    <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                    Se actualizó correctamente la planta<br>
                    Con el nombre de:
                    <?php echo $vars['plant-updated']; ?>
                </div>
            </div>
            <?php
        } ?>
    </form>

    <hr class="border-light border-2">

    <?php
    include_once './public/footer.php';
    ?>