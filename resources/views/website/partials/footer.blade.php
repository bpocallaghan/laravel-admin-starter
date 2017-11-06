<footer class="pt-5 bg-primary text-white mt-auto">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 text-left">
                <a href="/" class="logo" title="{{ config('app.name') }}">
                    <img src="/images/logo-w.png">
                </a>
                <hr>
                <small>
                    Website by <a href="https://github.com/bpocallaghan" target="_blank">{!! env('APP_AUTHOR') !!}</a>
                </small>
            </div>
            <div class="col-sm-8 text-center">
                <div class="row text-left">
                    <ul class="col-sm-4">
                        @foreach($footerNavigation['About'] as $item)
                            <li><a class="{{ $loop->first ? 'text-white':'text-grey' }}" href="{{ $item->url }}">{!! $item->name !!}</a></li>
                        @endforeach
                            <li><a class="text-grey" href="/contact-us">Contact Us</a></li>
                    </ul>
                    <ul class="col-sm-4">
                        <li><a class="text-white" href="#">Pages</a></li>
                        @foreach($footerNavigation['Pages'] as $item)
                            <li><a class="text-grey" href="{{ $item->url }}">{!! $item->name !!}</a></li>
                        @endforeach
                    </ul>
                    <ul class="col-sm-4">
                        <li><a class="text-white" href="#">Corporate</a></li>
                        @foreach($footerNavigation['Corporate'] as $item)
                            <li><a class="text-grey" href="{{ $item->url }}">{!! $item->name !!}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-3 bg-dark mt-3">
        {{--<p class="text-right float-right text-muted small">
            Copyright &copy; {{config('app.name') . ' ' . date('Y')}}
        </p>--}}
        <div class="text-center">
            <a class="text-muted small" href="/privacy-policy">Privacy Policy</a> |
            <a class="text-muted small" href="/terms-and-conditions">Terms and Conditions </a> |
            <a class="text-muted small" href="/faq">FAQs</a>
        </div>
    </div>
</footer>