<div class="col-12">
    <form method="post">
        <div class="row">
            <div class="col-12">
                <div class="form-group animated">
                    <input type="number" step="0.01" class="form-control animated" name="prep_cost"
                           value="{{ round($row->prep_cost, 2) }}">
                    <label class="animate-label">{{ __('Prep Cost') }}</label>
                </div>
            </div>

            <div class="col-6">
                <div class="card border">
                    <div class="card-header border-gray" style="background-color: #fcede8">
                        <div class="float-start">
                            <p class="card-text green fw-bold red font-size-12">{{ __('Total Fee') }}</p>
                        </div>
                        <div class="float-end">
                            <i class="fas fa-caret-down" data-toggle="popover" data-bs-trigger="hover"
                               data-bs-title="{{ __('Total Fees') }}"
                               data-bs-content="@include('data-tables.supplier-sheet-products.fee-breakdown')"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <span class="card-text fw-bold mb-0">$</span>
                            </div>
{{--                            @php $total_fees = $row->referral_fee + $row->fba_fees + $row->storage_fee + $row->inbound_placement_fee @endphp--}}
                            <div class="col-8 fw-bold d-flex justify-content-end">
                                <p class="mb-0">{{ round($row->total_fee, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card border">
                    <div class="card-header border-gray" style="background-color: #fcede8">
                        <p class="card-text green fw-bold red font-size-12">{{ __('ASIN Cost') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <span class="card-text fw-bold mb-0">$</span>
                            </div>
                            <div class="col-8 fw-bold d-flex justify-content-end">
                                {{ round($row->asin_cost, 2) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
