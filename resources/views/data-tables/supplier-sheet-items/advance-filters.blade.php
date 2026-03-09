<div id="advanceFiltersModal" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="advanceFiltersLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="advanceFiltersLabel">{{ __('Advance Filters') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body d-flex">
                <form action="" id="advanceFiltersForm">
                    <div class="row">
                        @foreach($data_table->getAdvanceSearchable('text') as $column)
                            <div class="col-lg-4">
                                <div class="form-group m-2">
                                    <div class="input-group">
                                        <label class="control-label w-30">{{ $column['title'] }}</label>
                                        @if (($column['column_type'] ?? 'text') == 'boolean')
                                            <select class="form-control w-70" name="{{ $column['data'] }}">
                                                <option value="">{{ __('All') }}</option>
                                                <option value="1">{{ __('Yes') }}</option>
                                                <option value="0">{{ __('No') }}</option>
                                            </select>
                                        @else
                                            <input type="text" class="form-control w-70" name="{{ $column['data'] }}" placeholder="{{ __('Search here...') }}" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        @foreach($data_table->getAdvanceSearchable('range') as $column)
                            <div class="col-lg-4">
                                <div class="form-group m-2">
                                    <label class="control-label">{{ $column['title'] }}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control w-50" name="{{ $column['data'] }}_min" placeholder="min"/>
                                        <input type="text" class="form-control w-50" name="{{ $column['data'] }}_max" placeholder="max"/>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect waves-light reset-filter">
                    <i class="fa fa-undo"></i> {{__('Reset')}}
                </button>
                <button type="button" class="btn btn-primary waves-effect waves-light save-advance-filters">
                    <i class="fas fa-save"></i> {{ __('Save') }}
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
