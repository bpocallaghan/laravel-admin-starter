@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-users"></i></span>
                        <span>List All {{ ucfirst(str_plural($resource)) }}</span>
                    </h3>
                </div>

                <div class="box-body">

                    @include('admin.partials.info')

                    <div class="well well-sm well-toolbar">
                        <a class="btn btn-labeled btn-primary" href="{{ Request::url().'/invites' }}">
                            <span class="btn-label"><i class="fa fa-fw fa-user-plus"></i></span>Invite Administrator
                        </a>
                    </div>

                    <table id="tbl-list" data-server="false" class="dt-table table nowrap table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th><i class="fa fa-fw fa-user text-muted"></i> Name</th>
                            <th><i class="fa fa-fw fa-envelope text-muted"></i> Email</th>
                            <th><i class="fa fa-fw fa-mobile-phone text-muted"></i> Cellphone</th>
                            <th>Gender</th>
                            <th><i class="fa fa-fw fa-calendar text-muted"></i> Last Login</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $user)
                            <tr>
                                <td>{{ $user->fullname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->cellphone }}</td>
                                <td>{{ $user->gender }}</td>
                                <td>{{ ($user->logged_in_at)? $user->logged_in_at->diffForHumans():'-' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection