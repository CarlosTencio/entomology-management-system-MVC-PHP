<?php
include_once './public/headerSuperuser.php';
?>

<div class="container my-4 mb-3 content">
    <div class="col-12 table-responsive">
        <h2 class="title">Especies de:
            <?php echo $vars['name'] ?>
        </h2>
        <hr class="border-success  border-3">

        <?php if ($vars['species'] == null) { ?>
            <div class="alert alert-danger text-center mb-3" role="alert">
                No se encontraron especies para este género
            </div>
        <?php } else { ?>
            <div class="col-12 d-flex">
                <table class="table" id="resultsTable">
                    <thead>
                        <tr>
                            <th style="color:aliceblue">Orden</th>
                            <th style="color:aliceblue">Familia</th>
                            <th style="color:aliceblue">Subfamilia</th>
                            <th style="color:aliceblue">Género</th>
                            <th style="color:aliceblue">Especie</th>
                            <th style="color:aliceblue">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="Tbody">
                        <?php
                        $contador = 0;
                        foreach ($vars['species'] as $value) {
                            ?>
                            <tr>
                                <td style="color:aliceblue">
                                    <?php echo $value['orden'] ?>
                                </td>
                                <td style="color:aliceblue">
                                    <?php echo $value['familia'] ?>
                                </td>
                                <td style="color:aliceblue">
                                    <?php echo $value['subfamilia'] ?>
                                </td>
                                <td style="color:aliceblue">
                                    <?php echo $value['genero'] ?>
                                </td>
                                <td style="color:aliceblue">
                                    <?php echo $value['especie'] ?>
                                </td>
                                <td style="color:aliceblue">
                                    <form action="?controller=Specimen&action=showSpecimens" method="post">
                                        <input id="namespecies" name="namespecies" value="<?php echo $value['especie'] ?>" hidden>
                                        <input id="namegender" name="namegender" value="<?php echo $value['genero'] ?>" hidden>
                                        <input id="species" name="species" value="<?php echo $value['id_especie'] ?>" hidden>
                                        <button class="btn btn-secondary" type="submit">Ver especímenes</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                            $contador = $contador + 1;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</div>

<?php
include_once './public/footer.php';
?>