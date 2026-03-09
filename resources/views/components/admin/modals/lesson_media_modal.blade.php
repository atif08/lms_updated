<!-- Your Modal Code -->
<div class="modal fade bs-example-modal-xl" id="mediaModal" tabindex="-1" role="dialog"
     aria-labelledby="mediaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modalDialogCentered" role="document">
        <div class="modal-content modalContent" style="border: 1px solid black;">
            <div class="modal-header">
                <h5 class="modal-title" id="mediaModalLabel">Select Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab"
                                aria-controls="tab1" aria-selected="true">Media</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab"
                                aria-controls="tab2" aria-selected="false">Add Media</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                        <div class="form-group mt-2" id="mediaTableMain">
                            <!-- Your content for Tab 1 -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                        <p>Content for Tab 2</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('keyup', '#mediaSearchInput', function (e) {
                var value = $(this).val().toLowerCase();
                $('#mediaTable tbody tr').filter(function () {
                    $(this).toggle($(this).find('.media-name').text().toLowerCase().indexOf(value) > -1);
                });
            });

            $(document).on('click', '.select-media', function (e) {
                var mediaId = $(this).data('media-id');
                var mediaThumbnailUrl = $(this).data('media-thumbnail-url');
                $('#mediaId').val(mediaId);
                $('#mediaThumbnail').attr('src', mediaThumbnailUrl).show();
                $('#selectedMedia').show();
                $('#mediaModal').modal('hide');
            });

            $(document).on('click', '#removeMedia', function (e) {
                $('#mediaId').val('');
                $('#selectedMedia').hide();
                $('#mediaModal').modal('show');
            });
        })
    </script>
@endpush
