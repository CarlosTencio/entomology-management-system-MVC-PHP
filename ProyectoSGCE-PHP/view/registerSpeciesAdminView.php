<?php
include_once './public/headerAdmin.php';
?>


<div class="container my-4 content">
    <form class="row g-3 form-input" method="post" action="?controller=Species&action=registerSpeciesAdmin">
        <div class="text-center">
            <h2 class="title">Registrar especie</h2>
            <hr class="border-success  border-3">
            <?php if (isset($vars['species-registered'])) { ?>
                <div class="col-12 mb-3 d-flex justify-content-center">
                    <div class="col-xl-5 col-md-5 col-sm-12  mb-3">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            Se registró correctamente la especie<br>
                            En <br>
                            Orden:
                            <?php echo $vars['order-registered']; ?> <br>
                            Familia:
                            <?php echo $vars['family-registered']; ?> <br>
                            Subamilia:
                            <?php echo $vars['subfamily-registered']; ?> <br>
                            Género:
                            <?php echo $vars['gender-registered']; ?> <br>
                            Con Nombre:
                            <?php echo $vars['species-registered']; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-3 col-md-8 col-sm-12 mb-3 mb-3">
                    <label for="order" class="form-label" id="" name="">Orden al que va a pertenecer</label>
                    <input class="form-control is-invalid" list="list-orders" id="name-order" name="name-order"
                        placeholder="Nombre orden" oninput=" findOrder()">
                    <div class="invalid-feedback" id="order-feed">Este campo no puede estar vacío</div>
                    <datalist id="list-orders">
                        <?php
                        foreach ($vars['orders'] as $key => $value) {
                            ?>
                            <option id="<?php echo $value[0]; ?>" value="<?php echo $value[1]; ?>"></option>
                            <?php
                        }
                        ?>
                    </datalist>
                </div>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-3 col-md-8 col-sm-12 mb-3 mb-3" id="div-family" style="display:none">
                    <label for="order" class="form-label" id="" name="">Familia al que va a pertenecer</label>
                    <input class="form-control is-invalid" list="list-families" id="name-family" name="name-family"
                        placeholder="Nombre familia" oninput=" findFamily()">
                    <div class="invalid-feedback" id="family-feed">Este campo no puede estar vacío</div>
                    <datalist id="list-families">
                    </datalist>
                </div>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-3 col-md-8 col-sm-12 mb-3 mb-3" id="div-subfamily" style="display:none">
                    <label for="order" class="form-label" id="" name="">Subfamilia al que va a pertenecer</label>
                    <input class="form-control is-invalid" list="list-subfamilies" id="name-subfamily"
                        name="name-subfamily" placeholder="Nombre subfamilia" oninput=" findSubfamily()">
                    <div class="invalid-feedback" id="subfamily-feed">Este campo no puede estar vacío</div>
                    <datalist id="list-subfamilies">
                    </datalist>
                </div>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-3 col-md-8 col-sm-12 mb-3 mb-3" id="div-gender" style="display:none">
                    <label for="order" class="form-label" id="" name="">Género al que va a pertenecer</label>
                    <input class="form-control is-invalid" list="list-genders" id="name-gender" name="name-gender"
                        placeholder="Nombre género" oninput=" findGender()">
                    <div class="invalid-feedback" id="gender-feed">Este campo no puede estar vacío</div>
                    <datalist id="list-genders">
                    </datalist>
                    <input type="text" name="select-gender" id="select-gender" hidden>
                </div>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-3 col-md-8 col-sm-12 mb-3 mb-3" id="div-species" style="display:none">
                    <label for="family" class="form-label">Nombre especie</label>
                    <input class="form-control  is-invalid" id="name-species" name="name-species" type="text"
                        oninput="validateRegisteredSpecies(this,'name-feed')" required>
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