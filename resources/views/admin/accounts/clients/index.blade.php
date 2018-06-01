@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List of Clients</span>
                    </h3>
                </div>

                <div class="box-body">
                    @include('admin.partials.info')

                    <div class="well">
                        <form id="js-form-filters">
                            {!! csrf_field() !!}

                            <div class="row filters">
                                <div class="col-sm-6 col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
                                        <input id="filter_name" type="text" class="form-control" placeholder="Client Name" name="name">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                        <input id="filter_cellphone" type="text" class="form-control" placeholder="Cellphone" name="cellphone">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                        <input id="filter_email" type="text" class="form-control" placeholder="Email" name="email">
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-2">
                                    <a href="{{ request()->url() }}" class="btn btn-default btn-ajax-submit" data-toggle="tooltip" title="Refresh Filters">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="pagination-box">
                        @include('admin.accounts.clients.pagination')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function () {
            var pagination = new PaginationClass({
                onComplete: onPaginationComplete
            });

            function onPaginationComplete()
            {
                $('[data-toggle="tooltip"]').tooltip();
                initActionDeleteClick($('.table-pagination'));
            }

            onPaginationComplete();

            $('#filter_name').on("propertychange change click keyup input paste", onFilterFieldChange);
            $('#filter_cellphone').on("propertychange change click keyup input paste", onFilterFieldChange);
            $('#filter_email').on("propertychange change click keyup input paste", onFilterFieldChange);

            var filterTimeout;

            function onFilterFieldChange()
            {
                var elem = $(this);
                if (elem.data('oldVal') != elem.val()) {
                    clearTimeout(filterTimeout);
                    elem.data('oldVal', elem.val());
                    filterTimeout = setTimeout(function () {
                        filterEntries();
                    }, 500);
                }
            }

            function filterEntries()
            {
                doAjax('/admin/accounts/clients/filter', {
                    name: $('#filter_name').val(),
                    cellphone: $('#filter_cellphone').val(),
                    email: $('#filter_email').val(),
                }, function (response) {
                    pagination.showPage(1, true);
                });
            }
        })
    </script>
@endsection