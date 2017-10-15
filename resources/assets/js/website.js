var FORM;
var BTN;

$(document).ready(function () {
    initWebsite();
});

function initWebsite()
{
    FORM = new FormClass();
    BTN = new ButtonClass();

    // init vendor selections on page load
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
        }
    });

    // back to top button
    $(window).scroll(function () {
        // if u scrolled more than 80% of the current window
        if ($(window).scrollTop() > ($(window).height() * .8)) {
            $('.back-to-top').css({"bottom": "20px"});
        } else {
            $('.back-to-top').css({"bottom": "-50px"});
        }
    });

    // jump to an achor link
    $("a.jumper").click(function (event) {
        event.preventDefault();
        var link = $(this).attr('href');
        setTimeout(function () {
            $(link).trigger('click');
        }, 500);
        var urlHashes = this.href.split("#");
        var scrollTop = $("#" + urlHashes[1]).offset().top - 50;
        $('html, body').animate({scrollTop: scrollTop}, 500);
        return false;
    });
}