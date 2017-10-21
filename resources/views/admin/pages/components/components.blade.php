@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>{!! $page->name !!}</span>
                    </h3>
                </div>

                <div class="box-body">

                    <div class="alert alert-info">
                        <h4 class="title">How to create Page Sections</h4>
                        <ul>
                            <li>Update the list order by dragging the headings up or down.</li>
                            <li>Content Component</li>
                            <li>Media Component</li>
                            <li>Gallery Component</li>
                        </ul>
                    </div>

                    <div class="well well-sm well-toolbar" id="nestable-menu">
                        <a href="/admin/pages" class="btn btn-labeled btn-default">
                            <span class="btn-label"><i class="fa fa-fw fa-chevron-left"></i></span>Back
                        </a>

                        <a class="btn btn-labeled btn-info" href="{{ $page->url }}" target="_blank">
                            <span class="btn-label"><i class="fa fa-fw fa-eye"></i></span>
                            View Page
                        </a>

                        <a class="btn btn-labeled btn-primary" href="{{ Request::url().'/content/create' }}">
                            <span class="btn-label"><i class="fa fa-fw fa-align-justify"></i></span>
                            Create Content
                        </a>

                        <a class="btn btn-labeled btn-primary" href="{{ Request::url().'/media/create' }}">
                            <span class="btn-label"><i class="fa fa-fw fa-id-card-o"></i></span>
                            Create Media Component
                        </a>

                        <a class="btn btn-labeled btn-primary" href="{{ Request::url().'/gallery/create' }}">
                            <span class="btn-label"><i class="fa fa-fw fa-image"></i></span>
                            Create Gallery Component
                        </a>

                        <a class="btn btn-labeled btn-primary" href="{{ Request::url().'/document/create' }}">
                            <span class="btn-label"><i class="fa fa-fw fa-files-o"></i></span>
                            Create Documents Component
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="dd" id="dd-navigation" style="max-width: 100%">
                                <ol class="dd-list">
                                    @foreach($page->sections as $item)
                                        <li class="dd-item" data-id="{{ $item->id }}">
                                            <div class="btn-toolbar dt-table" data-server="true" style="float: right; margin-top: 5px; margin-right: 5px;">
                                                <div class="btn-group">
                                                    <a href="{{ "/admin/pages/{$page->id}/sections/{$item->type}/{$item->component->id}/edit" }}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Edit {{ $item->component->heading }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </div>

                                                <div class="btn-group">
                                                    <form id="form-delete-row{{ $item->id }}" method="POST" action="{{ "/admin/pages/{$page->id}/sections/{$item->id}" }}">
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <input name="_id" type="hidden" value="{{ $item->id }}">
                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                                        <a data-form="form-delete-row{{ $item->id }}" class="btn btn-danger btn-xs btn-delete-row" data-toggle="tooltip" title="Delete {{ $item->component->heading }}">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="dd-handle">
                                                <div>
                                                    <span class="text-bold" style="font-size: larger;">
                                                        {{ $item->component->heading }}
                                                        <span class="text-muted">
                                                            ({{ $item->component->heading_element }}
                                                            )
                                                            <em><small>{{ $item->type }}</small></em>
                                                        </span>
                                                    </span>
                                                </div>
                                                <div>
                                                    @if($item->type == 'content')
                                                        {!! $item->component->summary !!}
                                                    @elseif($item->type == 'media')
                                                        <div class="media">
                                                            <div class="media-left">
                                                                <a href="#">
                                                                    <img class="media-object" src="{{ $item->component->thumbUrl }}" style="height: 30px;">
                                                                </a>
                                                            </div>
                                                            <div class="media-body">
                                                                {!! $item->component->summary !!}
                                                            </div>
                                                        </div>
                                                    @elseif($item->type == 'gallery')
                                                        @foreach($item->component->photos as $photo)
                                                            <img class=img-responsive" src="{{ $photo->thumb_url }}" style="height: 30px;">
                                                        @endforeach
                                                    @elseif($item->type == 'document')
                                                        @foreach($item->component->documents as $document)
                                                            <a href="{{ $document->url }}">{{ $document->name }}</a>{{ $loop->last?'':' | ' }}
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    @include('admin.partials.nestable')
    <script type="text/javascript" charset="utf-8">
        $(function () {
            initNestableMenu(1, "{{ Request::url() }}/order");
        })
    </script>
@endsection