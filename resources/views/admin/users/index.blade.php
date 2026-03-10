@extends('layouts.master')

@section('title', __('Users'))

@section('extra-buttons')

@endsection

@section('content')
    @component('components.admin.page-title')
        @slot('li_1'){{ __('Settings') }}@endslot
        @slot('title'){{ __('Users List') }}@endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {!! $data_table->filters() !!}
                    <div class="table-responsive">
                        {!! $data_table->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Profile Modal -->
    <div class="modal fade" id="userProfileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="extend-request-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">User Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="user-profile-content"></div>
                </div>
            </form>
        </div>
    </div>

    <!-- Extend Assignment Due Date Modal -->
    <div class="modal fade" id="extendApproveModal" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" role="dialog" aria-labelledby="extendApproveLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px;">
            <div class="modal-content">
                <form action="{{ route('assignments.approve-extend-request') }}" id="extendRequestForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="extendApproveLabel">Request Assignment Extension</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="request_id" id="modal_request_id">
                        <input type="hidden" name="assignment_id" id="modal_assignment_id">
                        <input type="hidden" name="user_id" id="modal_user_id">
                        <div class="mb-3">
                            <label for="requested_due_date" class="form-label">New Extended Due Date</label>
                            <input type="date" class="form-control" id="requested_due_date" name="extended_due_date" required>
                            <span class="text-danger" id="extend-error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Extend Due Date</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Comments Modal -->
    <div id="editAssignmentModal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="editAssignmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="editAssignmentModalLabel">{{ __('Add Comments') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body edit-assignment-body"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $data_table->scripts() !!}

    <script type="text/javascript">
        $(document).on('submit', '#update-submitted-assignment', function (e) {
            e.preventDefault();
            const $form = $(this);
            makePostCall($form.attr('action'), new FormData(this), function (r) {
                $('.btn-close').click();
                alertify.success('Grades update successfully.');
            }, function (r) {
                alertify.error('Something went wrong');
            }, true);
        });

        $(document).on('click', '.edit-assignment-btn', function (e) {
            const url = $(this).attr('data-url');
            e.preventDefault();
            makeGetCall(url, {}, function (response) {
                $('#editAssignmentModal .edit-assignment-body').html(response);
            });
        });

        $(document).on('click', '.get-user-profile', function (e) {
            const url = $(this).attr('data-url');
            e.preventDefault();
            makeGetCall(url, {}, function (response) {
                $('#user-profile-content').html(response);
            });
        });

        $(document).on('click', '.btn-success[data-bs-target="#extendApproveModal"]', function () {
            const $btn = $(this);
            $('#modal_request_id').val($btn.data('request-id'));
            $('#modal_assignment_id').val($btn.data('assignmnet-id'));
            $('#modal_user_id').val($btn.data('user-id'));
        });

        $(document).on('submit', '#extendApproveModal form', function (e) {
            e.preventDefault();
            const $form = $(this);
            $('#extend-error').text('');
            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (response) {
                    let modal = bootstrap.Modal.getInstance(document.getElementById('extendApproveModal'));
                    if (modal) { modal.hide(); }
                    alert(response.message || 'Extension request approved successfully!');
                    location.reload();
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        if (errors.extended_due_date) {
                            $('#extend-error').text(errors.extended_due_date[0]);
                        }
                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                }
            });
        });

        $(document).on('change', '.btn-status', function () {
            let toggleButton = $(this);
            let checked = this.checked;
            $.post($(this).data('url'), {}, function (r) {
                success_alert(r.message);
            }).fail(function (r) {
                error_alert(r.message);
                toggleButton.prop('checked', !checked);
            });
        });

        $(document).on('click', '.export-block', function (e) {
            e.preventDefault();
            let parameters = {
                dashboard: 'USER_DASHBOARD',
                block: 'user_report',
                ...window['dashboardFilters'],
                custom_filters: window.dtFilters
            };
            let parser = document.createElement('a');
            let url = '{{ route('exports.get.export-request') }}' + (parser.search ? parser.search + '&' : '?') + $.param(parameters);
            makeGetCall(url, {}, function (response) {
                if (response) {
                    success_alert("{{ __('Export Request Submitted Successfully !!') }}<br/><a href='{{ url('admin/exports') }}'><i>download</i></a>");
                }
            });
        });

        $(document).on('show.bs.modal', '.modal', function () {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'), 0);
        });

        $(document).on('hidden.bs.modal', '.modal', function () {
            if ($('.modal:visible').length > 0) {
                $('body').addClass('modal-open');
            }
        });
    </script>
@endpush
