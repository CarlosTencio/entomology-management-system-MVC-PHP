<?php
include_once './public/headerUser.php';
?>

<div class="container my-4 content">
    <form class="row g-1 form-input" action="?controller=Plant&action=listGenderPlant" method="post">
        <div class="col-12 mb-3 my-4 text-center">
            <h2 class="title">Buscar por Planta Hospedadora</h2>
            <hr class="border-success  border-3">
        </div>
        <div class="col-12 d-flex">
            <div class="col-xl-3 col-md-4 col-sm-6 mx-1">
                <div class="form-floating mb-3">

                    <input type="text" class="form-control" id="plant" name="plant" class="col-sm-2"
                        placeholder="Planta hospedadora" required>
                    <label for="floatingInput" style="color:black">Nombre de la planta hospedadora</label>
                </div>
            </div>
            <div class="col-xl-1 col-md-4 col-sm-3 mb-3 mx-2">
                <input type="submit" class="btn btn-secondary" id="search" name="search" value="Buscar">
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6 mb-3 mx-2">
                <h4 class="subtitle">Búsqueda de:
                    <?php echo $vars['name'] ?>
                </h4>
            </div>
        </div>
    </form>
    <hr class="border-light  border-2">
    <div class="col-12 table-responsive">
        <?php if ($vars['lista'] == null) {
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
                            <th style="color:aliceblue">Género</th>
                            <th style="color:aliceblue">Cantidad de especies</th>
                            <th style="color:aliceblue">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="Tbody">
                        <?php
                        $contador = 0;
                        foreach ($vars['lista'] as $value) {
                            ?>
                            <tr>
                                <td style="color:aliceblue">
                                    <?php echo $value['Orden']; ?>
                                </td>
                                <td style="color:aliceblue">
                                    <?php echo $value['Familia']; ?>
                                </td>
                                <td style="color:aliceblue">
                                    <?php echo $value['Subfamilia']; ?>
                                </td>
                                <td style="color:aliceblue">
                                    <?php echo $value['Genero']; ?>
                                    <input type="text" id="id<?php echo $contador ?>" name="id"
                                        value="<?php echo $value['id_genero']; ?>" hidden>
                                </td>
                                <td style="color:aliceblue">
                                    <?php echo $value['Especies']; ?>
                                </td>
                                <td>
                                    <?php
                                    if ($_SESSION['viewsGenders'] != null) {
                                        if (!in_array($value['id_genero'], $_SESSION['viewsGenders'])) {
                                            ?>
                                            <button class="btn btn-light" type="button" value="0"
                                                onclick="addToViewsSuperuser('<?php echo $_SESSION['username'] ?>', '1',$('#id<?php echo $contador ?>').val(),this);">
                                                <img src="public/img/see.png" alt=""></button>
                                        <?php } else
                                            if (in_array($value['id_genero'], $_SESSION['viewsGenders'])) { ?>
                                                <button button class="btn btn-danger" type="button" value="1"
                                                    onclick="addToViewsSuperuser('<?php echo $_SESSION['username'] ?>', '1',$('#id<?php echo $contador ?>').val(),this);">
                                                    <img src="public/img/nosee.png" alt=""></button>
                                            <?php }
                                    } else { ?>
                                    <button class="btn btn-light" type="button" value="0"
                                        onclick="addToViewsSuperuser('<?php echo $_SESSION['username'] ?>','1', $('#id<?php echo $contador ?>').val(),this);">
                                        <img src="public/img/see.png" alt=""></button>
                                <?php }
                                    ?>
                                    <?php
                                    if ($_SESSION['carGenders'] != null) {
                                        if (!in_array($value['id_genero'], $_SESSION['carGenders'])) {
                                            ?>
                                            <button class="btn btn-secondary" type="button" value="0"
                                                onclick="addToCarSuperuser('<?php echo $_SESSION['username'] ?>', '1',$('#id<?php echo $contador ?>').val(),this);">
                                                <img src="public/img/addCar.png" alt=""></button>
                                        <?php } else
                                            if (in_array($value['id_genero'], $_SESSION['carGenders'])) { ?>
                                                <button button class="btn btn-danger" type="button" value="1"
                                                    onclick="addToCarSuperuser('<?php echo $_SESSION['username'] ?>', '1', $('#id<?php echo $contador ?>').val(), this);">
                                                    <img src="public/img/delete.png" alt=""></button>
                                            <?php }
                                    } else { ?>
                                    <button class="btn btn-secondary" type="button" value="0"
                                        onclick="addToCarSuperuser('<?php echo $_SESSION['username'] ?>', '1',$('#id<?php echo $contador ?>').val(),this);">
                                        <img src="public/img/addCar.png" alt=""></button>
                                <?php }
                                    ?>
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

<?php
include_once './public/footer.php';
?>