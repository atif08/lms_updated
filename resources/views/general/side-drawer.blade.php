<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100 right-sidebar-container">
        <div class="rightbar-title d-flex align-items-center px-3 py-4">
            <h5 class="m-0 me-2">{{ __($title) }}</h5>

            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

        <div class="p-3">
            {!! form($form) !!}
        </div>
    </div> <!-- end slimscroll-menu-->
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '.btn-save', function (e) {
            e.preventDefault();
            let form = $(this).closest('form')[0];
            let formData = new FormData(form);
            $.ajax({
                url: form.action,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    success_alert(response.message);
                    $('body').toggleClass('right-bar-enabled');
                    redrawDataTable();
                },
                error: function (response) {
                    displayValidationErrors($('.right-sidebar-container form'), response);
                }
            });
        });
    </script>
@endpush
