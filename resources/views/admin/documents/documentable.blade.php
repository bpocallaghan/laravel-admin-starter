<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <span><i class="fa fa-image"></i></span>
                    <span>{!! $documentable->name !!} Documents</span>
                </h3>
            </div>

            <div class="box-body documents-container">
                <div class="row">
                    @forelse($documents as $document)
                        <div class="col-md-2">
                            <div class="well">
                                <a class="btn btn-info btn-xs" href="{{ $document->url }}" target="_blank" title="View Document" data-toggle="tooltip">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a id="image-row-clicker-{{ $document->id }}" class="dropzone-document-click" href="#" data-id="{{ $document->id }}" data-title="{{ $document->name }}">
                                    <span id="image-row-title-span-{{ $document->id }}" class="image-row-title-span">{{ $document->name }}</span>
                                </a>

                                <form id="form-delete-row{{ $document->id }}" method="POST" action="/admin/documents/{{ $document->id }}" class="dt-titan" style="display: inline-block;">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                    <input name="_id" type="hidden" value="{{ $document->id }}">

                                    <a data-form="form-delete-row{{ $document->id }}" class="btn btn-danger btn-xs btn-delete-row" data-toggle="tooltip" title="Delete document - {{ $document->name }}"
                                       style="padding: 0px 6px;">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <p class="text-muted">Please click on the panel below to upload
                                documents
                                to {!! $documentable->name !!}.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <span><i class="fa fa-cloud"></i></span>
                    <span>Upload a Document</span>
                </h3>
            </div>

            <div class="box-body">
                <div class="callout callout-info callout-help">
                    <h4 class="title">How it works?</h4>
                    <p>
                        Click on the button below to browse for documents<br/>
                        Refresh the page when upload is complete<br/>
                        Click on the document name to change it<br/>
                        Click on the radio button to set the cover document<br/>
                    </p>
                </div>

                <form id="formDocumentDropzone" class="dropzone" method="POST" action="/admin/documents/upload" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="documentable_id" value="{{ $documentable->id }}">
                    <input type="hidden" name="documentable_type" value="{{ get_class($documentable) }}">
                    <input type="hidden" name="documentable_type_name" value="{{ (new \ReflectionClass($documentable))->getShortName() }}">

                    <div class="dz-default dz-message">
                        <span>Click here to browse for documents.</span>
                    </div>
                </form>

                <div id="preview-template" style="display: none">
                    <div class="dz-preview dz-file-preview">
                        <a class="dropzone-document-click" href="#">
                            <div class="dz-image">
                                <img data-dz-thumbnail/>
                            </div>
                            <div class="dz-details">
                                <div class="dz-size"><span data-dz-size></span></div>
                                <!--<div class="dz-filename"><span data-dz-name></span></div>-->
                                <span class="image-row-title-span"></span>
                            </div>
                            <div class="dz-progress">
                                <span class="dz-upload" data-dz-uploadprogress></span></div>
                            <div class="dz-error-message"><span data-dz-errormessage></span>
                            </div>
                            <div class="dz-success-mark">
                                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                    <title>Check</title>
                                    <defs></defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="dz-error-mark">
                                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                    n <title>Error</title>n
                                    <defs></defs>
                                    n
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                        n
                                        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                                            n
                                            <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                @include('admin.partials.form_footer', ['submit' => false])
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-document" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header alert-success">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Update Document Name</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="modal-document-id"/>

                    <fieldset style="padding: 0">
                        <section class="form-group">
                            <label for="modal-document-name">Name of the Document</label>
                            <input type="text" class="form-control" id="modal-document-name" placeholder="Enter the name of the Document">
                        </section>
                    </fieldset>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                </button>
                <button id="btn-form-save-document" type="button" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent

    <script type="text/javascript" charset="utf-8">
        Dropzone.autoDiscover = false;
        $(function () {
            activateImageClick();
            initActionDeleteClick($('.documents-container'));

            // autodiscover was turned off - update the settings
            var documentDropzone = new Dropzone("#formDocumentDropzone");
            documentDropzone.options.maxFiles = "10";
            documentDropzone.options.maxFilesize = "5";
            documentDropzone.options.paramName = "file";
            documentDropzone.previewTemplate = $('#preview-template').html();
            documentDropzone.on("success", function (file, response) {
                if (response.data && response.success) {
                    var data = response.data;

                    file.hiddenInputs = Dropzone.createElement('<input class="image-row-title" type="hidden" value=""/>');
                    file.previewElement.appendChild(file.hiddenInputs);
                    file.hiddenInputs = Dropzone.createElement('<input class="image-row-id" type="hidden" id="image-row-' + data['id'] + '" value="' + data['id'] + '"/>');
                    file.previewElement.appendChild(file.hiddenInputs);

                    notify('Successfully', 'The document has been uploaded and saved in the database.', null, null, 5000);
                } else {
                    notifyError(response.error['title'], response.error['content']);
                    //notifyError('Oops!', 'Something went wrong (hover over image for more information', null, null, 5000);
                }
            });

            function activateImageClick()
            {
                $('.dropzone-document-click').off('click');
                $('.dropzone-document-click').on('click', function (e) {
                    e.preventDefault();

                    var id = $($(this).parent().find('.image-row-id')).val();
                    var title = $($(this).parent().find('.image-row-title')).val();

                    if ($(this).attr('data-id')) {
                        id = $(this).attr('data-id');
                        title = $(this).attr('data-title');
                    }

                    $('#modal-document-id').val(id);
                    $('#modal-document-name').val(title);
                    $('#modal-document').modal();

                    return false;
                });
            }

            $('#btn-form-save-document').click(function (e) {
                e.preventDefault();

                $('#modal-document').modal('hide');

                if ($('#modal-document-name').val().length < 3) {
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: "/admin/documents/" + $('#modal-document-id').val() + '/edit/name',
                    data: {
                        'name': $('#modal-document-name').val()
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.error) {
                            notifyError(data.error.title, data.error.content);
                        } else {
                            notify('Successfully', 'The document name was updated.', null, null, 5000);
                        }

                        // update the title tag's input
                        var id = $('#modal-document-id').val();
                        var title = $('#modal-document-name').val();
                        var idInput = $('#image-row-' + id);

                        idInput.parent().find('.image-row-title-span').html(title);
                        $('#image-row-title-span-' + id).html(title);
                        $('#image-row-clicker-' + id).attr('data-title', title);

                        // reset
                        $('#modal-document-name').val('');
                    }
                });
            })
        })
    </script>
@endsection