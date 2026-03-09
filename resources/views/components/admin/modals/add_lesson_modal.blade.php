<div id="addLessonModal" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="addLessonModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="addLessonModalLabel">{{__('Create New Lesson')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>
            <div class="modal-body add-lesson">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            showContent('MEDIA');
            $(document).on('change', '#type', function (e) {
                $('#external_link').val('');
                $('#iframe').val('');
                $('#mediaId').val('');
                var selectedType = $(this).val();
                showContent(selectedType);

            });
            function showContent(selectedType){
                if (selectedType == 'EXTERNAL_LINK') {
                    $('.iframe').hide();
                    $('#mediaId').hide()
                    $('.quiz_link').hide()
                    $('.external_link').show();
                } else if (selectedType == 'IFRAME') {
                    $('.external_link').hide();
                    $('.quiz_link').hide()
                    $('#mediaId').hide()
                    $('.iframe').show();
                } else if (selectedType == 'MEDIA') {
                    $('.iframe').hide();
                    $('.quiz_link').hide()
                    $('.external_link').hide();
                    $('#mediaId').show();
                }
            }
        });
    </script>
@endpush
