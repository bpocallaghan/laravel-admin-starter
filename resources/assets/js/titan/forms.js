//---------------------------------------------
// FORMS UTILS
//---------------------------------------------
var FormClass = function (options)
{
    var vars = {};

    var root = this;

    this.construct = function (options)
    {
        $.extend(vars, options);

        $('.input-generate-slug').change(function ()
        {
            var v = convertStringToSlug($(this).val());
            $("form input[name='slug']").val(v);
        })

        function convertStringToSlug(text)
        {
            return text.toString().toLowerCase().trim()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/&/g, '-and-')         // Replace & with 'and'
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '')             // Trim - from end of text
                .replace(/-$/, '');             // Remove last floating dash if exists
        }
    };

    /**
     * Validate a form
     *
     * @param form
     * @param inputs
     * @returns {boolean}
     */
    this.validateForm = function (form, inputs)
    {
        var id = '#' + $(form).attr('id');
        var alert = id + ' .alert';

        // validate form
        var s = "";
        // general validation
        for (var i = 0; i < inputs.length; i++) {
            var input = inputs[i];
            var type = input['type'] ? input['type'] : 'input';
            s += root.validateFormField(id, input['name'], type);
        }

        if (s.length > 1) {
            root.showAlert(alert, 'danger', 'Please complete the form.');
            BTN.reset(form.find('[type="submit"]'));
            return false;
        }

        // do the 'special' validation
        for (var i = 0; i < inputs.length; i++) {
            var input = inputs[i];

            // if email - test on valid email
            if (input['email'] && input['email'] === true) {
                if (!root.validateEmail($(id + " input[name='" + input['name'] + "']").val())) {
                    root.addFormFieldError(id, input['name']);
                    root.showAlert(alert, 'danger', 'Email is not valid.');
                    BTN.reset(form.find('[type="submit"]'));
                    return false;
                }
            }
        }

        // hide alert
        $(alert).slideUp();
        BTN.reset(form.find('[type="submit"]'));
        return true;
    }

    this.activateSubmitBtn = function (form)
    {
        BTN.reset($(form).find('[type="submit"]'));
    }

    /**
     * Send the form data to the server
     *
     * @param form
     * @param data
     */
    this.sendFormToServer = function (form, data, callback)
    {
        var id = '#' + $(form).attr('id');
        var url = $(form).attr('action');
        var spinner = id + ' .feedback-spinner';
        var alert = id + ' .feedback-alert';

        $(alert).hide();
        $(spinner).slideDown(100);

        // set loading text and disable btn
        BTN.loading(form.find('[type="submit"]'));
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            dataType: 'json',
            success: function (response)
            {
                $(spinner).slideUp();

                // when custom ajax error
                if (response['success'] == 0 && response['error']) {
                    root.showAlert(alert, 'danger', response['error']['title']);
                    BTN.reset(form.find('[type="submit"]')); // reset button
                    return false;
                }

                // clear form fields
                root.resetForm(form);

                // reload / redirect
                if (response.data['redirect'] && response.data['redirect'].length > 2) {
                    document.location.href = response.data['redirect'];
                } else {
                    if (response['success'] && response['data'] && response['data']['level']) {
                        root.showAlert(alert, response['data']['level'], response['data']['title'] + ' ' + response['data']['description']);
                    } else {

                        if (typeof callback == 'function') {
                            callback(response.data);
                        } else {
                            root.showAlert(alert, 'success', response.data);
                        }
                    }
                }

                // reset captcha and clear inputs on success
                if (typeof grecaptcha != "undefined") {
                    grecaptcha.reset();
                }
            },
            error: function (data)
            {
                var errors = data.responseJSON;
                if(errors.hasOwnProperty('errors')) {
                    errors = errors.errors;
                }

                var messages = '';
                for (var key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        // if array or string
                        if (!Array.isArray(errors[key])) {
                            messages += errors[key] + "<br/>";
                        } else {
                            messages += errors[key][0] + "<br/>";
                        }
                    }
                }

                $(spinner).slideUp();
                BTN.reset(form.find('[type="submit"]'));
                root.showAlert(alert, 'danger', messages);
            }
        });
    }

    /**
     * Show the form alert
     *
     * @param elesohw
     * @param content
     */
    this.showAlert = function (ele, type, content)
    {
        FORM.activateSubmitBtn($(ele).parents('form'));

        $(ele).removeClass('alert-danger alert-success alert-warning hidden').addClass('alert-' + type);
        $(ele).html(content);
        $(ele).slideDown();
    }

    this.showAlertSuccess = function (ele, content)
    {
        root.showAlert(ele, 'success', content);
    }

    this.validateFormField = function (id, inputName, type)
    {
        var s = "";
        var input = $(id + " " + type + "[name='" + inputName + "']");
        var parent = input.parent().removeClass('error');

        if (type == 'select') {
            if (input.find(":selected").val() <= 0) {
                parent.addClass('error');
                s += "Please select the " + inputName.charAt(0).toUpperCase() + inputName.slice(1) + ". <br/>";
            }
        } else {
            if (input.val().length <= 1) {
                parent.addClass('error');
                s += "Please add your " + inputName.charAt(0).toUpperCase() + inputName.slice(1) + ". <br/>";
            }
        }

        return s;
    }

    this.addFormFieldError = function (id, inputName)
    {
        var input = $(id + " input[name='" + inputName + "']");
        input.parent().removeClass('error').addClass('error');
    }

    this.removeFormFieldError = function (id, inputName)
    {
        var input = $(id + " input[name='" + inputName + "']");
        input.parent().removeClass('error');
    }

    this.validateEmail = function (email)
    {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    /**
     * Reset the form
     * @param form
     */
    this.resetForm = function (form)
    {
        form.find('textarea').val('');
        form.find('textarea').html('');
        form.find('input')
            .not('input[type="radio"]')
            .not('input[type="checkbox"]')
            .not('input[type="hidden"]')
            .val('');

        form.find('input').each(function ()
        {
            $(this).parent().removeClass('error');
        });

        var alert = '#' + form.attr('id') + ' .alert';
        $(".feedback-spinner").slideUp();
        $(alert).slideUp();

        BTN.reset(form.find('[type="submit"]'));
    }

    /**
     * Get the selected val of a select
     * @param id
     * @param name
     * @returns {*|jQuery}
     */
    this.selectValByName = function (id, name)
    {
        return $(id + ' select[name="' + name + '"]').find(":selected").val();
    }

    /**
     * Input Helper
     * @param form
     * @param name
     * @param type
     * @returns {*|jQuery|HTMLElement}
     */
    this.input = function (form, name, type)
    {
        type = type ? type : 'input';
        return $(form + ' ' + type + '[name="' + name + '"]');
    }

    this.construct(options);
};
