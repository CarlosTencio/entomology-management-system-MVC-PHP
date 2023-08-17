<?php
include_once './public/headerSuperuser.php';
?>

<div class="container my-4 content">
    <form class="row g-3 form-input" method="post" action="?controller=Plant&action=registerPlantAdmins">
        <div class="text-center">
            <h2 class="title">Registrar Planta Hospedadora</h2>
            <hr class="border-success  border-3">
            <?php if (isset($vars['plant-registered'])) { ?>
                <div class="col-12 mb-3 d-flex justify-content-center">
                    <div class="col-5 mb-3">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            Se registró correctamente la planta<br>
                            Con Nombre:
                            <?php echo $vars['plant-registered']; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-3 mb-3" id="div-plan" >
                    <label for="plant" class="form-label">Nombre planta hospedadora</label>
                    <input class="form-control is-invalid" id="name-plant" name="name-plant" type="text"
                        oninput="validateRegisteredPlant(this,'name-feed')" required>
                    <div class="invalid-feedback" id="name-feed">Este campo no puede estar vacío</div>
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