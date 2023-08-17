<?php
include_once './public/headerSuperuser.php';
?>

<div class="container my-4 mb-3 content">
    <div class="col-12 table-responsive">
 
        <hr class="border-success  border-3">

        <?php if ($vars['specimen'] == null) { ?>
            <div class="alert alert-danger text-center mb-3" role="alert">
                No se encontraron especimens
            </div>
        <?php } else { ?>
            <div class="col-12 d-flex">
                <table class="table" id="resultsTable">
                    <thead>
                        <tr>
                            <th style="color:aliceblue">Género/Especie</th>
                            <th style="color:aliceblue">Gabinete/Caja</th>
                            <th style="color:aliceblue">Gaveta/Vial</th>
                        </tr>
                    </thead>
                    <tbody id="Tbody">
                        <?php
                    
                        foreach ($vars['specimen'] as $value) {
                            ?>
                            <tr>
                            <td style="color:aliceblue">
                                <?php echo $value['nombre']; ?>
                            </td>
                            <td style="color:aliceblue">
                                <?php echo $value['num_gabinete']; ?>
                            </td>
                            <td style="color:aliceblue">
                                <?php echo $value['num_gaveta']; ?>
                            </td>
                            </tr>
                            <?php
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