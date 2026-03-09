<div class="row">

    <div class="col-xl-2 col-lg-12 col-md-12 col-sm-12">
        <div class="row">
            <div class="img-container">
                <img alt="" src="{{ image($row->image_url) }}" width="75" height="75" class="img-thumbnail"/>
                {{--<i class="fas fa-edit edit-icon"></i>--}}
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <p class="card-text green fw-bold">{{ __('UPC') }}</p>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <p class="card-text">
                            <a target="_blank" href="https://www.upcitemdb.com/upc/{{ $row->upc }}">{{ $row->upc }}</a>
                        </p>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <i class="fas fa-copy float-end mt-1" onclick="copy('{{ $row->upc }}')"></i>
                    </div>
                </div>

                <hr class="mt-2 mb-2">

                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <p class="card-text green fw-bold">{{ __('DESC') }}</p>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <p class="card-text">{{ $row->item_description }}</p>
                    </div>

                    <div class="col-lg-2 col-md-12">
                        <i class="fas fa-copy float-end mt-1" onclick="copy('{{ $row->item_description }}')"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <p class="card-text green fw-bold">{{ __('Item') }}</p>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <p class="card-text">{{ $row->item_code }}</p>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <i class="fas fa-copy float-end mt-1" onclick="copy('{{ $row->item_code }}')"></i>
                    </div>
                </div>

                <hr class="mt-2 mb-2">

                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <p class="card-text green fw-bold">{{ __('Size') }}</p>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <p class="card-text">{{ $row->sell_size }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

