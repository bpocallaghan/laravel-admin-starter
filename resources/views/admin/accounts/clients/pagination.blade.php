<table class="table-pagination table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Fullname</th>
        <th>Cellphone</th>
        <th>Email</th>
        <th>Roles</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($paginator as $item)
        <tr>
            <td>{{ $item->fullname }}</td>
            <td>{{ $item->cellphone }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->roles_string }}</td>
            <td>
                @if(!config('app.is_preview'))
                    <div class="btn-group">
                        <a href="/admin/accounts/clients/{{$item->id}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Show {{$item->fullname}}">
                            <i class="fa fa-eye"></i>
                        </a>
                    </div>

                    <div class="btn-group">
                        <a href="/admin/accounts/clients/{{$item->id}}/edit" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Edit {{$item->fullname}}">
                            <i class="fa fa-edit"></i>
                        </a>
                    </div>

                    <div class="btn-group">
                        <form id="form-delete-row{{ $item->id }}" method="POST" action="/admin/accounts/clients/{{ $item->id }}">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input name="_id" type="hidden" value="{{ $item->id }}">
                            <a data-form="form-delete-row{{ $item->id }}" class="btn btn-danger btn-xs btn-delete-row" data-toggle="tooltip" title="Delete {{ $item->fullname }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </form>
                    </div>
                @else
                    <span class="label label-info">(preview user)</span>
                @endif

                @if ($item->confirmed_at)
                    <div class="btn-group">
                        <form id="impersonate-login-form-{{$item->id}}" action="{{route('impersonate.login', $item->id)}}" method="post">
                            <input name="_token" type="hidden" value="{{csrf_token()}}">
                            <input name="redirect_to" type="hidden" value="/{{$item->logged_in_as}}">
                            <a data-form="impersonate-login-form-{{$item->id}}" class="btn btn-warning btn-xs btn-confirm-modal-row" data-toggle="tooltip" title="Impersonate {{$item->fullname}}">
                                <i class="fa fa-user-secret"></i>
                            </a>
                        </form>
                    </div>
                @endif

                <div class="btn-group">
                    <span class="label label-{{ $item->confirmed_at ? 'success':'warning' }}">
                        {{ $item->confirmed_at ? 'Confirmed ' . $item->confirmed_at->format('d M Y') : 'Not confirmed yet' }}
                    </span>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@include('admin.partials.pagination_footer')