<script async src="https://www.googletagmanager.com/gtag/js?id={{ config('app.google_analytics') }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '{{ config('app.google_analytics') }}');
</script>