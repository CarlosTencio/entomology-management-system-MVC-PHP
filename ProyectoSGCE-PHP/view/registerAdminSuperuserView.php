<?php
include_once './public/headerSuperuser.php';
?>

<div class="container my-4 content">
    <form class="row g-3 form-input" method="post" action="?controller=User&action=registerAdmin">
        <div class="text-center">
            <h2 class="title">Registrar Administrador</h2>
            <hr class="border-success  border-3">
            <?php if (isset($vars['user-registered'])) { ?>
                <div class="col-12 mb-3 d-flex justify-content-center">
                    <div class="col-5 mb-3">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            Se registró correctamente el administrador<br>
                            Con nombre:
                            <?php echo $vars['user-registered']; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-3 mb-3" id="div-order">
                    <label for="username" class="form-label">Nombre usuario</label>
                    <input class="form-control is-invalid" id="username" name="username" type="text"
                        oninput="validateRegisteredUser(this,'username-feed')" required>
                    <div class="invalid-feedback" id="username-feed">Este campo no puede estar vacío</div>
                </div>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center">
                <div class="col-3 mb-3" id="div-order">
                    <label for="user" class="form-label">Contraseña usuario</label>
                    <input class="form-control is-invalid" id="password" name="password" type="text"
                        oninput="validateEmptyPassword(this,'password-feed')" disabled required >
                    <div class="invalid-feedback" id="password-feed">Este campo no puede estar vacío</div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <input id="save-user" class="btn btn-success" type="submit" value="Registrar" disabled>
            </div>
    </form>
</div>

<?php
include_once './public/footer.php';
?>