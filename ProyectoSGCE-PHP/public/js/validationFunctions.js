function showButton(button, div) {
    $("#" + button).fadeIn();
    $("#" + div).fadeIn();
}

function hideButton(button, div) {
    $("#" + button).fadeOut();
    $("#" + div).fadeOut();
}

function validateDate(input, feed) {
    var regex = /^\d{4}-\d{2}-\d{2}$/;
    if (!regex.test($("#" + input).val())) {
        $("#" + feed).html('La fecha debe estar completa');
        $("#" + input).removeClass('is-valid').addClass('is-invalid');
        $("#" + feed).removeClass("valid-feedback").addClass("invalid-feedback");
        $("#" + feed).removeClass("is-valid").addClass("is-invalid");
        $("#" + feed).fadeIn();
        return false;
    } else {
        $("#" + feed).html('Fecha válida');
        $("#" + input).removeClass('is-invalid').addClass('is-valid');
        $("#" + feed).removeClass("invalid-feedback").addClass("valid-feedback");
        $("#" + feed).removeClass("is-invalid").addClass("is-valid");
        $("#" + feed).fadeIn();
        return true;
    }
}

function validateStorage(input, feed) {
    if (validateEmpty(input, 'div', feed)) {
        $('#submit-storage').val(input.value);
        $('#select-storage').val(input.value);
        $("#number-drawer").prop("disabled", false);
    } else {
        $("#number-drawer").prop("disabled", true);
    }
}

function validateDrawer(input, feed) {
    if (validateEmpty(input, 'div', feed)) {
        $('#submit-drawer').val(input.value);
        $('#select-drawer').val(input.value);
        showButton("but", "div-img");
        $("#save-changes-storage").prop("disabled", false);
    } else {
        hideButton("but", "div-img");
        $("#save-changes-storage").prop("disabled", true);
    }
}

function validateCollector(input, feed) {
    var regex = /^[A-Z]\. [A-Z][a-z]+$/;
    if (!regex.test($("#" + input).val())) {
        $("#" + feed).html('El nombre debe tener formato: A. Apellido');
        $("#" + input).removeClass('is-valid').addClass('is-invalid');
        $("#" + feed).removeClass("valid-feedback").addClass("invalid-feedback");
        $("#" + feed).removeClass("is-valid").addClass("is-invalid");
        $("#" + feed).fadeIn();
        return false;
    } else {
        $("#" + feed).html('Formato válido');
        $("#" + input).removeClass('is-invalid').addClass('is-valid');
        $("#" + feed).removeClass("invalid-feedback").addClass("valid-feedback");
        $("#" + feed).removeClass("is-invalid").addClass("is-valid");
        $("#" + feed).fadeIn();
        return true;
    }
}

function validateFields() {
    var valorIngresado = $("#name-district").val();
    var opciones = $("#list-districts option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });
    if (validateDate('input-date', "date-feed") && validateCollector('input-collector', "collector-feed") && validOption) {
        $("#save-changes-tag").prop("disabled", false);
    } else {
        $("#save-changes-tag").prop("disabled", true);
    }
}

function showButtonRegister(input, button, feed) {
    if (validateEmptyAndNumber(input, 'div', feed)) {
        $("#" + button).prop("disabled", false);
    } else {
        $("#" + button).prop("disabled", true);
    }
}

function validateRegisteredOrder(input, feed) {
    $.ajax(
        {
            data: "", //datos que se envian a traves de ajax
            url: '?controller=Order&action=getOrders', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                    var list = JSON.parse(response);
                    var valorIngresado = input.value;
                    var exist = false;
                    if (list.orders.length > 0) {
                        for (var i = 0; i < list.orders.length; i++) {
                            if (list.orders[i].nombre == valorIngresado) {
                                exist = true;
                                break;
                            }
                        }
                        if (exist) {
                            input.classList.remove('is-valid');
                            input.classList.add('is-invalid');
                            $("#" + feed).html('Este orden ya está registrado');
                            $("#" + feed).fadeIn();
                            $("#save-changes").prop("disabled", true);
                            $("#button").fadeOut();
                        } else if (validateEmpty(input, 'button', feed)) {
                            $("#name-order").val(valorIngresado);
                            $("#save-changes").prop("disabled", false);
                        }
                    } else if (validateEmpty(input, 'button', feed)) {
                        $("#save-changes").prop("disabled", false);
                    }
            }
        }
    );
}//validateRegisteredOrder

