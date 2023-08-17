<?php
include_once './public/headerAdmin.php';
?>

<div class="container my-4 content">
    <form class="row g-3 form-input" method="post" action="?controller=Cabinet&action=registerCabinetAdmins">
        <div class="text-center">
            <h2 class="title">Registrar Gabinete</h2>
            <hr class="border-success  border-3">
            <?php if (isset($vars['cabinet-registered'])) { ?>
                <div class="col-12 mb-3 d-flex justify-content-center">
                    <div class="col-sm-6 mb-3">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            Se registró correctamente el gabinete<br>
                            Número de gabinete:
                            <?php echo $vars['cabinet-registered']; ?> <br>
                            Con una cantidad de gavetas de:
                            <?php echo $vars['drawers-registered']; ?> <br>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-sm-5 col-md-3 col-xl-3 mb-3" id="div-cabinter">
                    <label for="family" class="form-label">Número de gabinete</label>
                    <input class="form-control is-invalid" id="name-cabinet" name="name-cabinet" type="text"
                        oninput="validateRegisteredCabinet('name-feed-cabinet',this)" required>
                    <div class="invalid-feedback" id="name-feed-cabinet">Este campo no puede estar vacío</div>
                </div>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-sm-6 col-md-3 col-xl-3 mb-3" id="div-drawer-register" style="display:none">
                    <label for="drawer" class="form-label">Cantidad de gavetas asociadas</label>
                    <input class="form-control is-invalid" id="number-drawers" name="number-drawers" type="number"
                        oninput="validateEmptyAndNumber(this,'button','name-feed-drawer');" required>
                    <div class="invalid-feedback" id="name-feed-drawer">
                        Este campo no puede estar vacío <br>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3" id="button" style="display:none">
                <input class="btn btn-success" type="submit" value="Registrar">
            </div>
        </div>
    </form>
</div>

<?php
include_once './public/footer.php';
?>