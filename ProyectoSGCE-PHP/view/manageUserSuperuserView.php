<?php
include_once './public/headerSuperuser.php';
?>



<div class="container my-4 content">
    <div class="row g-3 form-input">
        <div class="text-center">
            <h2 class="title">Gestionar usuarios</h2>
            <hr class="border-success  border-3">
            <div class="table-responsive">

                <table class="table" id="resultsTable">
                    <thead>
                        <tr>
                            <th style="color:aliceblue">Nombre de usuario</th>
                            <th style="color:aliceblue">Tipo de usuario</th>
                            <th style="color:aliceblue">Estado</th>
                            <th style="color:aliceblue">Habilitar/Deshabilitar</th>
                        </tr>
                    </thead>
                    <tbody id="Tbody">
                        <?php foreach ($vars['users'] as $value) { ?>
                            <form action="?controller=User&action=activateUser" method="post">
                                <tr> <!-- Agregar etiqueta <tr> para cada fila -->
                                        <input type="text" name="id_usuario" value="<?php echo $value['id_usuario'] ?>" hidden>

                                    <td style="color:aliceblue">
                                        <?php echo $value['nombre_usuario'] ?>
                                    </td>
                                    <td style="color:aliceblue">
                                        <?php if ($value['tipo_usuario'] == 1) {
                                            echo 'Estudiante';
                                        } else if ($value['tipo_usuario'] == 2) {
                                            echo 'Profesor';
                                        } else {
                                            echo 'Administrador';
                                        }
                                        ?>
                                    </td>
                                    <td style="color:aliceblue">
                                        <?php if ($value['is_active'] == 0) {
                                            echo 'Desactivado'; ?>
                                        <?php } else if ($value['is_active'] == 1) {
                                            echo 'Activado'; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="color:aliceblue">
                                        <?php if ($value['is_active'] == 0) { ?>
                                            <button class="btn btn-success" type="submit" value="" onclick=""><img
                                                    src="public/img/on.png" alt=""></button>
                                        <?php } else if ($value['is_active'] == 1) { ?>
                                                <button class="btn btn-danger" type="submit" value="" onclick=""><img
                                                        src="public/img/on.png" alt=""></button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </form>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    include_once './public/footer.php';
    ?>