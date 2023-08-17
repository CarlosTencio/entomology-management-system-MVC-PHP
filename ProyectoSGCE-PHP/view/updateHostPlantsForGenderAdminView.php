<?php
include_once './public/headerAdmin.php';
?>

<div class="container my-4 content">
    <form class="g-1 form-input" method="post" action="?controller=Gender&action=listGenderSpeciesForUpdate">
        <input id="inputSearch" name="inputSearch" value="<?php echo $vars['inputSearch'] ?>"hidden>
        <button class="btn btn-secondary my-1">Volver</button>
    </form>
    <div class="col-12 mb-3 my-4 text-center">
        <h2 class="title">Asociar/Desasociar Plantas Hospedadoras</h2>
        <h5 class="" style="color:white">Plantas asociadas al género: <?php echo $vars['name-gender'] ?></h5>
        <hr class="border-success  border-3">
    </div>
    <?php if (isset($vars['updated'])) { ?>
        <div class="col-xl-12 col-md-6 col-sm-12 mb-3 text-center">
            <div class="alert alert-success" role="alert">
                <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                    aria-label="Close"></button>
                Se actualizaron correctamente las plantas<br>
            </div>
        </div>
        <?php
    } ?>
    <form class="row g-1 form-input" method="post" action="?controller=Gender&action=updatePlantsGender">
        <div class="col-xl-12 col-md-6 col-sm-12 text-center">
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
                    <?php
                    $inicio = 0; // Número a partir del cual deseas empezar a mostrar los elementos
                    $contador = 0;
                    $checkboxesSeleccionados = isset($_POST['checkbox-plants']) ? $_POST['checkbox-plants'] : array(); // Obtener los checkboxes seleccionados
                    ?>
                    <div class="table-responsive">
                        <table class="table " id="resultsTable">
                            <thead>
                                <tr>
                                    <th style="color:aliceblue">Planta</th>
                                    <th style="color:aliceblue">Seleccionar</th>
                                </tr>
                            </thead>
                            <tbody id="Tbody">
                                <?php foreach ($vars['plants'] as $key => $value) {
                                    $checkboxValue = $value['id_planta'];
                                    $isChecked = in_array($checkboxValue, $vars['plantsGender']); // Verificar si el checkbox está seleccionado en el arreglo $plantsGender
                                    ?>
                                    <tr>
                                        <td style="color:aliceblue">
                                            <?php echo $value['nombre_planta'] ?>
                                        </td>
                                        <td style="color:aliceblue">
                                            <input class="checkbox-plants" name="checkbox-plants[]" id="checkbox-plants"
                                                value="<?php echo $checkboxValue ?>" onclick="getValueCheckbox()"
                                                type="checkbox" <?php echo $isChecked ? 'checked' : '' ?> onclick="" />
                                        </td>
                                    </tr>
                                    <?php
                                    $contador++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class=' col-xl-12 col-md-6 col-sm-12 text-center mb-3'>
            <button class="btn btn-success" type="submit">Guardar Cambios</button>
        </div>
        <input id="gender-plant" name="gender-plant" value="<?php echo $vars['gender'] ?>" hidden>
        <input id="search-value" name="search-value" value="<?php echo $vars['inputSearch'] ?>"hidden>
    </form>
</div>

<?php
include_once './public/footer.php';
?>