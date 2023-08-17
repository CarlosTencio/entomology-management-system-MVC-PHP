<?php
include_once './public/headerAdmin.php';
?>

<div class="container my-4 content">
    <form class="row g-1 form-input" action="?controller=Gender&action=listGenderSpeciesForUpdate" method="post">
        <div class="col-12 mb-3 my-4 text-center">
            <h2 class="title">Actualizar Género/Especie</h2>
            <hr class="border-success  border-3">
        </div>
        <div class="col-xl-3 col-md-12 col-sm-12 ">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="inputSearch"
                    placeholder="genero o especie" required>
                <label for="floatingInput" style="color:black">Ingrese genero o especie</label>
            </div>
        </div>
        <div class="col-xl-2 col-md-12 col-sm-12 mx-1">
            <input type="submit" class="btn btn-secondary" id="search" name="search" value="Buscar">
        </div>
        <div class="col-xl-2 col-md-12 col-sm-12">
            <h4 class="subtitle">Búsqueda de:
                <?php echo $vars['inputSearch'] ?>
            </h4>
        </div>
    </form>
    <hr class="border-light  border-2">
    <div class="col-12 table-responsive">
        <?php if ($vars['gendersSpecies'] == null) {
            ?>
            <div class="alert alert-danger text-center mb-3" role="alert">
                No se encontraron elementos</div>
            <?php
        } else { ?>
            <div class="col-12 d-flex">
                <table class="table" id="resultsTable">
                    <thead>
                        <tr>
                            <th style="color:aliceblue">Orden</th>
                            <th style="color:aliceblue">Familia</th>
                            <th style="color:aliceblue">Subfamilia</th>
                            <th style="color:aliceblue">Tipo</th>
                            <th style="color:aliceblue">Nombre</th>
                            <th style="color:aliceblue">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="Tbody">
                        <?php
                        $contador = 0;
                        foreach ($vars['gendersSpecies'] as $value) {
                            ?>
                            <!-- <form action="?controller=Specimen&action=getSpecimens" method="post"> -->
                            <tr>
                                <td style="color:aliceblue">
                                    <?php echo $value['Orden']
                                        ?>
                                </td>
                                <td style="color:aliceblue">
                                    <?php echo $value['Familia'] ?>
                                </td>
                                <td style="color:aliceblue">
                                    <?php echo $value['Subfamilia'] ?>
                                </td>
                                <td style="color:aliceblue">
                                    <?php echo $value['tipo'] ?>
                                <td style="color:aliceblue">
                                    <?php echo $value['Nombre'] ?>
                                    <input id="id<?php echo $contador ?>" name="id" value="<?php echo $value['id'] ?>"
                                        hidden></input>
                                </td>
                                <td>
                                    <?php if ($value['numero_tipo'] == 1) { ?>
                                        <div class="accordion" id="genderMenuAccordion<?php echo $contador ?>">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#genderCollapse<?php echo $contador ?>"
                                                        aria-expanded="false" aria-controls="genderCollapse">
                                                        Gestionar
                                                    </button>
                                                </h2>
                                                <div id="genderCollapse<?php echo $contador ?>" class="accordion-collapse collapse"
                                                    aria-labelledby="genderHeading"
                                                    data-bs-parent="#genderMenuAccordion<?php echo $contador ?>">
                                                    <div class="accordion-body">
                                                        <div class="column">
                                                            <form class="mb-2"
                                                                action="?controller=Species&action=showSpeciesForUpdate"
                                                                method="post">
                                                                <input id="namegender" name="namegender"
                                                                    value="<?php echo $value['Nombre'] ?>" hidden>
                                                                <input id="gender" name="gender" value="<?php echo $value['id'] ?>"
                                                                    hidden>
                                                                <button class="btn btn-secondary" type="submit" onclick="">Ver
                                                                    especies</button>
                                                            </form>
                                                            <form class="mb-2"
                                                                action="?controller=Gender&action=showPlantsGenderForUpdate"
                                                                method="post">
                                                                <input id="gender-plant" name="gender-plant"
                                                                    value="<?php echo $value['id'] ?>" hidden>
                                                                <input id="search-value" name="search-value"
                                                                    value="<?php echo $vars['inputSearch'] ?>" hidden>
                                                                <button class="btn btn-info" type="submit">Gestionar
                                                                    plantas</button>
                                                            </form>
                                                            <button class="btn btn-info" type="button" onclick="chargeInfoGender(
                                                '<?php echo $value['id_orden'] ?>', '<?php echo $value['Orden'] ?>',
                                                '<?php echo $value['id_familia'] ?>','<?php echo $value['Familia'] ?>',
                                                '<?php echo $value['id_subfamilia'] ?>','<?php echo $value['Subfamilia'] ?>',
                                                '<?php echo $value['id_genero'] ?>','<?php echo $value['Nombre'] ?>');"
                                                                data-bs-toggle="modal" data-bs-target="#genderModal">Editar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    </div>
                <?php } else if ($value['numero_tipo'] == 2) { ?>
                        <form action="?controller=Specimen&action=showSpecimensForUpdate" method="post">
                            <input id="namespecies" name="namespecies" value="<?php echo $value['Nombre'] ?>" hidden>
                            <input id="species" name="species" value="<?php echo $value['id'] ?>" hidden>
                            <button class="btn btn-secondary" type="submit" onclick="">Ver especímenes</button>
                            <button class="btn btn-info" type="button" onclick="chargeInfoSpecies(
                                                '<?php echo $value['id_orden'] ?>', '<?php echo $value['Orden'] ?>',
                                                '<?php echo $value['id_familia'] ?>','<?php echo $value['Familia'] ?>',
                                                '<?php echo $value['id_subfamilia'] ?>','<?php echo $value['Subfamilia'] ?>',
                                                '<?php echo $value['id_genero'] ?>','<?php echo $value['Genero'] ?>',
                                                '<?php echo $value['id'] ?>','<?php echo $value['Nombre'] ?>');"
                                data-bs-toggle="modal" data-bs-target="#speciesModal">Editar</button>
                        </form>
                    <?php } ?>
                </td>
                </tr>
                <?php
                $contador++;
                        }
        } ?>
        </tbody>
        </table>
    </div>
