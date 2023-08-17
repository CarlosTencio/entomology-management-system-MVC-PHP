<?php
include_once './public/headerAdmin.php';
?>

<div class="container my-4 content">
    <form class="row g-3 form-input" method="post" action="?controller=Drawer&action=registerDrawersAdmins">
        <div class="text-center">
            <h2 class="title">Registrar Gaveta</h2>
            <hr class="border-success  border-3">
            <?php if (isset($vars['drawers-registered'])) { ?>
                <div class="col-12 mb-3 d-flex justify-content-center">
                    <div class="col-5 mb-3">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            Se registraron correctamente las gavetas<br>
                            En <br>
                            Gabinete:
                            <?php echo $vars['cabinet-registered']; ?> <br>
                            Cantidad de gavetas:
                            <?php echo $vars['drawers-registered']; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-3 mb-3">
                    <label for="order" class="form-label" id="" name="">Gabinete al que va a pertenece</label>
                    <input class="form-control is-invalid" list="list-cabinets" id="number-cabinet" name="number-cabinet"
                        placeholder="Número gabinete" oninput="findCabinet()">
                    <div class="invalid-feedback" id="cabinet-feed">Este campo no puede estar vacío</div>
                    <datalist id="list-cabinets">
                        <?php
                        foreach ($vars['cabinets'] as $key => $value) {
                            ?>
                            <option id="<?php echo $value[0]; ?>" value="<?php echo $value[0]." - ". $value[1]; ?>"></option>
                            <?php
                        }
                        ?>
                    </datalist>
                    <input type="text" name="select-cabinet" id="select-cabinet" hidden>
                </div>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-3 mb-3" id="div-drawer" style="display:none">
                    <label for="family" class="form-label">Cantidad de gavetas a registrar</label>
                    <input class="form-control is-invalid"  id="number-drawers" name="number-drawers"
                        type="number" oninput="validateEmptyAndNumber(this,'button','drawer-feed');" required>
                    <div class="invalid-feedback" id="drawer-feed">Este campo no puede estar vacío</div>
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