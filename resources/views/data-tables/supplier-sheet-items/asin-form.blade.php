<div class="col-12">
    <div class="input-group form-group">
        <div class="input-group-text green">{{ __('+ Added') }}</div>
        <input name="asin" type="text" value="{{ ($row->product_count ?? 0) . ' ' . __('ASIN') }}" class="form-control" disabled>
    </div>
</div>

<div class="col-12 mt-3">
    <div class="btn-group w-100" role="group">
        <button type="button" class="btn btn-light waves-effect btn-save-changes w-50"
                data-url="{{ route('supplier-sheet-products.post.index', $row->id) }}">
            <i class="fas fa-save"></i> {{ __('Apply Changes') }}
        </button>

        <button type="button" class="btn btn-primary waves-effect btn-asin w-50"
                data-url="{{ route('supplier-sheet-products.get.add-product', $row->id) }}">
            <i class="fas fa-plus"></i> {{ __('Add More ASIN') }}
        </button>
    </div>
</div>
