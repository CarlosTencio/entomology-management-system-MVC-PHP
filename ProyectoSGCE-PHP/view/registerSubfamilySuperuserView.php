<?php
include_once './public/headerSuperuser.php';
?>

<div class="container my-4 content">
    <form class="row g-3 form-input" method="post" action="?controller=Subfamily&action=registerSubfamilyAdmins">
        <div class="text-center">
            <h2 class="title">Registrar subfamilia</h2>
            <hr class="border-success  border-3">
            <?php if (isset($vars['subfamily-registered'])) { ?>
                <div class="col-12 mb-3 d-flex justify-content-center">
                    <div class="col-xl-5 col-md-5 col-sm-12 mb-3">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            Se registró correctamente la subfamilia<br>
                            En <br>
                            Orden:
                            <?php echo $vars['order-registered']; ?> <br>
                            Familia:
                            <?php echo $vars['family-registered']; ?> <br>
                            Con el nombre de:
                            <?php echo $vars['subfamily-registered']; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-3 col-md-8 col-sm-12 mb-3">
                    <label for="order" class="form-label" id="" name="">Orden al que va a pertenecer</label>
                    <input class="form-control is-invalid" list="list-orders" id="name-order" name="name-order"
                        placeholder="Nombre orden" oninput="findOrder()">
                    <div class="invalid-feedback" id="order-feed">El orden no existe</div>
                    <datalist id="list-orders">
                        <?php
                        foreach ($vars['orders'] as $key => $value) {
                            ?>
                            <option id="<?php echo $value[0]; ?>" value="<?php echo $value[1]; ?>"></option>
                            <?php
                        }
                        ?>
                    </datalist>
                    <input type="text" name="order" id="order" hidden>
                </div>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-3 col-md-8 col-sm-12 mb-3" id="div-family" style="display:none">
                    <label for="order" class="form-label" id="" name="">Familia al que va a pertenecer</label>
                    <input class="form-control is-invalid" list="list-families" id="name-family" name="name-family"
                        placeholder="Nombre orden" oninput=" findFamily()">
                    <div class="invalid-feedback" id="family-feed">Familia no existe</div>
                    <datalist id="list-families">
                    </datalist>
                    <input type="text" name="select-family" id="select-family" hidden>
                </div>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-3 col-md-8 col-sm-12 mb-3" id="div-subfamily" style="display:none">
                    <label for="family" class="form-label">Nombre subfamilia</label>
                    <input class="form-control is-invalid" id="name-subfamily" name="name-subfamily" type="text"
                        oninput="validateRegisteredSubfamily(this,'name-feed')" required>
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