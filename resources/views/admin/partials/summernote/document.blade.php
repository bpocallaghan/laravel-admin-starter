@section('styles')
    @parent
    <style>
        #form-modal-documents .select2.select2-container {
            display: block;
            width: 100% !important;
        }
    </style>
@endsection

@section('content')
    @parent
    <div class="modal fade" id="modal-documents" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header alert-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Insert Document Link</h4>
                </div>
                <div class="modal-body">
                    <form id="form-modal-documents">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Text to display" value="">
                        </div>
                        <div class="form-group">
                            <label for="document">Document</label>
                            {!! form_select('document_id', ([0 => 'Please select a Document'] + $documents), null, ['class' => 'select2 form-control']) !!}
                        </div>
                        <div class="checkbox">
                            <label>
                                <input value="1" type="checkbox" name="open_in_new_window" checked="checked">
                                <i></i> Open in new Window
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                    </button>
                    <button id="modal-documents-submit" type="button" class="btn btn-primary" data-dismiss="modal">
                        Insert Document
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        var DocumentButton = function (context) {
            var ui = $.summernote.ui;
            var button = ui.button({
                contents: '<i class="fa fa-files-o"/>',
                tooltip: 'Insert link to a document',
                click: function () {
                    // open modal
                    $('#modal-documents').modal();
                }
            });

            return button.render();
        }

        $(function () {
            // on insert link
            $('#modal-documents-submit').on('click', function () {
                var name = $('#form-modal-documents input[name=name]');
                var url = $('#form-modal-documents select[name=document_id]').find(":selected").val();
                var isNewWindow = $('#form-modal-documents input[name=open_in_new_window]').is(':checked');

                // basic validation
                if (name.val().length >= 2 && url.length > 2) {
                    addLinkToSummernote("{{ $summernote or '.summernote' }}", name.val(), url, isNewWindow);
                }

                // reset
                name.val('');
            })
        })
    </script>
@endsection
