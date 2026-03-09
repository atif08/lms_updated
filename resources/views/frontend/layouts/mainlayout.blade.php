<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layouts.partials.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
@if (Route::is(['index-two']))
    <body class="home-two">
    @endif
    @if (Route::is(['index-three']))
        <body class="home-three">
        @endif
        @if (Route::is(['index-four']))
            <body class="home-five">
            @endif
            <!-- Main Wrapper -->
            @if (!Route::is(['get.login', 'register']))
                <div class="main-wrapper" style="background-color: #1d1d56">
                    @endif
                    @if (Route::is(['get.login', 'register']))
                        <div class="main-wrapper log-wrap">
                            @endif
                            @if (
                                !Route::is([
                                    'password.request',
                                    'password.reset',
                                    'get.login',
                                    'new-password',
                                    'get.register',
                                    'courses.get.details'
                                ]))
                                @include('frontend.layouts.partials.header')
                            @endif
                            @yield('content')
                            @if (
                                !Route::is([
                                    'coming-soon',
                                    'error-404',
                                    'error-500',
                                    'password.request',
                                    'get.login',
                                    'new-password',
                                    'get.register',
                                    'under-construction',
                                    'verification-code',
                                    'password.reset'

                                ]))
                                {{-- @include('frontend.layouts.partials.footer') --}}
                            @endif
                        </div>
                        @include('frontend.layouts.partials.footer-scripts')

                        <!-- /Main Wrapper -->
                        <script>
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                        </script>
                        @mediaLibraryScripts

            </body>

</html>
