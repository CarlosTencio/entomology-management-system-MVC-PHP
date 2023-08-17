<?php
include_once './public/headerSuperuser.php';
?>

<div class="container my-4 content">
    <form class="row g-3 form-input" method="post" action="?controller=Order&action=registerOrderAdmins">
        <div class="text-center">
            <h2 class="title">Registrar Orden</h2>
            <hr class="border-success  border-3">
            <?php if (isset($vars['order-registered'])) { ?>
                <div class="col-12 mb-3 d-flex justify-content-center">
                    <div class="col-xl-5 col-md-5 col-sm-12 mb-3">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            Se registró correctamente el orden<br>
                            Con el nombre de:
                            <?php echo $vars['order-registered']; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-3 col-md-8 col-sm-12 mb-3" id="div-order">
                    <label for="order" class="form-label">Nombre orden</label>
                    <input class="form-control is-invalid" id="name-order" name="name-order" type="text"
                        oninput="validateRegisteredOrder(this,'name-feed')" required>
                    <div class="invalid-feedback" id="name-feed">Este campo no puede estar vacío</div>
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