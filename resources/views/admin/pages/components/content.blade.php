@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->heading . ' entry': 'Create a new Page Content Section' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">
                    <div class="callout callout-info callout-help">
                        <h4 class="title">How it works?</h4>
                        <p>
                            Enter heading (optional)<br/>
                            Enter content (optional)<br/>
                            Browse for photo (optional)<br/>
                            Upload your documents (optional)<br/>
                            Upload your photos (optional)<br/>
                            Submit to save the page section
                        </p>
                    </div>

                    <form method="POST" action="/admin/pages/{{ $page->id . '/sections/content' . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="page_id" type="hidden" value="{{ $page->id }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>
                            @include('admin.pages.components.form_heading')

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group {{ form_error_class('media', $errors) }}">
                                        <label>Upload your Photo (optional) - Maximum 2MB</label>
                                        <div class="input-group input-group-sm">
                                            <input id="media-label" type="text" class="form-control" readonly placeholder="Browse for a photo">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default" onclick="document.getElementById('media').click();">Browse</button>
                                            </span>
                                            <input id="media" style="display: none" accept="{{ get_file_extensions('image') }}" type="file" name="media" onchange="document.getElementById('media-label').value = this.value">
                                        </div>
                                        {!! form_error_message('media', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ form_error_class('media_align', $errors) }}">
                                        <label for="media_align">Media Alignment</label>
                                        {!! form_select('media_align', \App\Models\PageContent::$alignments, ($errors && $errors->any()? old('media_align') : (isset($item)? $item->media_align : 'left')), ['class' => 'select2 form-control']) !!}
                                        {!! form_error_message('media_align', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ form_error_class('caption', $errors) }}">
                                        <label for="caption">Media Caption (optional)</label>
                                        <input type="text" class="form-control" id="caption" name="caption" placeholder="Please insert the Caption" value="{{ ($errors && $errors->any()? old('caption') : (isset($item)? $item->caption : '')) }}">
                                        {!! form_error_message('caption', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            @include('admin.pages.components.form_content')

                            @if(isset($item) && $item->media)
                                <div>
                                    <a target="_blank" href="{{ $item->imageUrl }}">
                                        <img src="{{ $item->thumb_url }}"/>
                                    </a>
                                </div>
                            @endif
                        </fieldset>

                        {{--@include('admin.partials.form_footer')--}}
                        <div class="form-footer">
                            @if(isset($submit) == false || $submit == true)
                                <button class="btn btn-labeled btn-primary btn-submit">
                                    <span class="btn-label"><i class="fa fa-fw fa-save"></i></span>Submit & Continue
                                </button>
                            @endif

                            <a href="/admin/pages/{{ $page->id }}/edit" class="btn btn-labeled btn-default">
                                <span class="btn-label"><i class="fa fa-fw fa-chevron-left"></i></span>Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(isset($item))
        @include('admin.photos.photoable', ['photoable' => $item, 'photos' => $item->photos])

        @include('admin.documents.documentable', ['documentable' => $item, 'documents' => $item->documents])
    @endif
@endsection
