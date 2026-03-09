<!-- 1. Upload File -->
<h3>{{ __('Upload UPCs') }}</h3>
<section>
    <div id="step1-form">
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
