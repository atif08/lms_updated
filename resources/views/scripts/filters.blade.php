<script type="text/javascript">
    $(document).on('submit', '#customFiltersForm', function (e) {
        e.preventDefault();
        let formDataArray = $(this).serializeArray();

        let transformedData = {
            search_by: { key: '', value: '' },
            sort_by: { key: '', value: '' }
        };

        formDataArray.forEach(function(item) {
            if (item.name.startsWith('search_by_')) {
                transformedData.search_by[item.name.replace('search_by_', '')] = item.value;
            } else if (item.name.startsWith('sort_by_')) {
                transformedData.sort_by[item.name.replace('sort_by_', '')] = item.value;
            }
        });

        window.dtFilters = {...window.dtFilters,...transformedData};
        redrawDataTable();
    });

    $(document).on('keyup change', '#customFiltersForm .apply-search', function (e) {
        e.preventDefault();
        // alert('adsf');
        $('#customFiltersForm').submit();
    });

    $(document).on('click', '#customFiltersForm .btn-asc, #customFiltersForm .btn-desc', function (e) {
        e.preventDefault();
        $('.btn-asc').toggleClass('active');
        $('.btn-desc').toggleClass('active');
        let input = $('input[name="sort_by_value"]');
        let value = input.val() === 'asc' ? 'desc' : 'asc';
        input.val(value);
        $('#customFiltersForm').submit();
    });

    $(document).on('click', '#advanceFiltersModal .save-advance-filters', function (e) {
        e.preventDefault();
        $('#advanceFiltersForm').submit();
        $('.btn-close').click();
    });

    $(document).on('submit', '#advanceFiltersForm', function (e) {
        e.preventDefault();
        let transformedData = {};
        let formDataArray = $(this).serializeArray();
        formDataArray.forEach(function(item) {
            if (item.name.endsWith('_min') || item.name.endsWith('_max')) {
                let match = item.name.match(/(.*)_(min|max)$/);
                let mainKey = match[1]; // 'sales_rank'
                let subKey = match[2];  // 'min' or 'max'
                if (!transformedData[mainKey]) {
                    transformedData[mainKey] = {};
                }
                transformedData[mainKey][subKey] = item.value;
            } else {
                transformedData[item.name] = {value: item.value};
            }
        });
        window.dtFilters = {...window.dtFilters,...transformedData};
        redrawDataTable();
    });

    $(document).on('click', '#customFiltersForm .reset-filter', function (e){
        window.dtFilters = {};
        $('#advanceFiltersForm').trigger('reset');
        $('#customFiltersForm').trigger('reset');
        redrawDataTable();
    });

</script>
