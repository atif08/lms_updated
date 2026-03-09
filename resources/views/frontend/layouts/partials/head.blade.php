<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<!-- Conditional Title & Favicon -->
@if (Str::contains(url()->current(), 'portal.astiacademy.ac.ae'))
<title>ASTI Study Portal</title>
@else
<title>BTC Study Portal</title>
@endif
<!-- Conditional Favicon -->
@if (Str::contains(url()->current(), 'portal.astiacademy.ac.ae'))
<link rel="shortcut icon" type="image/x-icon" href="{{ url('frontend/img/asti-favicon.ico') }}">
@else
<link rel="shortcut icon" type="image/x-icon" href="{{ url('frontend/img/buc-favicon.ico') }}">
@endif
<!-- Bootstrap CSS -->
<link href="{{ URL::asset('libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ url('/frontend/css/bootstrap.min.css') }}">
<!-- Daterangepicker CSS -->
<link rel="stylesheet" href="{{ url('/frontend/plugins/daterangepicker/daterangepicker.css') }}">
<!-- Datepicker CSS -->
<link rel="stylesheet" href="{{ url('/frontend/css/bootstrap-datetimepicker.min.css') }}">
<!-- Boxioons CSS -->
<link rel="stylesheet" href="{{ url('/frontend/plugins/boxicons/css/boxicons.min.css') }}">
<!-- Fontawesome CSS -->
<link rel="stylesheet" href="{{ url('/frontend/plugins/fontawesome/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ url('/frontend/plugins/fontawesome/css/all.min.css') }}">

<!-- Feather CSS -->
<link rel="stylesheet" href="{{ url('/frontend/css/feather.css') }}">

<!-- Select2 CSS -->
<link rel="stylesheet" href="{{ url('/frontend/plugins/select2/css/select2.min.css') }}">

<!-- Datatable CSS -->
<link rel="stylesheet" href="{{ url('/frontend/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}">

<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="{{ url('/frontend/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ url('/frontend/css/owl.theme.default.min.css') }}">

<!-- Swiper CSS -->
<link rel="stylesheet" href="{{ url('/frontend/plugins/swiper/css/swiper.min.css') }}">

<!-- Slick CSS -->
<link rel="stylesheet" href="{{ url('/frontend/plugins/slick/slick.css') }}">
<link rel="stylesheet" href="{{ url('/frontend/plugins/slick/slick-theme.css') }}">

<!-- Feathericon CSS -->
<link rel="stylesheet" href="{{ url('/frontend/plugins/feather/feather.css') }}">

<!-- Dropzone -->
<link rel="stylesheet" href="{{ url('/frontend/plugins/dropzone/dropzone.min.css') }}">

<!-- Aos CSS -->
<link rel="stylesheet" href="{{ url('/frontend/plugins/aos/aos.css') }}">

<!-- Main CSS -->
<link rel="stylesheet" href="{{ url('/frontend/css/style.css') }}">

<!-- Conditional CSS -->
@if (Str::contains(url()->current(), 'portal.astiacademy.ac.ae'))
<link rel="stylesheet" href="{{ url('/frontend/css/style-asti.css') }}" type="text/css"/>
@else
    <link rel="stylesheet" href="{{ url('/frontend/css/style-buc.css') }}" type="text/css"/>
@endif
@yield('style')
