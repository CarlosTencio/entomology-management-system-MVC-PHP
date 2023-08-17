<?php
include_once './public/headerAdmin.php';
?>

<div class="container my-4 content">
    <form class="row g-1 form-input" action="?controller=Subfamily&action=searchSubfamilyForUpdate" method="post">
        <div class="col-12 mb-3 my-4 text-center">
            <h2 class="title">Actualizar Subfamilia</h2>
            <hr class="border-success  border-3">
        </div>
        <div class="col-xl-3 col-md-12 col-sm-12">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="subfamily" name="subfamily" placeholder="subfamilia">
                <label for="floatingInput" style="color:black">Ingrese el nombre de subfamilia</label>
            </div>
        </div>
        <div class="col-xl-2 col-md-12 col-sm-12 ">
            <input type="submit" class="btn btn-secondary" id="search" name="search" value="Buscar">
        </div>
        <?php if (isset($vars['order-updated'])) { ?>
            <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                <div class="alert alert-success" role="alert">
                    <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                    Se actualizó correctamente la subfamilia<br>
                    En el orden:
                    <?php echo $vars['order-updated']; ?> <br>
                    En la familia:
                    <?php echo $vars['family-updated']; ?> <br>
                    Con el nombre de:
                    <?php echo $vars['subfamily-updated']; ?>
                </div>
            </div>
            <?php
        } ?>
    </form>
    <hr class="border-light  border-2">
</div>


<?php
include_once './public/footer.php';
?>