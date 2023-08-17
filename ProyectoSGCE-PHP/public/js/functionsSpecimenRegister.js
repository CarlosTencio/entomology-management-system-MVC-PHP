function getFamilies(id_order) {
    var parametros = {
        "order": id_order
    }; //equivalente a un formulario
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Family&action=getFamilies', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-families');
                var list = JSON.parse(response);
                var datalist = $('#list-families');
                datalist.empty();
                if (list.families.length > 0) {
                    $('#name-family').attr('placeholder', 'Nombre de la familia');
                    for (var i = 0; i < list.families.length; i++) {
                        var option = $('<option>')
                            .attr('value', list.families[i].nombre)
                            .attr('id', list.families[i].id_familia);
                        datalist.append(option);
                    }
                } else {
                    // Seleccionar el campo de entrada y establecer el placeholder
                    $('#name-family').attr('placeholder', 'No hay familias registradas');
                }
                if ($('#taxFamily').length) {
                    $('#name-family').val($('#taxFamily').val());
                }
                findFamilyModal();
            }
        }
    );
}//getFamilies

function getFamiliesGender(id_order) {
    var parametros = {
        "order": id_order
    }; //equivalente a un formulario
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Family&action=getFamilies', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-families-gender');
                var list = JSON.parse(response);
                var datalist = $('#list-families-gender');
                datalist.empty();
                if (list.families.length > 0) {
                    $('#name-family').attr('placeholder', 'Nombre de la familia');
                    for (var i = 0; i < list.families.length; i++) {
                        var option = $('<option>')
                            .attr('value', list.families[i].nombre)
                            .attr('id', list.families[i].id_familia);
                        datalist.append(option);
                    }
                } else {
                    // Seleccionar el campo de entrada y establecer el placeholder
                    $('#name-family').attr('placeholder', 'No hay familias registradas');
                }
                findFamilyGenderModal();
            }
        }
    );
}//getFamilies

function getSubfamilies(id_family) {
    console.log(id_family);
    var parametros = {
        "family": id_family
    }; //equivalente a un formulario
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Subfamily&action=getSubfamilies', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-subfamilies');
                var list = JSON.parse(response);
                var datalist = $('#list-subfamilies');
                datalist.empty();
                $('#name-subfamily').attr('placeholder', 'Nombre de la subfamilia');
                if (list.subfamilies.length > 0) {
                    for (var i = 0; i < list.subfamilies.length; i++) {
                        var option = $('<option>')
                            .attr('value', list.subfamilies[i].nombre)
                            .attr('id', list.subfamilies[i].id_subfamilia);
                        datalist.append(option);
                    }
                }
                if ($('#taxSubfamily').length) {
                    $('#name-subfamily').val($('#taxSubfamily').val());
                }
                findSubfamilyModal();
            }
        }
    );
}//getSubfamilies


function getSubfamiliesGender(id_family) {
    console.log(id_family);
    var parametros = {
        "family": id_family
    }; //equivalente a un formulario
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Subfamily&action=getSubfamilies', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-subfamilies-gender');
                var list = JSON.parse(response);
                var datalist = $('#list-subfamilies-gender');
                datalist.empty();
                $('#name-subfamily').attr('placeholder', 'Nombre de la subfamilia');
                if (list.subfamilies.length > 0) {
                    for (var i = 0; i < list.subfamilies.length; i++) {
                        var option = $('<option>')
                            .attr('value', list.subfamilies[i].nombre)
                            .attr('id', list.subfamilies[i].id_subfamilia);
                        datalist.append(option);
                    }
                }
                findSubfamilyGenderModal();
            }
        }
    );
}//getSubfamilies

function getGenders(id_subfamily, id_family, name_subfamily) {
    if (name_subfamily === "S.P") {
        var parametros = {
            "family": id_family,
            "option": 1
        }; //equivalente a un formulario
    } else {
        var parametros = {
            "subfamily": id_subfamily,
            "option": 2
        }; //equivalente a un formulario
    }
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Gender&action=getGenders', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-genders');
                var list = JSON.parse(response);
                var datalist = $('#list-genders');
                datalist.empty();
                $('#name-gender').attr('placeholder', 'Nombre del género');
                if (list.genders.length > 0) {
                    for (var i = 0; i < list.genders.length; i++) {
                        var option = $('<option>')
                            .attr('value', list.genders[i].nombre)
                            .attr('id', list.genders[i].id_genero);
                        datalist.append(option);
                    }
                } else {
                    $('#name-gender').attr('placeholder', 'No hay géneros registrados');
                }
                if ($('#taxGender').length) {
                    $('#name-gender').val($('#taxGender').val());
                }
                findGenderModal();
            }
        }
    );

}//getGenders

