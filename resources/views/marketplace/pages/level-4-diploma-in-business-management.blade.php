<?php $page = 'Advancing Careers Through Professional Development | Know More About Us'; ?>
@extends('frontend.layouts.front_layout')
@section('style')
    <style>
        /* Styles for small screens menu tab*/
        @media (max-width: 768px) {
            .tab-ul {
                display: none;
                flex-direction: column;
                align-items: center;
                background: rgba(0, 0, 0, 0.9);
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                z-index: 1000;
                justify-content: center;
                padding: 20px;
            }

            .tab-ul.show {
                display: flex;
            }

            .tab-list a {
                color: #fff;
                font-size: 20px;
                padding: 15px;
            }

            .menu-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                background: #111111;
                color: #fff;
                padding: 10px 15px;
                border-radius: 5px;
                cursor: pointer;
                width: 120px;
                margin: 3px;
            }

            .nav-link-p {
                padding: 0rem 1rem !important;
            }

            .menu-btn i {
                font-size: 22px;
            }

            .menu-container {
                position: sticky;
                display: flex;
                justify-content: center;
                top: 79px;
                z-index: 999;
                background: white;
                text-align: center;
                padding: 10px;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            }

            /* Close button inside the menu */
            .close-menu {
                position: absolute;
                top: 15px;
                right: 20px;
                color: #fff;
                font-size: 24px;
                cursor: pointer;
            }

            .tab-list {
                border: none;
            }
        }
    </style>

    <style>
        /* Basic styles */

        /* Styles for the modal */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
        }

        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #f5f5f5;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
            z-index: 10000;
            width: 90%;
            max-width: 500px;
            height: 400px;
            border-radius: 8px;
        }

        .close-modal {
            position: absolute;
            top: 8px;
            right: 15px;
            cursor: pointer;
            font-size: 2rem;
        }
    </style>
    <style>
        .iti {
            /* display: block !important; */
            width: 100%;
        }

        .field-phone {
            padding-left: 100px !important;
        }

        .iti__selected-country {
            background: #f5f5f5;
        }
    </style>

    <style>
        form {
            display: flex;
            flex-direction: column;
        }

        button {
            padding: 10px;
            cursor: pointer;
        }

        .primary-button {
            z-index: 0;
        }
    </style>

    <!-- ==============================================
                                                                                                                                                                                                                                                                                Theme Settings
                                                                                                                                                                                                                                                                                =============================================== -->
    <style>
        :root {
            --header-bg-color: #111111;
            --nav-item-color: #f5f5f5;
            --top-nav-item-color: #f5f5f5;
            --hero-bg-color: #000000;

            --section-1-bg-color: #f5f5f5;
            --section-2-bg-color: #111111;
            --section-3-bg-color: #f5f5f5;

            --footer-bg-color: #191919;
        }

        .content input {
            display: none;
        }

        .content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content .list {
            display: flex;
            flex-direction: column;
            position: relative;
            margin-right: 50px;
        }

        .content .list label {
            cursor: pointer;
            line-height: 60px;
            font-size: 22px;
            font-weight: 500;
            padding-right: 10px;
            padding-left: 25px;
            transition: all 0.5s ease;
            z-index: 10;
        }

        #program-spec:checked~.list label.program-spec,
        #program-module:checked~.list label.program-module,
        #uk-levels:checked~.list label.uk-levels,
        #how-to-apply:checked~.list label.how-to-apply,
        #program-fees:checked~.list label.program-fees,
        #admission-requirement:checked~.list label.admission-requirement,
        #accreditation:checked~.list label.accreditation,
        #outcome:checked~.list label.outcome {
            color: #fff;
        }

        .content .slider {
            position: absolute;
            left: 0;
            top: 0;
            height: 60px;
            width: 100%;
            border-radius: 12px;
            transition: all 0.5s ease;

            background: brown;
        }

        #program-spec:checked~.list .slider {
            top: 0;
        }

        #program-module:checked~.list .slider {
            top: 60px;
        }

        #outcome:checked~.list .slider {
            top: 120px;
        }

        .content .text-content {
            width: 60%;
            height: 100%;
        }

        .content .text {
            display: none;
        }

        .content .text .title {
            font-size: 25px;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .container .text p {
            text-align: justify;
        }

        .content .text-content .program-spec {
            display: block;
        }

        #program-spec:checked~.text-content .program-spec,
        #program-module:checked~.text-content .program-module,
        #uk-levels:checked~.text-content .uk-levels,
        #how-to-apply:checked~.text-content .how-to-apply,
        #program-fees:checked~.text-content .program-fees,
        #admission-requirement:checked~.text-content .admission-requirement,
        #accreditation:checked~.text-content .accreditation,
        #outcome:checked~.text-content .outcome {
            display: block;
        }

        #program-module:checked~.text-content .program-spec,
        #uk-levels:checked~.text-content .program-spec,
        #how-to-apply:checked~.text-content .program-spec,
        #program-fees:checked~.text-content .program-spec,
        #admission-requirement:checked~.text-content .program-spec,
        #accreditation:checked~.text-content .program-spec,
        #outcome:checked~.text-content .program-spec {
            display: none;
        }

        .content .list label:hover {
            color: brown;
        }

        :root {
            --ring-size: calc(min(200px, 14vw));
            --ring-border-size: calc(var(--ring-size) * 0.1);
            --ring-offset-left: calc(var(--ring-size) + var(--ring-border-size));
            --ring-offset-top: calc((var(--ring-size) - var(--ring-border-size)) * 0.5);

            --logo-size-w: calc((var(--ring-size) * 3 + var(--ring-border-size) * 2) * 1.5);
            --logo-size-h: calc((var(--ring-size) * 1.5 - var(--ring-border-size) * 0.5) * 2);
            --logo-bg-color: #f1f1f1;
        }

        .header-wrapper {
            margin: 50px 0px 0 0;
            position: relative;
        }

        .gallery-box {
            height: calc(var(--logo-size-h) * 1.25);
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr calc(var(--logo-size-w) * 0.6) 1fr 1fr 1fr 1fr;
            grid-template-rows: 1fr 1fr 1fr 1fr;
            grid-template-areas:
                "p6 p6 p6 p6 . p5 p5 p4 p4"
                "p6 p6 p6 p6 . p5 p5 p4 p4"
                "p1 p1 p7 p7 . p2 p2 p2 p3"
                "p1 p1 p8 p8 . p2 p2 p2 p3";
        }

        .i1 {
            background: url("./assets/images/gal1.webp");
            grid-area: p1;
        }

        .i2 {
            background: url("./assets/images/gal2.webp");
            grid-area: p2;
        }

        .i3 {
            background: url("./assets/images/gal3.webp");
            grid-area: p3;
        }

        .i4 {
            background: url("./assets/images/gal4.webp");
            grid-area: p4;
        }

        .i5 {
            background: url("./assets/images/gal5.webp");
            grid-area: p5;
        }

        .i6 {
            background: url("./assets/images/gal6.webp");
            grid-area: p6;
        }

        .i7 {
            background: url("./assets/images/gal7.webp");
            grid-area: p7;
        }

        .i8 {
            background: url("./assets/images/gal8.webp");
            grid-area: p8;
        }

        .photo {
            background-position: center;
            background-size: cover;
        }

        .dwc-logo {
            clip-path: polygon(0 0, 100% 0, 80% 100%, 20% 100%);
            background: linear-gradient(to bottom, #fff, #fff);
            width: calc(var(--logo-size-w) * 1);
            height: calc(var(--logo-size-h) * 1.25);
            margin: 0 auto;
            padding: 20px 0;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, 0);
        }

        .olympic-rings {
            position: relative;
            width: calc(var(--ring-size) * 3 + var(--ring-border-size) * 2);
            height: calc(var(--ring-size) * 1.5 - var(--ring-border-size) * 0.5);
            margin: 158px auto;
        }

        .button-enrollNow {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .enroll-button {
            background: linear-gradient(135deg, #ff8a00, #e52e71);
            color: #fff;
            font-size: 18px;
            font-weight: 600;
            padding: 14px 24px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            align-items: center;
            width: 250px;
            max-width: 250px;
            text-align: center;
        }

        .enroll-button:hover {
            background: linear-gradient(135deg, #e67e22, #d63031);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
            transform: translateY(-2px);
        }

        .enroll-button:active {
            transform: translateY(0);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
    <style>
        .facts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 16px;
            max-width: 900px;
            /* controls overall width */
            margin: 0 auto;
            /* centers grid */
        }

        .fact-box {
            background: #fff;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
            /* border: 2px solid rebeccapurple; */
        }

        .enroll-button {
            margin: 10px 0px;
        }
    </style>
    <style>
        .why-section {
            background: #ffffff;
            padding: 70px 0;
        }

        .why-header {
            text-align: center;
            max-width: 900px;
            margin: 0 auto 40px;
        }

        .why-header h3 {
            font-size: 28px;
            font-weight: 600;
            line-height: 1.4;
        }

        .why-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
        }

        .why-card {
            background: #fff;
            padding: 32px 24px;
            border-radius: 14px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .why-card i {
            font-size: 34px;
            color: #ff4a17;
            margin-bottom: 16px;
        }

        .why-card h4 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .why-card p {
            font-size: 15px;
            color: #555;
            line-height: 1.6;
        }

        .why-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.08);
        }

        @media (max-width: 576px) {
            .why-header h3 {
                font-size: 22px;
            }

            .why-card {
                padding: 24px 18px;
            }
        }
    </style>
@endsection
@section('content')
    <!-- Hero -->
    <section id="slider" class="hero p-0 odd">
        <div class="swiper-container no-slider slider-h-75">
            <div class="swiper-wrapper">
                <!-- Item 1 -->
                <div class="swiper-slide slide-center">
                    <img src="/frontend/assets/images/programs-banner/webp/Education and training.webp" class="full-image"
                        data-mask="70" />

                    <div class="slide-content row text-center">
                        <div class="col-12 mx-auto inner">
                            <h1 data-aos="zoom-out-up" data-aos-delay="400" class="title effect-static-text"
                                style="font-size: 3rem !important">
                                Level 4 Diploma in Business Management Course
                            </h1>
                            <h6 style="color: #000">Build a Successful Career in Diploma in Business Management Course
                                with a Flexible Online
                                Diploma</h6>
                        </div>
                        <!--<div class="col-12 row align-items-center justify-content-center">-->
                        <!--  <button-->
                        <!--    type="button"-->
                        <!--    class="btn primary-button"-->
                        <!--    id="open-modal"-->
                        <!--  >-->
                        <!--    Download Brochure-->
                        <!--    <i class="icon-arrow-down-circle left"></i>-->
                        <!--  </button>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Fun Facts -->
    <section id="funfacts" class="section-3" style="padding: 10px 0px">
        <div class="container">
            <div class="facts-grid">
                <div class="fact-box">
                    <h4>Mode of Study</h4>
                    <span>Online</span>
                </div>

                <div class="fact-box">
                    <h4>Program Duration</h4>
                    <span>1 Year</span>
                </div>

                <div class="fact-box">
                    <h4>UK Qualification</h4>
                    <span>Level 4</span>
                </div>
            </div>
        </div>
    </section>
    <div class="button-enrollNow">
        @if (\Illuminate\Support\Facades\Auth::check())
            <a href="{{ route('courses.checkout', $course->slug) }}" class="enroll-button">
                Enroll Now
            </a>
        @else
            <a class="enroll-button" href="{{ route('get.login') }}">
                Enroll Now
            </a>
        @endif


    </div>
    <!-- About [image] -->
    <section id="about" class="section-1 highlights image-right" style="padding: 20px 0px">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 align-self-center text-center text-md-left">
                    <div class="row intro">
                        <div class="col-12 p-0">
                            <h3 class="featured alt">
                                How Does Level 4 Diploma in Business Management Strengthen My Professional Foundation?
                            </h3>
                            <p style="text-align: justify">
                                This Level 4 Diploma in Business Management equips you with essential academic knowledge and
                                practical business skills required to succeed in today’s competitive business environment.
                                The programme covers core concepts ranging from academic writing and research skills to
                                business operations, communication, finance, leadership, and global business practices.

                                You will develop a strong understanding of how modern organizations operate by learning key
                                business principles, management techniques, and decision-making frameworks. Through
                                structured learning and real-world business scenarios, the course strengthens your
                                analytical thinking, problem-solving abilities
                            </p>
                            <a href="/courses/contact" class="btn primary-button button">Apply Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <a href="#">
                        <img src="/frontend/assets/images/level-4-business-management.jpg" class="fit-image"
                            alt="Chemical Engineering Program" />
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="section-1" style="background-color: #fff; padding: 40px 0">

        <!-- <div class="row mt--40 nav-sticky sticky-top d-none d-md-block z-0" style="top: 84px">
                                                                                                                                                                                                                                                                                    <div class="col-12 col-md-12 align-self-center text-center">
                                                                                                                                                                                                                                                                                      <main>
                                                                                                                                                                                                                                                                                        <ul class="tab-ul">
                                                                                                                                                                                                                                                                                          <li class="tab-list">
                                                                                                                                                                                                                                                                                            <a href="#section1"><span>Course Overview</span> </a>
                                                                                                                                                                                                                                                                                          </li>
                                                                                                                                                                                                                                                                                          <li class="tab-list">
                                                                                                                                                                                                                                                                                            <a href="#section2"> <span>Course Objective</span> </a>
                                                                                                                                                                                                                                                                                          </li>
                                                                                                                                                                                                                                                                                          <li class="tab-list">
                                                                                                                                                                                                                                                                                            <a href="#section3"><span>Course Module</span> </a>
                                                                                                                                                                                                                                                                                          </li>
                                                                                                                                                                                                                                                                                          <li class="tab-list">
                                                                                                                                                                                                                                                                                            <a href="#section4"> <span>Course specification</span> </a>
                                                                                                                                                                                                                                                                                          </li>
                                                                                                                                                                                                                                                                                          <li class="tab-list">
                                                                                                                                                                                                                                                                                            <a href="#section5"><span>Learning outcomes</span> </a>
                                                                                                                                                                                                                                                                                          </li>
                                                                                                                                                                                                                                                                                          <li class="tab-list">
                                                                                                                                                                                                                                                                                              <a href="#section6"><span>Skills Covered</span> </a>
                                                                                                                                                                                                                                                                                            </li>
                                                                                                                                                                                                                                                                                        </ul>
                                                                                                                                                                                                                                                                                      </main>
                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                  </div> -->
        <!-- Sticky Menu Button for Small Screens -->
        <div class="menu-container d-md-none">
            <div class="menu-btn" onclick="toggleMenu()">
                <i class="fas fa-bars"></i> Menu
            </div>
            <div class="menu-btn" onclick="document.getElementById('contact').scrollIntoView({ behavior: 'smooth' })">
                Enroll Now
            </div>
        </div>

        <!-- Desktop Tab Menu -->
        <div class="row mt--40 nav-sticky sticky-top d-none d-md-block z-0" style="top: 84px">
            <div class="col-12 col-md-12 align-self-center text-center">
                <main>
                    <ul class="tab-ul">
                        <li class="tab-list">
                            <a href="#section1"><span>Overview</span> </a>
                        </li>
                        <li class="tab-list">
                            <a href="#section2"> <span>Objective</span> </a>
                        </li>
                        <li class="tab-list">
                            <a href="#section3"><span>Module</span> </a>
                        </li>
                        <li class="tab-list">
                            <a href="#section4"> <span>specification</span> </a>
                        </li>
                        <li class="tab-list">
                            <a href="#section5"><span>Learning outcomes</span> </a>
                        </li>
                        <li class="tab-list">
                            <a href="#section6"><span>Skills Covered</span> </a>
                        </li>
                        <li class="tab-list">
                            <a href="#section7"><span>Accreditations</span> </a>
                        </li>
                        <li class="tab-list">
                            <a href="#section8"><span>FAQ</span> </a>
                        </li>
                    </ul>
                </main>
            </div>
        </div>

        <!-- Mobile Fullscreen Menu -->
        <ul class="tab-ul d-md-none" id="mobileMenu">
            <span class="close-menu" onclick="closeMenu()">✖</span>
            <li class="tab-list">
                <a href="#section1" onclick="scrollToSection(event)">Overview</a>
            </li>
            <li class="tab-list">
                <a href="#section2" onclick="scrollToSection(event)">Objective</a>
            </li>
            <li class="tab-list">
                <a href="#section3" onclick="scrollToSection(event)">Course Module</a>
            </li>
            <li class="tab-list">
                <a href="#section4" onclick="scrollToSection(event)">Specification</a>
            </li>
            <li class="tab-list">
                <a href="#section5" onclick="scrollToSection(event)">Learning Outcomes</a>
            </li>
            <li class="tab-list">
                <a href="#section6" onclick="scrollToSection(event)">Skills Covered</a>
            </li>
            <li class="tab-list">
                <a href="#section7" onclick="scrollToSection(event)">Accreditations</a>
            </li>
            <li class="tab-list">
                <a href="#section8" onclick="scrollToSection(event)">FAQ</a>
            </li>
        </ul>
        <div class="container">


            <div id="section1" class="content-section" style="padding: 10px 0px">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Course Overview</h3>
                        <p>
                            The OTHM Level 4 Diploma in Business Management provides a comprehensive foundation in core
                            business and management principles essential for today’s dynamic business environment. The
                            programme is designed to develop learners’ understanding of how organizations operate, focusing
                            on key areas such as business operations, communication, finance, leadership, and global
                            business practices.

                            This diploma emphasizes academic and professional skill development, including research and
                            academic writing, effective communication, financial awareness, and team leadership. Learners
                            gain practical insights into decision-making, problem-solving, and strategic thinking through
                            structured learning and real-world business scenarios.

                            Suitable for aspiring managers, entrepreneurs, and working professionals, the programme prepares
                            learners to progress confidently into higher-level qualifications or entry-level management
                            roles. By the end of the course, learners will have a strong academic and professional
                            foundation to succeed in business management studies and modern organizational environments.
                        </p>
                    </div>
                </div>
            </div>

            <div id="section2" class="content-section" style="padding: 10px 0px">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Course Objective</h3>
                        <ul>
                            <li>
                                <b>Develop Core Business Management Knowledge:</b> Build a strong foundation in key business
                                and management concepts, including organizational structures, business operations, and
                                management principles.
                            </li>

                            <li>
                                <b>Enhance Academic Writing and Research Skills:</b> Develop effective academic writing,
                                research, and analytical skills required for higher education and professional business
                                studies.
                            </li>

                            <li>
                                <b>Apply Financial and Operational Understanding:</b> Gain practical knowledge of finance,
                                accounting, and business operations to support informed decision-making within
                                organizations.
                            </li>

                            <li>
                                <b>Strengthen Leadership and Communication Skills:</b> Learn to communicate effectively,
                                manage teams, and operate confidently in diverse and global business environments.
                            </li>


                        </ul>
                    </div>
                </div>
            </div>

            <div id="section3" class="content-section" style="padding: 10px 0px">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Program Modules</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered"
                                style="
                    border-collapse: collapse !important;
                    border-spacing: 0 !important;
                  ">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Title</th>
                                        <th>Duration</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Unit 1: Academic Writing and Research Skills</td>
                                        <td>200 Hours</td>
                                        <td>Develop academic writing, research, and referencing skills for business studies.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Unit 2: Business Operations</td>
                                        <td>200 Hours</td>
                                        <td>Understand how businesses plan, manage, and improve operational activities.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Unit 3: Communication in Business</td>
                                        <td>200 Hours</td>
                                        <td>Learn effective communication methods used in professional business
                                            environments.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Unit 4: Finance and Accounting</td>
                                        <td>200 Hours</td>
                                        <td>Gain basic financial and accounting knowledge for business decision-making.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Unit 5: Leading and Managing Teams</td>
                                        <td>200 Hours</td>
                                        <td>Develop leadership skills and understand team management practices.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Unit 6: Operating in a Global Context</td>
                                        <td>200 Hours</td>
                                        <td>Understand global business operations and international business environments.
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="section4" class="content-section" style="padding: 10px 0px">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Program Specification</h3>

                        <div class="table-responsive">
                            <table class="table table-bordered"
                                style="
                    border-collapse: collapse !important;
                    border-spacing: 0 !important;
                  ">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Qualification Title</th>
                                        <th>Mode of Study</th>
                                        <th>Duration</th>
                                        <th>Assessment</th>
                                        <th>Certification</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Level-4 Diploma In Business Management</td>
                                        <td>100% Online</td>
                                        <td>Flexible (1 Year)</td>
                                        <td>Assignments, hands-on projects</td>
                                        <td>Internationally recognized qualification</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row justify-content-center">
                            <a href="/courses/contact" class="btn primary-button button">Enquiry Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="section5" class="content-section" style="padding: 10px 0px">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Learning outcomes</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <ul>
                                    <li>
                                        Understand core business management concepts, organizational structures, and
                                        management principles.
                                    </li>
                                    <li>
                                        Apply academic writing and research skills to produce structured and well-referenced
                                        business assignments.
                                    </li>
                                    <li>
                                        Analyze business operations, financial information, and management practices to
                                        support effective decision-making.
                                    </li>
                                    <li>
                                        Demonstrate effective communication, leadership, and teamwork skills within
                                        professional and global business environments.
                                    </li>


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="section6" class="content-section pb-5" style="padding: 10px 0px">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Skills Covered</h3>
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Business management fundamentals</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Academic writing and research skills</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Business communication techniques</span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Financial and accounting basics</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Leadership and team management</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Global business awareness</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="button-enrollNow">
        @if (\Illuminate\Support\Facades\Auth::check())
            <a href="{{ route('courses.checkout', $course->slug) }}" class="enroll-button">
                Apply Now
            </a>
        @else
            <a class="enroll-button" href="{{ route('get.login') }}">
                Apply Now
            </a>
        @endif


    </div>
    <section id="features" class="section-2 odd offers" style="padding: 40px 0 !important">
        <div class="container">
            <h3 class="text-center">
                Why Choose ASTI Online for Level-4 Diploma In Business Management?
            </h3>
            <div class="row justify-content-center text-center items">
                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-globe"></i>
                        <h4>Flexible Online Learning</h4>
                        <p>Study at your convenience with structured online learning designed to fit around academic,
                            professional, and personal commitments without compromising learning quality.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-basket"></i>
                        <h4>Industry-Aligned Curriculum</h4>
                        <p>
                            Gain practical business and management knowledge aligned with current industry standards,
                            covering operations, finance, communication, leadership, and global business practices.
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-layers"></i>
                        <h4>Assignment & Practical Learning</h4>
                        <p>
                            Learn through case studies, real-world business scenarios, and assignment-based assessments that
                            strengthen analytical thinking and practical decision-making skills.
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-graduation"></i>
                        <h4>Career Advancement Opportunities</h4>
                        <p>
                            Prepare for entry-level management roles, career progression, or further academic study with
                            skills that enhance employability and professional growth across industries.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features -->

    <section id="section7" class="section-3 highlights image-right" style="background-color: #fff; padding:10px 0px ">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">
                    <h3 class="text-center">Our Accreditations & Recognitions</h3>
                    <p>
                        ASTI Academy offers government-approved vocational educational
                        certification programs in Dubai and is recognized and accredited
                        by the Government of Dubai, KHDA, TVET, Ofqual, and other
                        international educational legal authorities.
                    </p>
                </div>
            </div>

            <div class="col-12">
                <div class="row divided-list">
                    <div class="col-md-3 divided-col"
                        style="
                display: flex;
                justify-content: center;
                align-items: center;
              ">
                        <div class="divided-col-item" style="margin: 10px; padding: 10px">
                            <a href="assets/images/wes-logo.png">
                                <img src="/frontend/assets/images/wes-logo.png" alt="About Us" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 divided-col"
                        style="
                display: flex;
                justify-content: center;
                align-items: center;
              ">
                        <div class="divided-col-item" style="margin: 10px; padding: 10px">
                            <a href="assets/images/sce-logo.png">
                                <img src="/frontend/assets/images/sce-logo.png" alt="About Us" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 divided-col"
                        style="
                display: flex;
                justify-content: center;
                align-items: center;
              ">
                        <div class="divided-col-item" style="margin: 10px; padding: 10px">
                            <a href="assets/images/mof-logo.png">
                                <img src="/frontend/assets/images/mof-logo.png" alt="About Us" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 divided-col"
                        style="
                display: flex;
                justify-content: center;
                align-items: center;
              ">
                        <div class="divided-col-item" style="margin: 10px; padding: 10px">
                            <a href="assets/images/khd-logo.png">
                                <img src="/frontend/assets/images/khd-logo.png" alt="About Us" />
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3 divided-col"
                        style="
                display: flex;
                justify-content: center;
                align-items: center;
              ">
                        <div class="divided-col-item" style="margin: 10px; padding: 10px">
                            <a href="assets/images/moh-logo.png">
                                <img src="/frontend/assets/images/moh-logo.png" alt="About Us" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 divided-col"
                        style="
                display: flex;
                justify-content: center;
                align-items: center;
              ">
                        <div class="divided-col-item" style="margin: 10px; padding: 10px">
                            <a href="assets/images/qad-logo.png">
                                <img src="/frontend/assets/images/qad-logo.png" alt="About Us" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 divided-col"
                        style="
                display: flex;
                justify-content: center;
                align-items: center;
              ">
                        <div class="divided-col-item" style="margin: 10px; padding: 10px">
                            <a href="assets/images/ofqual-logo.png">
                                <img src="/frontend/assets/images/ofqual-logo.png" alt="About Us" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 divided-col"
                        style="
                display: flex;
                justify-content: center;
                align-items: center;
              ">
                        <div class="divided-col-item" style="margin: 10px; padding: 10px">
                            <a href="assets/images/tvet-logo.png">
                                <img src="/frontend/assets/images/tvet-logo.png" alt="About Us" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="features" class="offers" style="background-color: #000 !important; padding: 20px 0">
        <div class="container">
            <div class="row justify-content-center items">
                <div class="col-12 col-md-12 col-lg-12" style="display: flex">
                    <h4 style="color: #ff0101">
                        We have changed the lives of over 300,000 students since 1995. Now
                        it’s your turn!
                    </h4>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="tel:+971564157272" class="btn primary-button">
                        Call Now</a>
                </div>
            </div>
        </div>
    </section>
    <section id="section8" class="section-6 subscribe" style="padding: 20px 0px">
        <div class="container smaller">
            <div class="row text-center intro">
                <div class="col-12">
                    <h3>Frequently Asked Questions</h3>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="faq-container col-12">
                    <div class="faq">
                        <h5 class="faq-title">Who can enroll in the OTHM Level 4 Diploma in Business Management?</h5>
                        <p class="faq-text">
                            This programme is suitable for school leavers, diploma holders, graduates, and working
                            professionals who wish to build a strong foundation in business and management or progress to
                            higher-level qualifications.
                        </p>
                        <button class="faq-toggle">
                            <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                            </svg>

                            <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <div class="faq">
                        <h5 class="faq-title">Do I need prior business or management experience to join this course?</h5>
                        <p class="faq-text">
                            No prior business experience is required. The programme starts with fundamental concepts and
                            gradually develops academic, analytical, and managerial skills suitable for beginners.
                        </p>
                        <button class="faq-toggle">
                            <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                            </svg>

                            <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <div class="faq">
                        <h5 class="faq-title">
                            Is this qualification recognized internationally?
                        </h5>
                        <p class="faq-text">
                            Yes. OTHM qualifications are regulated and recognized internationally, allowing learners to
                            progress to higher-level studies or pursue career opportunities globally.
                        </p>
                        <button class="faq-toggle">
                            <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                            </svg>

                            <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <div class="faq">
                        <h5 class="faq-title">What assessment methods are used in this programme?</h5>
                        <p class="faq-text">
                            Assessment is assignment-based, including written assignments, case studies, and practical
                            tasks. There are no written examinations for this qualification.
                        </p>
                        <button class="faq-toggle">
                            <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                            </svg>

                            <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <div class="faq">
                        <h5 class="faq-title">
                            Will I receive a certificate after completing the programme?
                        </h5>
                        <p class="faq-text">
                            Yes. Learners who successfully complete all required units and assessments will receive the OTHM
                            Level 4 Diploma in Business Management certificate.
                        </p>
                        <button class="faq-toggle">
                            <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                            </svg>

                            <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <div class="faq">
                        <h5 class="faq-title">What career or academic progression options are available after completion?
                        </h5>
                        <p class="faq-text">
                            Graduates can progress to OTHM Level 5 qualifications, higher national diplomas, or
                            undergraduate degree programmes, as well as pursue entry-level roles in business and management.
                        </p>
                        <button class="faq-toggle">
                            <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                            </svg>

                            <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>


                </div>

            </div>

        </div>
    </section>
    <!-- Features -->
    <section id="why-business-management" class="why-section">
        <div class="container">
            <div class="why-header">
                <h3>What are the 4 reasons to study Business Management?</h3>
            </div>

            <div class="why-grid">
                <div class="why-card">
                    <i class="icon icon-globe"></i>
                    <h4>Growing Industry Demand</h4>
                    <p>
                        Business management professionals are in demand across
                        finance, retail, healthcare, technology, and operations,
                        supporting organizational growth and performance.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-basket"></i>
                    <h4>Technology-Driven Career Path</h4>
                    <p>
                        Modern organizations rely on digital tools, data analysis,
                        and strategic decision-making, making business management
                        a future-focused career choice.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-screen-smartphone"></i>
                    <h4>Practical & Job-Oriented Skills</h4>
                    <p>
                        Learn through real-world case studies and assignments that
                        build skills in leadership, finance, communication, and
                        operations management.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-layers"></i>
                    <h4>Wide Career Opportunities</h4>
                    <p>
                        Progress into entry-level management roles, supervisory
                        positions, or higher academic qualifications in business
                        and management.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- Testimonials -->
    {{-- <section id="testimonials" class="section-3 carousel" style="background-color: #fff">
        <div class="overflow-holder">
            <div class="container">
                <div class="row text-center intro">
                    <div class="col-12">
                        <h3>Testimonials</h3>
                    </div>
                </div>
                <div class="swiper-container mid-slider items">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/18.webp" alt="Adams Baker"
                                        class="person" />
                                    <h4>Christina</h4>
                                    <p style="text-align: justify">
                                        The faculty was extremely supportive, and the career
                                        guidance sessions helped me navigate opportunities in the
                                        chemical industry.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/12.webp" alt="Mary Evans"
                                        class="person" />
                                    <h4>Mark R</h4>
                                    <p style="text-align: justify">
                                        The faculty was extremely supportive, and the career
                                        guidance sessions helped me navigate opportunities in the
                                        chemical industry.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/19.webp" alt="Nadia Malik"
                                        class="person" />
                                    <h4>Emma T</h4>
                                    <p style="text-align: justify">
                                        The program covered chemical thermodynamics, safety
                                        regulations, and industrial processes in great detail,
                                        preparing me for an exciting career.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/13.webp" alt="Khalid Mansoor"
                                        class="person" />
                                    <h4>Dinoy</h4>
                                    <p style="text-align: justify">
                                        I managed to study while working full-time. The course
                                        curriculam was industry-relevant, and I gained skills that
                                        helped me to get a better job.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/Comments_68-x-68_6.png" alt="Sara Khan"
                                        class="person" />
                                    <h4>Sarah L</h4>
                                    <p style="text-align: justify">
                                        The inclusion of virtual labs, safety simulations, and
                                        process design projects made this diploma extremely
                                        valuable.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section> --}}



    <div class="button-enrollNow">
        @if (\Illuminate\Support\Facades\Auth::check())
            <button id="pay-button" class="enroll-button">
                Register Now
            </button>
        @else
            <a class="enroll-button" href="{{ route('get.login') }}">
                Register Now
            </a>
        @endif


    </div>
@endsection
