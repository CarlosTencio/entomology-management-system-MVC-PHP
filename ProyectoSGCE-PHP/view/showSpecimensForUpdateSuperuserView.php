<?php
include_once './public/headerSuperuser.php';
?>
<div class="container my-4 mb-3 content">
    <div class="col-12 table-responsive">
        <h2 class="title">Especímenes de:
            <?php echo $vars['name'] ?>
        </h2>
        <hr class="border-success  border-3">
        <?php if (isset($vars['deleted'])) { ?>
        <div class="col-xl-3 col-md-6 col-sm-12 mb-3 d-flex justify-content-center">
            <div class="alert alert-success" role="alert">
                <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                    aria-label="Close"></button>
                Se eliminó correctamente el especimen<br>
            </div>
        </div>
        <?php 
        }
        if ($vars['specimens'] == null) {
            ?>
            <div class="alert alert-danger text-center mb-3" role="alert">
                No se encontraron especímenes para este género y especie</div>
            <?php
        } else { ?>
            <div class="col-12 d-flex">
                <table class="table" id="resultsTable">
                    <thead>
                        <tr>
                            <th style="color:aliceblue">Género</th>
                            <th style="color:aliceblue">Especie</th>
                            <th style="color:aliceblue">Lugar de almacenamiento</th>
                            <th style="color:aliceblue">Número</th>
                            <th style="color:aliceblue">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="Tbody">
                        <?php
                        $contador = 0;
                        foreach ($vars['specimens'] as $value) {
                            ?>
                            <tr>
                                <input id="specimen<?php echo $contador ?>" name="specimen"
                                    value="<?php echo $value['id_especimen'] ?>" hidden></input>
                                <td style="color:aliceblue">
                                    <?php echo $value['Genero'] ?>
                                </td>
                                <td style="color:aliceblue">
                                    <?php echo $value['Especie'] ?>
                                </td>
                                <td style="color:aliceblue">
                                    <?php echo $value['Almacenaje'] ?>
                                </td>
                                <td style="color:aliceblue">
                                    <?php echo $value['Lugar'] ?>
                                </td>
                                <td style="color:aliceblue">
                                    <form action="?controller=Specimen&action=showSpecimenForUpdate" method="post">
                                        <input id="specimenform" name="specimen" value="<?php echo $value['id_especimen'] ?>"
                                            hidden>
                                        <button class="btn btn-info" type="submit" onclick="">Actualizar</button>
                                        <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            onclick="chargeInfoSpecimen('<?php echo $value['id_especimen'] ?>')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>

                            <?php
                            $contador = $contador + 1;
                        } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</div>

<!--Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  ">
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
                            ¿Desea eliminar el especimen?
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="?controller=Specimen&action=deleteSpecimen" method="post">
                    <input id="submit-specimen" name="submit-specimen" type="text" hidden>
                    <input id="search-value" name="search-value" type="text" value=" <?php echo $vars['name'] ?>" hidden>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                    <button id="save-changes" type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once './public/footer.php';
?>