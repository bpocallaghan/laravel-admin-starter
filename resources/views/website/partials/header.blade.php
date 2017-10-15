<div class="container">
    <div class="padding-bottom-10">
        <a href="/" class="logo" title="{{ config('app.name') }}">
            <img src="/images/logo.png">
        </a>

        <div class="text-center pull-right">
            <div>
                @if(!\Auth::check())
                    <a href="#" class="" data-icon="fa-sign-in" data-toggle="modal" data-target="#modal-login">
                        <i class="fa fa-sign-in"></i>
                        Login
                    </a>
                    or
                    <a href="/auth/register" class="" data-icon="fa-edit">
                        Register
                    </a>
                @else
                    <br/>
                @endif
            </div>

            <div class="btn-group" role="group" aria-label="...">
                @foreach($navigationFeatured as $item)
                    <a class="btn btn-default" href="{{ $item->url }}">{!! $item->name !!}</a>
                @endforeach
            </div>
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
