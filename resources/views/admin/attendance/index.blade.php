@extends('layouts.master')

@section('title', __('Attendance'))

@section('content')
    @component('components.admin.page-title')
        @slot('li_1'){{ __('Settings') }}@endslot
        @slot('title'){{ __('Attendance List') }}@endslot
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
@endsection

@push('scripts')
    {!! $data_table->scripts() !!}

    <script type="text/javascript">
        $(document).on('click', '.export-block', function (e) {
            e.preventDefault();
            let parameters = {
                dashboard: 'ATTENDANCE_DASHBOARD',
                block: 'attendance_report',
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
