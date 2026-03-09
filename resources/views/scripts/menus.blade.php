<script type="text/javascript">
    @if(isset($user))
        loadMenu();

        function loadMenu() {
            let parameters = {};
            @if(request()->has('t'))
                parameters['t'] = '{{ request()->get('t') }}';
            @endif
            makeGetCall("{{ route('general.get.menus') }}", parameters, function (response) {
                $('#side-menu').html(response)
            });
        }
    @endif
</script>
