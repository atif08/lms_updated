<header id="header">
    <style>
        /* Allow dropdowns to escape navbar containers */
        .navbar,
        .navbar .container,
        .navbar .container-fluid,
        .navbar .navbar-nav {
            overflow: visible !important;
        }

        /* Bootstrap flex override */
        .navbar .navbar-nav {
            position: static !important;
        }

        /* Anchor Programs menu */
        .navbar .nav-item.program {
            position: relative;
        }

        /* RESET Bootstrap dropdown defaults */
        .navbar .nav-item.program>.dropdown-menu {
            position: absolute !important;
            top: calc(100% + 2px) !important;
            left: 0 !important;

            width: auto !important;
            min-width: 390px !important;
            max-width: 400px !important;

            height: auto !important;
            max-height: none !important;

            padding: 10px 0 !important;
            margin: 0 !important;

            background-color: #ffffff !important;
            border-radius: 6px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.18) !important;

            display: none !important;
            z-index: 9999 !important;

            overflow: hidden !important;
            transform: none !important;
            bottom: 20px;
            /* border: 2px solid red !important; */

        }

        /* Remove any inherited scrollbar */
        .navbar .dropdown-menu::-webkit-scrollbar {
            display: none;
        }

        /* Dropdown list reset */
        .navbar .dropdown-menu li {
            list-style: none;
            width: 100%;
        }

        /* Dropdown links */
        .navbar .dropdown-menu .dropdown-item {
            display: block;
            padding: 10px 18px;
            font-size: 14px;
            font-weight: 500;
            color: #111111;
            white-space: nowrap;
            background: transparent;
            transition: all 0.25s ease;
        }

        /* Hover state */
        .navbar .dropdown-menu .dropdown-item:hover {
            background-color: #f5f5f5;
            color: #ff4d2d;

        }

        /* Show dropdown on hover (desktop) */
        .navbar .nav-item.program:hover>.dropdown-menu {
            display: block !important;
        }

        /* Prevent Bootstrap JS from forcing visibility */
        .navbar .dropdown-menu.show {
            display: none !important;
        }

        /* Optional: Disable hover dropdown on mobile */
        @media (max-width: 991px) {
            .navbar .nav-item.program:hover>.dropdown-menu {
                display: none !important;
            }
        }

        /* .program {
            border: 2px solid red;

        } */
    </style>
    <!-- Navbar -->
    <nav data-aos="zoom-out" data-aos-delay="800" class="navbar navbar-expand" style="background-color: #111111;">
        <div class="container header">
            <!-- Navbar Brand-->
            <a class="navbar-brand" href="/">
                <img src="/frontend/assets/images/Logo-N.png" alt=" ASTI Academy " />
            </a>

            <!-- Nav holder -->
            <div class="ml-auto"></div>

            <!-- Navbar Items -->
            <ul class="navbar-nav items">
                <li class="nav-item dropdown">
                    <a href="{{ route('get.about') }}" class="nav-link">About Us </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="/courses/certification-programs" class="nav-link">Certification Programs </a>
                </li>

                {{-- <ul class="dropdown-menu">
                        <div class="menu-row">
                            <div class="dropdown-category">
                                <b class="mx-3">Uk Level Diploma Qualifications</b>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link" href="/courses/level-3-foundation-diploma-in-accountancy">
                                        Foundation Diploma in Accountancy-UK Level-3
                                    </a>
                                </li>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link" href="/courses/level-3-diploma-in-education-and-training">
                                        Diploma in Education & Training-UK Level-3
                                    </a>
                                </li>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link" href="/courses/level-3-foundation-diploma-in-higher-education">
                                        Diploma in Higher Education Studies-UK Level-3
                                    </a>
                                </li>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link"
                                        href="/courses/level-4-and-5-diploma-in-accounting-and-business">
                                        Diploma in Accounting and Business-UK Level-4
                                    </a>
                                </li>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link" href="/courses/level-4-and-5-diploma-in-education-and-training">
                                        Diploma in Education and Training-UK Level-4
                                    </a>
                                </li>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link" href="/courses/level-5-diploma-in-accounting-and-business">
                                        Diploma in Accounting and Business-UK Level-5
                                    </a>
                                </li>
                            </div>


                            <div class="dropdown-category">
                                <b class="mx-3">Information Technology & AI</b>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link"
                                        href="/courses/study-online-blockchain-and-technology-diploma-program">
                                        Block Chain Technology Programme
                                    </a>
                                </li>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link" href="/courses/study-artificial-intelligence-diploma-program">
                                        Artificial Intellingence Programme
                                    </a>
                                </li>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link" href="/courses/study-online-data-analysis-course">
                                        Data Analysis Training Course
                                    </a>
                                </li>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link" href="/courses/study-online-python-web-development-course">
                                        Python Webdevelopment Course
                                    </a>
                                </li>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link" href="/courses/digital-marketing-management">
                                        Digital Marketing Management
                                    </a>
                                </li>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link" href="/courses/health-administration">
                                        Health Administration
                                    </a>
                                </li>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link" href="/courses/marketing-management-sales-management-programme">
                                        Marketing Management Sales Management
                                    </a>
                                </li>
                            </div>

                            <div class="dropdown-category">
                                <b class="mx-3">Engineering, Architecture and Design</b>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="/courses/study-online-property-management-diploma">
                                        Property Management Programme
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="/courses/study-online-design-engineering-program">
                                        Design Engineering Programme
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="/courses/online-biomedical-engineering-diploma-program">
                                        Biomedical Engineering Programme
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="/courses/online-chemical-engineering-diploma">
                                        Chemical Engineering Programme
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="/courses/online-mechatronics-engineering-diploma-program">
                                        Mechatronics Engineering Programme
                                    </a>
                                </li>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link"
                                        href="/courses/study-online-petroleum-engineering-diploma-program">
                                        Petroleum Engineering Programme
                                    </a>
                                </li>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link" href="/courses/online-quantity-survey-engineering-diploma">
                                        Quantity Surveying Engineering Programme
                                    </a>
                                </li>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link" href="/courses/online-electrical-vehicle-engineering-course">
                                        Electrical Vehicle Engineering Programme
                                    </a>
                                </li>
                                <li class="nav-item dropdown pb-2">
                                    <a class="nav-link" href="/courses/facade-engineering">
                                        Facade Engineering
                                    </a>
                                </li>
                            </div>

                            <div class="dropdown-category">
                                <b class="mx-3">Accounting and Finance</b>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="/courses/oracle-financials-training-course-in-UAE">
                                        Oracle Financial Programme
                                    </a>
                                </li>

                            </div>
                        </div>


                    </ul> --}}
                <li class="nav-item dropdown program">
                    <a href="/courses/courses" class="nav-link program">
                        UK Level Programs <i class="icon-arrow-down"></i>
                    </a>

                    <ul class="dropdown-menu program-dropdown">


                        <li><a class="dropdown-item" href="/courses/level-3-grid">UK-Level 3 Diploma
                                Qualifications</a></li>
                        <li><a class="dropdown-item" href="/courses/level-4-grid-courses">UK-Level 4 Diploma
                                Qualifications</a></li>
                        <li><a class="dropdown-item" href="/courses/level-5-grid">UK-Level 5 Diploma
                                Qualifications</a></li>
                    </ul>
                </li>


                <!--<li class="nav-item dropdown">-->
                <!--  <a href="#" class="nav-link"-->
                <!--    >Programs <i class="icon-arrow-down"></i-->
                <!--  ></a>-->
                <!--             <ul class="dropdown-menu">-->
                <!--    <li class="nav-item dropdown">-->
                <!--        <a-->
                <!--          class="nav-link"-->
                <!--          href="/level-3-diploma-in-education-and-training"-->
                <!--          >Level 3 - Diploma in Education and Training-->
                <!--        </a>-->
                <!--      </li>-->
                <!--      <li class="nav-item dropdown">-->
                <!--        <a-->
                <!--          class="nav-link"-->
                <!--          href="/level-3-award-in-assessing-vocationally-related-achievement"-->
                <!--          >Level 3 - Award in Assessing Vocationally Related-->
                <!--          Achievement (RQF )-->
                <!--        </a>-->
                <!--      </li>-->
                <!--       <li class="nav-item dropdown">-->
                <!--    <a-->
                <!--      class="nav-link"-->
                <!--      href="/level-3-foundation-diploma-in-accountancy"-->
                <!--      >Level 3 - Diploma in Accountancy-->
                <!--    </a>-->
                <!--  </li>-->
                <!--      <li class="nav-item dropdown">-->
                <!--        <a-->
                <!--          class="nav-link"-->
                <!--          href="/online-electrical-vehicle-engineering-course"-->
                <!--          >Electrical Vehicle Engineering Course-->
                <!--        </a>-->
                <!--      </li>-->
                <!--  <li class="nav-item dropdown">-->
                <!--    <a-->
                <!--      class="nav-link"-->
                <!--      href="/level-4-and-5-diploma-in-accounting-and-business.blade.php"-->
                <!--      >Level 4 & 5 - Diploma in Accounting and Business-->
                <!--    </a>-->
                <!--  </li>-->
                <!--  <li class="nav-item dropdown">-->
                <!--    <a-->
                <!--      class="nav-link"-->
                <!--      href="/level-4&5-diploma-in-education-and-training"-->
                <!--      >Level 4 & 5 - Diploma in Education and Training-->
                <!--    </a>-->
                <!--  </li>-->

                <!--  <li class="nav-item dropdown">-->
                <!--    <a-->
                <!--      class="nav-link"-->
                <!--      href="/level-4&5-diploma-in-hospitality-tourism-management"-->
                <!--      >Level 4 & 5 - Diploma in Hospitality & Tourism Management-->
                <!--    </a>-->
                <!--  </li>-->
                <!--      <li class="nav-item dropdown">-->
                <!--      <a-->
                <!--        class="nav-link"-->
                <!--        href="/study-online-data-analysis-course"-->
                <!--        >Data Analysis Training Course-->
                <!--      </a>-->
                <!--    </li>-->
                <!--    <li class="nav-item dropdown">-->
                <!--      <a-->
                <!--        class="nav-link"-->
                <!--        href="/study-online-data-science-with-ai"-->
                <!--        >Data Science with AI Training Course-->
                <!--      </a>-->
                <!--    </li>-->
                <!--    <li class="nav-item dropdown">-->
                <!--      <a-->
                <!--        class="nav-link"-->
                <!--        href="/study-online-python-web-development-course"-->
                <!--        >Python Web Development Course-->
                <!--      </a>-->
                <!--    </li>-->
                <!--</ul>-->
                <!--  <ul class="dropdown-menu">-->
                <!--       <b class="mx-3"-->
                <!--    >Accounting and Finance Training</b-->
                <!--  >-->
                <!--        <li class="nav-item dropdown pb-2">-->
                <!--      <a-->
                <!--        class="nav-link"-->
                <!--        href="/oracle-financials-training-course-in-UAE"-->
                <!--      >-->
                <!--        Oracle Financials Programme-->
                <!--      </a>-->
                <!--    </li>-->

                <!--  <b class="mx-3"-->
                <!--    >Construction,Mechanical & Built Environment Skills-->
                <!--    Training</b-->
                <!--  >-->
                <!--  <li class="nav-item dropdown">-->
                <!--      <a-->
                <!--        class="nav-link"-->
                <!--        href="/online-chemical-engineering-diploma"-->
                <!--      >-->
                <!--      Chemical Engineering Programme-->
                <!--      </a>-->
                <!--    </li>-->
                <!--  <li class="nav-item dropdown pb-2">-->
                <!--    <a-->
                <!--      class="nav-link"-->
                <!--      href="/online-mechatronics-engineering-diploma-program"-->
                <!--    >-->
                <!--      Mechatronics Engineering Programme-->
                <!--    </a>-->
                <!--  </li>-->

                <!--       <b class="mx-3"-->
                <!--    >Other Courses</b-->
                <!--  >-->
                <!--  <li class="nav-item dropdown">-->
                <!--    <a-->
                <!--      class="nav-link"-->
                <!--      href="/online-electrical-vehicle-engineering-course"-->
                <!--      >Electrical Vehicle Engineering Course-->
                <!--    </a>-->
                <!--  </li>-->

                <!--  <li class="nav-item dropdown">-->
                <!--    <a-->
                <!--      class="nav-link"-->
                <!--      href="/study-online-data-analysis-course"-->
                <!--      >Data Analysis Training Course-->
                <!--    </a>-->
                <!--  </li>-->
                <!--  <li class="nav-item dropdown">-->
                <!--    <a-->
                <!--      class="nav-link"-->
                <!--      href="/study-online-data-science-with-ai"-->
                <!--      >Data Science with AI Training Course-->
                <!--    </a>-->
                <!--  </li>-->
                <!--  <li class="nav-item dropdown">-->
                <!--    <a-->
                <!--      class="nav-link"-->
                <!--      href="/study-online-python-web-development-course"-->
                <!--      >Python Web Development Course-->
                <!--    </a>-->
                <!--  </li>-->
                <!--</ul>-->
                <!--</li>-->

                <li class="nav-item dropdown">
                    <a href="{{ route('get.contact') }}" class="nav-link">Contact Us </a>
                </li>
            </ul>

            <!-- Navbar Toggle -->
            <ul class="navbar-nav toggle">
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#menu">
                        <i class="icon-menu m-0"></i>
                    </a>
                </li>
            </ul>

            <!-- Navbar Action -->
            <ul class="navbar-nav action">
                <li class="nav-item ml-3">
                    @if (\Illuminate\Support\Facades\Auth::check())
                        <a href="{{ route('students.get.dashboard') }}"
                            class="btn ml-lg-auto primary-button">Dashboard</a>
                    @else
                        <a href="{{ route('get.register') }}" class="btn ml-lg-auto primary-button">
                            <i class="icon-rocket"></i>Register Now
                        </a>
                        &nbsp;
                        <a href="{{ route('get.login') }}" class="btn ml-lg-auto primary-button">Login</a>
                    @endif
                    <!--Suggestion: Replace the purchase button above with a contact button. <a href="#contact" class="smooth-anchor btn ml-lg-auto primary-button"><i class="icon-rocket"></i>CONTACT US</a>-->
                </li>
            </ul>
        </div>
    </nav>
</header>
