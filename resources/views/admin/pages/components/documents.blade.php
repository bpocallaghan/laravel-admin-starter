@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->heading . ' entry': 'Create a new Page Documents Section' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">
                    <div class="callout callout-info callout-help">
                        <h4 class="title">How it works?</h4>
                        <p>
                            Create a Documents Page Component<br/>
                            Enter the heading<br/>
                            Upload your documents<br/>
                            Click on 'submit' to save the page documents<br/>
                        </p>
                    </div>

                    <form method="POST" action="/admin/pages/{{ $page->id . '/sections/document' . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="page_id" type="hidden" value="{{ $page->id }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>
                            @include('admin.pages.components.form_heading')

                            @include('admin.pages.components.form_content', ['height' => 120])
                        </fieldset>

                        @include('admin.partials.form_footer')
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.documents.documentable', ['documentable' => $item, 'documents' => $item->documents])
@endsection

