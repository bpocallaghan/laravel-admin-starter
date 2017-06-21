/*
 * Button Class
 */
var ButtonClass = function (options)
{
    /*
     * Can access this.method
     * inside other methods using
     * root.method()
     */
    var root = this;

    /*
     * Constructor
     */
    this.construct = function (options)
    {
        root.activate();
    };

    /**
     * Set button into loading status
     * @param btn
     */
    this.loading = function (btn)
    {
        $(btn).attr('data-loading-text', "<i class='fa fa-spin fa-refresh'></i>");
        $(btn).each(function ()
        {
            $(this).attr('data-loading-text', "<i class='fa fa-spin fa-refresh'></i>");
            $(this).button('loading');
        })
    }

    /**
     * Reset the status of the button
     * @param btn
     */
    this.reset = function (btn)
    {
        $(btn).each(function ()
        {
            $(this).button('reset');
        })
    }

    // enable all buttons
    this.activate = function ()
    {
        $('.btn-ajax-submit').attr('data-loading-text', "<i class='fa fa-spin fa-refresh'></i>");
        $('.btn-ajax-submit').each(function ()
        {
            buttonEnable($(this));
        });

        $('.btn-ajax-submit').off('click');
        $('.btn-ajax-submit').on('click', function ()
        {
            // buttonDisable($(this));
            buttonDisable($(this));
        });

        $('.btn-submit').attr('data-loading-text', "<i class='fa fa-spin fa-refresh'></i>");
        $('.btn-submit').on('click', function ()
        {
            $(this).button('loading');
        });
    }

    // enable a specific button
    var buttonEnable = function (btn)
    {
        btn.each(function ()
        {
            // $(this).prop('disabled', false);
            // $(this).html($(this).attr('data-text'));

            $(this).button('reset');
        })
    }

    // disable and show loading button
    var buttonDisable = function (btn)
    {
        btn.each(function ()
        {
            // reset the text (some buttons change their text)
            $(this).attr('data-text', $(this).html());

            // disable (chrome messes this up)
            // form does not get submitted on chrome
            // $(this).prop('disabled', true);

            // show loading
            // $(this).html('loading...');

            $(this).button('loading');
        })
    }

    /*
     * Pass options when class instantiated
     */
    this.construct();
};