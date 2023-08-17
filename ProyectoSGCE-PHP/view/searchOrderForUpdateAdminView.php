<?php
include_once './public/headerAdmin.php';
?>

<div class="container my-4 content">
    <form name="form-order" id="form-order" class="row g-3 form-input"
        action="?controller=Order&action=searchOrderForUpdate" method="post" class="form-inline">
        <div class="col-12 mb-3 my-4 text-center">
            <h2 class="title">Actualizar Orden</h2>
            <hr class="border-success  border-3">
        </div>
        <div class="col-12 d-flex">
            <div class="col-xl-3 col-md-12 col-sm-12 ">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="order" name="order" placeholder="orden">
                    <label for="floatingInput" style="color:black">Nombre del orden</label>
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
        </div>
    </form>
    <hr class="border-light  border-2">
    <div class="col-12 table-responsive text-center">
        <?php if ($vars['orders'] == null) {
            ?>
            <div class="alert alert-danger text-center mb-3" role="alert">
                No se encontraron elementos</div>
            <?php
        } else { ?>
            <table class="table" id="resultsTable">
                <thead>
                    <tr>
                        <th style="color:aliceblue">Nombre de orden</th>
                        <th style="color:aliceblue">Acción</th>
                    </tr>
                </thead>
                <tbody id="Tbody">
                    <?php
                    $count = 0;
                    foreach ($vars['orders'] as $value) {
                        ?>
                        <tr>
                            <input id="order<?php echo $count; ?>" type="text" value="<?php echo $value['id_orden']; ?>" hidden>
                            <input id="name<?php echo $count; ?>" type="text" value="<?php echo $value['nombre']; ?>" hidden>
                            <td style="color:aliceblue">
                                <?php echo $value['nombre']; ?>
                            </td>
                            <td style="color:aliceblue">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#orderModal"
                                    onclick="chargeInfoOrder($('#order<?php echo $count; ?>').val(),$('#name<?php echo $count; ?>').val())">Editar
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
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input class="form-control is-invalid" id="name-order-modal" name="name-order-modal"
                                type="text" oninput="validateRegisteredOrder(this,'name-feed') ">
                            <div class="invalid-feedback" id="name-feed">Este campo no puede estar
                                vacío
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="?controller=Order&action=updateOrder" method="post">
                    <input id="id-order" name="id-order" type="text" hidden>
                    <input id="name-order" name="name-order" type="text" hidden>
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