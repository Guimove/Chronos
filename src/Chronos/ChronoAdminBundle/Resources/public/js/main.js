$("form input.date").datepicker({
    dateFormat: 'dd/mm/yy',
    defaultDate:null,
    changeYear:true,
    yearRange: '-60:-16',
    firstDay:1
}).attr("readonly","readonly");