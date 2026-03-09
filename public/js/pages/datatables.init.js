window.dataTables = {};
window.currentDataTable = '';
window.dtOptions = {};
window.dtFilters = {};
window.callbacks = {};

window.dtParameters = {
    allowedHeaders: ['Origin', 'X-Requested-With', 'Content-Type', 'Accept'],
    bStateSave: true,
    iStateDuration: 0,
    pageLength: 10,
    aLengthMenu: [10, 25, 50, 100],
    bPaginate: 'false',
    bAutoWidth: 'false',
    bFilter: 'false',
    fixedHeader: {
        header: 'true',
        headerOffset: 60
    },
    bProcessing: true,
    bServerSide: true,
    sScrollX: true,
    bScrollCollapse: true,
    language: {
        "lengthMenu": "_MENU_",
        "infoEmpty": "No records available",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "search": ""
    }
}

function getDTFilters() {
    let parameters = {};

    $.each(window.dashboardFilters, function (key, value) {
        parameters[key] = value;
    });

    if ((window.dashboardFilters.hasOwnProperty("from_date")) && window.dashboardFilters.hasOwnProperty("to_date")) {
        parameters.date_range = [
            window.dashboardFilters['from_date'], window.dashboardFilters['to_date']
        ];
    }

    if (window.dtFilters) {
        parameters.custom_filters = window.dtFilters;
    }

    return parameters;
}

function loadDataTable(tableId, dtParams) {
    let this_table_cbs = window.callbacks[tableId] ? window.callbacks[tableId] : {};
    let callbacks = $.extend({}, {
        fnServerParams: function (parameters) {
            $.extend(parameters, getDTFilters());
        },
    }, this_table_cbs);

    let dtOptions = {
        ...window.dtParameters,
        ...dtParams,
        ...callbacks,
    }

    window.dtOptions = dtOptions;
    window.dataTables[tableId] = $('#' + tableId).DataTable(dtOptions);
    window.currentDataTable = tableId;
}

function redrawDataTable(tableId = null) {
    let _tableId = tableId ? tableId : $('.dt-wrapper').attr('id');
    if (window.dataTables[_tableId]) {
        window.dataTables[_tableId].ajax.reload()
    }
}

function restateDataTable(tableId = null) {
    let _tableId = tableId ? tableId : $('.dt-wrapper').attr('id');
    if (window.dataTables[_tableId]) {
        window.dataTables[_tableId].ajax.reload(null, false)
    }
}

// Global handler for simple search inputs (dt-search class)
$(document).on('keyup', '.dt-search', function () {
    let tableId = window.currentDataTable;
    if (tableId && window.dataTables[tableId]) {
        window.dataTables[tableId].search($(this).val()).draw();
    }
});

// Global handler for filter selects (batch-select class)
// The select's name attribute is used as the filter key sent to the backend
$(document).on('change', '.batch-select', function () {
    if (!window.dtFilters) { window.dtFilters = {}; }
    window.dtFilters[$(this).attr('name')] = $(this).val();
    redrawDataTable();
});
