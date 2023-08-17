<?php
include_once './public/headerAdmin.php';
?>

<div class="container  text-center my-4 content">
    <form class="row form-input" method="post" action="?controller=Gender&action=registerGenderAdmins"
        submit="clearCheckbox()">
        <div class="col-12 mb-3 my-4 text-center">
            <h2 class="subtitle">Registrar Género</h2>
            <hr class="border-success  border-3">
        </div>
        <?php if (isset($vars['gender-registered'])) { ?>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="ol-xl-5 col-md-5 col-sm-12 mb-3">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                            Se registró correctamente el género<br>
                            En <br>
                            Orden:
                            <?php echo $vars['order-registered']; ?> <br>
                            Familia:
                            <?php echo $vars['family-registered']; ?> <br>
                            Subamilia:
                            <?php echo $vars['subfamily-registered']; ?> <br>
                           Con Nombre:
                            <?php echo $vars['gender-registered']; ?> 
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="col-xl-6 col-md-6 col-sm-12  text-center">
            <div class="col-12 text-center">
                <h4 class="mb-2">Datos del género</h4>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-6 col-md-8 col-sm-12 mb-3">
                    <label for="order" class="form-label" id="" name="">Orden al que va a pertenecer</label>
                    <input class="form-control is-invalid" list="list-orders" id="name-order" name="name-order"
                        placeholder="Nombre orden" oninput=" findOrder()">
                    <div class="invalid-feedback" id="order-feed">El órden no existe</div>
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
                <div class="col-xl-6 col-md-8 col-sm-12 mb-3" id="div-family" style="display:none">
                    <label for="order" class="form-label" id="" name="">Familia al que va a pertenecer</label>
                    <input class="form-control is-invalid" list="list-families" id="name-family" name="name-family"
                        placeholder="Nombre orden" oninput=" findFamily()">
                    <div class="invalid-feedback" id="family-feed">Familia no existe</div>
                    <datalist id="list-families">
                    </datalist>
                </div>
            </div>
            <input type="text" name="select-family" id="select-family" hidden>
            <input type="text" name="select-subfamily" id="select-subfamily" hidden>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-6 col-md-8 col-sm-12 mb-3" id="div-subfamily" style="display:none">
                    <label for="order" class="form-label" id="" name="">Subfamilia al que va a pertenecer</label>
                    <input class="form-control is-invalid" list="list-subfamilies" id="name-subfamily"
                        name="name-subfamily" placeholder="Nombre subfamilia" oninput=" findSubfamily()">
                    <div class="invalid-feedback" id="subfamily-feed">Subfamilia no existe</div>
                    <datalist id="list-subfamilies">
                    </datalist>
                </div>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-6 col-md-8 col-sm-12  mb-3" id="div-gender" style="display:none">
                    <label for="family" class="form-label">Nombre género</label>
                    <input class="form-control is-invalid" id="name-gender" name="name-gender" type="text"
                        oninput="validateRegisteredGender(this,'name-feed')">
                    <div class="invalid-feedback" id="name-feed">Este campo no puede estar vacío</div>
                </div>
            </div>
            <div class="col-12 mb-3" id="button" style="display:none">
                <input class="btn btn-success" type="submit" value="Registrar">
            </div>
        </div>
        <div class="col-xl-6 col-md-6 col-sm-12 text-center">
            <div class="col-12 text-center">
                <h4 class="mb-2">Seleccione las plantas hospedadoras</h4>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <button class="page-link" type="button"
                                onclick=" previousButton(<?php echo $vars['plantsQuantity'] ?>)" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </button>
                        </li>
                        <?php for ($count = 0; $count < $vars['plantsQuantity']; $count++) { ?>
                            <li class="page-item"><button class="page-link" type="button"
                                    onclick="plantsPagination(<?php echo $count ?>)"><?php echo $count + 1 ?></button></li>
                        <?php } ?>
                        <li class="page-item">
                            <button class="page-link" type="button"
                                onclick=" nextButton(<?php echo $vars['plantsQuantity'] ?>)" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-xl-8 col-md-12 col-sm-12 mb-3">
                    <?php
                    $inicio = 0; // Número a partir del cual deseas empezar a mostrar los elementos
                    $contador = 0;
                    $checkboxesSeleccionados = isset($_POST['checkbox-plants']) ? $_POST['checkbox-plants'] : array(); // Obtener los checkboxes seleccionados
                    
                    for ($count = 0; $count < $vars['plantsQuantity']; $count++) { ?>
                        <div class="table-responsive" id='table-<?php echo $count ?>' <?php if ($count != 0) { ?>
                                style="display:none;" <?php } ?>>
                            <table class="table table-dark table-striped table-bordered" id="resultsTable">
                                <thead>
                                    <tr>
                                        <th style="color:aliceblue">Planta</th>
                                        <th style="color:aliceblue">Seleccionar</th>
                                    </tr>
                                </thead>
                                <tbody id="Tbody">
                                    <?php foreach ($vars['plants'] as $key => $value) {
                                        if ($key >= $inicio && $contador < 8) {
                                            $checkboxValue = $value['id_planta'];
                                            $isChecked = in_array($checkboxValue, $checkboxesSeleccionados); // Verificar si el checkbox está seleccionado
                                            ?>
                                            <tr> <!-- Agregar etiqueta <tr> para cada fila -->
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
                                    }
                                    $inicio = $inicio + $contador;
                                    $contador = 0; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
include_once './public/footer.php';
?>