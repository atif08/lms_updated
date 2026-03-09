<form method="post" action="">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12">
            <div class="form-group animated mb-1">
                <input type="number" step="0.01" value="{{ round($row->net_case_cost, 2) }}"
                       class="form-control animated" name="net_case_cost">
                <label class="animate-label">{{ __('Case Cost') }}</label>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12">
            <div class="form-group animated mb-1">
                <input type="number" step="0.01" value="{{ round($row->net_unit_cost, 2) }}"
                       class="form-control animated" name="net_unit_cost" disabled>
                <label class="animate-label">{{ __('Each Cost') }}</label>
            </div>
        </div>
    </div>
</form>
