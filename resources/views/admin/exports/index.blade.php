@extends('layouts.master')

@section('title') {{ __('Export Request') }} @endsection

@section('content')
    @component('components.admin.page-title')
        @slot('li_1') {{ __('Reports') }} @endslot
        @slot('title') {{ __('Export Requests') }} @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1 font-size-16">{{ __('Export Requests') }}</h4>
                </div>

                <div class="card-body">
                    <div class="filter-container"></div>

                    <div class="row">
                        <div class="table-responsive">
                            {!! $data_table->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $data_table->scripts() !!}
    <script type="text/javascript">
        $(document).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            let url = $(this).data('url');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: !0,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-success mt-2',
                cancelButtonClass: 'btn btn-danger ms-2 mt-2',
                buttonsStyling: !1
            }).then(function (input) {
                if (input.isConfirmed) {
                    $.post(url, {}, function (response) {
                        success_alert("{{ __('Deleted.') }}");
                        redrawDataTable();
                    });
                }
            });
        });
    </script>
@endpush
