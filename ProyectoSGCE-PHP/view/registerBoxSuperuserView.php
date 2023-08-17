<?php
include_once './public/headerSuperuser.php';
?>

<div class="container my-4 content">
    <form class="row g-3 form-input" method="post" action="?controller=Box&action=registerBoxAdmins">
        <div class="text-center">
            <h2 class="title">Registrar Caja</h2>
            <hr class="border-success  border-3">
            <?php if (isset($vars['box-registered'])) { ?>
                <div class="col-12 mb-3 d-flex justify-content-center">
                    <div class="col-sm-6 mb-3">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            Se registró correctamente la caja<br>
                            Número de caja:
                            <?php echo $vars['box-registered']; ?> <br>
                            Con una cantidad de viales de:
                            <?php echo $vars['vials-registered']; ?> <br>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-sm-5 col-md-3 col-xl-3 mb-3" id="div-box">
                    <label for="family" class="form-label">Número de caja</label>
                    <input class="form-control is-invalid" id="name-box" name="name-box" type="text"
                        oninput="validateRegisteredBox('name-feed-box',this)" required>
                    <div class="invalid-feedback" id="name-feed-box">Este campo no puede estar vacío</div>
                </div>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-sm-6 col-md-3 col-xl-3 mb-3" id="div-vials-register" style="display:none">
                    <label for="vials" class="form-label">Cantidad de viales asociados</label>
                    <input class="form-control is-invalid" id="number-vials" name="number-vials" type="number"
                        oninput="validateEmptyAndNumber(this,'button','name-feed-vials');" required>
                    <div class="invalid-feedback" id="name-feed-vials">
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