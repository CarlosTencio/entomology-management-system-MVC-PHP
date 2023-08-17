<?php
include_once './public/headerAdmin.php';
?>


<div class="container my-4 content">
    <form class="row g-1 form-input" action="?controller=Family&action=searchFamilyForUpdate" method="post">
        <div class="col-12 mb-3 my-4 text-center">
            <h2 class="title">Actualizar Familia</h2>
            <hr class="border-success  border-3">
        </div>
        <div class="col-12 d-flex">
            <div class="col-xl-3 col-md-12 col-sm-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="family" name="family" placeholder="familia">
                    <label for="floatingInput" style="color:black">Nombre de familia</label>
                </div>
            </div>
            <div class="col-xl-2 col-md-12 col-sm-12 mx-1">
                <input type="submit" class="btn btn-secondary" id="search" name="search" value="Buscar">
            </div>
            <?php if (isset($vars['order-updated'])) { ?>
                <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                        Se actualizó correctamente la familia<br>
                        En el orden:
                        <?php echo $vars['order-updated']; ?> <br>
                        Con el nombre de:
                        <?php echo $vars['family-updated']; ?>
                    </div>
                </div>
                <?php
            } ?>
        </div>
    </form>
    <hr class="border-light  border-2">
</div>



<?php
include_once './public/footer.php';
?>