<div class="custom-filters">
    <form action="" id="customFiltersForm">
        <div class="card-body row">
            <!-- DATATABLE SEARCHING -->
            <div class="col-lg-3 col-md-12 col-xs-12 col-sm-12">
                <div class="form-group m-2">
{{--                    <label for="search-type" class="control-label">{{ __('Search Type') }}</label>--}}
                    <div class="input-group">

                        <select id="search-type" class="form-select apply-search w-30 no-select2" name="search_by_key">
                            @foreach($data_table->getSearchable() as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>

                        <input type="text" name="search_by_value" class="form-control apply-search w-70"
                               placeholder="{{ __('Search here...') }}">
                    </div>
                </div>
            </div>

            <!-- DATATABLE SORTING -->
            <div class="col-lg-3 col-md-12 col-xs-12 col-sm-12">
                <div class="form-group m-2">
{{--                    <label for="sort-by" class="control-label">{{ __('Sort By') }}</label>--}}
                    <div class="input-group">
                        <select id="sort-by" class="form-select apply-search no-select2" name="sort_by_key">
                            <option value="default">{{ __('Default')  }}</option>
                            @foreach($data_table->getSortable() as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>

                        <button type="button" value="asc"
                                class="btn btn-outline-secondary btn-asc waves-effect waves-light">
                            {{ __('Asc') }} <i class="fas fa-arrow-up"></i></button>

                        <button type="button" value="desc"
                                class="btn btn-outline-secondary btn-desc waves-effect waves-light active">
                            {{ __('Desc') }} <i class="fas fa-arrow-down"></i></button>

                        <input type="hidden" class="form-control apply-search" name="sort_by_value" value="desc">

                        <button type="button" class="btn btn-danger waves-effect waves-light reset-filter">
                            <i class="fas fa-undo"></i> {{ __('Reset') }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12">
                @yield('extra-filters')
            </div>

        </div>
    </form>

    @yield('extra-modals')
</div>
