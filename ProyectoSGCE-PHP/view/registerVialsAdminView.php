<?php
include_once './public/headerAdmin.php';
?>

<div class="container my-4 content">
    <form class="row g-3 form-input" method="post" action="?controller=Vials&action=registerVialsAdmins">
        <div class="text-center">
            <h2 class="title">Registrar Viales</h2>
            <hr class="border-success  border-3">
            <?php if (isset($vars['vials-registered'])) { ?>
                <div class="col-12 mb-3 d-flex justify-content-center">
                    <div class="col-5 mb-3">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            Se registraron correctamente los viales<br>
                            En <br>
                            Caja:
                            <?php echo $vars['box-registered']; ?> <br>
                            Cantidad de viales:
                            <?php echo $vars['vials-registered']; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-3 mb-3">
                    <label for="order" class="form-label" id="" name="">Caja al que va a pertenece</label>
                    <input class="form-control is-invalid" list="list-boxes" id="number-box" name="number-box"
                        placeholder="Número caja" oninput="findBox()">
                    <div class="invalid-feedback" id="box-feed">Este campo no puede estar vacío</div>
                    <datalist id="list-boxes">
                        <?php
                        foreach ($vars['boxes'] as $key => $value) {
                            ?>
                            <option id="<?php echo $value[0]; ?>" value="<?php echo $value[0]." - ". $value[1]; ?>"></option>
                            <?php
                        }
                        ?>
                    </datalist>
                    <input type="text" name="select-box" id="select-box" hidden>
                </div>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-3 mb-3" id="div-vial" style="display:none">
                    <label for="family" class="form-label">Cantidad de viales a registrar</label>
                    <input class="form-control is-invalid"  id="number-vials" name="number-vials"
                        type="number" oninput="validateEmptyAndNumber(this,'button','vials-feed');" required>
                    <div class="invalid-feedback" id="vials-feed">Este campo no puede estar vacío</div>
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