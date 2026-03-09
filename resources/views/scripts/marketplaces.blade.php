<script type="text/javascript">
    @if(!($settings_page ?? false))
        function loadMarketplaces(callback = null) {
            makeGetCall("{{ route('general.get.marketplaces') }}", window.dashboardFilters, function (response) {
                if (callback) {
                    callback(response);
                }
            });
        }

        $(document).on('change', '.mp-option', function (e) {
            e.preventDefault();
            let account_id = $(this).val();
            if (window.defaultSettings.currentAccountId !== account_id) {
                $.post('{{ route('general.post.marketplaces') }}', {
                    ... window.dashboardFilters,
                    account_id: account_id,
                }, function (response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert("Something went wrong");
                    }
                });
            }
        });

        $(document).on('click', '.marketplace-wrapper', function (e) {
            e.preventDefault();
            loadMarketplaces(function (response) {
                $('.right-sidebar-container').html(response);
                $('body').toggleClass('right-bar-enabled');
            })
        });

        $(document).on('keyup', '#marketplace-search input', function () {
            let value = $(this).val().toLowerCase();
            let mpRows = $(".marketplace-list li");
            mpRows.filter(function () {
                $(this).toggle($(this).find('.mp-name')
                    .text().toLowerCase().indexOf(value) > -1)
            });
        });
    @endif
</script>
