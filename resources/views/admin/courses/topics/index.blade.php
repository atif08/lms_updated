@extends('layouts.master')

@section('title', __('Topics'))

@section('content')
    @component('components.admin.page-title')
        @slot('li_1')
            {{ __('Settings') }}
        @endslot
        @slot('title')
            {{ __('Topics List') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-4">
                        <div class="input-group form-group">
                            <input type="text" name="query" class="form-control dt-search"
                                   placeholder="Search">
                        </div>
                    </div>
                    <div class="table-responsive mt-2">
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
