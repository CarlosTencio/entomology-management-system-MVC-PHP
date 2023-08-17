function plantsPagination(tableId) {
    var table = document.getElementById('table-' + tableId);
    var tables = document.getElementsByClassName('table-responsive');
    for (var i = 0; i < tables.length; i++) {
        tables[i].style.display = 'none';
    }
    table.style.display = 'block';
}

function previousButton(currentPage) {
    var tables = document.getElementsByClassName('table-responsive');
    var currentPage = -1;
    for (var i = tables.length - 1; i >= 0; i--) {
      if (tables[i].style.display !== 'none') {
        currentPage = i;
        break;
      }
    }
    if (currentPage > 0) {
      currentPage--;
      for (var i = 0; i < tables.length; i++) {
        tables[i].style.display = 'none';
      }
      document.getElementById('table-' + currentPage).style.display = 'block';
    }
}

function nextButton(plantsQuantity) {
    var tables = document.getElementsByClassName('table-responsive');
    var currentPage = -1;
    for (var i = 0; i < tables.length; i++) {
      if (tables[i].style.display !== 'none') {
        currentPage = i;
        break;
      }
    }
    if (currentPage <plantsQuantity - 1) {
      currentPage++;
      for (var i = 0; i < tables.length; i++) {
        tables[i].style.display = 'none';
      }
      document.getElementById('table-' + currentPage).style.display = 'block';
    }
}

function getValueCheckbox() {
    var valoresCheckboxes = $('.checkbox-plants:checked').map(function () {
        return $(this).val();
    }).get();
}

function clearCheckbox() {
    $('.checkbox-plants').prop('checked', false);
}