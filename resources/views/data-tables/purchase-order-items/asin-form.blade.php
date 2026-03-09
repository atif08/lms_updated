<div class="row">
    <div class="col-6">
        <div class="card border">
            <div class="card-header bg-transparent border-gray">
                <div class="col-12">
                    <p class="card-text"><span class="green fw-bold">{{ __('ASIN:') }}&nbsp;</span><span
                            style="color: red" class="fw-bold font-size-12">{{ __('Create new sku-checkbox') }} &nbsp;</span> <i
                            class="fas fa-globe-americas blue"></i></p>
                </div>
            </div>
            <div class="card-header bg-transparent border-gray">
                <div class="col-12">
                    <p class="card-text"><i style="color: green" class="fas fas fa-check-circle"></i>&nbsp;
                        {{$row->asin}}&nbsp;<i class="far fas fa-arrow-right blue"></i></p>
                </div>
            </div>
            <div class="card-header bg-transparent border-gray">
                <div class="col-4">
                    <p class="card-text green fw-bold">{{ __('Desc:') }}</p>
                </div>
                <div class="col-12">
                    <p class="card-text" data-toggle="popover" data-bs-trigger="hover"
                       data-bs-content="{{ $row->item_description }}">
                        {{ mb_substr($row->item_description, 0, 30) . '...' }}
                    </p>
                </div>
            </div>
            <div class="card-body bg-transparent border-gray mt-2">
                <div class="col-12">
                    <div class="form-group animated">
                        <select name="sku" class="form-control animated">
                            <option>{{$row->sku}}</option>
                        </select>
                        <label class="animate-label">{{__('Sku(1)')}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="col-12">
            <div class="form-group animated">
                <input name="prep_cost"  type="text" value="{{$row->prep_cost}}" class="form-control animated">
                <label class="animate-label">{{ __('Prep Cost') }}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group animated">
                            <input type="text" value="{{$row->buy_box}}" class="form-control animated"
                                   placeholder=" ">
                            <label class="animate-label">{{ __('Buy Box') }}</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card border">
                            <div class="card-header border-gray" style="background-color: #fcede8">
                                <p class="card-text green fw-bold red font-size-12">{{ __('Total Fee:') }}</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <span class="card-text fw-bold">$</span>
                                    </div>
                                    <div class="col-8 fw-bold d-flex  justify-content-end">
                                        {{$row->total_fee}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group animated">
                            <input name="pack_size" type="text" value="{{$row->pack_size}}" class="form-control animated">
                            <label class="animate-label" >{{ __('Pack Size') }}</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card border">
                            <div class="card-header border-gray" style="background-color: #fcede8">
                                <p class="card-text green fw-bold red font-size-12">{{ __('ASIN Cost:') }}</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <span class="card-text fw-bold">$</span>
                                    </div>
                                    <div class="col-8 fw-bold d-flex  justify-content-end">
                                        {{$row->asin_cost}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


</div>