</div>
</div>

<!--Modal -->
<div class="modal fade" id="plantModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Asociar Plantas Hospedadoras
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container my-4">

                </div>
            </div>
            <div class="modal-footer">
                <form action="?controller=Plant&action=updatePlant" method="post">
                    <input id="id-plant" name="id-plant" type="text" hidden>
                    <input id="name-plant" name="name-plant" type="text" hidden>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
                    <button id="save-changes" type="submit" class="btn btn-success" disabled>Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal -->
<div class="modal fade" id="genderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Actualizar Información del
                    Género
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container my-4">
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-xl-6 col-md-8 col-sm-12 mb-3 mb-3">
                            <label for="order" class="form-label" id="" name="">Nombre del orden</label>
                            <input class="form-control is-valid" list="list-orders" id="name-order-gender"
                                placeholder="Nombre orden"
                                oninput=" findOrderGenderModal();
                                   validateRegisteredGenderForUpdate(document.getElementById('name-gender-modal'),'name-feed');">
                            <div class="invalid-feedback" id="order-feed-gender"></div>
                            <datalist id="list-orders-gender">
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
                        <div class="col-xl-6 col-md-8 col-sm-12 mb-3 mb-3" id="div-family">
                            <label for="order" class="form-label" id="" name="">Nombre de la familia</label>
                            <input class="form-control is-valid" list="list-families-gender" id="name-family-gender"
                                name="name-family-gender" placeholder="Nombre familia"
                                oninput="findFamilyGenderModal();
                                   validateRegisteredGenderForUpdate(document.getElementById('name-gender-modal'),'name-feed');">
                            <div class="invalid-feedback" id="family-feed-gender"></div>
                            <datalist id="list-families-gender">
                            </datalist>
                        </div>
                    </div>
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-xl-6 col-md-8 col-sm-12 mb-3 mb-3" id="div-subfamily">
                            <label for="order" class="form-label" id="" name="">Nombre de la subfamilia</label>
                            <input class="form-control is-valid" list="list-subfamilies-gender"
                                id="name-subfamily-gender" name="name-subfamily-gender" placeholder="Nombre subfamilia"
                                oninput=" findSubfamilyGenderModal();
                                validateRegisteredGenderForUpdate(document.getElementById('name-gender-modal'),'name-feed');">
                            <div class="invalid-feedback" id="subfamily-feed-gender"></div>
                            <datalist id="list-subfamilies-gender">
                            </datalist>
                        </div>
                    </div>
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-xl-6 col-md-8 col-sm-12 mb-3 mb-3" id="div-gender">
                            <label for="family" class="form-label">Nombre del género</label>
                            <input class="form-control  is-valid" id="name-gender-modal" name="name-gender-modal"
                                type="text" oninput="validateRegisteredGenderForUpdate(this,'name-feed-gender');">
                            <div class="invalid-feedback" id="name-feed-gender"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="?controller=Gender&action=updateGender" method="post" onsubmit=" infoGender()">
                    <input id="select-order-gender" name="select-order-gender" type="text" hidden>
                    <input id="submit-order-gender" name="submit-order-gender" type="text" hidden>
                    <input id="select-family-gender" name="select-family-gender" type="text" hidden>
                    <input id="submit-family-gender" name="submit-family-gender" type="text" hidden>
                    <input id="select-subfamily-gender" name="select-subfamily-gender" type="text" hidden>
                    <input id="submit-subfamily-gender" name="submit-subfamily-gender" type="text" hidden>
                    <input id="id-gender" name="id-gender" type="text" hidden>
                    <input id="submit-gender-gender" name="submit-gender-gender" type="text" hidden>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
                    <button id="save-changes-gender" type="submit" class="btn btn-success">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal -->
