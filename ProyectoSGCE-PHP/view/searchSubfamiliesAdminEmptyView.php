<?php
include_once './public/headerAdmin.php';
?>


<div class="container my-4 content">
    <form class="row g-1 form-input" action="?controller=Subfamily&action=ListSubfamiliesAsc" method="post">
        <div class="col-12 mb-3 my-4 text-center">
            <h2 class="title">Buscar por Subfamilia</h2>
            <hr class="border-success  border-3">
        </div>
        <div class="col-12 d-flex">
            <div class="col-xl-3 col-md-4 col-sm-6 mx-1">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="subfamily" name="subfamily" placeholder="subfamilia">
                    <label for="floatingInput" style="color:black">Nombre de subfamilia</label>
                </div>
            </div>
            <div class="col-xl-1 col-md-4 col-sm-3 mb-3 mx-2">
                <input type="submit" class="btn btn-secondary" id="search" name="search" value="Buscar">
            </div>
        </div>
    </form>
    <hr class="border-light  border-2">
</div>


<?php
include_once './public/footer.php';
?>