function validateRegisteredFamily(input, feed) {
    $.ajax(
        {
            data: '', //datos que se envian a traves de ajax
            url: '?controller=Family&action=getAllFamilies', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                var list = JSON.parse(response);
                var valorIngresado = input.value;
                var exist = false;
                if (list.families.length > 0) {
                    for (var i = 0; i < list.families.length; i++) {
                        if (list.families[i].nombre == valorIngresado) {
                            exist = true;
                            break;
                        }
                    }
                    if (exist) {
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                        $("#" + feed).html('Esta familia ya está registrada');
                        $("#" + feed).fadeIn();
                        $("#save-changes").prop("disabled", true);
                        $("#button").fadeOut();
                    } else if (validateEmpty(input, 'button', feed)) {
                        $("#name-family").val(valorIngresado);
                        $("#save-changes").prop("disabled", false);
                    }
                } else if (validateEmpty(input, 'button', feed)) {
                    $("#name-family").val(valorIngresado);
                    $("#save-changes").prop("disabled", false);
                }
            }
        }
    );
}//validateRegisteredFamily

function validateRegisteredFamilyForUpdate(input, feed) {

    var parametters = {
        'order': $("#select-order").val()
    };
    $.ajax(
        {
            data: parametters, //datos que se envian a traves de ajax
            url: '?controller=Family&action=getFamilies', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                var list = JSON.parse(response);
                var valorIngresado = input.value;
                var exist = false;
                if (list.families.length > 0) {
                    for (var i = 0; i < list.families.length; i++) {
                        if (list.families[i].nombre == valorIngresado) {
                            exist = true;
                            break;
                        }
                    }
                    if (exist) {
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                        $("#" + feed).html('Esta familia ya está registrada');
                        $("#" + feed).fadeIn();
                        $("#save-changes").prop("disabled", true);
                        $("#button").fadeOut();
                    } else if (validateEmpty(input, 'button', feed)) {
                        $("#name-family").val(valorIngresado);
                        $("#save-changes").prop("disabled", false);
                    } else {
                        $("#save-changes").prop("disabled", true);
                    }
                } else if (validateEmpty(input, 'button', feed)) {
                    $("#name-family").val(valorIngresado);
                    $("#save-changes").prop("disabled", false);
                }
            }
        }
    );
}//validateRegisteredFamily

function validateRegisteredSubfamily(input, feed) {
    $.ajax(
        {
            data: "", //datos que se envian a traves de ajax
            url: '?controller=Subfamily&action=getAllSubfamilies', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                var list = JSON.parse(response);
                var valorIngresado = input.value;
                var exist = false;
                if (list.subfamilies.length > 0) {
                    for (var i = 0; i < list.subfamilies.length; i++) {
                        if (list.subfamilies[i].nombre == valorIngresado) {
                            exist = true;
                            break;
                        }
                    }
                    if (exist) {
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                        $("#" + feed).html('Esta subfamilia ya está registrada');
                        $("#" + feed).fadeIn();
                        $("#save-changes").prop("disabled", true);
                        $("#button").fadeOut();
                    } else if (validateEmpty(input, 'button', feed)) {
                        $("#name-subfamily").val(valorIngresado);
                        $("#save-changes").prop("disabled", false);
                    }
                } else if (validateEmpty(input, 'button', feed)) {
                    $("#name-subfamily").val(valorIngresado);
                    $("#save-changes").prop("disabled", false);
                }
            }
        }
    );
}//validateRegisteredSubfamily

function validateRegisteredSubfamilyForUpdate(input, feed) {
    var parametters = {
        'family': $("#select-family").val()
    };
    $.ajax(
        {
            data: parametters, //datos que se envian a traves de ajax
            url: '?controller=Subfamily&action=getSubfamilies', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                var list = JSON.parse(response);
                var valorIngresado = input.value;
                var exist = false;
                if (list.subfamilies.length > 0) {
                    for (var i = 0; i < list.subfamilies.length; i++) {
                        if (list.subfamilies[i].nombre == valorIngresado) {
                            exist = true;
                            break;
                        }
                    }
                    if (exist) {
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                        $("#" + feed).html('Esta subfamilia ya está registrada');
                        $("#" + feed).fadeIn();
                        $("#save-changes").prop("disabled", true);
                        $("#button").fadeOut();
                    } else if (validateEmpty(input, 'button', feed)) {
                        $("#name-subfamily").val(valorIngresado);
                        $("#save-changes").prop("disabled", false);
                    } else {
                        console.log("entro");
                        $("#save-changes").prop("disabled", true);
                    }
                } else if (validateEmpty(input, 'button', feed)) {
                    $("#name-subfamily").val(valorIngresado);
                    $("#save-changes").prop("disabled", false);
                }
            }
        }
    );
}//validateRegisteredSubfamily

