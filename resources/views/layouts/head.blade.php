@yield('css')

<link href="{{ URL::asset('flag-icons/css/flag-icons.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>

<!-- Sweet Alert -->
<link href="{{ URL::asset('libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('libs/alertifyjs/alertifyjs.min.css') }}" rel="stylesheet" type="text/css"/>

<!-- Datatables CSS -->
<link href="{{ URL::asset('libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('libs/datatables/fixedHeader.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>

<!-- Bootstrap CSS -->
<link href="{{ URL::asset('css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>

<!-- Icons CSS -->
<link href="{{ URL::asset('css/icons.min.css')}}" id="icons-style" rel="stylesheet" type="text/css"/>
<!-- App CSS-->
<link href="{{ URL::asset('css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css"/>

<link href="{{ URL::asset('libs/datepicker/datepicker.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('libs/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css"/>

<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('css/jquery-ui.css') }}" rel="stylesheet" type="text/css"/>

<link href="{{ URL::asset('css/media-library.css') }}" rel="stylesheet" type="text/css"/>

<!-- TinyMCE -->
<script src="{{ URL::asset('libs/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

@mediaLibraryStyles
@mediaLibraryScripts

@yield('css-bottom')

@stack('css')

@yield('style')

<script type="text/javascript">
    window.defaultSettings = {
        currency: "{{ $currency ?? 'USD' }}",
        currencyIcon: "{{ $currency_icon ?? '$' }}",
        currentAccountId: "{{ @$current_account?->id ?? ''}}",
        dateFormat: 'MM-DD-YYYY',
        baseUrl: "{{ route('home') }}",
        urlSegments: "{{ implode('/', request()->segments()) }}"
    };

    window.momentFormat = 'Y-MM-DD';
    window.dashboardFilters = {};

    @if(isset($date_object))
        window.dashboardFilters['from_date'] = "{{ $date_object->getFromDate()->format('Y-m-d') }}";
        window.dashboardFilters['to_date'] = "{{ $date_object->getToDate()->format('Y-m-d') }}";
    @endif
</script>
