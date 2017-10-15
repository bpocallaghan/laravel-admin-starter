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
                            Create a Content Page Component<br/>
                            Enter the heading<br/>
                            Enter the content<br/>
                        </p>
                    </div>

                    <form method="POST" action="/admin/pages/{{ $page->id . '/sections/content' . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="page_id" type="hidden" value="{{ $page->id }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>
                            @include('admin.pages.components.form_heading')

                            @include('admin.pages.components.form_content')
                        </fieldset>

                        @include('admin.partials.form_footer')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

