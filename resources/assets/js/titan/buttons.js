/*
 * Button Class
 */
var ButtonClass = function ()
{
    var root = this;

    /*
     * Constructor
     */
    this.construct = function ()
    {
        root.activate();
    };

    /**
     * Set button into loading status
     * @param btn
     */
    this.loading = function (btn)
    {
        $(btn).attr('data-reset', $(btn).html());
        $(btn).attr('data-loading', "<i class='fa fa-spin fa-refresh'></i>");
        $(btn).each(function ()
        {
            console.log('loading loading');
            buttonDisable($(this));
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
            buttonEnable(btn);
            //$(this).button('reset');
        })
    }

    // enable all buttons
    this.activate = function ()
    {
        $('.btn-ajax-submit').each(function ()
        {
            buttonEnable($(this));
        });

        // when button gets the disabled attribute
        // the ajax form does not get triggered
        return false;

        $('.btn-ajax-submit').off('click');
        $('.btn-ajax-submit').on('click', function (e)
        {
            console.log('clickckkkkkk');
            root.loading($(this));
        });

        $('.btn-submit').attr('data-loading', "<i class='fa fa-spin fa-refresh'></i>");
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
            //$(this).button('reset');

            console.log('buttonEnable buttonEnable buttonEnable');

            $(this).prop('disabled', false);
            $(this).html($(this).attr('data-reset'));

            $(this).attr('data-is-loading', false);
        })
    }

    // disable and show loading button
    var buttonDisable = function (btn)
    {
        btn.each(function ()
        {
            console.log('buttonDisable buttonDisable');
            //$(this).button('loading');

            $(this).prop('disabled', true);
            $(this).attr('data-is-loading', true);
            $(this).html($(this).attr('data-loading'));

            // disable (chrome messes this up)
            // form does not get submitted on chrome
            // $(this).prop('disabled', true);

            // show loading
            //$(this).button('loading');
        })
    }

    /*
     * Pass options when class instantiated
     */
    this.construct();
};