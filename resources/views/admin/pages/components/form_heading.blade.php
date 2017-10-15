<div class="row">
    <div class="col-md-8">
        <div class="form-group {{ form_error_class('heading', $errors) }}">
            <label for="heading">Heading</label>
            <input type="text" class="form-control" id="heading" name="heading" placeholder="Please insert the Heading" value="{{ ($errors && $errors->any()? old('heading') : (isset($item)? $item->heading : '')) }}">
            {!! form_error_message('heading', $errors) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ form_error_class('heading_element', $errors) }}">
            <label for="heading_element">Heading Element</label>
            {!! form_select('heading_element', (['h1' => 'Heading 1', 'h2' => 'Heading 2', 'h3' => 'Heading 3', 'h4' => 'Heading 4']), ($errors && $errors->any()? old('heading_element') : (isset($item)? $item->heading_element : 'h2')), ['class' => 'select2 form-control']) !!}
            {!! form_error_message('heading_element', $errors) !!}
        </div>
    </div>
</div>