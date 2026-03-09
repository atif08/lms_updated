<!-- Header -->
@if (Route::is([
'students.get.profile',
'students.get.settings',
'students.get.change-password',
                    'students.get.calendar',
'courses.get',
'courses.get.details',
'courses.get.enrolled'
]))
    <header class="header header-page">
        @else
            <header class="header">

                @endif
                <div class="header-fixed">
                    <nav class="navbar navbar-expand-lg header-nav scroll-sticky">
                        <div class="container">
                            <div class="navbar-header">
                                {{-- <a id="mobile_btn" href="javascript:void(0);">
                            <span class="bar-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                                </a> --}}
                                <a href="{{ url('/') }}" class="navbar-brand logo">
                                    {{-- <img src="{{ URL::asset('/frontend/img/BUC.png') }}" class="img-fluid" alt="Logo"> --}}
                                    @if (Str::contains(Request::url(), 'portal.astiacademy.ac.ae'))
                                        <img src="{{ URL::asset('/frontend/img/ASTI.png') }}" class="img-fluid" alt="Logo">
                                    @else
                                        <img src="{{ URL::asset('/frontend/img/BUC.png') }}" class="img-fluid" alt="Logo">
                                    @endif

                                </a>
                            </div>
                            <div class="main-menu-wrapper">
                                <div class="menu-header">
                                    <a href="{{ url('index') }}" class="menu-logo">
                                        <img src="{{ URL::asset('/frontend/img/BUC.png') }}" class="img-fluid"
                                             alt="Logo">
                                    </a>
                                    <a id="menu_close" class="menu-close" href="javascript:void(0);">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                                <ul class="main-nav">
                                    {{--                                     <li>--}}
                                    {{--                                         <a href="{{route('courses.get')}}">Courses</a>--}}
                                    {{--                                     </li>--}}
                                    <li class="login-link">
                                        <a href="{{ url('login') }}">Login / Signup</a>
                                    </li>
                                </ul>
                            </div>
                            <ul class="nav header-navbar-rht">
                                @if (!Auth::user())
                                    <li class="nav-item">
                                        <a class="nav-link header-sign" href="{{ url('login') }}">Signin</a>
                                    </li>
                                    {{--                                     <li class="nav-item">--}}
                                    {{--                                         <a class="nav-link header-login" href="{{ url('register') }}">Signup</a>--}}
                                    {{--                                     </li>--}}
                                @endif
                                @if (Auth::user())
                                    <li class="nav-item user-nav">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <span class="user-img">

                                    <img src="{{get_image(Auth::user()->media)}}" alt="User Image"
                                         class="avatar-img rounded-circle">
                                    <span class="status online"></span>
                                </span>
                                        </a>
                                        <div class="users dropdown-menu dropdown-menu-right"
                                             data-popper-placement="bottom-end">

                                            <div class="user-header">
                                                <div class="avatar avatar-sm">
                                                    <img src="{{get_image(Auth::user()->media)}}" alt="User Image"
                                                         class="avatar-img rounded-circle">
                                                </div>
                                                <div class="user-text">
                                                    <h6>{{Auth::user()->name}}</h6>
                                                    <p class="text-muted mb-0">{{(Auth::user()->user_type)}}</p>
                                                </div>
                                            </div>
                                            <a class="dropdown-item" href="{{ route('students.get.dashboard') }}"><i
                                                    class="feather-home me-1"></i> Dashboard</a>
                                            @if(auth()->user()->user_type == \Domain\Users\Enums\UserTypeEnum::ADMIN() || auth()->user()->user_type == \Domain\Users\Enums\UserTypeEnum::FACULTY_MEMBER())
                                                <a class="dropdown-item" href="{{ url('admin/courses') }}"><i
                                                        class="feather-home me-1"></i> Go To Admin</a>
                                            @endif
                                            <strong class="dropdown-item total-hours"></strong>

                                            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                               class="dropdown-item" href="{{ route('logout') }}"><i
                                                    class="feather-log-out me-1"></i> Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                                <input type="hidden" name="total_hours" class="total-hours">
                                            </form>
                                        </div>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </nav>
                </div>
            </header>
