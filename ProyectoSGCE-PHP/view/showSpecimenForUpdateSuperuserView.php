<?php
include_once './public/headerSuperuser.php';
?>

<div class="container my-4 content">
    <div class="row g-3 form-input">
        <div class="text-center">
            <h2 class="title">Actualizar Información del Espécimen</h2>
            <hr class="border-success  border-3">
        </div>
        <?php if (isset($vars['updated'])) { ?>
            <div class="col-xl-12 col-md-6 col-sm-12 mb-3 text-center">
                <div class="alert alert-success" role="alert">
                    <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                    Se actualizó correctamente la informacion del especimen<br>
                </div>
            </div>
            <?php
        } ?>
        <div class="col-12 mb-3">
            <div class="col-xl-3 col-md-6 col-sm-8 d-flex justify-content-center">
                <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#imgModal"
                    onclick="chargeInfoImg()">
                    <img src="public/img/add-img.png" alt="especimen.jpg"></button>
                <button class="btn btn-info mx-3" type="button" data-bs-toggle="modal" data-bs-target="#storageModal"
                    onclick="chargeInfoStorage()">Editar almacenaje</button>
            </div>
        </div>
        <div class="text-center">
            <div class="col-xl-12 col-md-12 col-sm-12 d-flex justify-content-center">
                <div class="col-10 d-flex">
                    <table class="table" id="resultsTable">
                        <thead>
                            <tr>
                                <th style="color:aliceblue">Imágenes</th>
                                <th style="color:aliceblue">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="Tbody">
                            <?php
                            $contador = 0;
                            foreach ($vars['img'] as $value) {
                                ?>
                                <tr>
                                    <input id="img<?php echo $contador ?>" name="specimen"
                                        value="<?php echo $value['id_img'] ?>" hidden></input>
                                    <td style="color:aliceblue">
                                        <img src="<?php echo $value['ruta_imagen']; ?>" class="img-table"
                                            alt="especimen.jpg">
                                    </td>
                                    <td style="color:aliceblue">
                                        <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            onclick="chargeInfoImgForDelete('<?php echo $value['id_img']; ?>','<?php echo $value['ruta_imagen']; ?>')">
                                            <img src="public/img/delete.png" alt="delete.png"></button>
                                    </td>
                                </tr>
                                <?php
                                $contador = $contador + 1;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
    foreach ($vars['specimen'] as $value) {
        ?>
        <input id="id-specimen" name="id-specimen" type="text" value="<?php echo $value['id_especimen']; ?>" hidden>
        <input id="type" type="text" value="<?php echo $value['tipo_almacenaje']; ?>" hidden>
        <input id="storage" type="text" value="<?php echo $value['lugar_almacenaje']; ?>" hidden>
        <input id="drawer" type="text" value="<?php echo $value['id_almacenamiento']; ?>" hidden>
        <div class="col-12 mb-3  d-flex justify-content-center row">
            <div class="col-xl-4 col-sm-12 col-md-12 mb-3">
                <div class="col-md-12 " class="card">
                    <div class="card" style="border-radius: 0.5em;">
                        <div class="card-header  font-card" style="color:black">
                            <h4 class="fw-bold">Información recolección
                                <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#tagModal"
                                    onclick="chargeInfoTag()">
                                    <img src="public/img/edit.png" alt="edit.png"></button>
                            </h4>
                        </div>
                        <input id="tagId" value="<?php echo $value['etiqueta'] ?>" hidden></input>
                        <ul class="list-group list-group-flush" style="border-radius:0.5em;">
                            <li class="list-group-item">
                                <?php echo "País: " . $value['pais']; ?>
                                <input id="tagCountry" value="<?php echo $value['pais'] ?>" hidden></input>
                            </li>
                            <li class="list-group-item">
                                <input id="tagProvince" value="<?php echo $value['provincia'] ?>" hidden></input>
                                <?php echo "Provincia: " . $value['provincia']; ?>
                            </li>
                            <li class="list-group-item">
                                <input id="tagCanton" value="<?php echo $value['canton'] ?>" hidden></input>
                                <?php echo "Cantón: " . $value['canton']; ?>
                            </li>
                            <li class="list-group-item">
                                <input id="tagDistrict" value="<?php echo $value['distrito'] ?>" hidden></input>
                                <?php echo "Distrito: " . $value['distrito']; ?>
                            </li>
                            <li class="list-group-item">
                                <input id="tagCollector" value="<?php echo $value['recolector'] ?>" hidden></input>
                                <?php echo "Recolector: " . $value['recolector']; ?>
                            </li>
                            <li class="list-group-item">
                                <input id="tagDate" value="<?php echo $value['fecha'] ?>" hidden></input>
                                <?php echo "Fecha de recolección: " . $value['fecha']; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-12 col-md-12 mb-3">
                <div class="col-md-12" class="card">
                    <div class="card" style="border-radius: 0.5em;">
                        <div class="card-header font-card" style="color:black">
                            <h4 class="fw-bold">
                                Información taxonómica
                                <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#taxModal"
                                    onclick="chargeInfoTax()">
                                    <img src="public/img/edit.png" alt="edit.png"></button>
                            </h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-start">
                                <input id="taxOrder" value="<?php echo $value['orden'] ?>" hidden></input>
                                <pre class="indent "><?php echo "Orden: " . $value['orden']; ?></pre>
                            </li>
                            <li class="list-group-item text-start">
                                <input id="taxFamily" value="<?php echo $value['familia'] ?>" hidden></input>
                                <pre class="indent"><?php echo "           ﹂Familia: " . $value['familia']; ?></pre>
                            </li>
                            <li class="list-group-item text-start">
                                <input id="taxSubfamily" value="<?php echo $value['subfamilia'] ?>" hidden></input>
                                <pre
                                    class="indent"><?php echo "                       ﹂Subfamilia: " . $value['subfamilia']; ?></pre>
                            </li>
                            <li class="list-group-item text-start">
                                <input id="id_gender" value="<?php echo $value['id_genero'] ?>" hidden></input>
                                <input id="taxGender" value="<?php echo $value['genero'] ?>" hidden></input>
                                <pre
                                    class="indent"><?php echo "                                  ﹂Género: " . $value['genero']; ?></pre>
                            </li>
                            <li class="list-group-item text-start">
                                <input id="id_species" value="<?php echo $value['id_especie'] ?>" hidden></input>
                                <input id="taxSpecies" value="<?php echo $value['especie'] ?>" hidden></input>
                                <pre
                                    class="indent"><?php echo "                                                   ﹂Especie: " . $value['especie']; ?></pre>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    ?>
</div>
</div>

<!--Modal -->
<div class="modal fade" id="imgModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Añadir imágenes
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container my-4">
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-12 mb-3 my-4 d-flex justify-content-center">
                            <div class="col-xl-12 col-sm-12 col-md-12" id="div-img">
                                <label for="" id="img-specimen">Seleccione las imágenes</label>
                                <input class="form-control" id="imageFiles" type="file" name="imageFiles[ ]"
                                    onchange="verifyImages()" multiple>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="?controller=Specimen&action=updateImages" method="post" enctype="multipart/form-data">
                    <input id="submit-specimen" name="submit-specimen" type="text" hidden>
                    <input class="form-control" id="select-imageFiles" type="file" name="select-imageFiles[ ]" multiple
                        hidden>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
                    <button id="save-changes" type="submit" class="btn btn-success" disabled>Agregar imágenes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Eliminar imagen
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container my-4">
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="alert alert-danger" role="alert">
                            ¿Desea eliminar la imagen?
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="?controller=Specimen&action=deleteImage" method="post">
                    <input id="submit-img" name="submit-img" type="text" hidden>
                    <input id="submit-route" name="submit-route" type="text" hidden>
                    <input id="submit-specimen-delete" name="submit-specimen-delete" type="text" hidden>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                    <button id="save-changes" type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal -->
<div class="modal fade" id="taxModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Actualizar taxonomía
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container my-4">
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-xl-6 col-md-8 col-sm-12 mb-3 mb-3">
                            <label for="order" class="form-label" id="" name="">Nombre del orden</label>
                            <input class="form-control is-valid" list="list-orders" id="name-order" name="name-order"
                                placeholder="Nombre orden" oninput=" findOrderModal()">
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
                                name="name-family" placeholder="Nombre familia" oninput=" findFamilyModal()">
                            <div class="invalid-feedback" id="family-feed"></div>
                            <datalist id="list-families">
                            </datalist>
                        </div>
                    </div>
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-xl-6 col-md-8 col-sm-12 mb-3 mb-3" id="div-subfamily">
                            <label for="order" class="form-label" id="" name="">Nombre de la subfamilia</label>
                            <input class="form-control is-valid" list="list-subfamilies" id="name-subfamily"
                                name="name-subfamily" placeholder="Nombre subfamilia" oninput=" findSubfamilyModal()">
                            <div class="invalid-feedback" id="subfamily-feed"></div>
                            <datalist id="list-subfamilies">
                            </datalist>
                        </div>
                    </div>
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-xl-6 col-md-8 col-sm-12 mb-3 mb-3" id="div-gender">
                            <label for="order" class="form-label" id="" name="">Nombre del género</label>
                            <input class="form-control is-valid" list="list-genders" id="name-gender" name="name-gender"
                                placeholder="Nombre género" oninput=" findGenderModal()">
                            <div class="invalid-feedback" id="gender-feed"></div>
                            <datalist id="list-genders">
                            </datalist>
                        </div>
                    </div>
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-xl-6 col-md-8 col-sm-12 mb-3 mb-3" id="div-species">
                            <label for="family" class="form-label">Nombre de la especie</label>
                            <input class="form-control  is-valid" id="name-species" name="name-species" type="text"
                                list="list-species" oninput="findSpeciesModal()">
                            <div class="invalid-feedback" id="species-feed"></div>
                            <datalist id="list-species">
                            </datalist>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="?controller=Specimen&action=updateTaxSpecimen" method="post">
                    <input id="select-gender" name="select-gender" type="text" hidden>
                    <input id="select-species" name="select-species" type="text" hidden>
                    <input id="submit-specimen-tax" name="submit-specimen-tax" type="text" hidden>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
                    <button id="save-changes-tax" type="submit" class="btn btn-success">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade " id="tagModal" tabindex="-1" aria-labelledby="tagModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar etiqueta
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
                            <input class="form-control is-valid" list="list-countries" id="name-country"
                                name="name-country" placeholder="Pais" oninput="findCountry();">
                            <div class="invalid-feedback" id="country-feed">
                            </div>
                            <datalist id="list-countries">
                                <?php
                                foreach ($vars['countries'] as $key => $value) {
                                    ?>
                                    <option id="<?php echo $value[0]; ?>" value="<?php echo $value[1]; ?>"></option>
                                    <?php
                                }
                                ?>
                            </datalist>
                        </div>
                        <div class="col-5 mb-3">
                            <label for="province" id="province" name="province">Provincia</label>
                            <input class="form-control is-valid" list="list-provinces" id="name-province"
                                name="name-province" placeholder="Provincia" oninput="findProvince(); ">
                            <div class="invalid-feedback" id="province-feed">
                            </div>
                            <datalist id="list-provinces">
                            </datalist>
                        </div>
                    </div>

                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-5 mb-3 mx-2">
                            <label for="canton" id="canton" name="canton">Cantón</label>
                            <input class="form-control is-valid" list="list-cantons" id="name-canton" name="name-canton"
                                placeholder="Cantón" oninput="findCanton(); infoTag()">
                            <div class="invalid-feedback" id="canton-feed"></div>
                            <datalist id="list-cantons">
                            </datalist>
                        </div>
                        <div class="col-5 mb-3">
                            <label for="district" id="district" name="district">Distrito</label>
                            <input class="form-control is-valid" list="list-districts" id="name-district"
                                name="name-district" placeholder="Distrito"
                                oninput="findDistrict();  validateFields();">
                            <div class="invalid-feedback" id="district-feed">
                            </div>
                            <datalist id="list-districts">
                            </datalist>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3 d-flex justify-content-center">
                    <div class="col-5 mb-3">
                        <label for="date" id="date" name="date">Fecha</label>
                        <input class="form-control is-valid" id="input-date" name="input-date" type="date"
                            onchange="addDate(this.value); validateFields();  infoTag()">
                        <div class="invalid-feedback" id="date-feed"></div>
                    </div>
                    <div class="col-5 mb-3 mx-2">
                        <label for="collector" id="collector" name="collector">Recolector</label>
                        <input class="form-control is-valid" name="input-collector" id="input-collector"
                            oninput="addName(this.value);  validateFields();  infoTag()">
                        <div class="invalid-feedback" id="collector-feed"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                <form method="post" action="?controller=Specimen&action=updateTagSpecimen">
                    <input id="submit-tag" name="submit-tag" type="text" hidden>
                    <input id="submit-specimen-tag" name="submit-specimen-tag" type="text" hidden>
                    <input id="select-district" name="select-district" type="text" hidden>
                    <input id="submit-date" name="submit-date" type="text" hidden>
                    <input id="submit-collector" name="submit-collector" type="text" hidden>
                    <button id="save-changes-tag" type="submit" class="btn btn-success" disabled>Guardar cambios
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal -->
<div class="modal fade" id="storageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Actualizar almacenaje
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container my-4">
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-12 mb-3 d-flex justify-content-center">
                            <div class="col-6">
                                <label id="cabinet" for="cabinet">Identificador del Gabinete</label>
                                <label id="box" for="box" style="display:none">Identificador de la Caja</label>
                                <input class="form-control is-valid" id="number-cabinet" name="number-cabinet"
                                    oninput="validateStorage(this,'cabinet-feed')">
                                <div class="invalid-feedback" id="cabinet-feed"></div>
                                <label id="label-drawer" for="label-drawer">Identificador de la Gaveta</label>
                                <label id="vial" for="vial" style="display:none">Identificador del Vial</label>
                                <input class="form-control is-valid" id="number-drawer" name="number-drawer"
                                    oninput="validateDrawer(this,'drawer-feed')">
                                <div class="invalid-feedback" id="drawer-feed"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="?controller=Specimen&action=updateLocationSpecimen" method="post">
                        <input id="submit-specimen-storage" name="submit-specimen-storage" type="text" hidden>
                        <input id="submit-storage" name="submit-storage" type="text" hidden>
                        <input id="submit-drawer" name="submit-drawer" type="text" hidden>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
                        <button id="save-changes-storage" type="submit" class="btn btn-success">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });	</script>

<?php
include_once './public/footer.php';
?>