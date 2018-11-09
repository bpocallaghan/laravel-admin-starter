//-------------------------------------------------
// SOCIAL MEDIA SHARE ACTIONS
//-------------------------------------------------
$(function () {
    $(".link-share").click(doShareClick);

    function doShareClick(e)
    {
        e.preventDefault();
        var type = $(this).attr('data-social');
        var title = $(this).attr('data-title');
        var image = $(this).attr('data-image');

        // object to be send to server
        var data = {
            'type': type,
            'url': getShareLink(),
            'description': getShareDescription(),
            'title': (title) ? title : getShareTitle(),
            'image': (image) ? image : getShareImage()
        };

        switch (type) {
            case "facebook":
                doFacebookShare();
                break;
            case "twitter":
                doTwitterShare();
                break;
            case "youtube":
                doYoutubeShare();
                break;
            case "googleplus":
                doGoolgePlusShare();
                break;
            case "pinterest":
                doPinterestShare();
                break;
            case "print":
                window.print();
                break;
            case "email":
                document.location.href = "mailto:?subject=" + encodeURI(data['title']) + '&amp;body=' + encodeURI(data['description']);
                break;
        }

        $.post("/ajax/log/social-media", data);

        return false;
    }

    function doFacebookShare()
    {
        if (FB || $('#fb-root').length >= 1) {
            FB.ui({
                method: 'share',
                display: 'popup',
                href: $('meta[name="og:url"]').attr('content')
            }, function (response) {
            });
        }
    }

    function doTwitterShare()
    {
        var message = getShareTitle() + ' ' + getShareLink();
        openPopupWindow("https://twitter.com/home?status=" + encodeURI(message));
        return message;
    }

    function doGoolgePlusShare()
    {
        openPopupWindow("https://plus.google.com/share?url=" + encodeURI(getShareLink()));
    }

    function doYoutubeShare()
    {
        var link = "https://www.youtube.com/channel/UC2c2ERwS06KDXoRgmUWGgDw";
        openPopupWindow(link);
        return link;
    }

    function doPinterestShare()
    {
        var link = "http://pinterest.com/pin/create/button/?url=" + encodeURI(getShareLink());
        link += "&description=" + encodeURI(getShareTitle());
        link += "&media=" + encodeURIComponent(getShareImage());

        openPopupWindow(link);
    }

    function getShareImage()
    {
        return $("meta[name='og:image']").attr('content');
    }

    function getShareLink()
    {
        return window.location.href;
        /*$("meta[name='og:url']").attr('content');*/
    }

    function getShareTitle()
    {
        return $("meta[name='og:title']").attr('content');
    }

    function getShareDescription()
    {
        return $("meta[name='og:description']").attr('content');
    }

    function getShareCaption()
    {
        return $('meta[name="og:caption"]').attr('content');
    }

    function openExternalWindow(url)
    {
        openWindow(url, '_blank');
    }

    function openWindow(url, type)
    {
        var win = window.open(url, type);
        win.focus();
    }

    function openPopupWindow(url)
    {
        var win = window.open(url, 'popup', 'width=600, height=300');
        win.focus();
    }
});