/* Set the defaults for DataTables initialisation */
$.extend(true, $.fn.dataTable.defaults, {
    "oClasses": {
        "sFilter": 'dataTables_filter input-group',
    },
    "oLanguage": {
        "sLengthMenu": "_MENU_",
        "sSearch": "",
        "sInfo": "Showing <span class='txt-color-darken'>_START_</span> to <span class='txt-color-darken'>_END_</span> of <span class='text-primary'>_TOTAL_</span> entries",
        "sInfoEmpty": "<span class='text-danger'>Showing 0 to 0 of 0 entries</span>",
        "sSearch": "<span class='input-group-addon'><i class='glyphicon glyphicon-search'></i></span> "
    }
});

$(function ()
{
    $('.dt-table').each(function ()
    {
        var id = $(this).attr('id');
        var ajax = $(this).attr('data-server');
        if (ajax == 'false') {
            initDataTables('#' + id);
        }
    })

    initActionDeleteClick();
});

function initDatatablesAjax(selector, url, columns)
{
    return initDataTables(selector, {
        ajax: url,
        processing: true,
        serverSide: true,
        columns: columns,
    });
}

function initDataTables(selector, options)
{
    var options = (options ? options : {});
    options.responsive = true;
    options.order = getOrderBy(selector);
    options.sDom = "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
        "t" +
        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>";

    return $(selector).DataTable(options);
}

function getOrderBy(element)
{
    var orderByVal = $(element).attr('data-order-by');

    var orderBy = [0, 'asc'];
    if (!(orderByVal == 'false' || orderByVal == false || orderByVal == undefined)) {
        var pieces = orderByVal.split('|');
        if (pieces.length == 1) {
            orderBy = [pieces[0], 'asc'];
        }
        else if (pieces.length == 2) {
            orderBy = [pieces[0], pieces[1]];
        }
    }

    return orderBy;
}

function initActionDeleteClick()
{
    $('.dt-table').off('click', '.btn-delete-row');

    // DELETE ROW LINK
    $('.dt-table').on('click', '.btn-delete-row', onActionDeleteClick);

    function onActionDeleteClick(e)
    {
        e.preventDefault();
        var formId = $(this).attr('data-form');
        var title = $(this).attr('data-original-title');
        if (title.length > 7) {
            title = '<strong>' + title.substring(0, 6).toLowerCase() + '</strong> the <strong>' + title.slice(7) + '</strong>';
        }

        var content = "Are you sure you want to " + title + " entry? ";
        $('#modal-confirm').find('.modal-body').find('p').html(content);
        $('#modal-confirm').find('.modal-footer').find('.btn-primary').on('click', function (e)
        {
            $('#' + formId).submit();
        });
        $('#modal-confirm').modal('show');

        return false;
    }
}