<div class="modal fade" id="speciesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Actualizar Información de la
                    Especie
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container my-4">
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-xl-6 col-md-8 col-sm-12 mb-3 mb-3">
                            <label for="order" class="form-label" id="" name="">Nombre del orden</label>
                            <input class="form-control is-valid" list="list-orders" id="name-order" name="name-order"
                                placeholder="Nombre orden"
                                oninput=" findOrderModal();
                                 validateRegisteredSpeciesForUpdate(document.getElementById('name-species-modal'),'name-feed');">
                            <div class="invalid-feedback" id="order-feed"></div>
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
                        <div class="col-xl-6 col-md-8 col-sm-12 mb-3 mb-3" id="div-family">
                            <label for="order" class="form-label" id="" name="">Nombre de la familia</label>
                            <input class="form-control is-valid" list="list-families" id="name-family"
                                name="name-family" placeholder="Nombre familia"
                                oninput=" findFamilyModal();
                                validateRegisteredSpeciesForUpdate(document.getElementById('name-species-modal'),'name-feed');">
                            <div class="invalid-feedback" id="family-feed"></div>
                            <datalist id="list-families">
                            </datalist>
                        </div>
                    </div>
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-xl-6 col-md-8 col-sm-12 mb-3 mb-3" id="div-subfamily">
                            <label for="order" class="form-label" id="" name="">Nombre de la subfamilia</label>
                            <input class="form-control is-valid" list="list-subfamilies" id="name-subfamily"
                                name="name-subfamily" placeholder="Nombre subfamilia"
                                oninput=" findSubfamilyModal();
                                validateRegisteredSpeciesForUpdate(document.getElementById('name-species-modal'),'name-feed');">
                            <div class="invalid-feedback" id="subfamily-feed"></div>
                            <datalist id="list-subfamilies">
                            </datalist>
                        </div>
                    </div>
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-xl-6 col-md-8 col-sm-12 mb-3 mb-3" id="div-gender">
                            <label for="order" class="form-label" id="" name="">Nombre del género</label>
                            <input class="form-control is-valid" list="list-genders" id="name-gender" name="name-gender"
                                placeholder="Nombre género"
                                oninput=" findGenderModal();
                                validateRegisteredSpeciesForUpdate(document.getElementById('name-species-modal'),'name-feed');">
                            <div class="invalid-feedback" id="gender-feed"></div>
                            <datalist id="list-genders">
                            </datalist>
                        </div>
                    </div>
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-xl-6 col-md-8 col-sm-12 mb-3 mb-3" id="div-species">
                            <label for="family" class="form-label">Nombre de la especie</label>
                            <input class="form-control  is-valid" id="name-species-modal" name="name-species-modal"
                                type="text" oninput="validateRegisteredSpeciesForUpdate(this,'name-feed')">
                            <div class="invalid-feedback" id="name-feed"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="?controller=Species&action=updateSpecies" method="post" onsubmit=" infoSpecies()">
                    <input id="select-order" name="select-order" type="text" hidden>
                    <input id="submit-order" name="submit-order" type="text" hidden>
                    <input id="select-family" name="select-family" type="text" hidden>
                    <input id="submit-family" name="submit-family" type="text" hidden>
                    <input id="select-subfamily" name="select-subfamily" type="text" hidden>
                    <input id="submit-subfamily" name="submit-subfamily" type="text" hidden>
                    <input id="select-gender" name="select-gender" type="text" hidden>
                    <input id="submit-gender" name="submit-gender" type="text" hidden>
                    <input id="select-species" name="select-species" type="text" hidden>
                    <input id="id-species" name="id-species" type="text" hidden>
                    <input id="submit-species" name="submit-species" type="text" hidden>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
                    <button id="save-changes-species" type="submit" class="btn btn-success">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once './public/footer.php';
?>