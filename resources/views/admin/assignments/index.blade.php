@extends('layouts.master')

@section('title', __('Assignments'))

@section('content')
    @component('components.admin.page-title')
        @slot('li_1'){{ __('Settings') }}@endslot
        @slot('title'){{ __('Assignments List') }}@endslot
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
@endpush
