<?php
include_once './public/headerSuperuser.php';
?>
<div class="container my-4 content">
    <form action="?controller=Audit&action=listByYear" method="post" class="row g-2 form-input" >
        <div class="form-group d-flex">
            <label for="year" style="color: aliceblue;">Año:</label>
            <input type="text" class="form-control mx-3" id="year" name="year" style="width: 100px;" required>
            <button type="submit" class="btn btn-secondary">Buscar</button>
        </div>
    </form>

    <form action="?controller=Audit&action=listByDates" method="post" class="form-inline">
        <div class="form-group d-flex">
            <label for="initial-date" style="color: aliceblue;">Fecha inicial-final</label>
            <input type="date" class="form-control mx-3" id="initial-date" name="initial-date" style="width: 150px;" required>
           
            <input type="date" class="form-control mx-3" id="final-date" name="final-date" style="width: 150px;" required>
            <button type="submit" class="btn btn-secondary">Buscar</button>
        </div>
    </form>

    <table class="table" id="resultsTable">
        <thead>
            <tr>
                <th style="color: aliceblue;">Descripción</th>
                <th style="color: aliceblue;">Usuario</th>
                <th style="color: aliceblue;">Fecha</th>
            </tr>
        </thead>
        <tbody id="Tbody">
            <?php
            $contador = 0;
            foreach ($vars['lista'] as $value) {
                ?>
                <tr>
                    <td style="color: aliceblue;">
                        <?php echo $value['descripcion']; ?>
                    </td>
                    <td style="color: aliceblue;">
                        <?php echo $value['nombre_usuario']; ?>
                    </td>
                    <td style="color: aliceblue;">
                        <?php echo $value['date']; ?>
                    </td>
                </tr>
                <?php
            } ?>
        </tbody>
    </table>
</div>



<?php
include_once './public/footer.php';
?>