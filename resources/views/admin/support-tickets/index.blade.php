@extends('layouts.master')

@section('title', __('Support Tickets'))

@section('extra-buttons')
    <a type="button" href="{{ route('support-tickets.create') }}" class="btn btn-primary float-end">
        <i class="fa fa-plus"></i> | {{ __('Add Ticket') }}
    </a>
@endsection

@section('content')
    @component('components.admin.page-title')
        @slot('li_1'){{ __('Settings') }}@endslot
        @slot('title'){{ __('Support Tickets List') }}@endslot
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
