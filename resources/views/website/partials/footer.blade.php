<footer class="bg-gray-light">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 text-left">
                <small>Copyright &copy; {{config('app.name') . ' ' . date('Y')}}</small>
            </div>
            <div class="col-sm-4 text-center">
                <span><a href="/privacy-policy">Privacy Policy</a> | <a href="/terms-and-conditions">Terms and Conditions </a> | <a href="/faq">FAQs</a></span>
            </div>
            <div class="col-sm-4 text-right">
                <small>
                    Website by <a href="https://github.com/bpocallaghan" target="_blank">{!! env('APP_AUTHOR') !!}</a>
                </small>
            </div>
        </div>
    </div>
</footer>