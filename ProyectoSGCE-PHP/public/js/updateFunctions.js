function chargeInfoTag() {
    var valorEntrada = $('#tagCountry').val();

    $('#name-country').val(valorEntrada);
    $('#submit-tag').val($('#tagId').val());
    $('#submit-specimen-tag').val($('#id-specimen').val());
    findCountry();
    $('#input-collector').val($('#tagCollector').val());
    $('#input-date').val($('#tagDate').val());
    $('#submit-date').val($('#input-date').val());
    $('#submit-collector').val($('#input-collector').val());
    $("#save-changes").prop("disabled", false);
}// Fin de la función chargeInfoTag

function infoTag() {
    $('#submit-date').val($('#input-date').val());
    $('#submit-collector').val($('#input-collector').val());
}


function chargeInfoTax() {
    var valorEntrada = $('#taxOrder').val();
    $('#name-order').val(valorEntrada);
    $('#submit-specimen-tax').val($('#id-specimen').val());

    findOrderModal();
    $("#save-changes-tax").prop("disabled", true);
    // $("#save-changes-tax").prop("disabled", false);
}

function chargeInfoStorage() {
    if ($('#type').val() === 1) {
        $("#box").hide();
        $("#cabinet").show();
        $("#label-drawer").show();
        $("#vial").hide();
    } else {
        $("#box").show();
        $("#cabinet").hide();
        $("#label-drawer").hide();
        $("#vial").show();
    }
    $('#number-cabinet').val($('#storage').val());
    $('#number-drawer').val($('#drawer').val());
    $('#submit-storage').val($('#storage').val());
    $('#submit-drawer').val($('#drawer').val());
    $('#submit-specimen-storage').val($('#id-specimen').val());
}

function chargeInfoImg() {
    $('#submit-specimen').val($('#id-specimen').val());
}

function chargeInfoImgForDelete(id, route) {
    $('#submit-specimen-delete').val($('#id-specimen').val());
    $('#submit-img').val(id);
    $('#submit-route').val(route);
}

function chargeInfoPlant(plant, name) {
    $("#id-plant").val(plant);
    $("#name-plant").val(name);
    $("#name-plant-modal").val(name);

    validateRegisteredPlant(document.getElementById('name-plant-modal'), 'name-feed');
}// Fin de la función chargeInfoPlant

function chargeInfoOrder(order, name) {
    $("#id-order").val(order);
    $("#name-order").val(name);
    $("#name-order-modal").val(name);

    validateRegisteredOrder(document.getElementById('name-order-modal'), 'name-feed');
}// Fin de la función chargeInfoPlant

function chargeInfoFamily(id_order, order, family, name) {
    $("#select-order").val(id_order);
    $("#name-order").val(order);
    $("#submit-order").val(order);
    $("#id-family").val(family);
    $("#name-family-modal").val(name);
    $("#name-family").val(name);
    // validateRegisteredFamily(document.getElementById('name-family-modal'),'name-feed');
}// chargeInfoFamily

function chargeInfoSubfamily(id_order, order, id_family, family, subfamily, name) {
    $("#select-order").val(id_order);
    $("#name-order").val(order);
    $("#submit-order").val(order);
    $("#select-family").val(id_family);
    $("#name-family").val(family);
    $("#submit-family").val(family);
    $("#id-subfamily").val(subfamily);
    $("#name-subfamily").val(name);
    $("#name-subfamily-modal").val(name);
    findOrderModal();
    $("#save-changes").prop("disabled", true);
    // validateRegisteredFamily(document.getElementById('name-family-modal'),'name-feed');
}// chargeInfoFamily

function chargeInfoGender(id_order, order, id_family, family, id_subfamily, subfamily, gender, name) {
    $("#select-order-gender").val(id_order);
    $("#select-family-gender").val(id_family);
    $("#select-subfamily-gender").val(id_subfamily);

    $("#name-order-gender").val(order);
    $("#name-family-gender").val(family);
    $("#name-subfamily-gender").val(subfamily);

    $("#submit-order-gender").val(order);
    $("#submit-family-gender").val(family);
    $("#submit-subfamily-gender").val(subfamily);

    $("#id-gender").val(gender);
    $("#submit-gender-gender").val(name);
    $("#name-gender-modal").val(name);
    findOrderGenderModal();
    $("#save-changes-species").prop("disabled", true);
}

function infoGender() {
    $("#submit-order-gender").val($("#name-order-gender").val());
    $("#submit-family-gender").val($("#name-family-gender").val());
    $("#submit-subfamily-gender").val($("#name-subfamily-gender").val());
}

function infoSpecies() {
    $("#submit-order").val($("#name-order").val());
    $("#submit-family").val($("#name-family").val());
    $("#submit-subfamily").val($("#name-subfamily").val());
    $("#submit-gender").val($("#name-gender").val());
}//

function chargeInfoSpecies(id_order, order, id_family, family, id_subfamily, subfamily, id_gender, gender, species, name) {
    $("#select-order").val(id_order);
    $("#select-family").val(id_family);
    $("#select-subfamily").val(id_subfamily);
    $("#select-gender").val(id_gender);

    $("#name-order").val(order);
    $("#name-family").val(family);
    $("#name-subfamily").val(subfamily);
    $("#name-gender").val(gender);

    $("#submit-order").val(order);
    $("#submit-family").val(family);
    $("#submit-subfamily").val(subfamily);
    $("#submit-gender").val(gender);

    $("#id-species").val(species);
    $("#submit-species").val(name);
    $("#name-species-modal").val(name);

    findOrderModal();
    $("#save-changes-species").prop("disabled", true);
}

function chargeInfoSpecimen(specimen) {
    $('#submit-specimen').val(specimen);
}

function sendForm() {
        $("#form-plant").submit();
}

function chargeInputs() {
    $("#submit-order").val($("#name-order").val());
    $("#submit-family").val($("#name-family").val());
}



