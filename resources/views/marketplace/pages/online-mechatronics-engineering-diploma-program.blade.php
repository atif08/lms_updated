<?php $page = 'Advancing Careers Through Professional Development | Know More About Us'; ?>
@extends('marketplace.layouts.front_layout')
@section('style')
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
                font-size: 18px;
                width: 120px;
                margin: 0 auto;
            }

            .menu-btn i {
                font-size: 22px;
            }

            .menu-container {
                position: sticky;
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
                                Mechatronics
                                Engineering Program
                            </h1>
                            <h6 style="color: #000"> Study Online & Shape the Future with a Mechatronics
                                Engineering Diploma</h6>
                        </div>
                        <!--<div class="col-12
                                row align-items-center justify-content-center">-->
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
                    <span>6 Months</span>
                </div>

                <div class="fact-box" style="display:none">
                    <h4>Program Fee</h4>
                    <span>$599</span>
                </div>
            </div>
        </div>
    </section>
    <!-- About [image] -->
    <div class="button-enrollNow">
        @if (\Illuminate\Support\Facades\Auth::check())
            <a href="{{ route('courses.checkout', $course->slug) }}" class="enroll-button">
                Enroll Now
            </a>
        @else
            <a class="enroll-button" href="{{ route('login') }}">
                Enroll Now
            </a>
        @endif


    </div>
    <section id="about" class="section-1 highlights image-right" style="padding: 20px 0px ">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 align-self-center text-center text-md-left">
                    <div class="row intro">
                        <div class="col-12 p-0">
                            <h3 class="featured alt">
                                What You Will Achieve from the Online Mechatronics Engineering
                                Program </h3>
                            <p style="text-align: justify">
                                The Online Mechatronics Engineering program equips you with
                                automation, robotics, and intelligent systems expertise. This
                                multidisciplinary field integrates mechanical, electrical, and
                                computer engineering, providing a solid foundation for
                                future-ready careers. The program is designed to be flexible,
                                allowing students to gain experience, develop technical
                                skills, and work on real-world projects that align with
                                industry needs. By the end of the program, you will be
                                equipped with in-demand skills to innovate, design, and
                                implement advanced mechatronics solutions in various
                                engineering industries. </p>
                            <a href="/courses/contact" class="btn primary-button button">Apply Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <a href="#">
                        <img src="/frontend/assets/images/mechatronics-engineering-program-1.jpg" class="fit-image"
                            alt="Mechatronics Engineering Program" />
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="section-1" style="background-color: #fff; padding: 40px 0">
        <!-- Sticky Menu Button for Small Screens -->
        <div class="menu-container d-md-none">
            <div class="menu-btn" onclick="toggleMenu()">
                <i class="fas fa-bars"></i> Menu
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
            <div id="section1" class="content-section" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Course Overview</h3>
                        <p>
                            The Online Mechatronics Engineering program is structured to
                            provide a strong foundation in automation, robotics, and control
                            systems. The curriculum combines theoretical knowledge with
                            practical learning, allowing students to develop problem-solving
                            skills in modern engineering. The program is industry-focused,
                            ensuring graduates are well-prepared for roles in advanced
                            manufacturing, AI-driven automation, and robotics engineering.
                        </p>
                    </div>
                </div>
            </div>

            <div id="section2" class="content-section" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Course Objective</h3>
                        <ul>
                            <li>
                                Develop expertise in automation, robotics, and smart
                                technologies.
                            </li>
                            <li>
                                Gain a deep understanding of mechatronic system integration.
                            </li>
                            <li>
                                Learn how to design, test, and optimize intelligent mechanical
                                systems.
                            </li>
                            <li>
                                Enhance problem-solving and analytical skills to address
                                engineering challenges.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="section3" class="content-section" style="padding: 10px 0px ">
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
                                        <td>Module 1: Introduction to Mechatronics Engineering</td>
                                        <td>4 Hours</td>
                                        <td>An introduction to the multidisciplinary field of mechatronics, combining
                                            mechanical, electrical, and computer engineering principles to design and
                                            control smart systems.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 2: Sensors and Actuators</td>
                                        <td>6 Hours</td>
                                        <td>Focuses on the role of sensors and actuators in mechatronic systems, covering
                                            their types, working principles, and applications in automation.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 3: Embedded Systems</td>
                                        <td>6 Hours</td>
                                        <td>Explores the design and application of embedded systems in mechatronics,
                                            including microcontrollers and real-time operating systems used in smart devices
                                            and control systems.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 4: Control Systems</td>
                                        <td>6 Hours</td>
                                        <td>Examines the principles of control theory and how to design and implement
                                            feedback control systems to regulate the behavior of mechatronic devices.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 5: Robotics</td>
                                        <td>8 Hours</td>
                                        <td>Covers the principles of robotic systems, including kinematics, dynamics, and
                                            the design of robotic arms, mobile robots, and autonomous systems.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 6: Mechatronics System Design</td>
                                        <td>6 Hours</td>
                                        <td>Focuses on the integrated design of mechatronic systems, from concept to final
                                            product, emphasizing collaboration between different engineering disciplines.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Module 7: S Automation and Industrial Control</td>
                                        <td>4 Hours</td>
                                        <td>Introduces automation techniques and industrial control systems used in
                                            manufacturing, including PLCs, SCADA, and distributed control systems.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 8: Mechatronics Applications</td>
                                        <td>4 Hours</td>
                                        <td>Examines real-world applications of mechatronics in various industries such as
                                            manufacturing, healthcare, automotive, and consumer electronics.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 9: Future Trends in Mechatronics</td>
                                        <td>4 Hours</td>
                                        <td>Exploration of future technologies and trends in mechatronics.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="section4" class="content-section" style="padding: 10px 0px ">
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
                                        <td>Mechatronics Engineering</td>
                                        <td>100% Online</td>
                                        <td>Flexible (6 months)</td>
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

            <div id="section5" class="content-section" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Learning outcomes</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <ul>
                                    <li>
                                        Gain expertise in automation, control systems, and
                                        AI-driven technologies.
                                    </li>
                                    <li>
                                        Learn how to design and develop robotic and autonomous
                                        systems.
                                    </li>
                                    <li>
                                        Master the use of embedded systems and industrial IoT
                                        applications.
                                    </li>
                                    <li>
                                        Understand sensor integration, power electronics, and
                                        mechanical design.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="section6" class="content-section pb-5" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Skills Covered</h3>
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Mechanical Systems & Design</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Electrical & Electronic Circuit Design</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Embedded Systems & Microcontrollersr</span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Control Systems & AI Integration</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Software & Programming Skills</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Advanced Manufacturing & Industry 4.0
                                        Technologies</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section
                                                              id="about"
                                                              class="section-1 highlights image-right"
                                                              style="padding: 40px 0"
                                                            >
                                                              <div class="container">
                                                                <div class="row">
                                                                  <div class="col-12 col-md-12 align-self-center text-center">
                                                                    <div class="row intro">
                                                                      <div class="col-12 p-0">
                                                                        <h3 class="featured alt">UK Level System</h3>
                                                                        <img src="assets/images/uk-level.png" />
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </section> -->
    <!-- Features -->
    <div class="button-enrollNow">
        @if (\Illuminate\Support\Facades\Auth::check())
            <a href="{{ route('courses.checkout', $course->slug) }}" class="enroll-button">
                Enroll Now
            </a>
        @else
            <a class="enroll-button" href="{{ route('login') }}">
                Enroll Now
            </a>
        @endif


    </div>
    <section id="why-mechatronics" class="why-section">
        <div class="container">
            <div class="why-header">
                <h3>What are 4 reasons to study Mechatronics Engineering?</h3>
            </div>

            <div class="why-grid">
                <div class="why-card">
                    <i class="icon icon-globe"></i>
                    <h4>Global Industry Demand</h4>
                    <p>
                        Industries worldwide are rapidly adopting automation,
                        robotics, and AI-driven systems.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-basket"></i>
                    <h4>Future-Proof Career Path</h4>
                    <p>
                        Mechatronics plays a vital role in Industry 4.0 and smart
                        manufacturing innovations.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-screen-smartphone"></i>
                    <h4>Flexible Learning Path</h4>
                    <p>
                        Study from anywhere, anytime—ideal for working
                        professionals looking to upskill.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-layers"></i>
                    <h4>High Salaries & Career Growth</h4>
                    <p>
                        Mechatronics engineers enjoy competitive salaries and
                        strong long-term career progression.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->

    <section id="section7" class="section-3 highlights image-right" style="background-color: #fff; padding:10px 0px">
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
    <section id="section8" class="section-6 subscribe" style="padding: 20px 0px ">
        <div class="container smaller">
            <div class="row text-center intro">
                <div class="col-12">
                    <h3>Frequently Asked Questions</h3>
                </div>
            </div>
            <div class="faq-container">
                <div class="faq">
                    <h5 class="faq-title">What is Mechatronics Engineering?</h5>
                    <p class="faq-text">
                        Mechatronics Engineering is an interdisciplinary field that
                        integrates mechanical, electrical, and computer engineering to
                        develop automated and intelligent systems.
                    </p>
                    <button class="faq-toggle">
                        <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>

                        <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="faq">
                    <h5 class="faq-title">Can I study this program online?</h5>
                    <p class="faq-text">
                        Yes, this program is 100% online, offering a flexible learning
                        experience with hands-on virtual labs and real-world applications.
                    </p>
                    <button class="faq-toggle">
                        <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>

                        <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="faq">
                    <h5 class="faq-title">
                        What career opportunities are available after this program?
                    </h5>
                    <p class="faq-text">
                        Graduates can pursue careers in robotics, industrial automation,
                        AI-driven systems, smart manufacturing, and automotive technology.
                    </p>
                    <button class="faq-toggle">
                        <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>

                        <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="faq">
                    <h5 class="faq-title">What are the eligibility requirements?</h5>
                    <p class="faq-text">
                        A background in engineering, electronics, or a related technical
                        field is recommended. Some universities may have additional
                        criteria.
                    </p>
                    <button class="faq-toggle">
                        <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>

                        <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="faq">
                    <h5 class="faq-title">
                        How long does it take to complete the program?
                    </h5>
                    <p class="faq-text">
                        The program duration is flexible, typically ranging from 12 to 24
                        months, depending on your study pace.
                    </p>
                    <button class="faq-toggle">
                        <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>

                        <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="faq">
                    <h5 class="faq-title">
                        Will I receive an accredited certification?
                    </h5>
                    <p class="faq-text">
                        Yes, upon successful completion, you will receive an
                        internationally recognized certification that enhances your career
                        prospects.
                    </p>
                    <button class="faq-toggle">
                        <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>

                        <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="faq">
                    <h5 class="faq-title">What are the key skills I will gain?</h5>
                    <p class="faq-text">
                        Skills include robotics engineering, automation, AI applications,
                        IoT integration, control systems, and embedded programming.
                    </p>
                    <button class="faq-toggle">
                        <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>

                        <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="faq">
                    <h5 class="faq-title">Can I work while studying?</h5>
                    <p class="faq-text">
                        Yes, the online format allows working professionals to balance
                        their studies with their job commitments.
                    </p>
                    <button class="faq-toggle">
                        <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>

                        <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="faq">
                    <h5 class="faq-title">
                        Do I need prior experience in mechatronics?
                    </h5>
                    <p class="faq-text">
                        Although previous experience is advantageous, foundational courses
                        are offered to guarantee that students from various engineering
                        backgrounds can thrive.
                    </p>
                    <button class="faq-toggle">
                        <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>

                        <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="faq">
                    <h5 class="faq-title">
                        Which industries hire Mechatronics Engineers?
                    </h5>
                    <p class="faq-text">
                        Industries such as automotive, aerospace, healthcare automation,
                        AI-driven robotics, and industrial manufacturing require
                        mechatronics engineers.
                    </p>
                    <button class="faq-toggle">
                        <svg class="chevron w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>

                        <svg class="close w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- Features -->
    {{-- <section id="features" class="section-3" style="background-color: #fff">
        <div class="container">
            <div class="row text-center intro">
                <div class="col-12">
                    <h3>What are 4 reasons to study Mechatronics Engineering?</h3>
                </div>
            </div>
            <div class="row justify-content-center text-center items">
                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-globe"></i>
                        <h4>Global Demand for Mechatronics Engineers</h4>
                        <p>
                            Industries are rapidly embracing automation, robotics, and AI.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-basket"></i>
                        <h4>Future-Proof Career</h4>
                        <p>
                            Mechatronics is a key driver of Industry 4.0 and smart
                            technology innovations.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-screen-smartphone"></i>
                        <h4>Flexible Learning Path</h4>
                        <p>
                            Learn from anywhere, anytime, making it easy for professionals
                            to upskill.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-layers"></i>
                        <h4 style="white-space: nowrap">
                            Competitive Salaries & Career Growth
                        </h4>
                        <p>
                            Mechatronics engineers earn high salaries with excellent career
                            progression opportunities.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

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
                                    <h4>Fathima</h4>
                                    <p style="text-align: justify">
                                        I was able to study while working full-time. The
                                        flexibility and industry-relevant modules prepared me for
                                        my dream job in robotics.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/12.webp" alt="Mary Evans"
                                        class="person" />
                                    <h4>John M</h4>
                                    <p style="text-align: justify">
                                        The Online Mechatronics Engineering program was a
                                        game-changer for me. The hands-on approach and expert
                                        faculty helped me develop the skills needed to work in
                                        industrial automation.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/19.webp" alt="Nadia Malik"
                                        class="person" />
                                    <h4>Emily T</h4>
                                    <p style="text-align: justify">
                                        The practical assignments and projects made learning
                                        easier and more engaging. Now, I’m working in a top
                                        AI-driven automation company.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/13.webp" alt="Khalid Mansoor"
                                        class="person" />
                                    <h4>David W</h4>
                                    <p style="text-align: justify">
                                        The faculty and online resources were excellent. I never
                                        felt lost in the course. Highly recommended for aspiring
                                        mechatronics engineers!
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
                                        As a mechanical engineer, this program helped me
                                        transition into automation and IoT applications. The
                                        learning experience was outstanding.
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
            <a href="{{ route('courses.checkout', $course->slug) }}" class="enroll-button">
                Enroll Now
            </a>
        @else
            <a class="enroll-button" href="{{ route('login') }}">
                Enroll Now
            </a>
        @endif


    </div>
@endsection
