<?php
include_once './public/headerAdmin.php';
?>

<div class="container my-4 content">
    
    <hr class="border-success  border-3">
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
                            <th style="color:aliceblue">Género</th>
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
                                    <?php echo $value['genero']; ?>
                                    <input type="text" id="id<?php echo $contador ?>" name="id"
                                        value="<?php echo $value['id_genero']; ?>" hidden><!-- hacerlo como en views -->
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