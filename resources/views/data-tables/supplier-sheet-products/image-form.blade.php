<div class="row">

    <div class="col-xl-2 col-lg-12 col-md-12 col-sm-12">
        <div class="row">
            <div class="img-container">
                <img alt="" src="{{ image($row->image_url) }}"
                     width="75" height="75" class="img-thumbnail"/>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <p class="card-text green fw-bold">{{ __('DESC') }}</p>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <p class="card-text" data-toggle="popover" data-bs-trigger="hover"
                           data-bs-content="{{ $row->title }}">
                            {{ mb_substr($row->title, 0,  30) . '...' }}
                        </p>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <i class="fas fa-copy float-end mt-1" onclick="copy('{{ $row->title }}')"></i>
                    </div>
                </div>

                <hr class="mt-2 mb-2">

                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <p class="card-text green fw-bold">{{ __('Qty') }}</p>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        @php $total_qty = $row->afn_total_quantity ?? 0 @endphp
                        <span class="button_container">
                            {{ $total_qty }} <i class="fas fa-caret-down" data-toggle="popover" data-bs-trigger="hover"
                                data-bs-title="{{ __('Total in Amazon') . ' (' . $total_qty . ')' }}"
                                data-bs-content="@include('data-tables.supplier-sheet-products.quantity-breakdown')"></i>
                        </span>
                    </div>

                    <div class="col-lg-2 col-md-12">
                        <i data-url="{{ route('supplier-sheet-products.post.fetch-product', $row->id) }}"
                           style="cursor: pointer" class="fas fa-redo-alt blue refresh-keepa float-end mt-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
        <form method="post">
            <div class="col-12">
                <div class="form-group animated">
                    <input type="number" step="1" class="form-control animated" name="pack_size"
                           value="{{ $row->pack_size ?? 1 }}">
                    <label class="animate-label">{{ __('Pack Size') }}</label>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group animated">
                    <input type="number" step="1" class="form-control animated" name="buy_box"
                           value="{{ round($row->buy_box, 2) }}">
                    <label class="animate-label">{{ __('Buy Box') }}</label>
                </div>
            </div>
        </form>
    </div>
</div>

