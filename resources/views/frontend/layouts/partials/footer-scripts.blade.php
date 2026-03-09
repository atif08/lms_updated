<!-- jQuery -->
<script src="{{ URL::asset('/frontend/js/jquery-3.7.1.min.js') }}"></script>


<!-- Bootstrap Core JS -->
<script src="{{ URL::asset('/frontend/js/bootstrap.bundle.min.js') }}"></script>

<!-- counterup JS -->
<script src="{{ URL::asset('/frontend/js/jquery.waypoints.js') }}"></script>
<script src="{{ URL::asset('/frontend/js/jquery.counterup.min.js') }}"></script>
<!-- Swiper JS -->
<script src="{{ URL::asset('/frontend/plugins/swiper/swiper.min.js') }}"></script>
<!-- Slimscroll JS -->
<script src="{{ URL::asset('/frontend/js/jquery.slimscroll.min.js') }}"></script>

<!-- Select2 JS -->
<script src="{{ URL::asset('/frontend/plugins/select2/js/select2.min.js') }}"></script>

<!-- Owl Carousel -->
<script src="{{ URL::asset('/frontend/js/owl.carousel.min.js') }}"></script>

<!-- Slick Slider -->
<script src="{{ URL::asset('/frontend/plugins/slick/slick.js') }}"></script>

<!-- Aos -->
<script src="{{ URL::asset('/frontend/plugins/aos/aos.js') }}"></script>

<!-- Ckeditor JS -->
<script src="{{ URL::asset('/frontend/js/ckeditor.js') }}"></script>

<!-- Bootstrap Tagsinput JS -->
<script src="{{ URL::asset('/frontend/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"></script>

<!-- Swiper Slider -->
<script src="{{ URL::asset('/frontend/plugins/swiper/js/swiper.min.js') }}"></script>

<!-- Feature JS -->
<script src="{{ URL::asset('/frontend/plugins/feather/feather.min.js') }}"></script>

<!-- Sticky Sidebar JS -->
<script src="{{ URL::asset('/frontend/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
<script src="{{ URL::asset('/frontend/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

<!-- Chart JS -->
<script src="{{ URL::asset('/frontend/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('/frontend/plugins/apexchart/chart-data.js') }}"></script>

<!-- Progress JS -->
<script src="{{ URL::asset('/frontend/js/circle-progress.min.js') }}"></script>

<!-- Dropzone JS -->
<script src="{{ URL::asset('/frontend/plugins/dropzone/dropzone.min.js') }}"></script>

<!-- Validation-->
<script src="{{ URL::asset('/frontend/js/validation.js') }}"></script>

<!-- Daterangepicker JS -->
<script src="{{ URL::asset('/frontend/js/moment.min.js') }}"></script>
<script src="{{ URL::asset('/frontend/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- Datepicker JS -->
<script src="{{ URL::asset('/frontend/js/moment.min.js') }}"></script>
<script src="{{ URL::asset('/frontend/js/bootstrap-datetimepicker.min.js') }}"></script>

<!-- Custom JS -->
<script src="{{ URL::asset('/frontend/js/script.js') }}"></script>
<script src="{{ URL::asset('/libs/tinymce/tinymce.min.js') }}"></script>

<script src="{{ URL::asset('libs/accounting/accounting.min.js') }}"></script>
<script src="{{ URL::asset('libs/alertifyjs/alertifyjs.min.js') }}"></script>
<script src="{{ URL::asset('libs/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
@php
    $user = auth()->user();
@endphp

@if($user && ($user->user_type == \Domain\Users\Enums\UserTypeEnum::STANDARD_STUDENT() || $user->user_type == \Domain\Users\Enums\UserTypeEnum::ACCELERATED_STUDENT()))
    <script>
        window.onload = function () {
            const checkInTime = new Date("{{ $user->today_attendance?->check_in }}");
            function updateRunningTime() {
                const now = new Date();
                const diff = Math.floor((now - checkInTime) / 1000);
                const hours = Math.floor(diff / 3600).toString().padStart(2, '0');
                const minutes = Math.floor((diff % 3600) / 60).toString().padStart(2, '0');
                const seconds = (diff % 60).toString().padStart(2, '0');
                $(".total-hours").html(`<i class="feather-clock me-1"></i> ${hours}:${minutes}:${seconds} Hrs`);
                $(".total-hours").val(`${hours}:${minutes}:${seconds}`);
            }
            setInterval(updateRunningTime, 1000); // Update every second
        }
    </script>
@endif
@stack('scripts')
@include('scripts.plugins')

