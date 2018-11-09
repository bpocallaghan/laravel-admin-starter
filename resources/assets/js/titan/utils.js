function showSpinner()
{
    $('.spinner-content').fadeIn(300);
}

function hideSpinner()
{
    $('.spinner-content').stop().fadeOut(300);
    setTimeout(function ()
    {
        $('.spinner-content').stop().fadeOut(300);
    }, 300);
}

function log(value)
{
    console.log(value);
}

function doAjax(url, data, callback, loader)
{
    if (loader == undefined || loader == true) {
        showSpinner();
    }

    var urlFull = url; // BASE_URL.replace(/\/$/, '') + '/' +
    if (url.search('http://') >= 0 || url.search('https://') >= 0) {
        urlFull = url;
    }

    if (data == undefined) {
        data = {};
    }
    // data['api_token'] = API_TOKEN;

    $.ajax({
        type: 'POST',
        url: urlFull,
        data: data,
        dataType: "json",
        timeout: 60000,
        error: function (x, t, m)
        {
            console.log('AJAX ERROR');
            console.log(x);
            console.log(t);
            console.log(m);
            notifyError('Sorry', 'A system error occurred. Please try again or contact our Call centre.');
        },
        success: function (response)
        {
            if (typeof callback == 'function') {
                callback(response);
            }
        }
    });
}

/**
 * Is the ajax response valid
 * @param response
 * @returns {boolean}
 */
function isAjaxResponseValid(response)
{
    if (!(response.success || response.data)) {
        notifyError('Sorry', 'Something went wrong, please try again.');
        return false;
    }

    return true;
}

/**
 * In Header of Box, the toolbox daterange icon
 * Dropdown with the selected dates to select from
 * @param selector
 * @param callback
 */
function initToolbarDateRange(selector, callback)
{
    $(selector).daterangepicker({
        ranges: {
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Last 3 Months': [moment().subtract(2, 'month').startOf('month'), moment().endOf('month')],
            'Last 6 Months': [moment().subtract(5, 'month').startOf('month'), moment().endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    }, function (start, end)
    {
        //window.alert("You chose: " + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        if (typeof callback === 'function') {
            callback(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
        }
    });
}

/**
 * Give from and to datetimepicker inputs,
 * This will automatically set min / max date on the fields
 */
function setDateTimePickerRange(from, to)
{
    $(from).datetimepicker();
    $(to).datetimepicker({useCurrent: false});

    $(from).on("dp.change", function (e)
    {
        $(to).data("DateTimePicker").minDate(e.date);
    });
    $(to).on("dp.change", function (e)
    {
        $(from).data("DateTimePicker").maxDate(e.date);
    });
}

function isFunction(variable)
{
    var getType = {};
    return variable && getType.toString.call(variable) === '[object Function]';
}

var roundValue = function (value)
{
    return Math.round(parseFloat(value) * 100) / 100;
}

var formatNumber2Decimal = function (value)
{
    value = parseFloat(value).toFixed(2);
    //value = (value).replace(/.00+$/, "");
    return value;
}