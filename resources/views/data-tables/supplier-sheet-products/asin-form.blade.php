<div class="col-12">
    <div class="card border">
        <div class="card-header bg-transparent border-gray ">
            <div class="row">
                <div class="col-6">
                    <p class="card-text fw-bold">
                        {{ $row->asin }}
                        <a target="_blank" href="{{ $row->link }}?th=1&az_field_BuyCost_FBA={{ $row->buy_box }}">
                            <i class="far fas fa-arrow-right blue"></i>
                        </a>
                    </p>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <p class="card-text fw-bold cursor-pointer">
                        <i data-url="{{ route('supplier-sheet-products.post.hide-product', $row->id) }}"
                           class="fas @if($row->hidden) fa-eye @else fa-eye-slash @endif btn-hide"></i>
                        <i class="fas fa-copy" onclick="copy('{{ $row->asin }}')"></i>
                        <i data-url="{{ route('supplier-sheet-products.post.detach-product', $row->id) }}"
                           style="cursor:pointer" class="fas fa-trash-alt red btn-delete"></i>
                    </p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <p class="card-text fw-bold">
                        <i style="color:gold" class="fas fa-star"></i>
                        {{ $row->sales_rank }} - {{ $row->category }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 mt-3">
    <div class="btn-group w-100" role="group">
        <button type="button" class="btn btn-light waves-effect btn-save-changes w-50"
                data-url="{{ route('supplier-sheet-products.post.update-product', $row->id) }}">
            <i class="fas fa-save"></i> {{ __('Apply Changes') }}
        </button>

        <button type="button" class="btn btn-secondary waves-effect waves-light btn-add-po w-50"
                data-bs-toggle="modal" data-bs-target="#addPoModal"
                data-url="{{ route('supplier-sheet-products.get.add-to-po', $row->id) }}">
            <i class="fas fa-arrow-right"></i> {{ __('Add To PO') }}
        </button>
    </div>
</div>
