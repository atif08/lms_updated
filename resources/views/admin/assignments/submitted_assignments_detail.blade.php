@extends('layouts.master')

@section('title', __('Assignments'))

@section('content')
    @component('components.admin.page-title')
        @slot('li_1')
            {{ __('Settings') }}
        @endslot
        @slot('title')
            {{ __('Assignments List') }}
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <button class="btn btn-primary export-block"><span class="fas fa-download "></span> {{ __('Export') }}</button>
                        </div>
                    </div>
                    <div class="table-responsive mt-2">
                        {!! $data_table->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="editAssignmentModal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="editAssignmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="editAssignmentModalLabel">{{__('Add Comments')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body edit-assignment-body">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection

@push('scripts')
    {!! $data_table->scripts() !!}

    <script type="text/javascript">
        /// Add new lesson form
        $(document).on('click', '.edit-assignment-btn', function (e) {
            const url = $(this).attr('data-url');
            e.preventDefault();
            makeGetCall(url, {}, function (response) {
                $('#editAssignmentModal .edit-assignment-body').html(response);
            })
        });
        $(document).on('click', '.create-assignment', function (e) {
            e.preventDefault();
            makeGetCall('{{route('assignments.create')}}', {}, function (response) {
                $('#editAssignmentModal .edit-assignment-body').html(response);
            })
        });
        $(document).on('click', '.export-block', function (e) {
            e.preventDefault();
            let parameters = {
                dashboard:'ASSIGNMENT_REPORT',
                block: 'assignment_report',
                ...window['dashboardFilters'],
                custom_filters:window.dtFilters
            }
            let parser = document.createElement('a');
            let url = '{{ route('exports.get.export-request') }}' + (parser.search ? parser.search + "&" : "?") + $.param(parameters);
            makeGetCall(url, {}, function (response) {
                if (response) {
                    success_alert("{{ __('Export Request Submitted Successfully !!') }}<br/><a href='{{ url('admin/exports') }}'><i>download</i></a>")
                }
            })
        });

    </script>
@endpush
