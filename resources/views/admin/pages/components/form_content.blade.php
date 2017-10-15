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
            initSummerNote('.summernote', {{ $height or '250' }});
        })
    </script>
@endsection