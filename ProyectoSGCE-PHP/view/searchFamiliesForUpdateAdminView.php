<?php
include_once './public/headerAdmin.php';
?>
<div class="container my-4 content">
    <form name="form-order" id="form-order" class="row g-2 form-input"
        action="?controller=Family&action=searchFamilyForUpdate" method="post" class="form-inline">
        <div class="col-12 mb-3 my-4 text-center">
            <h2 class="title">Actualizar Familia</h2>
            <hr class="border-success  border-3">
        </div>
        <div class="col-xl-3 col-md-12 col-sm-12">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="family" name="family" placeholder="family">
                <label for="floatingInput" style="color:black">Ingrese familia</label>
            </div>
        </div>
        <div class="col-xl-2 col-md-12 col-sm-12 mx-1">
            <input type="submit" class="btn btn-secondary" name="search" value="Buscar">
        </div>
        <div class="col-xl-2 col-md-12 col-sm-12">
            <h4 class="subtitle">Búsqueda de:
                <?php echo $vars['name'] ?>
            </h4>
        </div>
    </form>

    <hr class="border-light  border-2">
    <div class="col-12 table-responsive text-center">
        <?php if ($vars['families'] == null) {
            ?>
            <div class="alert alert-danger text-center mb-3" role="alert">
                No se encontraron elementos</div>
            <?php
        } else { ?>
            <table class="table" id="resultsTable">
                <thead>
                    <tr>
                        <th style="color:aliceblue">Orden</th>
                        <th style="color:aliceblue">Nombre de familia</th>
                        <th style="color:aliceblue">Acciones</th>
                    </tr>
                </thead>
                <tbody id="Tbody">
                    <?php
                    $count = 0;
                    foreach ($vars['families'] as $value) {
                        ?>
                        <tr>
                            <input id="family<?php echo $count; ?>" type="text" value="<?php echo $value['id_familia']; ?>"
                                hidden>
                            <input id="id_order<?php echo $count; ?>" type="text" value="<?php echo $value['id_orden']; ?>"
                                hidden>
                            <input id="order<?php echo $count; ?>" type="text" value="<?php echo $value['orden']; ?>" hidden>
                            <input id="name<?php echo $count; ?>" type="text" value="<?php echo $value['nombre']; ?>" hidden>
                            <td style="color:aliceblue">
                                <?php echo $value['orden']; ?>
                            </td>
                            <td style="color:aliceblue">
                                <?php echo $value['nombre']; ?>
                            </td>
                            <td style="color:aliceblue">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#familyModal"
                                    onclick="chargeInfoFamily($('#id_order<?php echo $count; ?>').val(),$('#order<?php echo $count; ?>').val(),$('#family<?php echo $count; ?>').val(),$('#name<?php echo $count; ?>').val())">Editar
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

<!-- Modal -->
<div class="modal fade" id="familyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Actualizar Familia
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
                                oninput="findOrderModal();validateRegisteredFamilyForUpdate(document.getElementById('name-family-modal'),'name-feed')">
                            <div class="invalid-feedback" id="order-feed">El orden existe</div>
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
                            <input class="form-control is-valid" id="name-family-modal" name="name-family-modal"
                                type="text" oninput="validateRegisteredFamilyForUpdate(this,'name-feed')">
                            <div class="invalid-feedback" id="name-feed">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="?controller=Family&action=updateFamily" method="post">
                    <input id="select-order" name="select-order" type="text" hidden>
                    <input id="submit-order" name="submit-order" type="text" hidden>
                    <input id="id-family" name="id-family" type="text" hidden>
                    <input id="name-family" name="name-family" type="text" hidden>
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