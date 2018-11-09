/*
 * PaginationClass
 */
var PaginationClass = function (options) {

    var root = this;

    // get the pagination classes
    var isAjaxBusy = false;
    var vars = {
        parent: null,
        popups: false,
        onComplete: null,
        currentPage: 1,
    };

    /*
     * Constructor
     */
    this.construct = function (options) {
        activate();
        $.extend(vars, options);
    };

    /*
     * Activate and init global events
     */
    var activate = function () {
        // 'deeplink' to the page specified
        if (window.location.hash && window.location.hash.length >= 2) {
            var hash = window.location.hash.substring(1);
            root.showPage(parseInt(hash));
        }

        // on hashchange - trigger the page change
        $(window).on('hashchange', function () {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    root.showPage(page);
                }
            }
        });

        // on pagination click
        $(document).on('click', '.pagination a', function (e) {
            root.showPage($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    };

    /**
     * Popup Button events
     * Popup events
     */
    var registerPopups = function () {

    }

    /**
     * Get selected paginate page items
     * @param page
     * @returns {boolean}
     */
    this.showPage = function (page, force) {
        if (force === undefined || force == null) {
            if (isAjaxBusy || vars.currentPage == page) {
                return false;
            }
        }

        isAjaxBusy = true;
        vars.currentPage = page;
        $('.js-pagination-loader').show();
        $.ajax({
            url: '?page=' + page,
            dataType: 'json',
        }).done(function (data) {
            isAjaxBusy = false;
            location.hash = page;
            $('.pagination-box').html(data);

            // re register the modal events
            if (vars.popups) {
                registerPopups();
            }

            // call function on parent when ajax is complete
            if (vars.onComplete) {
                vars.onComplete();
            }
            
            $('.js-pagination-loader').hide();
        }).fail(function () {
            isAjaxBusy = false;
            $('.js-pagination-loader').hide();
        });
    }

    this.construct(options);
};