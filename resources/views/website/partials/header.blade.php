<div class="container">
    <div class="row p-3 d-flex align-items-center">
        <a href="/" class="logo" title="{{ config('app.name') }}">
            <img src="/images/logo.png">
        </a>

        <div class="ml-auto" role="group" aria-label="...">
            {{--@foreach($navigationFeatured as $item)--}}
            {{--<a class="btn btn-link" href="{{ $item->url }}">{!! $item->name !!}</a>--}}
            {{--@endforeach--}}

            @if(!auth()->check())
                <a href="#" class="btn btn-outline-primary" data-icon="fa-sign-in" data-toggle="modal" data-target="#modal-login">
                    <i class="fa fa-sign-in"></i>
                    Login
                </a>
                <a href="/auth/register" class="btn btn-outline-secondary" data-icon="fa-edit">
                    Register
                </a>
            @else
                @if (impersonate()->isActive())
                    <small>
                        <a href="{{ route('impersonate.logout') }}"
                           onclick="event.preventDefault(); document.getElementById('impersonate-logout-form').submit();">
                            return to original user
                        </a>
                        <form id="impersonate-logout-form" action="{{ route('impersonate.logout') }}" method="post" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </small>
                @endif

                @if(auth()->check() && user()->isAdmin())
                    <a href="/admin" class="btn btn-link"><i class="fa fa-user-secret"></i>
                        Admin</a>
                @endif
            @endif
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function () {
            $('#form-search').on('submit', function () {
                var search = $("#form-search input[name='search']").val();
                window.location.href = "https://www.google.com.na/search?q={{ config('app.url') }}+" + encodeURI(search);
                return false;
            });
        })
    </script>
@endsection