function getSpecies(id_gender) {
    var parametros = {
        "gender": id_gender
    }; //equivalente a un formulario
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Species&action=getSpecies', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-species');
                var list = JSON.parse(response);
                var datalist = $('#list-species');
                datalist.empty();
                $('#name-species').attr('placeholder', 'Nombre de la especie');
                if (list.species.length > 0) {
                    for (var i = 0; i < list.species.length; i++) {
                        var option = $('<option>')
                            .attr('value', list.species[i].especie)
                            .attr('id', list.species[i].id_especie);
                        datalist.append(option);
                    }
                }
                if ($('#taxSpecies').length) {
                    $('#name-species').val($('#taxSpecies').val());
                }
                findSpeciesModal();
            }
        }
    );
}//getSpecies

function getDrawers(id_cabinet) {
    var parametros = {
        "cabinet": id_cabinet
    }; //equivalente a un formulario
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Drawer&action=getDrawers', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-drawers');
                var list = JSON.parse(response);
                var datalist = $('#list-drawers');
                datalist.empty();
                var list = JSON.parse(response);
                $('#name-drawer').attr('placeholder', 'Numero gaveta');
                if (list.drawers.length > 0) {
                    for (var i = 0; i < list.drawers.length; i++) {
                        var option = $('<option>')
                            .attr('value', list.drawers[i].num_gaveta)
                            .attr('id', list.drawers[i].id_gaveta);
                        datalist.append(option);
                    }
                } else {
                    $('#name-drawer').attr('placeholder', 'No hay gavetas registradas');
                }
            }
        }
    );
}

function getVials(id_box) {
    var parametros = {
        "box": id_box
    }; //equivalente a un formulario
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Vials&action=getVials', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-vials');
                var list = JSON.parse(response);
                var datalist = $('#list-vials');
                datalist.empty();
                var list = JSON.parse(response);
                $('#name-vial').attr('placeholder', 'Numero vial');
                if (list.vials.length > 0) {
                    for (var i = 0; i < list.vials.length; i++) {
                        var option = $('<option>')
                            .attr('value', list.vials[i].num_vial)
                            .attr('id', list.vials[i].id_vial);
                        datalist.append(option);
                    }
                } else {
                    $('#name-drawer').attr('placeholder', 'No hay viales registrados');
                }
            }
        }
    );
}//getVials

function getCountries() {
    $.ajax(
        {
            url: '?controller=Location&action=getCountries', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-countries');
                var list = JSON.parse(response);
                var datalist = $('#list-countries');
                datalist.empty();
                var list = JSON.parse(response);
                $('#name-country').attr('placeholder', 'País');
                if (list.countries.length > 0) {
                    for (var i = 0; i < list.countries.length; i++) {
                        var option = $('<option>')
                            .attr('value', list.countries[i].nombre_pais)
                            .attr('id', list.countries[i].id_pais);
                        datalist.append(option);
                    }
                } else {
                    $('#name-country').attr('placeholder', 'No hay países registrados');
                }
            }
        }
    );
}//getCountries

function getProvinces(id_country) {
    var parametros = {
        "country": id_country
    }; //equivalente a un formulario
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Location&action=getProvinces', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-provinces');
                var list = JSON.parse(response);
                $('#list-provinces').empty();
                $('#name-province').attr('placeholder', 'Provincia');
                if (list.provinces.length > 0) {
                    for (var i = 0; i < list.provinces.length; i++) {
                        var option = $('<option>')
                            .attr('value', list.provinces[i].nombre_provincia)
                            .attr('id', list.provinces[i].id_provincia);
                        $('#list-provinces').append(option);
                    }
                } else {
                    $('#name-province').attr('placeholder', 'No hay provincias registradas');
                }
                if ($('#tagProvince').length) {
                    $('#name-province').val($('#tagProvince').val());
                }
                findProvince();
            }
        }
    );
}//getProvinces


function getCantons(id_province) {
    console.log(id_province);
    var parametros = {
        "province": id_province
    }; //equivalente a un formulario
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Location&action=getCantons', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {
            },
            success: function (response) {
                clearDatalist('list-cantons');
                var list = JSON.parse(response);
                var datalist = $('#list-cantons');
                datalist.empty();
                $('#name-canton').attr('placeholder', 'Cantón');
                if (list.cantons.length > 0) {
                    for (var i = 0; i < list.cantons.length; i++) {
                        var option = $('<option>')
                            .attr('value', list.cantons[i].nombre_canton)
                            .attr('id', list.cantons[i].id_canton);
                        datalist.append(option);
                    }
                } else {
                    $('#name-canton').attr('placeholder', 'No hay cantones registrados');
                }
                if ($('#tagCanton').length) {
                    $('#name-canton').val($('#tagCanton').val());
                }
                findCanton();
            }
        }
    );
}//getCantons

