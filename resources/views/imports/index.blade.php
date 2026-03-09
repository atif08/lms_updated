@extends('layouts.master')

@section('li_1', __('Menu'))
@section('title', __('Imports List'))

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- DATATABLE / PAGE FILTERS -->
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
