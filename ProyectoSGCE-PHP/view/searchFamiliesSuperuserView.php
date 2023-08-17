<?php
include_once './public/headerSuperuser.php';
?>
<div class="container my-4 content">
    <form name="form-order" id="form-order" class="row g-2 form-input"
        action="?controller=Family&action=ListFamiliesAsc" method="post" class="form-inline">
        <div class="col-12 mb-3 my-4 text-center">
            <h2 class="title">Buscar por Familia</h2>
            <hr class="border-success  border-3">
        </div>
        <div class="col-12 d-flex">
            <div class="col-xl-3 col-md-4 col-sm-6 mx-1">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="family" name="family" placeholder="family">
                    <label for="floatingInput" style="color:black">Ingrese familia</label>
                </div>
            </div>
            <div class="col-xl-1 col-md-4 col-sm-3 mb-3 mx-2">
                <input type="submit" class="btn btn-secondary" name="search" value="Buscar">
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6 mb-3 mx-2">
                <h4 class="subtitle">Búsqueda de:
                    <?php echo $vars['name'] ?>
                </h4>
            </div>
        </div>
    </form>

    <div class="col-xs-1 d-inline-block">
        <form action="?controller=Family&action=ListFamiliesAsc" method="post" class="form-inline">
            <input type="text" name="family" id="family" value="<?php echo $vars['name']; ?>" hidden>
            <input type="submit" class="btn btn-secondary" name="asc" value="ASC">
        </form>
    </div>
    <div class="col-xs-1 d-inline-block">
        <form action="?controller=Family&action=ListFamiliesDesc" method="post" class="form-inline">
            <input type="text" name="family" id="family" value="<?php echo $vars['name']; ?>" hidden>
            <input type="submit" class="btn btn-secondary" name="desc" value="DESC">
        </form>
    </div>


    <hr class="border-light  border-2">
    <div class="col-12 table-responsive">

        <?php if ($vars['lista'] == null) {
            ?>
            <div class="alert alert-danger text-center mb-3" role="alert">
                No se encontraron elementos</div>
            <?php
        } else { ?>
            <table class="table" id="resultsTable">
                <thead>
                <tr>
                        <th style="color:aliceblue">Nombre de familia</th>
                        <th style="color:aliceblue">Subfamilias</th>
                        <th style="color:aliceblue">Géneros</th>
                        <th style="color:aliceblue">Especies</th>
                    </tr>
                </thead>
                <tbody id="Tbody">
                    <?php
                    foreach ($vars['lista'] as $value) {
                        ?>
                        <tr>
                            <td style="color:aliceblue">
                                <?php echo $value['nombre']; ?>
                            </td>
                            <td style="color:aliceblue">
                                <?php echo $value['total_subfamilias']; ?>
                            </td>
                            <td style="color:aliceblue">
                                <?php echo $value['total_generos']; ?>
                            </td>
                            <td style="color:aliceblue">
                                <?php echo $value['total_especies']; ?>
                            </td>
                        </tr>
                        <?php
                    }
        } ?>

            </tbody>
        </table>
    </div>
</div>
<?php
include_once './public/footer.php';
?>