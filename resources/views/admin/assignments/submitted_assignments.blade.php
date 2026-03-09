@extends('layouts.master')

@section('title', __('Submitted Assignments'))

@section('content')
    @component('components.admin.page-title')
        @slot('li_1'){{ __('Settings') }}@endslot
        @slot('title'){{ __('Submitted Assignments List') }}@endslot
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
        $(document).on('click', '.edit-assignment-btn', function (e) {
            const url = $(this).attr('data-url');
            e.preventDefault();
            makeGetCall(url, {}, function (response) {
                $('#editAssignmentModal .edit-assignment-body').html(response);
            });
        });

        $(document).on('click', '.export-block', function (e) {
            e.preventDefault();
            let parameters = {
                dashboard: 'ASSIGNMENT_REPORT',
                block: 'assignment_report',
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
    </script>
@endpush
