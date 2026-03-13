<?php $page = 'Advancing Careers Through Professional Development | Know More About Us'; ?>
@extends('frontend.layouts.front_layout')
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
                width: 120px;
                margin: 3px;
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
                                Artificial Intelligence Program
                            </h1>
                            <h6 style="color: #000">
                                Build the Future with Our Online Artificial Intelligence
                                Diploma Program
                            </h6>
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
                    <span>6 Months</span>
                </div>

                <div class="fact-box" style="display:none">
                    <h4>Program Fee</h4>
                    <span>$599</span>
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
                                What You Will Achieve from the Online Artificial Intelligence
                                Diploma Program
                            </h3>
                            <p style="text-align: justify">
                                The online artificial intelligence diploma program aims to
                                give students a strong foundation in AI concepts, methods, and
                                practical applications. Along with getting practical
                                experience in creating and implementing AI systems, you will
                                become an expert in fields including computer vision, natural
                                language processing (NLP), deep learning, and machine
                                learning. By the program's conclusion, you will be able to use
                                cutting-edge AI technology to solve challenging problems in
                                robotics, healthcare, finance, and smart automation.
                            </p>
                            <a href="/courses/contact" class="btn primary-button button">Apply Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <a href="#">
                        <img src="/frontend/assets/images/artificial-intelligence-programme-1.jpg" class="fit-image"
                            alt="About Us" />
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
                            Students studying in this program gain thorough instruction in
                            artificial intelligence (AI) and its subfields, including data
                            processing, neural networks, algorithm creation, and ethical
                            issues. Aspiring engineers, data scientists, developers, and
                            tech enthusiasts who want to take the lead in the AI-powered
                            future will find it ideal.
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
                                Understand core AI concepts and methodologies including neural
                                networks and expert systems
                            </li>
                            <li>
                                Develop skills to build AI models, smart applications, and
                                data-driven solutions
                            </li>
                            <li>
                                Apply AI across industries such as healthcare, finance, and
                                robotics
                            </li>
                            <li>
                                Promote ethical and responsible innovation in artificial
                                intelligence applications
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
                                        <td>Module 1: Introduction to Artificial Intelligence</td>
                                        <td>4 Hours</td>
                                        <td>This module introduces the fundamentals of Artificial Intelligence (AI),
                                            exploring its history, key concepts, and various applications. Learners will
                                            understand the impact of AI on industries such as healthcare, finance, and
                                            entertainment.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 2: Programming for AI using Python</td>
                                        <td>8 Hours</td>
                                        <td>This module introduces the fundamentals of Artificial Intelligence (AI),
                                            exploring its history, key concepts, and various applications. Learners will
                                            understand the impact of AI on industries such as healthcare, finance, and
                                            entertainment.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 3: Machine Learning Fundamentals</td>
                                        <td>10 Hours</td>
                                        <td>This module covers the core concepts of machine learning, including supervised
                                            and unsupervised learning, algorithms like decision trees and KNN, and how to
                                            build and evaluate machine learning models.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 4: Deep Learning and Neural Networks</td>
                                        <td>4 Hours</td>
                                        <td>Learners will dive into deep learning, a subset of machine learning that uses
                                            neural networks to solve complex problems. Topics include the architecture of
                                            neural networks, backpropagation, and training deep models for tasks like image
                                            and speech recognition.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 5: Natural Language Processing (NLP)</td>
                                        <td>6 Hours</td>
                                        <td>This module introduces Natural Language Processing, enabling machines to
                                            understand, interpret, and generate human language. Learners will explore
                                            techniques such as tokenization, sentiment analysis, and language models.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 6: Computer Vision Basics</td>
                                        <td>4 Hours</td>
                                        <td>Focusing on computer vision, this module teaches learners how machines interpret
                                            and process visual information. Key topics include image processing, object
                                            detection, classification, and segmentation using tools like OpenCV.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 7: Ethics, Bias, and Future of AI</td>
                                        <td>4 Hours</td>
                                        <td>This module addresses the ethical implications of AI, including bias in
                                            algorithms, fairness, transparency, and privacy concerns.</td>
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
                                        <td>Artificial Intelligence Program</td>
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

            <div id="section5" class="content-section" style="padding: 10px 0px">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Learning outcomes</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <ul>
                                    <li>
                                        Build and train AI and machine learning models using
                                        real-world datasets
                                    </li>
                                    <li>
                                        Apply NLP for sentiment analysis, language translation,
                                        and text summarization
                                    </li>
                                    <li>
                                        Develop deep learning systems for visual recognition and
                                        speech processing
                                    </li>
                                    <li>
                                        Evaluate and optimize AI model performance, security, and
                                        ethical compliance
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
                                    <span class="flex-grow-1 pl-2">Fundamentals of AI and Machine Learning</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Supervised and Unsupervised Learning</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Neural Networks & Deep Learning (CNNs, RNNs,
                                        Transformers)</span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Natural Language Processing (Text Analytics, Chatbots,
                                        Sentiment Analysis)</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Computer Vision (Image Processing, Object Detection,
                                        Face
                                        Recognition)</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Model Training, Evaluation & Deployment
                                    </span>
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
            <a class="enroll-button" href="{{ route('get.login') }}">
                Enroll Now
            </a>
        @endif


    </div>
    <section id="features" class="section-2 odd offers" style="padding: 40px 0 !important">
        <div class="container">
            <h3 class="text-center">
                Why Choose ASTI Online for Artificial Intelligence Program ?
            </h3>
            <div class="row justify-content-center text-center items">
                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-globe"></i>
                        <h4>Industry-Relevant Curriculum</h4>
                        <p>
                            Designed to meet the demands of today’s AI-driven job market
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-basket"></i>
                        <h4>Flexible Online Learning</h4>
                        <p>Study anytime, anywhere, at your own pace</p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-layers"></i>
                        <h4>Hands-On Skill Development</h4>
                        <p>Apply learning through real-world tools and coding projects</p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-graduation"></i>
                        <h4>Globally Recognized Diploma</h4>
                        <p>Build credibility with a certificate that employers trust</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features -->

    <section id="section7" class="section-3 highlights image-right" style="background-color: #fff; padding: 10px 0px">
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
            <div class="faq-container">
                <div class="faq">
                    <h5 class="faq-title">
                        What is the Artificial Intelligence Diploma Program?
                    </h5>
                    <p class="faq-text">
                        It is an in-depth, project-based course covering machine learning,
                        NLP, computer vision, and AI ethics.
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
                    <h5 class="faq-title">Do I need prior experience in AI?</h5>
                    <p class="faq-text">
                        No prior experience is needed. The course starts from the
                        fundamentals and builds up to advanced topics.
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
                        What tools will I learn during the course?
                    </h5>
                    <p class="faq-text">
                        You’ll gain hands-on experience with Python, TensorFlow, PyTorch,
                        NLTK, spaCy, Hugging Face, and OpenCV.
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
                        What jobs can I pursue after this diploma?
                    </h5>
                    <p class="faq-text">
                        You can work as an AI Engineer, Data Scientist, NLP Engineer, ML
                        Developer, or Computer Vision Specialist.
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
                        Is the course completely online? Do I need prior experience in
                        biomedical engineering?
                    </h5>
                    <p class="faq-text">
                        Yes. You can access all course content, projects, and assessments
                        100% online.
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
                    <h5 class="faq-title">How is the course assessed?</h5>
                    <p class="faq-text">
                        Through coding projects, presentations, peer reviews, and
                        real-world case studies.
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
    <section id="why-ai" class="why-section">
        <div class="container">
            <div class="why-header">
                <h3>What are the 4 reasons to study Artificial Intelligence (AI)?</h3>
            </div>

            <div class="why-grid">
                <div class="why-card">
                    <i class="icon icon-globe"></i>
                    <h4>Fast-Growing Career Opportunities</h4>
                    <p>
                        AI professionals are in high demand globally as industries
                        adopt automation, data intelligence, and smart systems.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-basket"></i>
                    <h4>Real-World Applications</h4>
                    <p>
                        Solve complex industry challenges using practical AI tools,
                        machine learning models, and data-driven techniques.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-screen-smartphone"></i>
                    <h4>Learn at Your Own Pace</h4>
                    <p>
                        Fully online and flexible learning designed to fit your
                        personal and professional schedule.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-layers"></i>
                    <h4>Be Future-Ready</h4>
                    <p>
                        Stay ahead in technology-driven sectors such as healthcare,
                        finance, robotics, and intelligent automation.
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
                                    <h4>Mariam</h4>
                                    <p style="text-align: justify">
                                        I switched from traditional IT to AI engineering after
                                        completing this program. Practical and career-oriented.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/12.webp" alt="Mary Evans"
                                        class="person" />
                                    <h4>Raviz</h4>
                                    <p style="text-align: justify">
                                        The modules on NLP and Deep Learning were in-depth and
                                        hands-on. Loved the real-world use cases.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/19.webp" alt="Nadia Malik"
                                        class="person" />
                                    <h4>Lana</h4>
                                    <p style="text-align: justify">
                                        I had no prior knowledge, but now I can confidently build
                                        ML models and use TensorFlow.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/13.webp" alt="Khalid Mansoor"
                                        class="person" />
                                    <h4>Ahmed</h4>
                                    <p style="text-align: justify">
                                        ASTI’s program helped me balance learning with my job. The
                                        platform and support were excellent.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/Comments_68-x-68_6.png" alt="Sara Khan"
                                        class="person" />
                                    <h4>Zainab</h4>
                                    <p style="text-align: justify">
                                        The course gave me a solid foundation in AI and exposed me
                                        to ethical and societal impacts
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

    <!-- Courses Section -->
    {{-- <section id="testimonials" class="section-5 carousel">
        <div class="overflow-holder">
            <div class="container">
                <div class="row text-center intro">
                    <div class="col-12">
                        <h3>Related Courses</h3>
                    </div>
                </div>
                <div class="swiper-container mid-slider items">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide swiper-slide-p slide-center text-center item">
                            <div id="spinner"></div>
                            <div class="contents-specific">
                                <div id="cards-container">
                                    <div class="card custom-padding-f">
                                        <div class="card-inner">
                                            <div class="card-front"
                                                style="
                            background-image: url('/frontend/assets/images/homepage-img/L3-Engineering-in-UAE.png');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Oracle Financials</h4>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <a href="oracle-financials-training-course-in-UAE.html"
                                                    class="btn primary-button button">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide swiper-slide-p slide-center text-center item">
                            <div id="spinner"></div>
                            <div class="contents-specific">
                                <div id="cards-container">
                                    <div class="card custom-padding-f">
                                        <div class="card-inner">
                                            <div class="card-front"
                                                style="
                            background-image: url('/frontend/assets/images/homepage-img/Automobile-Engineering-in-UAE.png');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Blockchain Technology</h4>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <a href="study-online-blockchain-and-technology-diploma-program.html"
                                                    class="btn primary-button button">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide swiper-slide-p slide-center text-center item">
                            <div id="spinner"></div>
                            <div class="contents-specific">
                                <div id="cards-container">
                                    <div class="card custom-padding-f">
                                        <div class="card-inner">
                                            <div class="card-front"
                                                style="
                            background-image: url('/frontend/assets/images/homepage-img/Civil-Engineering-in-UAE.png');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Property Management Programme</h4>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <a href="study-online-property-management-diploma.html"
                                                    class="btn primary-button button">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide swiper-slide-p slide-center text-center item">
                            <div id="spinner"></div>
                            <div class="contents-specific">
                                <div id="cards-container">
                                    <div class="card custom-padding-f">
                                        <div class="card-inner">
                                            <div class="card-front"
                                                style="
                            background-image: url('/frontend/assets/images/homepage-img/Electrical&Electronics-Engineering-in-UAE.png');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Design Engineering Programme</h4>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <a href="study-online-design-engineering-program.html"
                                                    class="btn primary-button button">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide swiper-slide-p slide-center text-center item">
                            <div id="spinner"></div>
                            <div class="contents-specific">
                                <div id="cards-container">
                                    <div class="card custom-padding-f">
                                        <div class="card-inner">
                                            <div class="card-front"
                                                style="
                            background-image: url('/frontend/assets/images/homepage-img/Mechanical-Engineering-in-UAE.png');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Artificial intelligence Programme</h4>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <a href="study-artificial-intelligence-diploma-program.html"
                                                    class="btn primary-button button">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide swiper-slide-p slide-center text-center item">
                            <div id="spinner"></div>
                            <div class="contents-specific">
                                <div id="cards-container">
                                    <div class="card custom-padding-f">
                                        <div class="card-inner">
                                            <div class="card-front"
                                                style="
                            background-image: url('/frontend/assets/images/homepage-img/Education&Training-in-UAE.png');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Quantity Surveying Programme</h4>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <a href="online-quantity-survey-engineering-diploma.html"
                                                    class="btn primary-button button">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide swiper-slide-p slide-center text-center item">
                            <div id="spinner"></div>
                            <div class="contents-specific">
                                <div id="cards-container">
                                    <div class="card custom-padding-f">
                                        <div class="card-inner">
                                            <div class="card-front"
                                                style="
                            background-image: url('/frontend/assets/images/homepage-img/IT-Engineering-in-UAE.png');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Biomedical Engineering Programme</h4>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <a href="online-biomedical-engineering-diploma-program.html"
                                                    class="btn primary-button button">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide swiper-slide-p slide-center text-center item">
                            <div id="spinner"></div>
                            <div class="contents-specific">
                                <div id="cards-container">
                                    <div class="card custom-padding-f">
                                        <div class="card-inner">
                                            <div class="card-front"
                                                style="
                            background-image: url('/frontend/assets/images/homepage-img/Hospitality&Tourism-Management-in-UAE.png');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Mechatronics Engineering Programme</h4>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <a href="online-mechatronics-engineering-diploma-program.html"
                                                    class="btn primary-button button">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide swiper-slide-p slide-center text-center item">
                            <div id="spinner"></div>
                            <div class="contents-specific">
                                <div id="cards-container">
                                    <div class="card custom-padding-f">
                                        <div class="card-inner">
                                            <div class="card-front"
                                                style="
                            background-image: url('/frontend/assets/images/homepage-img/Business-Management-in-UAE.png');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Petroleum Engineering Programme</h4>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <a href="study-online-petroleum-engineering-diploma-program.html"
                                                    class="btn primary-button button">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide swiper-slide-p slide-center text-center item">
                            <div id="spinner"></div>
                            <div class="contents-specific">
                                <div id="cards-container">
                                    <div class="card custom-padding-f">
                                        <div class="card-inner">
                                            <div class="card-front"
                                                style="
                            background-image: url('/frontend/assets/images/homepage-img/Psychology-in-UAE.png');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Chemical Engineering Programme</h4>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <a href="online-chemical-engineering-diploma.html"
                                                    class="btn primary-button button">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide swiper-slide-p slide-center text-center item">
                            <div id="spinner"></div>
                            <div class="contents-specific">
                                <div id="cards-container">
                                    <div class="card custom-padding-f">
                                        <div class="card-inner">
                                            <div class="card-front"
                                                style="
                            background-image: url('/frontend/assets/images/homepage-img/EV-Engineering-in-UAE.png');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Electrical Vehicle Engineering Course</h4>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <a href="online-electrical-vehicle-engineering-course.html"
                                                    class="btn primary-button button">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide swiper-slide-p slide-center text-center item">
                            <div id="spinner"></div>
                            <div class="contents-specific">
                                <div id="cards-container">
                                    <div class="card custom-padding-f">
                                        <div class="card-inner">
                                            <div class="card-front"
                                                style="
                            background-image: url('/frontend/assets/images/homepage-img/EV-Engineering-in-UAE.png');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Data Analysis Training Course</h4>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <a href="study-online-data-analysis-course.html"
                                                    class="btn primary-button button">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide swiper-slide-p slide-center text-center item">
                            <div id="spinner"></div>
                            <div class="contents-specific">
                                <div id="cards-container">
                                    <div class="card custom-padding-f">
                                        <div class="card-inner">
                                            <div class="card-front"
                                                style="
                            background-image: url('/frontend/assets/images/homepage-img/EV-Engineering-in-UAE.png');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Data Science with AI Training Course</h4>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <a href="study-online-data-science-with-ai.html"
                                                    class="btn primary-button button">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide swiper-slide-p slide-center text-center item">
                            <div id="spinner"></div>
                            <div class="contents-specific">
                                <div id="cards-container">
                                    <div class="card custom-padding-f">
                                        <div class="card-inner">
                                            <div class="card-front"
                                                style="
                            background-image: url('/frontend/assets/images/homepage-img/EV-Engineering-in-UAE.png');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Python Web Development Course</h4>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <a href="study-online-python-web-development-course.html"
                                                    class="btn primary-button button">Details</a>
                                            </div>
                                        </div>
                                    </div>
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
            <a class="enroll-button" href="{{ route('get.login') }}">
                Enroll Now
            </a>
        @endif

    </div>
@endsection