function validateRegisteredGender(input, feed) {
    $.ajax(
        {
            data: '', //datos que se envian a traves de ajax
            url: '?controller=Gender&action=getAllGenders', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                var list = JSON.parse(response);
                var valorIngresado = input.value;
                var exist = false;
                if (list.genders.length > 0) {
                    for (var i = 0; i < list.genders.length; i++) {
                        if (list.genders[i].nombre == valorIngresado) {
                            exist = true;
                            break;
                        }
                    }
                    if (exist) {
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                        $("#" + feed).html('Este género ya está registrado');
                        $("#" + feed).fadeIn();
                        $("#save-changes").prop("disabled", true);
                        $("#btn-add-gender").prop("disabled", true);
                        $("#button").fadeOut();
                    } else if (validateEmpty(input, 'button', feed)) {
                        $("#submit-gender").val(valorIngresado);
                        $("#save-changes-gender").prop("disabled", false);
                        $("#btn-add-gender").prop("disabled", false);
                    } else {
                        $("#save-changes-gender").prop("disabled", true);
                        $("#btn-add-gender").prop("disabled", true);
                    }
                } else if (validateEmpty(input, 'button', feed)) {
                    $("#submit-gender").val(valorIngresado);
                    $("#save-changes-gender").prop("disabled", false);
                    $("#btn-add-gender").prop("disabled", false);
                }
            }
        }
    );
}//validateRegisteredGender

function validateRegisteredGenderForUpdate(input, feed) {

    if ($('#submit-subfamily-gender').val() === "S.P") {
        var parametters = {
            "family": $('#select-family-gender').val(),
            "option": 1
        }; //equivalente a un formulario
    } else {
        var parametters = {
            "subfamily": $('#select-subfamily-gender').val(),
            "option": 2
        }; //equivalente a un formulario
    }
    $.ajax(
        {
            data: parametters, //datos que se envian a traves de ajax
            url: '?controller=Gender&action=getGenders', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                var list = JSON.parse(response);

                var valorIngresado = input.value;
                var exist = false;
                if (list.genders.length > 0) {
                    for (var i = 0; i < list.genders.length; i++) {
                        if (list.genders[i].nombre == valorIngresado) {
                            exist = true;
                            break;
                        }
                    }
                    if (exist) {
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                        $("#" + feed).html('Este género ya está registrado');
                        $("#" + feed).fadeIn();
                        $("#save-changes-gender").prop("disabled", true);
                        $("#button").fadeOut();
                    } else if (validateEmpty(input, 'button', feed)) {
                        $("#submit-gender-gender").val(valorIngresado);
                        $("#save-changes-gender").prop("disabled", false);
                    } else {
                        $("#save-changes-gender").prop("disabled", true);
                    }
                } else if (validateEmpty(input, 'button', feed)) {
                    $("#submit-gender-gender").val(valorIngresado);
                    $("#save-changes-gender").prop("disabled", false);
                }
            }
        }
    );
}//validateRegisteredGenderForUpdate

function validateRegisteredSpecies(input, feed) {
    $.ajax(
        {
            data: "", //datos que se envian a traves de ajax
            url: '?controller=Species&action=getAllSpecies', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                var list = JSON.parse(response);
                var valorIngresado = input.value;
                var exist = false;
                if (list.species.length > 0) {
                    for (var i = 0; i < list.species.length; i++) {
                        if (list.species[i].nombre == valorIngresado) {
                            exist = true;
                            break;
                        }
                    }
                    if (exist) {
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                        $("#" + feed).html('Esta especie ya está registrada');
                        $("#" + feed).fadeIn();
                        $("#save-changes").prop("disabled", true);
                        $("#save-changes-species").prop("disabled", true);
                        $("#btn-add-species").prop("disabled", true);
                        $("#button").fadeOut();
                    } else if (validateEmpty(input, 'button', feed)) {
                        $("#submit-species").val(valorIngresado);
                        $("#save-changes-species").prop("disabled", false);
                        $("#btn-add-species").prop("disabled", false);
                    } else {
                        $("#save-changes-species").prop("disabled", true);
                        $("#btn-add-species").prop("disabled", true);
                    }
                } else if (validateEmpty(input, 'button', feed)) {
                    $("#submit-species").val(valorIngresado);
                    $("#save-changes-species").prop("disabled", false);
                    $("#btn-add-species").prop("disabled", false);
                }
            }
        }
    );
}//validateRegisteredSpecies

function validateRegisteredSpeciesForUpdate(input, feed) {
    var parametters = {
        'gender': $("#select-gender").val()
    };
    $.ajax(
        {
            data: parametters, //datos que se envian a traves de ajax
            url: '?controller=Species&action=getSpecies', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                var list = JSON.parse(response);
                var valorIngresado = input.value;
                var exist = false;
                if (list.species.length > 0) {
                    for (var i = 0; i < list.species.length; i++) {
                        if (list.species[i].especie == valorIngresado) {
                            exist = true;
                            break;
                        }
                    }
                    if (exist) {
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                        $("#" + feed).html('Esta especie ya está registrada');
                        $("#" + feed).fadeIn();
                        $("#save-changes-species").prop("disabled", true);
                        $("#button").fadeOut();
                    } else if (validateEmpty(input, 'button', feed)) {
                        $("#save-changes-species").prop("disabled", false);
                    } else {
                        $("#save-changes-species").prop("disabled", true);
                    }
                } else if (validateEmpty(input, 'button', feed)) {
                    $("#submit-species").val(valorIngresado);
                    $("#save-changes-species").prop("disabled", false);
                }
            }
        }
    );
}//validateRegisteredSpecies

