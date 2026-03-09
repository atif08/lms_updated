<script type="text/javascript">
    // <<<<<<<<<<<<<<<<<<< DateRangePicker >>>>>>>>>>>>>>>>>>
    $('#date-range').dateRangePicker(function (start, end, label) {
        let title = label;
        if (label === 'Custom Range') {
            title = start.format('DD-MM-Y') + ' - ' + end.format('DD-MM-Y');
        }

        let format = 'Y-MM-DD';
        window.dashboardFilters['from_date'] = start.format(format);
        window.dashboardFilters['to_date'] = end.format(format);
        window.dashboardFilters['date_range'] = label;

        // SAVE DATE

        $('#date-range span').html(title);

        if (window['loadChart']) {
            window['loadChart']();
        }

        if (window['loadDashboard']) {
            window['loadDashboard']();
        }

        redrawDataTable();
    });
    // <<<<<<<<<<<<<<<<<<< DateRangePicker >>>>>>>>>>>>>>>>>>

</script>
