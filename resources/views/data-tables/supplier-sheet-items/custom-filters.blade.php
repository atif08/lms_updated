@extends('data-tables.custom-filters')

@section('extra-filters')
    <div class="row">
        <div class="col-lg-5">
            <div class="form-group m-2">
{{--                <label  class="control-label">{{ __('Connected POs') }}</label>--}}
                <div class="input-group">
                    <select class="form-select w-75" name="connected_pos">
                        <option value="">{{ __('Attach PO') }}</option>
                        @foreach($purchase_orders as $purchase_order)
                            <option value="{{ $purchase_order->id }}">{{ $purchase_order->name }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-outline-secondary w-25"
                            data-bs-toggle="modal" data-bs-target="#linkPoModal">
                        <i class="fas fa-link"></i></button>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="d-flex h-100">
                <div class="form-group mb-2 mt-auto">
                    <button type="button" class="btn btn-outline-secondary waves-effect waves-light fw-bolder"
                            data-bs-toggle="modal" data-bs-target="#advanceFiltersModal">
                        <i class="fas fa-filter"></i> {{ __('Source Filters') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-modals')
    {{--Filters Modal--}}
    @include('data-tables.supplier-sheet-items.advance-filters')
@endsection

