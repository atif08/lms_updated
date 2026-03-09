<!-- 1. Upload File -->
<h3>{{ __('Upload Supplier Sheet') }}</h3>
<section>
    <div id="step1-form">
        <div class="col-md-6 mx-auto">
            @if(isset($supplier_form))
                <h4 class="card-title mb-3">
                    {{ __('Create New Supplier') }}

                    <button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-light float-end"
                            id="show_supplier">{{ __('Add New') }} <i class="fa fa-plus"></i>
                    </button>
                </h4>

                <div style="display: none" class="create-supplier">
                    {!! form($supplier_form) !!}
                </div>

                <div class="clearfix"></div>
                <div class="form-group mb-6 mt-6"><hr/></div>
            @endif
        </div>
        <div class="col-md-6 mx-auto">
            {!! form($upload_form) !!}
        </div>
    </div>
</section>

<!-- 2. Map Columns -->
<h3>{{ __('Map Columns') }}</h3>
<section>
    <div id="step2-form">
        @if(isset($mappings_form))
            {!! form($mappings_form) !!}
        @endif
    </div>
</section>
