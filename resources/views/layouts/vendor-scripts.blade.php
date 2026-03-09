<!-- JAVASCRIPT -->
<script src="{{ URL::asset('libs/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('libs/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('libs/metismenu/metismenu.min.js')}}"></script>
<script src="{{ URL::asset('libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ URL::asset('libs/node-waves/node-waves.min.js')}}"></script>
<script src="{{ URL::asset('libs/waypoints/waypoints.min.js')}}"></script>
<script src="{{ URL::asset('libs/jquery-counterup/jquery-counterup.min.js')}}"></script>

<script src="{{ URL::asset('libs/select2/select2.min.js')}}"></script>

<script src="{{ URL::asset('libs/moment/moment.min.js')}}"></script>
<script src="{{ URL::asset('libs/daterangepicker/daterangepicker.min.js') }}"></script>
<script src="{{ URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ URL::asset('libs/accounting/accounting.min.js') }}"></script>

<script src="{{ URL::asset('libs/alertifyjs/alertifyjs.min.js') }}"></script>
<script src="{{ URL::asset('libs/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('libs/alertifyjs/alertifyjs.min.js') }}"></script>

<script src="{{ URL::asset('libs/datatables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('libs/datatables/dataTables.fixedColumns.min.js') }}"></script>

<script src="{{ URL::asset('libs/jquery-steps/jquery-steps.min.js') }}"></script>
<script src="{{ URL::asset('libs/jquery/jquery-ui.min.js') }}"></script>

<!-- App js -->
<script src="{{ URL::asset('js/app.js')}}"></script>

<script src="{{ URL::asset('js/pages/datatables.init.js?v=1') }}"></script>
<script src="{{ URL::asset('js/pages/import-wizard.init.js') }}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@include('scripts.plugins')
@include('scripts.menus')
@include('scripts.date-range')
@include('scripts.marketplaces')
@include('scripts.import')
@include('scripts.filters')
@include('scripts.custom')

@stack('scripts')