function validateRegisteredPlant(input, feed) {
    $.ajax(
        {
            data: "", //datos que se envian a traves de ajax
            url: '?controller=Plant&action=getAllPlants', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                if (!response) {
                    if (validateEmpty(input, 'button', feed)) {
                        $("#save-changes").prop("disabled", false);
                    }
                } else {
                    var list = JSON.parse(response);
                    var valorIngresado = input.value;
                    var exist = false;
                    if (list.plants.length > 0) {
                        for (var i = 0; i < list.plants.length; i++) {
                            if (list.plants[i].nombre_planta == valorIngresado) {
                                exist = true;
                                break;
                            }
                        }
                        if (exist) {
                            input.classList.remove('is-valid');
                            input.classList.add('is-invalid');
                            $("#" + feed).html('Esta planta ya está registrada');
                            $("#" + feed).fadeIn();
                            $("#save-changes").prop("disabled", true);
                            $("#button").fadeOut();
                        } else if (validateEmpty(input, 'button', feed)) {
                            $("#name-plant").val(valorIngresado);
                            $("#save-changes").prop("disabled", false);
                        }
                    }
                }
            }
        }
    );
}//validateRegisteredGender

function validateRegisteredUser(input, feed) {
    $.ajax(
        {
            data: "", //datos que se envian a traves de ajax
            url: '?controller=User&action=getUsers', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                var list = JSON.parse(response);
                var valorIngresado = input.value;
                var exist = false;
                if (list.users.length > 0) {
                    for (var i = 0; i < list.users.length; i++) {
                        if (list.users[i].nombre_usuario == valorIngresado) {
                            console.log(list.users[i].numbre_usuario);
                            exist = true;
                            break;
                        }
                    }
                    if (exist) {
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                        $("#" + feed).html('Esta usuario ya está registrado');
                        $("#" + feed).fadeIn();
                        $("#password").prop("disabled", true);
                        $("#save-user").prop("disabled", true);
                    } else if (validateEmpty(input, 'b', feed)) {
                        $("#password").prop("disabled", false);
                        validateEmptyPassword(document.getElementById('password'), 'password-feed')
                    }
                } else {
                    $("#password").prop("disabled", false);
                    validateEmptyPassword(document.getElementById('password'), 'password-feed')
                }
            }
        }
    );
}

function validateEmpty(input, div, feed) {
    if (input.value !== "") {
        $("#" + div).fadeIn();
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        $("#" + feed).fadeOut();
        // $('#save-user').prop("disabled", false);
        return true;
    } else {
        // $('#save-user').prop("disabled", true);
        $("#" + div).fadeOut();
        input.classList.remove('is-valid');
        input.classList.add('is-invalid');
        $("#" + feed).html('Este campo no puede estar vacío');
        $("#" + feed).fadeIn();
        return false;
    }
}

function validateEmptyPassword(input, feed) {
    if (input.value !== "") {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        $("#" + feed).fadeOut();
        $('#save-user').prop("disabled", false);
        return true;
    } else {
        $('#save-user').prop("disabled", true);
        input.classList.remove('is-valid');
        input.classList.add('is-invalid');
        $("#" + feed).html('Este campo no puede estar vacío');
        $("#" + feed).fadeIn();
        return false;
    }
}

function validateEmptyAndNumber(input, div, feed) {
    var regex = /^(0|[1-9]\d*)$/;

    if (input.value !== "" && regex.test(input.value)) {
        $("#" + div).fadeIn();
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        $("#" + feed).html('');
        $("#" + feed).fadeOut();
        return true;
    } else if (!regex.test(input.value)) {
        $("#" + div).fadeOut();
        input.classList.remove('is-valid');
        input.classList.add('is-invalid');
        $("#" + feed).html('El valor debe ser un número entero y mayor a 0');
        $("#" + feed).fadeIn();
        return false;
    } else if (input.value === "") {
        $("#" + div).fadeOut();
        input.classList.remove('is-valid');
        input.classList.add('is-invalid');
        $("#" + feed).html('Este campo no puede estar vacío ');
        $("#" + feed).fadeIn();
        return false;
    }
}

function validateOrder() {
    var order = $("#name-order-modal").val();
    if (order === "") {
        $('#name-order').val('');
        $('#div-alert-order').html('El campo no puede estar vacío');
        $('#div-alert-order').fadeIn();

    } else {
        registerOrderModal(order);
        $("#order-feed").html("El orden existe");
        $("#order-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-order").removeClass("is-invalid").addClass("is-valid");
        $('#orderModal').modal('hide');
    }
}//validateOrder