function getDistricts(id_canton) {
    var parametros = {
        "canton": id_canton
    }; //equivalente a un formulario
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Location&action=getDistricts', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-districts');
                var list = JSON.parse(response);
                var datalist = $('#list-districts');
                datalist.empty();
                var list = JSON.parse(response);
                $('#name-district').attr('placeholder', 'Distrito');
                if (list.districts.length > 0) {
                    for (var i = 0; i < list.districts.length; i++) {
                        var option = $('<option>')
                            .attr('value', list.districts[i].nombre_distrito)
                            .attr('id', list.districts[i].id_distrito);
                        datalist.append(option);
                    }
                } else {
                    $('#name-district').attr('placeholder', 'No hay distritos registrados');
                }
                if ($('#tagDistrict').length) {
                    $('#name-district').val($('#tagDistrict').val());
                }
                findDistrict();
            }
        }
    );
} //getDistricts


function clearDatalist(datalist) {
    var datalist = $('#' + datalist);
    datalist.empty();
}


function chargeOrderSelect() {
    $.ajax(
        {
            url: '?controller=Order&action=getOrders', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-orders');
                var list = JSON.parse(response);
                var datalist = $('#list-orders');
                datalist.empty();

                if (list.orders.length > 0) {
                    for (var i = 0; i < list.orders.length; i++) {
                        var option = $('<option>')
                            .attr('value', list.orders[i].nombre)
                            .attr('id', list.orders[i].id_orden);
                        if (list.orders.length - 1 == i) {
                            $('#name-order').attr('value', list.orders[i].nombre);
                            option.attr('selected', 'selected');
                            $('#select-order').val(list.orders[i].id_orden);
                            getFamilies(list.orders[i].id_orden);
                            showButton("btn-family", "div-family");
                        }
                        datalist.append(option);
                    }
                }
            }
        }
    );
}//getOrders

function registerOrderModal(name) {
    var parametros = {
        "name": name
    }; //equivalente a un formulario   
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Order&action=registerOrder', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {
            },
            success: function (response) {
                chargeOrderSelect();
            }
        }
    );
}

function chargeFamilySelect(order) {
    var parametters = {
        "order": order
    }; //equivalente a un formulario   
    $.ajax(
        {
            data: parametters, //datos que se envian a traves de ajax
            url: '?controller=Family&action=getFamilies', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-families');
                var list = JSON.parse(response);
                var datalist = $('#list-families');
                datalist.empty();

                if (list.families.length > 0) {
                    for (var i = 0; i < list.families.length; i++) {
                        $('#name-family').attr('placeholder', 'Nombre de la familia');
                        var option = $('<option>')
                            .attr('value', list.families[i].nombre)
                            .attr('id', list.families[i].id_familia);
                        if (list.families.length - 1 == i) {
                            $('#name-family').val(list.families[i].nombre);
                            option.attr('selected', 'selected');
                            $('#select-family').val(list.families[i].id_familia);
                            getSubfamilies(list.families[i].id_familia);
                            showButton("btn-subfamily", "div-subfamily");
                        }
                        datalist.append(option);
                    }
                }
            }
        }
    );
}// 

function registerFamilyModal(name, order) {
    var parametros = {
        "family": name,
        "order": order
    }; //equivalente a un formulario   
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Family&action=registerFamily', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                chargeFamilySelect(order);
            }
        }
    );
}


function chargeSubfamilySelect(family) {
    var parametters = {
        "family": family
    }; //equivalente a un formulario   
    $.ajax(
        {
            data: parametters, //datos que se envian a traves de ajax
            url: '?controller=Subfamily&action=getSubfamilies', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-subfamilies');
                var list = JSON.parse(response);
                var datalist = $('#list-subfamilies');
                datalist.empty();
                if (list.subfamilies.length > 0) {
                    for (var i = 0; i < list.subfamilies.length; i++) {
                        $('#name-subfamily').attr('placeholder', 'Nombre de la subfamilia');
                        var option = $('<option>')
                            .attr('value', list.subfamilies[i].nombre)
                            .attr('id', list.subfamilies[i].id_subfamilia);
                        if (list.subfamilies.length - 1 == i) {
                            $('#name-subfamily').val(list.subfamilies[i].nombre);
                            option.attr('selected', 'selected');
                            $('#select-subfamily').val(list.subfamilies[i].id_subfamilia);
                            getGenders(list.subfamilies[i].id_subfamilia);
                            showButton("btn-gender", "div-gender");

                        }
                        datalist.append(option);
                    }
                }
            }
        }
    );
}

