<?php
include_once './public/headerAdmin.php';
?>

<div class="container my-4 content">
    <form class="row g-3 form-input" method="post" action="?controller=Family&action=registerFamilyAdmins">
        <div class="text-center">
            <h2 class="title">Registrar familia</h2>
            <hr class="border-success  border-3">
            <?php if (isset($vars['family-registered'])) { ?>
                <div class="col-12 mb-3 d-flex justify-content-center">
                    <div class="col-xl-5 col-md-5 col-sm-12 mb-3">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            Se registró correctamente la familia<br>
                            En <br>
                            Órden:
                            <?php echo $vars['order-registered']; ?> <br>
                            Con el nombre de:
                            <?php echo $vars['family-registered']; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-3 col-md-5 col-sm-12 mb-3">
                    <label for="order" class="form-label" id="" name="">Orden al que va a pertenece</label>
                    <input class="form-control is-invalid" list="list-orders" id="name-order" name="name-order"
                        placeholder="Nombre orden" oninput="findOrder()">
                    <div class="invalid-feedback" id="order-feed">El órden no existe</div>
                    <datalist id="list-orders">
                        <?php
                        foreach ($vars['orders'] as $key => $value) {
                            ?>
                            <option id="<?php echo $value[0]; ?>" value="<?php echo $value[1]; ?>"></option>
                            <?php
                        }
                        ?>
                    </datalist>
                    <input type="text" name="select-order" id="select-order" hidden>
                </div>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-3 col-md-5 col-sm-12 mb-3" id="div-family" style="display:none">
                    <label for="family" class="form-label">Nombre familia</label>
                    <input class="form-control is-invalid" id="name-family" name="name-family" type="text"
                        oninput="validateRegisteredFamily(this,'name-feed')" required>
                    <div class="invalid-feedback" id="name-feed">Este campo no puede estar vacío</div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3" id="button" style="display:none">
            <input class="btn btn-success" type="submit" value="Registrar">
        </div>
    </form>
</div>

<?php
include_once './public/footer.php';
?>