function validateFamily() {
    var family = $("#name-family-modal").val();
    if (family === "") {
        $('#name-family').val('');
        $('#div-alert-family').html('El campo no puede estar vacío');
        $('#div-alert-family').fadeIn();
    } else {
        registerFamilyModal(family, $('#select-order').val());
        $("#family-feed").html("La familia existe");
        $("#family-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-family").removeClass("is-invalid").addClass("is-valid");
        $('#familyModal').modal('hide');
    }
}//validateFamily

function validateSubfamily() {
    var subfamily = $("#name-subfamily-modal").val();
    if (subfamily === "") {
        $('#name-subfamily').val('');
        $('#div-alert-subfamily').html('El campo no puede estar vacío');
        $('#div-alert-subfamily').fadeIn();
    } else {
        registerSubfamilyModal(subfamily, $("#select-family").val());
        $("#subfamily-feed").html("La subfamilia existe");
        $("#subfamily-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-subfamily").removeClass("is-invalid").addClass("is-valid");
        $('#subfamilyModal').modal('hide');
    }
}//validateSubfamily

function validateGender() {
    var gender = $("#name-gender-modal").val();
    if (gender === "") {
        $('#name-gender').val('');
        $('#div-alert-gender').html('El campo no puede estar vacío');
        $('#div-alert-gender').fadeIn();
    } else {
        registerGenderModal(gender, $("#select-family").val(), $("#select-subfamily").val(), $('#name-subfamily').val());
    }
}//validateGender

function validateSpecies() {
    var species = $("#name-species-modal").val();
    if (species === "") {
        $('#name-species').val('');
        $('#div-alert-species').html('El campo no puede estar vacío');
        $('#div-alert-species').fadeIn();
    } else {
        registerSpeciesModal(species, $("#select-gender").val());
        $("#species-feed").html("La especie existe");
        $("#species-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-species").removeClass("is-invalid").addClass("is-valid");
        $('#speciesModal').modal('hide');
    }
}//validateGender



function verifyImages() {
    var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Extensiones permitidas
    var files = $('#imageFiles')[0].files; // Obtener los archivos seleccionados
    var destinationElement = $('#select-imageFiles');
    destinationElement.empty();

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var extension = file.name.split('.').pop().toLowerCase();

        if (allowedExtensions.indexOf(extension) === -1) {
            // Limpiar el arreglo de imágenes
            $('#imageFiles').val('');
            $('#img-modal').modal('show');
            $('#div-alert').html('Este archivo no es una imagen' + file.name + '<br>' + 'Por favor, seleccione un archivo con una extensión válida');
            // Restablecer el campo de texto a su estado original
            $('#textField').val($('#textField').data('original-value'));
            hideButton("but", "div-button");
            return; // Detener el envío del formulario si se encuentra una extensión no permitida
        }
    }
    destinationElement[0].files = files;
    $('#save-changes').prop('disabled', false);
    showButton("but", "div-button");
}

function findOrderModal() {

    var valorIngresado = $("#name-order").val();

    var opciones = $("#list-orders option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();
    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });

    if (validOption) {
        $('#select-order').val(validOption.id);
        $('#select-order-gender').val(validOption.id);
        getFamilies(validOption.id);
        $("#order-feed").html("El orden existe");
        $("#order-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-order").removeClass("is-invalid").addClass("is-valid");
        $('#name-family').prop('disabled', false);
    } else {
        $('#select-order').val('');
        $("#order-feed").html("El orden no existe");
        $("#order-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-order").addClass("is-invalid").removeClass("is-valid");
        getFamilies(0);
    }
}//  findOrderModal

function findOrderGenderModal() {
    var valorIngresado = $("#name-order-gender").val();
    var opciones = $("#list-orders-gender option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();
    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });

    if (validOption) {
        $('#select-order-gender').val(validOption.id);
        getFamiliesGender(validOption.id);
        $("#order-feed-gender").html("El orden existe");
        $("#order-feed-gender").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-order-gender").removeClass("is-invalid").addClass("is-valid");
    } else {
        $("#order-feed-gender").html("El orden no existe");
        $("#order-feed-gender").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-order-gender").addClass("is-invalid").removeClass("is-valid");
        getFamiliesGender(0);
    }
}//  findOrderModal