function registerSubfamilyModal(name, family) {
    var parametros = {
        "subfamily": name,
        "family": family
    }; //equivalente a un formulario   
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Subfamily&action=registerSubfamily', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {
            },
            success: function (response) {
                chargeSubfamilySelect(family);
            }
        }
    );
}

function chargeCabinetSelect() {
    $.ajax(
        {
            data: "", //datos que se envian a traves de ajax
            url: '?controller=Cabinet&action=getCabinets', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-cabinets');
                var list = JSON.parse(response);
                var datalist = $('#list-cabinets');
                datalist.empty();

                if (list.cabinets.length > 0) {
                    for (var i = 0; i < list.cabinets.length; i++) {
                        $('#number-cabinet').attr('placeholder', 'Nombre del gabinete');
                        var option = $('<option>')
                            .attr('value', list.cabinets[i].nombre)
                            .attr('id', list.cabinets[i].id_gabinete);
                        if (list.cabinets.length - 1 == i) {
                            $('#number-cabinet').val(list.cabinets[i].num_gabinete);
                            option.attr('selected', 'selected');
                            $('#select-cabinet').val(list.cabinets[i].id);
                            getDrawers(list.cabinets[i].id);
                            $('#cabinetModal').modal('hide');
                            $("#cabinet-feed").html("El gabinete existe");
                            $("#cabinet-feed").removeClass("invalid-feedback").addClass("valid-feedback");
                            $("#number-cabinet").removeClass("is-invalid").addClass("is-valid");
                            $("#number-drawer").prop('disabled', false);
                            $("#number-drawer").val('');
                        }
                        datalist.append(option);
                    }
                }
            }
        }
    );
}

function registerCabinetModal() {
    var parametros = {
        "cabinet": $('#name-cabinet-modal').val(),
        "drawers": $('#number-drawers-modal').val()
    }; //equivalente a un formulario   
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Cabinet&action=registerCabinet', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {
            },
            success: function (response) {
                chargeCabinetSelect();
            }
        }
    );
}

function chargeBoxSelect() {
    $.ajax(
        {
            data: "", //datos que se envian a traves de ajax
            url: '?controller=Box&action=getBoxes', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-boxes');
                var list = JSON.parse(response);
                var datalist = $('#list-boxes');
                datalist.empty();

                if (list.boxes.length > 0) {
                    for (var i = 0; i < list.boxes.length; i++) {
                        $('#number-box').attr('placeholder', 'Nombre de la caja');
                        var option = $('<option>')
                            .attr('value', list.boxes[i].nombre)
                            .attr('id', list.boxes[i].id_caja);
                        if (list.boxes.length - 1 == i) {
                            $('#number-box').val(list.boxes[i].num_caja);
                            option.attr('selected', 'selected');
                            $('#select-box').val(list.boxes[i].id);
                            $('#boxModal').modal('hide');
                            $("#box-feed").html("La caja existe");
                            getVials(list.boxes[i].id);
                            $("#box-feed").removeClass("invalid-feedback").addClass("valid-feedback");
                            $("#number-box").removeClass("is-invalid").addClass("is-valid");
                            $("#number-vial").prop('disabled', false);
                            $("#number-vial").val('');
                        }
                        datalist.append(option);
                    }
                }
            }
        }
    );
}

function registerBoxModal() {
    var parametros = {
        "box": $('#name-box-modal').val(),
        "vials": $('#number-vials-modal').val()
    }; //equivalente a un formulario   

    console.log($('#number-vials-modal').val());
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Box&action=registerBox', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {
            },
            success: function (response) {
                chargeBoxSelect();
            }
        }
    );

}

