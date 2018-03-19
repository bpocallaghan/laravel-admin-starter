<div class="container">
    <div class="row p-3 d-flex align-items-center">
        <a href="/" class="logo" title="{{ config('app.name') }}">
            <img src="/images/logo.png">
        </a>

        {{--<div style="width: 20%; max-width: 246px; min-width: 120px">
            <a href="/" class="logo" title="{{ config('app.name') }}">
                @svg('logo', ['id' => 'Layer-1'])
            </a>
        </div>--}}
        <div class="ml-auto" role="group" aria-label="...">
            {{--@foreach($navigationFeatured as $item)--}}
                {{--<a class="btn btn-link" href="{{ $item->url }}">{!! $item->name !!}</a>--}}
            {{--@endforeach--}}

            @if(!\Auth::check())
                <a href="#" class="btn btn-outline-primary" data-icon="fa-sign-in" data-toggle="modal" data-target="#modal-login">
                    <i class="fa fa-sign-in"></i>
                    @lang('auth.login')
                </a>
                <a href="/auth/register" class="btn btn-outline-secondary" data-icon="fa-edit">
                    @lang('auth.register')
                </a>
            @else
                @if(\Auth::check() && user()->hasRole('admin'))
                   <a href="/admin" class="btn btn-link"><i class="fa fa-user-secret"></i> Admin</a>
                @endif
            @endif
            <select id="LanguageSwitcher" class="form-control btn btn-outline-dark" style="width:auto;">
                <option value="en" <?php $cuRRlocal = config('app.locale'); echo ($cuRRlocal == 'en' ? "selected" : "") ?>>English</option>
                <div class="dropdown-divider"></div>
                <option value="tr" <?php $cuRRlocal = config('app.locale'); echo ($cuRRlocal == 'tr' ? "selected" : "") ?> >Turkish</option>
            </select>
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
    <script type="text/javascript" src="{{ asset('js/locale.js') }}"></script>
@endsection
