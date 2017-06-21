$(document).ajaxStart(function() { Pace.restart(); });

function initAdmin()
{
    initTitan();

    $(".select2").select2();
    $('[data-toggle="tooltip"]').tooltip();
}
