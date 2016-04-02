@if(isset($popup) && $popup)
    <div id="modal-popup" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">
                        <i class="{{ $popup->icon_class }}"></i> {{ $popup->title }}</h4>
                </div>
                <div class="modal-body">
                    {{ $popup->summary }}
                    <img style="width: 100%; padding: 10px 0px 15px;" src="{{ uploaded_images_url($popup->image_thumb) }}" alt="{{ $popup->title }}">
                    <a class="btn_1" href="{{ $popup->url }}">View {{ $popup->type }}</a>
                </div>
                <div class="modal-footer">
                    <small>Autoclose delay in 10 seconds.</small>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        @parent
        <script type="text/javascript" charset="utf-8">
            $(function ()
            {
                var prevId = Cookies.get('popup-entry');
                var id = "{{$popup->id . '|' . $popup->type}}";

                // if popup entry is new or first time ever loading page
                // create a cookie that will expire in 14 days
                if (prevId != id) {
                    Cookies.remove('popup-entry');
                    Cookies.set('popup-entry', id, {expires: 14});

                    // open model with a slight delay
                    setTimeout(function ()
                    {
                        $('#modal-popup').modal('show');

                        // close in 10 sec
                        setTimeout(function ()
                        {
                            $('#modal-popup').modal('hide');
                        }, 10000);
                    }, 3000);
                }
            })
        </script>
    @endsection
@endif
