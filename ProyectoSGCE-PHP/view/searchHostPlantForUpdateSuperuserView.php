<?php
include_once './public/headerSuperuser.php';
?>

<div class="container my-4 content">
    <form class="row g-1 form-input" action="?controller=Plant&action=searchPlantForUpdate" method="post">
    <div class="col-12 mb-3 my-4 text-center">
            <h2 class="title">Actualizar Planta Hospedadora</h2>
            <hr class="border-success  border-3">
        </div>
        <div class="col-xl-3 col-md-12 col-sm-12">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="plant" name="plant" class="col-sm-2"
                    placeholder="Planta hospedadora" required>
                <label for="floatingInput" style="color:black">Nombre de la planta hospedadora</label>
            </div>
        </div>
        <div class="col-xl-2 col-md-12 col-sm-12 mx-1">
            <input type="submit" class="btn btn-secondary" id="search" name="search" value="Buscar">
        </div>
            <div class="col-xl-2 col-md-4 col-sm-6 mb-3 mx-2">
                <h4 class="subtitle">Búsqueda de:
                    <?php echo $vars['name'] ?>
                </h4>
            </div>
    </form>

    <hr class="border-light border-2">
    <div class="col-xl-12  table-responsive  text-center">
        <?php if ($vars['plants'] == null) {
            ?>
            <div class="alert alert-danger text-center mb-3" role="alert">
                No se encontraron elementos</div>
            <?php
        } else { ?>
            <div class="col-12 d-flex">
                <table class="table" id="resultsTable">
                    <thead>
                        <tr>
                            <th style="color:aliceblue">Nombre</th>
                            <th style="color:aliceblue">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="Tbody">
                        <?php
                        $count = 0;
                        foreach ($vars['plants'] as $value) {
                            ?>
                            <tr>
                            <input id="plant<?php echo $count; ?>" type="text" value="<?php echo $value['id_planta']; ?>" hidden>
                            <input id="name<?php echo $count; ?>"  type="text" value="<?php echo $value['nombre_planta']; ?>" hidden>
                                <td style="color:aliceblue">
                                    <?php echo $value['nombre_planta']; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#plantModal" onclick="chargeInfoPlant($('#plant<?php echo $count; ?>').val(),$('#name<?php echo $count; ?>').val())">Actualizar
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
</div>

<!--Modal -->
<div class="modal fade" id="plantModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Actualizar Planta
                    Hospedadora
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container my-4">
                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <div class="col-6 mb-3" id="">
                            <label for="plant" class="form-label">Nombre planta hospedadora</label>
                            <input class="form-control is-invalid" id="name-plant-modal" name="name-plant-modal"
                                type="text" oninput="validateRegisteredPlant(this,'name-feed') ">
                            <div class="invalid-feedback" id="name-feed">Este campo no puede estar
                                vacío
                            </div>
                        </div>
                    </div>
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

<?php
include_once './public/footer.php';
?>