function findFamilyModal() {
    var valorIngresado = $("#name-family").val();
    var opciones = $("#list-families option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });
    if (validOption) {
        $('#select-family').val(validOption.id);
        $("#family-feed").html("La familia existe");
        $("#family-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-family").removeClass("is-invalid").addClass("is-valid");
        $('#name-subfamily').prop('disabled', false);
        getSubfamilies(validOption.id);
    } else {
        $("#family-feed").html("La familia no existe");
        $("#family-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-family").addClass("is-invalid").removeClass("is-valid");
        getSubfamilies(0);
    }
}

function findFamilyGenderModal() {
    var valorIngresado = $("#name-family-gender").val();
    var opciones = $("#list-families-gender option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });
    if (validOption) {
        $('#select-family-gender').val(validOption.id);
        $("#family-feed-gender").html("La familia existe");
        $("#family-feed-gender").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-family-gender").removeClass("is-invalid").addClass("is-valid");
        getSubfamiliesGender(validOption.id);
    } else {
        $("#family-feed-gender").html("La familia no existe");
        $("#family-feed-gender").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-family-gender").addClass("is-invalid").removeClass("is-valid");
        getSubfamiliesGender(0);
    }
}

function findSubfamilyModal() {
    var inputValue = $("#name-subfamily").val();
    var optionsSubfamily = $("#list-subfamilies option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var optionsFamily = $("#list-families option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOptionSubfamily = optionsSubfamily.find(function (option) {
        return option.value === inputValue;
    });

    var validOptionFamily = optionsFamily.find(function (option) {
        return option.value === $('#name-family').val();
    });

    if (validOptionSubfamily) {
        $('#select-subfamily').val(validOptionSubfamily.id);
        $("#subfamily-feed").html("La subfamilia existe");
        $("#subfamily-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-subfamily").removeClass("is-invalid").addClass("is-valid");
        $('#name-gender-modal').val('');
        validateRegisteredGender(document.getElementById('name-gender-modal'), 'gender-feed--modal');
        $('#name-gender-modal').prop('disabled', false);
        //$('#btn-add-gender').prop('disabled', false);      
        getGenders(validOptionSubfamily.id, validOptionFamily.id, validOptionSubfamily.value);
    } else {
        $("#subfamily-feed").html("La subfamilia no existe");
        $('#name-gender-modal').prop('disabled', true);
        $('#btn-add-gender').prop('disabled', true);
        $("#subfamily-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-subfamily").addClass("is-invalid").removeClass("is-valid");
        getGenders(0, 0, 0);
    }
} // Fin de la función findSubfamily

function findSubfamilyGenderModal() {
    var inputValue = $("#name-subfamily-gender").val();
    var optionsSubfamily = $("#list-subfamilies-gender option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var optionsFamily = $("#list-families-gender option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOptionSubfamily = optionsSubfamily.find(function (option) {
        return option.value === inputValue;
    });

    var validOptionFamily = optionsFamily.find(function (option) {
        return option.value === $('#name-family-gender').val();
    });
    if (validOptionSubfamily) {
        $('#select-subfamily-gender').val(validOptionSubfamily.id);
        $("#subfamily-feed-gender").html("La subfamilia existe");
        $("#subfamily-feed-gender").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-subfamily-gender").removeClass("is-invalid").addClass("is-valid");
        getGenders(validOptionSubfamily.id, validOptionFamily.id, validOptionSubfamily.value);
    } else {
        $("#subfamily-feed-gender").html("La subfamilia no existe");
        $("#subfamily-feed-gender").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-subfamily-gender").addClass("is-invalid").removeClass("is-valid");
        getGenders(0, 0, 0);
    }
} // Fin de la función findSubfamily

