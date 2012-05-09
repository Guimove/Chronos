$(document).ready(function () {
    $("input.date").datepicker({
        dateFormat: 'dd/mm/yy',
        firstDay: 1
    }).attr("readonly", "readonly")
});