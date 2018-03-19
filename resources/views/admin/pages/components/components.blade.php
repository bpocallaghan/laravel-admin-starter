<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <span><i class="fa fa-table"></i></span>
                    <span>{!! $page->name !!}</span>
                </h3>
                <div class="pull-right">
                    <a target="_blank" href="{!! $page->url !!}">
                        <i class="fa fa-eye"></i>
                        View Page
                    </a>
                </div>
            </div>

            <div class="box-body">
                @if(($page->sections->count() <= 1))
                    <div class="alert alert-info">
                        <h4 class="title">How to create Page Sections</h4>
                        <ul>request()->url()
                            <li>Update the list order by dragging the headings up or down.</li>
                            <li>Create a new Component</li>
                        </ul>
                    </div>
                @endif

                <div class="well well-sm well-toolbar" id="nestable-menu">
                    <a href="/admin/pages" class="btn btn-labeled btn-default">
                        <span class="btn-label"><i class="fa fa-fw fa-chevron-left"></i></span>Back
                    </a>

                    <a class="btn btn-labeled btn-primary" href="{{ (isset($url)? $url : request()->url()).'/content/create' }}">
                        <span class="btn-label"><i class="fa fa-fw fa-align-justify"></i></span>
                        Create Content
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
                                                <a href="{{ "/admin/pages/{$page->id}/sections/content/{$item->id}/edit" }}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Edit {{ $item->heading }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </div>

                                            <div class="btn-group">
                                                <form id="form-delete-row{{ $item->id }}" method="POST" action="{{ "/admin/pages/{$page->id}/sections/{$item->id}" }}">
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <input name="_id" type="hidden" value="{{ $item->id }}">
                                                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                                    <a data-form="form-delete-row{{ $item->id }}" class="btn btn-danger btn-xs btn-delete-row" data-toggle="tooltip" title="Delete {{ $item->heading }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="dd-handle">
                                            <div>
                                                    <span class="text-bold" style="font-size: larger;">
                                                        {{ $item->heading }}
                                                        <span class="text-muted">
                                                            ({{ $item->heading_element }}
                                                            )
                                                            {{--<em><small>{{ $item->type }}</small></em>--}}
                                                        </span>
                                                    </span>
                                            </div>
                                            <div>
                                                <div class="media">
                                                    @if($item->media)
                                                        <div class="media-left">
                                                            <a href="#">
                                                                <img class="media-object" src="{{ $item->thumbUrl }}" style="height: 30px;">
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <div class="media-body">
                                                        {!! $item->summary !!}
                                                    </div>
                                                </div>

                                                @foreach($item->documents as $document)
                                                    <a href="{{ $document->url }}">{{ $document->name }}</a>{{ $loop->last?'':' | ' }}
                                                @endforeach

                                                @foreach($item->photos as $photo)
                                                    <img class=img-responsive" src="{{ $photo->thumb_url }}" style="height: 30px;">
                                                @endforeach
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

@section('scripts')
    @parent
    @include('admin.partials.nestable')
    <script type="text/javascript" charset="utf-8">
        $(function () {
            initNestableMenu(1, "{{ (isset($url)? $url : request()->url()) }}/order");
        })
    </script>
@endsection