<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <span><i class="fa fa-image"></i></span>
                    <span>{!! $photoable->name !!} Photos</span>
                </h3>
            </div>

            <div class="box-body superbox">
                @forelse($photos as $photo)
                    <div class="superbox-list">
                        <table class="dt-table">
                            <tbody>
                            <tr>
                                <td>
                                    <label class="radio" style="margin-top: -10px;;">
                                        <input class="photo-cover-radio" data-id="{{ $photo->id }}" type="radio" name="is_cover" {!! $photo->is_cover == 1? 'checked' : '' !!}>
                                        <i></i>
                                    </label>
                                </td>
                                <td style="width: 100%; text-align: center">
                                    <a id="image-row-clicker-{{ $photo->id }}" class="dropzone-image-click" href="#" data-id="{{ $photo->id }}" data-title="{{ $photo->name }}">
                                        <span id="image-row-title-span-{{ $photo->id }}" class="image-row-title-span">{{ $photo->name }}</span>
                                    </a>
                                </td>
                                <td style="min-width: 55px;">
                                    <form id="form-delete-row{{ $photo->id }}" method="POST" action="/admin/photos/{{ $photo->id }}" class="dt-titan">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                        <input name="_id" type="hidden" value="{{ $photo->id }}">

                                        <a data-form="form-delete-row{{ $photo->id }}" class="btn btn-danger btn-xs btn-delete-row" data-toggle="tooltip" title="Delete photo - {{ $photo->name }}"
                                           style="float:right; padding: 0px 6px;">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </form>
                                    <a href="{{ request()->url() }}/crop/{{ $photo->id }}" class="btn btn-info btn-xs" data-toggle="tooltip" title="Crop {{ $photo->name }}"
                                       style="float:right; padding: 0px 6px; margin-right: 3px;">
                                        <i class="fa fa-crop"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <a href="{{ $photo->url }}" data-lightbox="images" data-title="{{ $photo->name }}">
                            <img src="{{ $photo->thumb_url }}" title="{{ $photo->name }}" class="superbox-img">
                        </a>
                    </div>
                @empty
                    <p class="text-muted">Please click on the panel below to upload photos
                        to {!! $photoable->name !!}.
                    </p>
                @endforelse
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
                    <span>Upload a Photo</span>
                </h3>
            </div>

            <div class="box-body">

                <div class="callout callout-info callout-help">
                    <h4 class="title">How it works?</h4>
                    <p>
                        Click on the button below to browse for photos<br/>
                        Refresh the page when upload is complete<br/>
                        Click on the photo name to change it<br/>
                        Click on the radio button to set the cover photo<br/>
                    </p>
                </div>

                <form id="formPhotoDropzone" class="dropzone" method="POST" action="/admin/photos/upload" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="photoable_id" value="{{ $photoable->id }}">
                    <input type="hidden" name="photoable_type" value="{{ get_class($photoable) }}">
                    <input type="hidden" name="photoable_type_name" value="{{ (new \ReflectionClass($photoable))->getShortName() }}">

                    <div class="dz-default dz-message">
                        <span>Click here to browse for photos.</span>
                    </div>
                </form>

                <div id="preview-template" style="display: none">
                    <div class="dz-preview dz-file-preview">
                        <a class="dropzone-image-click" href="#">
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

<div class="modal fade" id="modal-photo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header alert-success">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Update Photo Name</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="modal-photo-id"/>

                    <fieldset style="padding: 0">
                        <section class="form-group">
                            <label for="modal-photo-name">Name of the Photo</label>
                            <input type="text" class="form-control" id="modal-photo-name" placeholder="Enter the name of the Photo">
                        </section>
                    </fieldset>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                </button>
                <button id="btn-form-save" type="button" class="btn btn-primary">
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
            initActionDeleteClick();

            lightbox.option({
                'wrapAround': true,
                'resizeDuration': 200,
            })

            // autodiscover was turned off - update the settings
            var photoDropzone = new Dropzone("#formPhotoDropzone");
            photoDropzone.options.maxFiles = "10";
            photoDropzone.options.maxFilesize = "5";
            photoDropzone.options.paramName = "file";
            photoDropzone.previewTemplate = $('#preview-template').html();
            photoDropzone.on("success", function (file, response) {
                if (response.data && response.success) {
                    var data = response.data;

                    file.hiddenInputs = Dropzone.createElement('<input class="image-row-title" type="hidden" value=""/>');
                    file.previewElement.appendChild(file.hiddenInputs);
                    file.hiddenInputs = Dropzone.createElement('<input class="image-row-id" type="hidden" id="image-row-' + data['id'] + '" value="' + data['id'] + '"/>');
                    file.previewElement.appendChild(file.hiddenInputs);

                    notify('Successfully', 'The photo has been uploaded and saved in the database.', null, null, 5000);
                } else {
                    notifyError(response.error['title'], response.error['content']);
                    //notifyError('Oops!', 'Something went wrong (hover over image for more information', null, null, 5000);
                }
            });

            // when the radio button change for the photo cover
            $('.photo-cover-radio').change(function () {
                var id = $(this).attr('data-id');

                $.ajax({
                    type: 'POST',
                    url: "/admin/photos/" + id + '/cover',
                    data: {
                        photoable_id: "{{ $photoable->id }}",
                        photoable_type: "{{ str_replace('\\','\\\\',get_class($photoable)) }}",
                        photoable_type_name: "{{ (new \ReflectionClass($photoable))->getShortName() }}",
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.error) {
                            notifyError(data.error.title, data.error.content);
                        } else {
                            notify('Successfully', 'The cover photo was updated.', null, null, 5000);
                        }
                    }
                });
            })

            function activateImageClick()
            {
                $('.dropzone-image-click').off('click');
                $('.dropzone-image-click').on('click', function (e) {
                    e.preventDefault();

                    var id = $($(this).parent().find('.image-row-id')).val();
                    var title = $($(this).parent().find('.image-row-title')).val();

                    if ($(this).attr('data-id')) {
                        id = $(this).attr('data-id');
                        title = $(this).attr('data-title');
                    }

                    $('#modal-photo-id').val(id);
                    $('#modal-photo-name').val(title);
                    $('#modal-photo').modal();

                    return false;
                });
            }

            $('#btn-form-save').click(function (e) {
                e.preventDefault();

                $('#modal-photo').modal('hide');

                if ($('#modal-photo-name').val().length < 3) {
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: "/admin/photos/" + $('#modal-photo-id').val() + '/edit/name',
                    data: {
                        'name': $('#modal-photo-name').val()
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.error) {
                            notifyError(data.error.title, data.error.content);
                        } else {
                            notify('Successfully', 'The photo name was updated.', null, null, 5000);
                        }

                        // update the title tag's input
                        var id = $('#modal-photo-id').val();
                        var title = $('#modal-photo-name').val();
                        var idInput = $('#image-row-' + id);

                        idInput.parent().find('.image-row-title-span').html(title);
                        $('#image-row-title-span-' + id).html(title);
                        $('#image-row-clicker-' + id).attr('data-title', title);

                        // reset
                        $('#modal-photo-name').val('');
                    }
                });
            })
        })
    </script>
@endsection