function chargeGenderSelect(id_family, id_subfamily, subfamily_name) {
    if (subfamily_name === "S.P") {
        var parametros = {
            "family": id_family,
            "option": 1
        }; //equivalente a un formulario
    } else {
        var parametros = {
            "subfamily": id_subfamily,
            "option": 2
        }; //equivalente a un formulario
    }
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Gender&action=getGenders', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                clearDatalist('list-genders');
                var list = JSON.parse(response);
                var datalist = $('#list-genders');
                datalist.empty();

                for (var i = 0; i < list.genders.length; i++) {
                    $('#name-gender').attr('placeholder', 'Nombre del género');
                    var option = $('<option>')
                        .attr('value', list.genders[i].nombre)
                        .attr('id', list.genders[i].id_genero);
                    if (i == list.genders.length - 1) {
                        $('#name-gender').val(list.genders[i].nombre);
                        option.attr('selected', 'selected');
                        $('#select-gender').val(list.genders[i].id_genero);
                        getSpecies(list.genders[i].id_genero);
                        $('#genderModal').modal('hide');
                        $("#gender-feed").html("El género existe");
                        $("#gender-feed").removeClass("invalid-feedback").addClass("valid-feedback");
                        $("#name-gender").removeClass("is-invalid").addClass("is-valid");
                        showButton("btn-species", "div-species");  
                        $('#name-species').prop('disabled', false);
                    }
                }
            }
        }
    );
}

function registerGenderModal() {
    gender = $("#name-gender-modal").val();
    family = $("#select-family").val();
    subfamily = $("#select-subfamily").val();
    subfamily_name = $("#name-subfamily").val();
    var parametros = {
        "gender": gender,
        "family": family,
        "subfamily": subfamily
    }; //equivalente a un formulario   
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Gender&action=registerGender', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {
                chargeGenderSelect(family, subfamily, subfamily_name);
            }
        }
    );
}

function chargeSpeciesSelect(gender) {
    var parametros = {
        "gender": gender
    }; //equivalente a un formulario
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Species&action=getSpecies', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {

            },
            success: function (response) {

                clearDatalist('list-species');
                var list = JSON.parse(response);
                var datalist = $('#list-species');
                datalist.empty();
                var list = JSON.parse(response);

                for (var i = 0; i < list.species.length; i++) {
                    $('#name-species').attr('placeholder', 'Nombre de la especie');
                    var option = $('<option>')
                        .attr('value', list.species[i].nombre)
                        .attr('id', list.species[i].id_especie);
                    if (i == list.species.length - 1) {
                        $('#name-species').val(list.species[i].especie);
                        option.attr('selected', 'selected');
                        $('#select-species').val(list.species[i].id_especie);
                        $('#speciesModal').modal('hide');
                        $("#species-feed").html("La especie existe");
                        $("#species-feed").removeClass("invalid-feedback").addClass("valid-feedback");
                        $("#name-species").removeClass("is-invalid").addClass("is-valid");
                    }
                }
            }
        }
    );
}

function registerSpeciesModal() {
    species = $("#name-species-modal").val();
    gender = $("#select-gender").val();
    var parametros = {
        "species": species,
        "gender": gender
    }; //equivalente a un formulario   
    $.ajax(
        {
            data: parametros, //datos que se envian a traves de ajax
            url: '?controller=Species&action=registerSpecies', //controlador que recibe la peticion
            type: 'post', //método de envio
            beforeSend: function () {
            },
            success: function (response) {
                chargeSpeciesSelect(gender);
            }
        }
    );
}


function showContainers() {
    var selectedOption = $("input[name='storage']:checked").val();
    validateStorage(document.getElementById("number-cabinet"));
    validateDrawer(document.getElementById("number-drawer"));
    console.log(selectedOption);
    if (selectedOption === "1") {
        $("#select-type").val('1');
        $("#box").hide();
        $("#cabinet").show();
        $("#drawer").show();
        $("#vial").hide();

        // $("#box-feed").html("Este campo no puede estar vacío");
        // $("#box-feed").removeClass("valid-feedback").addClass("invalid-feedback");
        // $("#number-box").removeClass("is-valid").addClass("is-invalid");
        // $("#vial-feed").html("Este campo no puede estar vacío");
        // $("#vial-feed").removeClass("valid-feedback").addClass("invalid-feedback");
        // $("#number-vial").removeClass("is-valid").addClass("is-invalid");
    } else if (selectedOption === "2") {
        $("#select-type").val('2');
        $("#box").show();
        $("#cabinet").hide();
        $("#drawer").hide();
        $("#vial").show();
        // $("#cabinet-feed").html("Este campo no puede estar vacío");
        // $("#cabinet-feed").removeClass("valid-feedback").addClass("invalid-feedback");
        // $("#number-cabinet").removeClass("is-valid").addClass("is-invalid");
        // $("#drawer-feed").html("Este campo no puede estar vacío");
        // $("#drawer-feed").removeClass("valid-feedback").addClass("invalid-feedback");
        // $("#number-drawer").removeClass("is-valid").addClass("is-invalid");
    }
}
