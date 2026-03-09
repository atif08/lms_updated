<script type="text/javascript">
    $(document).on('click', '#customFiltersForm .btn-import', function (e) {
        e.preventDefault();
        makeGetCall("{{ route('imports.get.requests') }}", {
            'report_type': $(this).attr('data-report-type')
        }, function (response) {
            $('#import-wizard').html(response);
            loadImportWizard(0);
        })
    });

    $(document).on('click', '.btn-import-mappings', function (e) {
        e.preventDefault();
        makeGetCall('{{ route('imports.get.requests') }}', {
            'report_type': $(this).attr('data-report-type'),
            'import_id': $(this).attr('data-import-id'),
        }, function (response) {
            $('#import-wizard').html(response);
            loadImportWizard(1);
        })
    });

    $(document).on('hide.bs.modal', '#importModal', function (e) {
        destroyImportWizard();
        redrawDataTable();
    });
</script>
