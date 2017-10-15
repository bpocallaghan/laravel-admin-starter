$(function () {
    $("body").append("<div id='notify-container'></div>");
    $("body").append("<audio id='notify-sound-info' src='/sounds/info.mp3'></audio>");
    $("body").append("<audio id='notify-sound-danger' src='/sounds/danger.mp3'></audio>");
});

/**
 * Global Success Helper
 * @param title
 * @param content
 * @param level
 */
function notify(title, content, level, icon, timeout)
{
    $.notify({
        title: title,
        content: content,
        level: level ? level : 'success',
        icon: icon ? icon : "fa fa-thumbs-o-up bounce animated",
        iconSmall: icon ? icon : "fa fa-thumbs-o-up bounce animated",
        timeout: timeout ? timeout : undefined,
    });
}

/**
 * Global Error Helper
 * @param title
 * @param content
 */
function notifyError(title, content)
{
    $.notify({
        title: title,
        content: content,
        level: 'danger',
        icon: "fa fa-thumbs-o-down shake animated",
        iconSmall: "fa fa-thumbs-o-down spin animated",
    });
}

var notifyCount = 0;
var notifyHeight = 0;

$.notify = function (settings) {
    settings = $.extend({
        title: "",
        content: "",
        icon: undefined,
        iconSmall: undefined,
        level: 'info',
        timeout: undefined
    }, settings);

    // vars
    notifyCount = notifyCount + 1;
    var notifyId = "notify" + notifyCount;

    // sound
    var soundFile = settings.level;
    if (settings.level == 'success') {
        soundFile = 'info';
    }
    if (settings.level == 'warning') {
        soundFile = 'danger';
    }

    // play sound
    document.getElementById('notify-sound-' + soundFile).play()

    // html markup
    var html = '<div id="' + notifyId + '"';
    html += 'class="notify animated fadeInRight fast alert-' + settings.level + '">';
    if (settings.icon == undefined) {
        html += '<div class="textfull">';
    } else {
        html += '<div class="icon-big"><i class="' + settings.icon + '"></i></div><div class="text">';
    }
    html += '<span>' + settings.title + '</span>'
    html += '<p>' + settings.content + '</p>';
    html += '</div><div>';
    if (settings.iconSmall) {
        html += '<i class="icon-small ' + settings.iconSmall + '"></i>';
    }
    html += '</div></div>';

    // append html markup to container
    $("#notify-container").append(html);
    if (notifyCount == 1 || $(".notify").length <= 0) {
        notifyHeight = $("#" + notifyId).height() + 40;
    } else {
        $("#" + notifyId).css("top", notifyHeight);

        // update all of their positions
        updateNotifyPositions(0);
    }

    // remove on timeout
    if (settings.timeout != undefined) {
        setTimeout(function () {
            removeNotify($("#" + notifyId));
        }, settings.timeout);
    }

    // remove on click
    $("#notify" + notifyCount).bind('click', function () {
        removeNotify($(this));
    });

    /**
     * Remove the notify and update the positions
     * @param ele
     */
    function removeNotify(ele)
    {
        // css3 animations
        ele.removeClass('fadeInRight').addClass('fadeOutRight');

        // after animation - remove and update other
        setTimeout(function () {
            ele.remove();
            updateNotifyPositions(300)
        }, 400);
    }

    /**
     * Remove element
     * Update other notifies positions
     * @param ele
     */
    function updateNotifyPositions(delay)
    {
        $(".notify").each(function (index) {
            if (index == 0) {
                $(this).animate({top: 20}, delay);
                notifyHeight = $(this).height() + 40;
            } else {
                $(this).animate({top: notifyHeight}, delay + 50);
                notifyHeight += $(this).height() + 20;
            }
        });
    }
}