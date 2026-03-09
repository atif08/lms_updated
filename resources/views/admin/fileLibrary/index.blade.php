@extends('layouts.master')

@section('title', __('File Libraries'))

@section('extra-buttons')
    <a type="button" href="{{ route('file-libraries.create') }}" class="btn btn-primary float-end">
        <i class="fa fa-plus"></i> | {{ __('Upload New File') }}
    </a>
@endsection

@section('content')
    @component('components.admin.page-title')
        @slot('li_1'){{ __('Settings') }}@endslot
        @slot('title'){{ __('Libraries List') }}@endslot
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
            @include('components.admin.modals.file_library_filter_modal', $data_table->getFilterData())
        </div>
    </div>
@endsection

@push('scripts')
    {!! $data_table->scripts() !!}

    <script type="text/javascript">
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
    </script>
@endpush
