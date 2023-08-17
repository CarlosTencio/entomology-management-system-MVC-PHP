<?php
include_once './public/headerSuperuser.php';
?>

<div class="container my-4 mb-3 content">
    <div class="col-12 table-responsive">
        <h2 class="title">Elementos en el carrito</h2>
        <hr class="border-success  border-3">
        <form action="?controller=Specimen&action=showLocationSpecimens" method="post">
            <input class="btn btn-secondary" type="submit" name="location" id="location" value="Ver ubicaciones" style="margin-bottom: 1em;">
        </form>
        
        <?php if ($vars['car'] == null) {
            ?>
            <div class="alert alert-danger text-center mb-3" role="alert">
                No se encontraron elementos guardados</div>
            <?php
        } else { ?>
            <div class="col-12 d-flex">
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
                        foreach ($vars['car'] as $value) {
                            ?>
                            <tr>
                                <td style="color:aliceblue">
                                    <?php echo $value['tipo'] ?>

                                    <input id="article<?php echo $contador ?>" name=""
                                        value="<?php echo $value['tipo_articulo'] ?>" hidden></input>
                                </td>
                                <td style="color:aliceblue">
                                    <?php echo $value['nombre']
                                        ?>
                                    <input id="article<?php echo $contador ?>" name="type"
                                        value="<?php echo $value['nombre'] ?>" hidden></input>
                                </td>
                                <td style="color:aliceblue">
                                    <?php if ($value['tipo_articulo'] == 2) { ?>
                                        <form action="?controller=Specimen&action=showSpecimens" method="post">
                                            <input id="namespecies" name="namespecies" value="<?php echo $value['nombre'] ?>" hidden>
                                            <input id="species" name="species" value="<?php echo $value['id_articulo'] ?>" hidden>
                                            <button class="btn btn-secondary" type="submit" onclick="">Ver especímenes</button>
                                            <button class="btn btn-danger" type="button" onclick="addToCarSuperuser('<?php echo $_SESSION['username'] ?>',
                                        '<?php echo $value['tipo_articulo'] ?>',
                                        '<?php echo $value['id_articulo'] ?>',
                                        this);" value="1"> <img src="public/img/delete.png" alt=""></button>
                                        </form>
                                        <?php
                                    } else if ($value['tipo_articulo'] == 1) { ?>
                                            <form action="?controller=Species&action=showSpecies" method="post">
                                                <input id="namegender" name="namegender" value="<?php echo $value['nombre'] ?>" hidden>
                                                <input id="gender" name="gender" value="<?php echo $value['id_articulo'] ?>" hidden>
                                                <button class="btn btn-secondary" type="submit" onclick="">Ver especies</button>
                                                <button class="btn btn-danger" type="button" onclick="addToCarSuperuser('<?php echo $_SESSION['username'] ?>',
                                        '<?php echo $value['tipo_articulo'] ?>',
                                        '<?php echo $value['id_articulo'] ?>',
                                        this);" value="1"><img src="public/img/delete.png" alt=""></button>
                                            </form>
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