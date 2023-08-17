<?php
include_once './public/headerSuperuser.php';
?>
<div class="container my-4 mb-3 content">
    <div class="col-12 table-responsive">
        <h2 class="title">Especímenes de:
            <?php echo $vars['name'] ?> 
        </h2>
        <hr class="border-success  border-3">

        <?php if ($vars['specimens'] == null) {
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
                                    <form action="?controller=Specimen&action=showSpecimen" method="post">
                                        <input id="gender" name="gender" value="<?php echo $value['id_genero'] ?>" hidden>
                                        <input id="species" name="species" value="<?php echo $value['id_especie'] ?>" hidden>
                                        <input id="specimenform" name="specimen" value="<?php echo $value['id_especimen'] ?>"
                                            hidden>
                                        <button class="btn btn-info" type="submit" onclick="">Detalles</button>
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

<?php
include_once './public/footer.php';
?>