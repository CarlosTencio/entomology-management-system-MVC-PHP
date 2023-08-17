<?php
include_once './public/headerSuperuser.php';
?>


<div class="container my-4 content">
    <form name="form-order" id="form-order" class="row g-1 form-input"
        action="?controller=Subfamily&action=searchSubfamilyForUpdate" method="post" class="form-inline">
        <div class="col-12 mb-3 my-4 text-center">
            <h2 class="title">Actualizar Subfamilia</h2>
            <hr class="border-success  border-3">
        </div>
        <div class="col-xl-3 col-md-12 col-sm-12">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="subfamily" name="subfamily" placeholder="subfamilia">
                <label for="floatingInput" style="color:black">Ingrese el nombre de subfamilia</label>
            </div>
        </div>
        <div class="col-xl-2 col-md-12 col-sm-12 mx-1">
            <input type="submit" class="btn btn-secondary" id="search" name="search" value="Buscar">
        </div>
        <div class="col-xl-2 col-md-12 col-sm-12">
            <h4 class="subtitle">Búsqueda de:
                <?php echo $vars['name'] ?>
            </h4>
        </div>
    </form>

    <hr class="border-light border-2">
    <div class="col-12 table-responsive">
        <?php if ($vars['subfamilies'] == null) {
            ?>
            <div class="alert alert-danger text-center mb-3" role="alert">
                No se encontraron elementos</div>
            <?php
        } else { ?>
            <table class="table" id="resultsTable">
                <thead>
                    <tr>
                        <th style="color:aliceblue">Orden</th>
                        <th style="color:aliceblue">Familia</th>
                        <th style="color:aliceblue">Subfamilia</th>
                        <th style="color:aliceblue">Acciones</th>
                    </tr>
                </thead>
                <tbody id="Tbody">
                    <?php
                    $count = 0;
                    foreach ($vars['subfamilies'] as $value) {
                        ?>
                        <tr>
                            <input id="id_subfamily<?php echo $count; ?>" type="text"
                                value="<?php echo $value['id_subfamilia']; ?>" hidden>
                            <input id="id_family<?php echo $count; ?>" type="text" value="<?php echo $value['id_familia']; ?>"
                                hidden>
                            <input id="id_order<?php echo $count; ?>" type="text" value="<?php echo $value['id_orden']; ?>"
                                hidden>
                            <input id="order<?php echo $count; ?>" type="text" value="<?php echo $value['orden']; ?>" hidden>
                            <input id="family<?php echo $count; ?>" type="text" value="<?php echo $value['familia']; ?>" hidden>
                            <input id="name<?php echo $count; ?>" type="text" value="<?php echo $value['nombre']; ?>" hidden>

                            <td style="color:aliceblue">
                                <?php echo $value['orden']; ?>
                            </td>
                            <td style="color:aliceblue">
                                <?php echo $value['familia']; ?>
                            </td>
                            <td style="color:aliceblue">
                                <?php echo $value['nombre']; ?>
                            </td>
                            <td style="color:aliceblue">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#subfamilyModal"
                                    onclick="chargeInfoSubfamily($('#id_order<?php echo $count; ?>').val(),$('#order<?php echo $count; ?>').val(),
                                    $('#id_family<?php echo $count; ?>').val(),$('#family<?php echo $count; ?>').val(),
                                    $('#id_subfamily<?php echo $count; ?>').val() ,$('#name<?php echo $count; ?>').val())">Editar
                                </button>
                            </td>
                        </tr>
                        <?php
                        $count++;
                    }
        } ?>
            </tbody>
        </table>
    </div>
</div>


<!--Modal -->
<div class="modal fade" id="subfamilyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Actualizar Orden
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container my-4">
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-6 mb-3" id="">
                            <label for="order" class="form-label">Nombre orden</label>
                            <input class="form-control is-valid" id="name-order" list="list-orders" name="name-order"
                                type="text"
                                oninput="findOrderModal();validateRegisteredSubfamilyForUpdate(document.getElementById('name-subfamily-modal'),'name-feed')">
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
                        <div class="col-6 mb-3" id="">
                            <label for="family" class="form-label">Nombre familia</label>
                            <input class="form-control is-valid" id="name-family" name="name-family"
                                list="list-families" type="text"
                                oninput="findFamilyModal();validateRegisteredSubfamilyForUpdate(document.getElementById('name-subfamily-modal'),'name-feed')">
                            <div class="invalid-feedback" id="family-feed">
                            </div>
                            <datalist id="list-families">
                            </datalist>
                        </div>
                    </div>
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-6 mb-3" id="">
                            <label for="order" class="form-label">Nombre subfamilia</label>
                            <input class="form-control is-valid" id="name-subfamily-modal" name="name-subfamily-modal"
                                type="text" oninput="validateRegisteredSubfamilyForUpdate(this,'name-feed') ">
                            <div class="invalid-feedback" id="name-feed">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="?controller=Subfamily&action=updateSubfamily" method="post" onsubmit="chargeInputs()">
                    <input id="select-order" name="select-order" type="text" hidden>
                    <input id="submit-order" name="submit-order" type="text" hidden>
                    <input id="select-family" name="select-family" type="text" hidden>
                    <input id="submit-family" name="submit-family" type="text" hidden>
                    <input id="id-subfamily" name="id-subfamily" type="text" hidden>
                    <input id="name-subfamily" name="name-subfamily" type="text" hidden>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
                    <button id="save-changes" type="submit" class="btn btn-success" disabled>Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once './public/footer.php';
?>