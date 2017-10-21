<div class="row">
    <div class="col-md-12">
        <section class="form-group {{ form_error_class('content', $errors) }}">
            <label for="content-content">Content</label>
            <textarea class="form-control summernote" id="content-content" name="content" rows="30" placeholder="Please insert the Content">{{ ($errors && $errors->any()? old('content') : (isset($item)? $item->content : '')) }}</textarea>
            {!! form_error_message('content', $errors) !!}
        </section>
    </div>
</div>

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function () {
            pageSummerNote('.summernote', {{ $height or '300' }});

            function pageSummerNote(selector, height)
            {
                $(selector).summernote({
                    height: height ? height : 120,
                    focus: false,
                    tabsize: 2,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                        ['color', ['color']],
                        ['layout', ['ul', 'ol', 'paragraph']],
                        ['insert', ['table', /*'link', 'picture', 'video',*/ 'hr']],
                        ['misc', ['fullscreen', 'codeview', 'undo']]
                    ]
                });
            }
        })
    </script>
@endsection