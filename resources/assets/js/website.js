var FORM;
var BTN;

function initWebsite()
{
    FORM = new FormClass();
    BTN = new ButtonClass();

    // init vendor selections on page load
    $('[data-toggle="tooltip"]').tooltip();

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
        }
    });
}