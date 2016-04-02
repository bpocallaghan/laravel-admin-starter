<div class="form-footer">
    @if(isset($submit) == false || $submit == true)
        <button class="btn btn-labeled btn-primary btn-submit">
            <span class="btn-label"><i class="fa fa-fw fa-save"></i></span>Submit
        </button>
    @endif

    <a href="javascript:window.history.back();" class="btn btn-labeled btn-default">
        <span class="btn-label"><i class="fa fa-fw fa-chevron-left"></i></span>Back
    </a>
</div>