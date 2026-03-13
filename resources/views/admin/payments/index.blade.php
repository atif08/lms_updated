@extends('layouts.master')

@section('title', __('Payments'))

@section('content')
    @component('components.admin.page-title')
        @slot('li_1')
            {{ __('Management') }}
        @endslot
        @slot('title')
            {{ __('Payments List') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="input-group form-group">
                                <input type="text" name="query" class="form-control dt-search"
                                       placeholder="Search Student or Course">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            @include('components.admin.date-range',['filter_column'=>'p.created_at'])
                        </div>
                        <div class="col-lg-5 text-end">
                            <a href="{{ route('payments.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i> {{ __('Record Offline Payment') }}
                            </a>
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
@endpush
