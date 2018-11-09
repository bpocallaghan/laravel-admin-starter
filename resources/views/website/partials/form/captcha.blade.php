<script type="text/javascript">
    /**
     * Helper to submit the forms via ajax
     * @param form
     * @returns {boolean}
     */
    function submitForm($form)
    {
        var inputs = [];
        if (!FORM.validateForm($form, inputs)) {
            return false;
        }

        var form = $form[0]; // You need to use standard javascript object here
        var formData = new FormData(form);

        FORM.sendFormToServer($form, formData);
        return false;
    }

    var onloadCallback = function() {
        $(".g-recaptcha").each(function() {
            var el = $(this);
            grecaptcha.render($(el).attr("id"), {
                "sitekey"   : "{{ env('RECAPTCHA_PUBLIC_KEY') }}",
                "badge"     : "bottomleft",
                "callback"  : function(token) {
                    $(el).parents('form').find(".g-recaptcha-response").val(token);
                    return submitForm($(el).parents('form'));
                }
            });
        });
    };

</script>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>