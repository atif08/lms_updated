@if (Route::is([
        'courses.get.enrolled',
        'students.get.profile',
        'students.get.quiz-attempts',
        'attendance.get',
        'students.get.settings',
        'students.get.calendar',
        'students.get.change-password',
        'students.get.dashboard'
    ]))
    <!-- sidebar -->
    <div class="col-xl-3 col-lg-3 theiaStickySidebar">
        {{-- <div class="settings-widget dash-profile">
            <div class="settings-menu">
                <div class="profile-bg">
                    <div class="profile-img">
                        <a href="{{ route('students.get.profile') }}"><img
                                src="{{get_image(Auth::user()->media)}}" alt="Img"></a>
                    </div>
                </div>
                <div class="profile-group">
                    <div class="profile-name text-center">
                        <h4><a href="{{route('students.get.profile')}}">{{Auth::user()->name}}</a></h4>
                        <p>Student</p>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="settings-widget account-settings">
            <div class="settings-menu">
                {{-- <h3>Dashboard</h3> --}}
                <ul>
{{--                    <li class="nav-item {{ Route::is('students.get.profile') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('students.get.profile') }}" class="nav-link">--}}
{{--                            <i class="bx bxs-tachometer"></i>Dashboard--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li class="nav-item {{ Request::is('students.get.dashboard') ? 'active' : '' }}">
                        <a href="{{route('students.get.dashboard')}}" class="nav-link">
                            <i class="bx bxs-dashboard"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('students.get.profile') ? 'active' : '' }}">
                        <a href="{{route('students.get.profile')}}" class="nav-link">
                            <i class="bx bxs-user"></i>My Profile
                        </a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('courses.get.enrolled') ? 'active' : '' }}">
                        <a href="{{ route('courses.get.enrolled') }}" class="nav-link">
                            <i class="bx bxs-graduation"></i>Enrolled Courses
                        </a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('students.get.quiz-attempts') ? 'active' : '' }}">
                        <a href="{{ route('students.get.quiz-attempts') }}" class="nav-link">
                            <i class="bx bxs-shapes"></i>My Quiz Attempts
                        </a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('attendance.get') ? 'active' : '' }}">
                        <a href="{{ route('attendance.get') }}" class="nav-link">
                            <i class="bx bxs-calendar"></i>Attendance
                        </a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('students.get.calendar') ? 'active' : '' }}">
                        <a href="{{ route('students.get.calendar') }}" class="nav-link">
                            <i class="bx bxs-graduation"></i>Calendar
                        </a>
                    </li>
                </ul>
                <h3>Account Settings</h3>
                <ul>
                    {{-- <li
                        class="nav-item {{ Request::is(
                            'students.get.settings',
                        )
                            ? 'active'
                            : '' }}">
                        <a href="{{ route('students.get.settings') }}" class="nav-link ">
                            <i class="bx bxs-cog"></i>Settings
                        </a>
                    </li> --}}
                    <li class="nav-item {{ Request::is('index') ? 'active' : '' }}">
                        <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}" class="nav-link">
                            <i class="bx bxs-log-out"></i>Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Sidebar -->
@endif