function findGenderModal() {
    var valorIngresado = $("#name-gender").val();
    var opciones = $("#list-genders option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });
    console.log(validOption);
    if (validOption) {
        $('#select-gender').val(validOption.id);
        getSpecies(validOption.id);
        $("#gender-feed").html("El género existe");
        $("#gender-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-gender").removeClass("is-invalid").addClass("is-valid");
        $('#name-species').prop('disabled', false);
    } else {
        $('#name-species').prop('disabled', true);
        $("#gender-feed").html("El género no existe");
        $("#gender-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-gender").addClass("is-invalid").removeClass("is-valid");
        getSpecies(0);

    }
}

function findSpeciesModal() {
    var valorIngresado = $("#name-species").val();
    var opciones = $("#list-species option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });

    if (validOption) {
        $("#select-species").val(validOption.id);
        $("#species-feed").html("La especie existe");
        $("#species-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-species").removeClass("is-invalid").addClass("is-valid");
        $('#save-changes-tax').prop('disabled', false);
    } else {
        $('#save-changes-tax').prop('disabled', true);
        $("#species-feed").html("La especie no existe");
        $("#species-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-species").addClass("is-invalid").removeClass("is-valid");
    }
}

function findOrder() {
    var valorIngresado = $("#name-order").val();
    var opciones = $("#list-orders option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });

    if (validOption) {
        getFamilies(validOption.id);
        $('#select-order').val(validOption.id);
        $("#order-feed").html("El órden existe");
        $("#order-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-order").removeClass("is-invalid").addClass("is-valid");
        showButton("btn-family", "div-family");
    } else {
        $("#order-feed").html("El orden no existe");
        $("#order-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-order").addClass("is-invalid").removeClass("is-valid");
        hideButton("btn-family", "div-family");
        hideButton("btn-subfamily", "div-subfamily");
        hideButton("btn-gender", "div-gender");
        hideButton("btn-species", "div-species");
        getFamilies(0);
    }
}


function findFamily() {
    var valorIngresado = $("#name-family").val();
    var opciones = $("#list-families option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });

    if (validOption) {
        $('#select-family').val(validOption.id);
        $("#family-feed").html("La familia existe");
        $("#family-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-family").removeClass("is-invalid").addClass("is-valid");
        getSubfamilies(validOption.id);
        showButton("btn-subfamily", "div-subfamily");
    } else {
        $("#family-feed").html("La familia no existe");
        $("#family-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-family").addClass("is-invalid").removeClass("is-valid");
        hideButton("btn-subfamily", "div-subfamily");
        hideButton("btn-gender", "div-gender");
        hideButton("btn-species", "div-species");
        getSubfamilies(0);
    }
}

function findSubfamily() {
    var inputValue = $("#name-subfamily").val();
    var optionsSubfamily = $("#list-subfamilies option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var optionsFamily = $("#list-families option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOptionSubfamily = optionsSubfamily.find(function (option) {
        return option.value === inputValue;
    });

    var validOptionFamily = optionsFamily.find(function (option) {
        return option.value === $('#name-family').val();
    });
    if (validOptionSubfamily) {
        $('#select-subfamily').val(validOptionSubfamily.id);
        $("#subfamily-feed").html("La subfamilia existe");
        $("#subfamily-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-subfamily").removeClass("is-invalid").addClass("is-valid");
        getGenders(validOptionSubfamily.id, validOptionFamily.id, validOptionSubfamily.value);
        showButton("btn-gender", "div-gender");
        $('#name-gender').val('');
        $('#name-species').val('');
    } else {
        $("#subfamily-feed").html("La subfamilia no existe");
        $("#subfamily-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-subfamily").addClass("is-invalid").removeClass("is-valid");
        $("#gender-feed").html("Este campo no puede estar vacío");
        $("#gender-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-gender").addClass("is-invalid").removeClass("is-valid");
        $("#species-feed").html("Este campo no puede estar vacío");
        $("#species-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-species").addClass("is-invalid").removeClass("is-valid");
        hideButton("btn-gender", "div-gender");
        hideButton("btn-species", "div-species");
        $('#name-gender').val('');
        $('#name-species').val('');
    }
} // Fin de la función findSubfamily

function findGender() {
    var valorIngresado = $("#name-gender").val();
    var opciones = $("#list-genders option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });
    if (validOption) {
        $('#select-gender').val(validOption.id);
        $("#gender-feed").html("El género existe");
        $("#gender-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-gender").removeClass("is-invalid").addClass("is-valid");
        getSpecies(validOption.id);
        showButton("btn-species", "div-species");
        $('#name-species').val('');
        $('#name-species').prop('disabled', false);
    } else {
        // $('#name-species').prop('disabled', false);
        $("#gender-feed").html("El género no existe");
        $("#gender-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-gender").addClass("is-invalid").removeClass("is-valid");
        $("#species-feed").html("Este campo no puede estar vacío");
        $("#species-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-species").addClass("is-invalid").removeClass("is-valid");
        hideButton("btn-species", "div-species");
        $('#name-species').val('');
    }
}

function findSpecies() {
    var valorIngresado = $("#name-species").val();
    var opciones = $("#list-species option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });
    if (validOption) {
        $("#select-species").val(validOption.id);
        $("#species-feed").html("La especie existe");
        $("#species-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-species").removeClass("is-invalid").addClass("is-valid");
        showButton("btn", "div-title");
        showButton("btn", "div-menu");

    } else {
        $("#species-feed").html("La especie no existe");
        $("#species-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-species").addClass("is-invalid").removeClass("is-valid");
        hideButton("btn", "div-title");
        hideButton("btn", "div-menu");

    }
}

function findCabinet() {
    var valorIngresado = $("#number-cabinet").val();
    var opciones = $("#list-cabinets option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });

    if (validOption) {
        $('#select-cabinet').val(validOption.id);
        $("#cabinet-feed").html("El gabinete existe");
        $("#cabinet-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#number-cabinet").removeClass("is-invalid").addClass("is-valid");
        showButton("btn", "div-drawer");
        getDrawers(validOption.id);
        $("#number-drawer").prop('disabled', false);
        $("#number-drawer").val('');
    } else {
        $("#cabinet-feed").html("El gabinete no existe");
        $("#cabinet-feed").removeClass("valid-feedback").addClass("invalid-feedback");
        $("#number-cabinet").removeClass("is-valid").addClass("is-invalid");
        hideButton("btn", "div-drawer");
        $("#number-drawer").prop('disabled', true);
        $("#number-drawer").val('');
    }
}

function findDrawer() {
    var valorIngresado = $("#number-drawer").val();
    var opciones = $("#list-drawers option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });
    if (validOption) {
        $('#select-drawer').val(validOption.id);
        $("#drawer-feed").html("La gaveta existe");
        $("#drawer-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#number-drawer").removeClass("is-invalid").addClass("is-valid");
        showButton("but", "div-img");

        // hideButton("button", "");
    } else {
        $("#drawer-feed").html("La gaveta no existe");
        $("#drawer-feed").removeClass("valid-feedback").addClass("invalid-feedback");
        $("#number-drawer").removeClass("is-valid").addClass("is-invalid");
        hideButton("but", "div-img");
        // showButton("button", "");
    }
}

function findBox() {
    var valorIngresado = $("#number-box").val();
    var opciones = $("#list-boxes option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });
    if (validOption) {
        $('#select-box').val(validOption.id);
        $("#box-feed").html("La caja existe");
        $("#box-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#number-box").removeClass("is-invalid").addClass("is-valid");
        showButton("btn", "div-vial");
        getVials(validOption.id);
        $("#number-vial").prop('disabled', false);
        $("#number-vial").val('');
    } else {
        $("#box-feed").html("La caja no existe");
        $("#box-feed").removeClass("valid-feedback").addClass("invalid-feedback");
        $("#number-box").removeClass("is-valid").addClass("is-invalid");
        hideButton("btn", "div-vial");
        $("#number-vial").prop('disabled', true);
        $("#number-vial").val('');
    }
}

function findVial() {
    var valorIngresado = $("#number-vial").val();
    var opciones = $("#list-vials option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });
    if (validOption) {
        $("#select-vial").val(validOption.id);
        $("#vial-feed").html("La gaveta existe");
        $("#vial-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#number-vial").removeClass("is-invalid").addClass("is-valid");
        showButton("but", "div-img");
    } else {
        $("#vial-feed").html("La gaveta no existe");
        $("#vial-feed").removeClass("valid-feedback").addClass("invalid-feedback");
        $("#number-vial").removeClass("is-valid").addClass("is-invalid");
        hideButton("but", "div-img");
    }
}


function findCountry() {

    var valorIngresado = $("#name-country").val();
    var opciones = $("#list-countries option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });

    if (validOption) {
        $("#select-country").val(validOption.id);
        $("#country-feed").html("El país existe");
        $("#country-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-country").removeClass("is-invalid").addClass("is-valid");
        getProvinces(validOption.id);
        $("#name-province").prop('disabled', false);
    } else {
        $("#country-feed").html("El país no existe");
        $("#country-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-country").addClass("is-invalid").removeClass("is-valid");
        getProvinces(0);
    }
}

function findProvince() {

    var valorIngresado = $("#name-province").val();
    var opciones = $("#list-provinces option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });
    if (validOption) {
        $("#select-province").val(validOption.id);
        $("#province-feed").html("La provincia existe");
        $("#province-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-province").removeClass("is-invalid").addClass("is-valid");
        getCantons(validOption.id);
    } else {
        $("#province-feed").html("La provincia no existe");
        $("#province-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-province").addClass("is-invalid").removeClass("is-valid");
        getCantons(0);
    }
}

function findCanton() {
    var valorIngresado = $("#name-canton").val();
    var opciones = $("#list-cantons option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });

    if (validOption) {
        getDistricts(validOption.id);
        $("#canton-feed").html("El cantón existe");
        $("#canton-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-canton").removeClass("is-invalid").addClass("is-valid");
        $("#name-district").prop('disabled', false);

    } else {
        getDistricts(0);
        $("#canton-feed").html("El cantón no existe");
        $("#canton-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-canton").addClass("is-invalid").removeClass("is-valid");
        // $("#district-feed").html("Este campo no puede estar vacío");
        // $("#district-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        // $("#name-district").addClass("is-invalid").removeClass("is-valid");
    }
}

function findDistrict() {
    var valorIngresado = $("#name-district").val();
    var opciones = $("#list-districts option").map(function () {
        return {
            id: $(this).attr("id"),
            value: $(this).val()
        };
    }).get();

    var validOption = opciones.find(function (opcion) {
        return opcion.value === valorIngresado;
    });
    if (validOption) {
        $("#select-district").val(validOption.id);
        $("#district-feed").html("El distrito existe");
        $("#district-feed").removeClass("invalid-feedback").addClass("valid-feedback");
        $("#name-district").removeClass("is-invalid").addClass("is-valid");
        $('#save-changes-tag').prop('disabled', false);
    } else {
        $("#district-feed").html("El distrito no existe");
        $("#district-feed").addClass("invalid-feedback").removeClass("valid-feedback");
        $("#name-district").addClass("is-invalid").removeClass("is-valid");
        $('#save-changes-tag').prop('disabled', true);
    }
}

function addName(name) {
    $("#select-collector").val(name);
}

function addDate(date) {
    $("#select-date").val(date);
}



