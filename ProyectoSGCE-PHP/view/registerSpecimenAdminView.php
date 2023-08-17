<?php
include_once './public/headerAdmin.php';
?>

<?php
include_once './public/headerSuperuser.php';
?>

<div class="container  text-center my-4 content">
    <div class="row g-1 form-input">
        <div class="col-12 mb-3 my-4 text-center">
            <h2 class="title">Asociar espécimen</h2>
            <hr class="border-success  border-3">
        </div>
        <?php if (isset($vars['registered'])) { ?>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-sm-6 mb-3">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                        Se registró correctamente el especimen<br>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="col-xl-6 col-md-6 col-sm-12  text-center">
            <div class="col-12 text-center">
                <h4 class="">Información taxonómica</h4>
            </div>

            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-6 mb-3" id="div-gender">
                    <label for="gender" id="gender" name="gender">Género</label>
                    <input class="form-control is-invalid" list="list-genders" id="name-gender" name="name-gender"
                        placeholder="Nombre género" oninput=" findGender()">
                    <div class="invalid-feedback" id="gender-feed">Este campo no puede estar vacío</div>
                    <datalist id="list-genders">
                        <?php
                        foreach ($vars['genders'] as $key => $value) {
                            ?>
                            <option id="<?php echo $value[0]; ?>" value="<?php echo $value[1]; ?>"></option>
                            <?php
                        }
                        ?>
                    </datalist>
                </div>
                <div class="col-1 mb-3 mx-2 my-4" id="btn-gender">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn addicons" data-bs-toggle="modal" data-bs-target="#genderModal">
                        <img src="public/img/add.png" alt="">
                    </button>
                </div>
            </div>

            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-6 mb-3" id="div-species" style="display:none">
                    <label for="orden" id="species" name="species">Especie</label>
                    <input class="form-control is-invalid" list="list-species" id="name-species" name="name-species"
                        placeholder="Nombre especie" oninput="  findSpecies()">
                    <div class="invalid-feedback" id="species-feed">Este campo no puede estar vacío</div>
                    <datalist id="list-species">
                    </datalist>
                </div>
                <div class="col-1 mb-3 mx-2 my-4" id="btn-species" style="display:none">
                    <!-- Button trigger modal -->
                    <button type="button icons" class="btn addicons" data-bs-toggle="modal"
                        data-bs-target="#speciesModal">
                        <img src="public/img/add.png" alt="anadir.png">
                    </button>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 col-sm-12 text-center">
            <div class="col-12 mb-3 d-flex justify-content-center ">
                <div class="col-12 mb-3">
                    <div class="col-12 text-center">
                        <h4 class="">Almacenaje</h4>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center ">
                <div class="col-6 mb-3">
                    <input class="form-check-input" type="radio" name="storage" value="1" id="optionCabinet"
                        onchange="showContainers()" checked> Gabinete
                    <input class="form-check-input" type="radio" name="storage" value="2" id="optionBox"
                        onchange="showContainers()"> Caja
                </div>
            </div>

            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-4 ">
                    <label id="cabinet" for="cabinet">Identificador del Gabinete</label>
                    <label id="box" for="box" style="display:none">Identificador de la Caja</label>
                    <input class="form-control is-invalid" id="number-cabinet"
                        name="number-cabinet"  oninput="validateStorage(this)">
                    <div class="invalid-feedback" id="cabinet-feed">Este campo no puede estar vacío</div>
                    <label id="drawer" for="cabinet" style="">Identificador de la Gaveta</label>
                    <label id="vial" for="vial" style="display:none">Identificador del Vial</label>
                    <input class="form-control is-invalid" id="number-drawer" name="number-drawer"
                       oninput="validateDrawer(this)" disabled>
                    <div class="invalid-feedback" id="drawer-feed">Este campo no puede estar vacío</div>
                </div>
            </div>
            <div class="col-12 mb-3 my-4 d-flex justify-content-center">
                <div class="col-6" id="div-img" style="display:none">
                    <label for="" id="img-specimen">Seleccione las imágenes</label>
                    <input class="form-control" id="imageFiles" type="file" name="imageFiles[ ]"
                        onchange="verifyImages()" multiple>
                </div>
            </div>

            <div class="col-12 mb-3 my-4 d-flex justify-content-center">
                <div class="col-6" id="div-button" style="display:none">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tagModal"
                        onclick="getCountries();return false;">
                        Generar etiqueta
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="img-modal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Error</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="div-alert" role="alert">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Entiendo</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="genderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Registrar
                    Género
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container my-4">
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-6 mb-3" id=div-order>
                            <label class="form-label" for="order" id="order" name="order">Orden</label>
                            <input class="form-control is-invalid" list="list-orders" id="name-order" name="name-order"
                                placeholder="Nombre orden" oninput="findOrderModal()">
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
                        <div class="col-6 mb-3" id="div-family">
                            <label class="form-label" for="family" id="family" name="family">Familia</label>
                            <input class="form-control is-invalid" list="list-families" id="name-family"
                                name="name-family" placeholder="Nombre familia" oninput=" findFamilyModal()" disabled>
                            <div class="invalid-feedback" id="family-feed">Este campo no puede estar vacío</div>
                            <datalist id="list-families">
                            </datalist>
                        </div>
                    </div>

                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-6 mb-3" id="div-subfamily">
                            <label class="form-label" for="subfamily" id="subfamily" name="subfamily">Subfamilia</label>
                            <input class="form-control is-invalid" list="list-subfamilies" id="name-subfamily"
                                name="name-subfamily" placeholder="Nombre subfamilia" oninput=" findSubfamilyModal()"
                                disabled>
                            <div class="invalid-feedback" id="subfamily-feed">Este campo no puede estar vacío</div>
                            <datalist id="list-subfamilies">
                            </datalist>
                        </div>
                    </div>

                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-6 mb-3">
                            <label for="gender" class="form-label">Nombre del Género</label>
                            <input class="form-control is-invalid" id="name-gender-modal" name="name-gender-modal"
                                oninput="validateRegisteredGender(this,'gender-modal-feed');" type="text" disabled>
                            <div class="invalid-feedback" id="gender-modal-feed">Este campo no puede estar vacío</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
                    <button id="btn-add-gender" type="button" class="btn btn-success" onclick="registerGenderModal()"
                        disabled>Agregar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="speciesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Registrar Especie
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container my-4">
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-6 mb-3" id="">
                            <label for="family" class="form-label">Nombre especie</label>
                            <input class="form-control is-invalid" id="name-species-modal" name="name-species-modal"
                                type="text" oninput="validateRegisteredSpecies(this,'name-feed-species-modal') ">
                            <div class="invalid-feedback" id="name-feed-species-modal">Este campo no puede estar
                                vacío
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
                <button id="btn-add-species" type="button" class="btn btn-success" onclick=" registerSpeciesModal()"
                    disabled>Agregar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade " id="tagModal" tabindex="-1" aria-labelledby="tagModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar etiqueta
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container text-center">
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-5 mb-3">
                        </div>
                    </div>

                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-5 mb-3 mx-2">
                            <label for="country" id="country" name="country">País</label>
                            <input class="form-control is-invalid" list="list-countries" id="name-country"
                                name="name-country" placeholder="Pais" oninput="findCountry()">
                            <div class="invalid-feedback" id="country-feed">Este campo no puede estar vacío
                            </div>
                            <datalist id="list-countries">
                            </datalist>
                        </div>
                        <div class="col-5 mb-3">
                            <label for="gender" id="gender" name="gender">Provincia</label>
                            <input class="form-control is-invalid" list="list-provinces" id="name-province"
                                name="name-province" placeholder="Provincia" oninput="findProvince()">
                            <div class="invalid-feedback" id="province-feed">Este campo no puede estar vacío
                            </div>
                            <datalist id="list-provinces">
                            </datalist>
                        </div>
                    </div>

                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-5 mb-3 mx-2">
                            <label for="gender" id="gender" name="gender">Cantón</label>
                            <input class="form-control is-invalid" list="list-cantons" id="name-canton"
                                name="name-canton" placeholder="Cantón" oninput="findCanton()">
                            <div class="invalid-feedback" id="canton-feed">Este campo no puede estar vacío</div>
                            <datalist id="list-cantons">
                            </datalist>
                        </div>
                        <div class="col-5 mb-3">
                            <label for="gender" id="gender" name="gender">Distrito</label>
                            <input class="form-control is-invalid" list="list-districts" id="name-district"
                                name="name-district" placeholder="Distrito" oninput="findDistrict();  validateFields()"
                              >
                            <div class="invalid-feedback" id="district-feed">Este campo no puede estar vacío
                            </div>
                            <datalist id="list-districts">
                            </datalist>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3 d-flex justify-content-center">
                    <div class="col-5 mb-3">
                        <label for="gender" id="gender" name="gender">Fecha</label>
                        <input class="form-control is-invalid" id="input-date" name="input-date" type="date"
                            onchange="addDate(this.value); validateFields()">
                        <div class="invalid-feedback" id="date-feed">Este campo no puede estar vacío</div>
                    </div>
                    <div class="col-5 mb-3 mx-2">
                        <label for="gender" id="gender" name="gender">Recolector</label>
                        <input class="form-control is-invalid" name="input-collector" id="input-collector"
                            oninput="addName(this.value);  validateFields()">
                        <div class="invalid-feedback" id="collector-feed">Este campo no puede estar vacío</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Salir</button>
                <form method="post" action="?controller=Specimen&action=registerSpecimen" enctype="multipart/form-data">
                    <input type="text" name="select-order" id="select-order" hidden>
                    <input type="text" name="select-family" id="select-family" hidden>
                    <input type="text" name="select-subfamily" id="select-subfamily" hidden>
                    <input type="text" name="select-gender" id="select-gender" hidden>
                    <input type="text" name="select-species" id="select-species" hidden>
                    <input type="text" name="select-type" id="select-type" value="1" hidden>
                    <input type="text" name="select-storage" id="select-storage"  hidden>
                    <input type="text" name="select-drawer" id="select-drawer"  hidden>
                    <input type="text" name="select-district" id="select-district" hidden>
                    <input type="text" id="select-date" name="select-date" hidden>
                    <input type="text" id="select-collector" name="select-collector" hidden>
                    <input class="form-control" id="select-imageFiles" type="file" name="select-imageFiles[ ]" multiple
                        hidden>
                    <button id="save-changes-tag" type="submit" class="btn btn-success" disabled>Guardar
                        todo</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once './public/footer.php';
?>