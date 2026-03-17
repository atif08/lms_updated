@extends('layouts.master')

@section('title', __('Referral Enrollments'))

@section('content')
    @component('components.admin.page-title')
        @slot('li_1'){{ __('Settings') }}@endslot
        @slot('title'){{ __('Referral Report') }}@endslot
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
        $(document).on('change', '#referral-course-filter', function () {
            if (!window.dtFilters) { window.dtFilters = {}; }
            window.dtFilters['course_name'] = { value: $(this).val() };
            redrawDataTable();
        });
    </script>
@endpush
