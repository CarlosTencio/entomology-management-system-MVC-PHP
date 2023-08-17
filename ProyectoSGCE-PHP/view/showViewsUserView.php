<?php
include_once './public/headerUser.php';
?>

<div class="container my-4 mb-3 content">
    <div class="col-12 table-responsive">
        <h2 class="title">Elementos vistos</h2>
        <hr class="border-success  border-3">

        <?php if ($vars['views'] == null) {
            ?>
            <div class="alert alert-danger text-center mb-3" role="alert">
                No se encontraron elementos vistos</div>
            <?php
        } else { ?>
            <table class="table" id="resultsTable">
                <thead>
                    <tr>
                        <th style="color:aliceblue">Tipo</th>
                        <th style="color:aliceblue">Nombre</th>
                        <th style="color:aliceblue">Acciones</th>

                    </tr>
                </thead>
                <tbody id="Tbody">
                    <?php
                    $contador = 0;
                    foreach ($vars['views'] as $value) {
                        ?>
                        <tr>
                            <td style="color:aliceblue">
                                <?php echo $value['tipo'] ?>

                                <input id="article<?php echo $contador ?>" name="" value="<?php echo $value['tipo_articulo'] ?>"
                                    hidden></input>
                            </td>
                            <td style="color:aliceblue">
                                <?php echo $value['nombre']
                                    ?>
                                <input id="article<?php echo $contador ?>" name="type" value="<?php echo $value['nombre'] ?>"
                                    hidden></input>
                            </td>
                            <td style="color:aliceblue">

                                <?php if ($value['tipo_articulo'] == 1) { ?>
                                    <button class="btn btn-danger" type="button" onclick="addToViewsSuperuser('<?php echo $_SESSION['username'] ?>',
                                        '<?php echo $value['tipo_articulo'] ?>',
                                        '<?php echo $value['id_articulo'] ?>',
                                        this);" value="1">
                                        <img src="public/img/nosee.png" alt="">
                                    </button>
                                    <?php
                                    if ($_SESSION['carGenders'] != null) {
                                        if (!in_array($value['id_articulo'], $_SESSION['carGenders'])) {
                                            ?>
                                            <button class="btn btn-secondary" type="button" value="0"
                                                onclick="addToCarSuperuser('<?php echo $_SESSION['username'] ?>', '<?php echo $value['tipo_articulo'] ?>',('<?php echo $value['id_articulo'] ?>'),this);">
                                                <img src="public/img/addCar.png" alt=""></button>
                                        <?php } else
                                            if (in_array($value['id_articulo'], $_SESSION['carGenders'])) { ?>
                                                <button button class="btn btn-danger" type="button" value="1"
                                                    onclick="addToCarSuperuser('<?php echo $_SESSION['username'] ?>', '<?php echo $value['tipo_articulo'] ?>', ('<?php echo $value['id_articulo'] ?>'), this);">
                                                    <img src="public/img/delete.png" alt=""></button>
                                            <?php }
                                    } else { ?>
                                        <button class="btn btn-secondary" type="button" value="0"
                                            onclick="addToCarSuperuser('<?php echo $_SESSION['username'] ?>', '<?php echo $value['tipo_articulo'] ?>',('<?php echo $value['id_articulo'] ?>'),this);">
                                            <img src="public/img/addCar.png" alt=""></button>
                                    <?php } ?>
                                    <?php
                                } else if ($value['tipo_articulo'] == 2) { ?>
                                        <button class="btn btn-danger" type="button" onclick="addToViewsSuperuser('<?php echo $_SESSION['username'] ?>',
                                        '<?php echo $value['tipo_articulo'] ?>',
                                        '<?php echo $value['id_articulo'] ?>',
                                        this);" value="1">
                                            <img src="public/img/nosee.png" alt="">
                                        </button>
                                        <?php
                                        if ($_SESSION['carSpecies'] != null) {
                                            if (!in_array($value['id_articulo'], $_SESSION['carSpecies'])) {
                                                ?>
                                                <button class="btn btn-secondary" type="button" value="0"
                                                    onclick="addToCarSuperuser('<?php echo $_SESSION['username'] ?>', '<?php echo $value['tipo_articulo'] ?>',('<?php echo $value['id_articulo'] ?>').val(),this);">
                                                    <img src="public/img/addCar.png" alt=""></button>
                                        <?php } else
                                                if (in_array($value['id_articulo'], $_SESSION['carSpecies'])) { ?>
                                                    <button class="btn btn-danger" type="button" value="1"
                                                        onclick="addToCarSuperuser('<?php echo $_SESSION['username'] ?>','<?php echo $value['tipo_articulo'] ?>',('<?php echo $value['id_articulo'] ?>'),this);">
                                                        <img src="public/img/delete.png" alt=""></button>
                                            <?php }
                                        } else { ?>
                                            <button class="btn btn-secondary" type="button" value="0"
                                                onclick="addToCarSuperuser('<?php echo $_SESSION['username'] ?>', '<?php echo $value['tipo_articulo'] ?>',('<?php echo $value['id_articulo'] ?>'),this);">
                                                <img src="public/img/addCar.png" alt=""></button>
                                    <?php }
                                        ?>
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

<?php
include_once './public/footer.php';
?>