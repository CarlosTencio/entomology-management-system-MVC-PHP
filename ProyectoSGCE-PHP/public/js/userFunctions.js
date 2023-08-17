function addToCarSuperuser(user, type, article, button) {
    if (button.value == 0) {
        registerInCarSuperuser(user, type, article, button);
    } else {
        deleteFromCarSuperuser(user, type, article, button)
    }
}//addToCarSuperuser

function addToViewsSuperuser(user, type, article, button) {
    if (button.value == 0) {
        registerInViewsSuperuser(user, type, article, button);
    } else {
        deleteFromViewsSuperuser(user, type, article, button);
    }
}//addToViewsSuperuser

function registerInCarSuperuser(user, type, id, button) {
    var parametros = {
        "user": user,
        "type": type,
        "id": id
    }; //equivalente a un formulario
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Car&action=addToCarSuperuser', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {
                button.innerHTML = '<div class="custom-loader"></div>';
            },
            success: function (response) {
                button.classList.remove("btn-secondary");
                button.classList.add("btn-danger");
                button.value = 1;
                button.innerHTML = '<img src="public/img/delete.png" alt="">';
            }
        }
    );
}

function registerInViewsSuperuser(user, type, id, button) {
    var parametros = {
        "user": user,
        "type": type,
        "id": id
    }; //equivalente a un formulario
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Car&action=addToSeeSuperuser', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {
                button.innerHTML = '<div class="custom-loader"></div>';
            },
            success: function (response) {
                button.classList.remove("btn-light");
                button.classList.add("btn-danger");
                button.value = 1;
                button.innerHTML = '<img src="public/img/nosee.png" alt="">';
            }
        }
    );
}

function deleteFromCarSuperuser(user, type, article, button) {
    var parametros = {
        "user": user,
        "type": type,
        "id": article
    }; //equivalente a un formulario
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Car&action=deleteFromCarSuperuser', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {
                button.innerHTML = '<div class="custom-loader"></div>';

            },
            success: function (response) {
                button.value = 0;
                button.classList.remove("btn-danger");
                button.classList.add("btn-secondary");
                button.innerHTML = '<img src="public/img/addcar.png" alt="">';
            }
        }
    );
}

function deleteFromViewsSuperuser(user, type, article, button) {

    var parametros = {
        "user": user,
        "type": type,
        "id": article
    }; //equivalente a un formulario
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Car&action=deleteFromViewsSuperuser', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {
                button.innerHTML = '<div class="custom-loader"></div>';


            },
            success: function (response) {
                button.value = 0;
                button.classList.remove("btn-danger");
                button.classList.add("btn-light");
                button.innerHTML = '<img src="public/img/see.png" alt="">';

            }
        }
    );
}

