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
                                Digital Marketing Management
                            </h1>
                            <h6 style="color: #000"> Explore the Future with Digital Marketing Management
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
    <!-- enroll-button-code-starts-here -->

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

    <!-- enroll-button-code-ends-here -->
    <!-- About [image] -->
    <section id="about" class="section-1 highlights image-right" style="padding: 20px 0px">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 align-self-center text-center text-md-left">
                    <div class="row intro">
                        <div class="col-12 p-0">
                            <h3 class="featured alt">
                                What You Will Achieve from the Online Digital Marketing Management Diploma Program
                            </h3>
                            <p style="text-align: justify">
                                This comprehensive digital marketing program equips learners with essential strategies
                                across paid advertising, organic growth, and analytics. Core highlights include Google Ads
                                mastery, from account setup and keyword research to advanced bidding strategies like Target
                                ROAS and Maximize Conversions, alongside campaign creation for search, display, remarketing,
                                and performance max. Facebook Marketing emphasizes page optimization, ad auctions, custom
                                audiences, and targeted campaigns for leads, sales, and traffic. LinkedIn Ads focus on
                                professional networking through formats like carousel and video ads, with retargeting and
                                conversion tracking. SEO fundamentals cover keyword intent, on-page optimization, backlink
                                strategies (guest posting, skyscraper technique), and technical audits. Content Marketing
                                stresses branding, ideation, repurposing, and AI-driven creation using tools like ChatGPT.
                                Email Marketing guides list-building via lead magnets and automation, while Google Analytics
                                and Tag Manager enable data-driven insights. WordPress setup rounds out practical
                                site-building skills, fostering scalable, ROI-focused digital campaigns
                            </p>
                            <a href="/courses/contact" class="btn primary-button button">Apply Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <a href="#">
                        <img style="object-fit: contain" src="/frontend/assets/images/digital-marketing-management.jpg"
                            class="fit-image" alt="Digital Marketing Image" />
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
                <a href="#section8" onclick="scrollToSection(event)">Faq</a>
            </li>
        </ul>
        <div class="container">
            <div id="section1" class="content-section" style="padding: 10px 0px">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Course Overview</h3>
                        <p>
                            An in-depth understanding of modern digital marketing principles and online growth strategies is
                            offered by this diploma program. It equips students with the theoretical and practical knowledge
                            required to create effective digital campaigns, manage social media presence, optimize search
                            visibility, analyze marketing performance, and build strong online brand identities. Through
                            real-world tools, platforms, and industry frameworks, learners gain the expertise to drive
                            audience engagement, increase conversions, and support business growth in today’s competitive
                            digital landscape.
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
                                To provide a thorough understanding of core digital marketing principles, tools, and modern
                                online marketing ecosystems
                            </li>
                            <li>
                                To develop competencies in social media management, SEO, content creation, paid advertising,
                                and performance analytics
                            </li>
                            <li>
                                To explore strategies for audience targeting, brand communication, lead generation, and
                                campaign optimization
                            </li>
                            <li>
                                To equip learners with industry-ready skills to plan, execute, and manage digital marketing
                                campaigns across multiple platforms
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
                                        <td>Unit 1: Introduction to Digital
                                            Marketing</td>
                                        <td>8 Hours</td>
                                        <td>- Evolution of marketing in the digital age
                                            - Key concepts: SEO, SEM, SMM, Content, Email,
                                            Mobile Marketing
                                            - Digital marketing vs traditional marketing
                                            - Understanding digital consumer behavior</td>
                                    </tr>
                                    <tr>
                                        <td>Unit 2: Digital Marketing
                                            Strategy and Planning</td>
                                        <td>9 Hours</td>
                                        <td>- Situation analysis (SWOT, PESTLE, Competitor
                                            Analysis)
                                            - Setting SMART digital objectives
                                            - Digital marketing funnel
                                            - Budgeting and resource allocation
                                            - Marketing automation tools
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Unit 3: Search and Content
                                            Marketing</td>
                                        <td>9 Hours</td>
                                        <td>- SEO: on-page, off-page, and technical
                                            - SEM: Google Ads, PPC management
                                            - Content strategy and storytelling
                                            - Copywriting and keyword optimization
                                            - Blogging and video content
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Unit 4: Social media and
                                            Influencer Marketing</td>
                                        <td>8 Hours</td>
                                        <td>- Social media platforms (Facebook, Instagram,
                                            LinkedIn, TikTok, X)
                                            - Paid social advertising
                                            - Community management
                                            - Influencer partnerships
                                            - Measuring engagement and ROI
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Unit 5: Email, Mobile, and ECommerce Marketing</td>
                                        <td>9 Hours</td>
                                        <td>- Email marketing strategy, segmentation, and
                                            automation
                                            - Mobile marketing (SMS, apps, push
                                            notifications)
                                            - E-commerce strategies and conversion
                                            optimization- Customer retention and CRM tools</td>
                                    </tr>
                                    <tr>
                                        <td>Unit 6: Analytics, Ethics and
                                            Final Project
                                        </td>
                                        <td>5 Hours</td>
                                        <td>- Google Analytics and data interpretation
                                            - KPI dashboards and ROI measurement
                                            - Digital marketing ethics, privacy,
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
                                        <td>Digital Marketing Management</td>
                                        <td>100% Online</td>
                                        <td>Flexible (6 months)</td>
                                        <td>Assignments</td>
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
                                        Understand the fundamentals of digital marketing, online consumer behaviour, and
                                        brand positioning
                                    </li>
                                    <li>
                                        Apply SEO, social media marketing, content strategies, and paid advertising
                                        techniques effectively
                                    </li>
                                    <li>
                                        Create, manage, and optimize digital marketing campaigns using industry-standard
                                        tools and platforms
                                    </li>
                                    <li>
                                        Analyze campaign performance using analytics tools to improve engagement,
                                        conversions, and ROI
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
                                    <span class="flex-grow-1 pl-2">Digital Marketing Strategy & Online Branding</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">SEO, SEM & Website Optimization</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Social Media Marketing & Content Creation</span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Lead Generation, Email Marketing & Customer
                                        Engagement</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Analytics, Reporting & Performance Tracking</span>
                                </div>
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <img src="/frontend/assets/svg/check-icon.svg" alt="Icon" width="26"
                                        height="26" />
                                    <span class="flex-grow-1 pl-2">Paid Advertising (Google Ads, Meta Ads) & Campaign
                                        Management</span>
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
    <!-- enroll-button-code-starts-here -->

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

    <!-- enroll-button-code-ends-here -->
    <!-- Features -->
    <section id="features" class="section-2 odd offers" style="padding: 40px 0 !important">
        <div class="container">
            <h3 class="text-center">
                Why Choose ASTI Online for the Digital Marketing Management Programme?
            </h3>
            <div class="row justify-content-center text-center items">
                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-globe"></i>
                        <h4>Curriculum Designed by Digital Marketing Experts</h4>
                        <p>
                            Learn industry-relevant skills aligned with current digital trends, tools, and employer
                            expectations.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-basket"></i>
                        <h4>100% Online, Anytime Learning</h4>
                        <p>Flexible, self-paced learning that fits perfectly for students, working professionals, and career
                            changers.
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-layers"></i>
                        <h4>Hands-On Digital Marketing Training</h4>
                        <p>
                            Practice real-world digital marketing activities including SEO, social media management, content
                            creation, and paid advertising campaigns.
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-graduation"></i>
                        <h4>Career-Ready Certification</h4>
                        <p>
                            Earn a recognized credential that opens opportunities in digital agencies, marketing
                            departments, e-commerce companies, startups, and media organizations.
                        </p>
                    </div>
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
                        What is the Digital Marketing Management program about?
                    </h5>
                    <p class="faq-text">
                        This program teaches you how to plan, execute, and optimize digital marketing campaigns using tools
                        like SEO, social media, content marketing, analytics, and paid advertising.
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
                    <h5 class="faq-title">Do I need any prior experience in marketing or digital tools?</h5>
                    <p class="faq-text">
                        No, the course is designed for beginners as well as professionals. All topics are taught from the
                        basics with practical, hands-on examples.
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
                    <h5 class="faq-title">What job roles can I pursue after completing this program?</h5>
                    <p class="faq-text">
                        You can work as a Digital Marketing Executive, Social Media Manager, SEO Specialist, PPC Executive,
                        Content Marketer, Marketing Analyst, or Email Marketing Specialist.
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
                        Will the course be completely online?
                    </h5>
                    <p class="faq-text">
                        Yes, the entire program is delivered online, allowing you to learn at your own pace from anywhere.
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
                        Will I receive a certificate after completing the course?
                    </h5>
                    <p class="faq-text">
                        Yes, you will receive an industry-recognized certification that boosts your profile in the digital
                        marketing sector.
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
                        What tools will I learn during this program?
                    </h5>
                    <p class="faq-text">
                        You will gain exposure to tools like Google Analytics, Google Ads, Meta Ads Manager, SEO tools,
                        email marketing platforms, and social media dashboards.
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
    <section id="why-digital-marketing" class="why-section">
        <div class="container">
            <div class="why-header">
                <h3>
                    What are the 4 reasons to study the Online Digital Marketing Management Program?
                </h3>
            </div>

            <div class="why-grid">
                <div class="why-card">
                    <i class="icon icon-globe"></i>
                    <h4>Relevant Industry Learning</h4>
                    <p>
                        Learn practical digital marketing skills using real-world
                        tools, platforms, and hands-on projects.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-basket"></i>
                    <h4>Career-Oriented Curriculum</h4>
                    <p>
                        Gain in-demand expertise in SEO, social media marketing,
                        analytics, content strategy, and paid advertising.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-screen-smartphone"></i>
                    <h4>Globally Relevant Knowledge</h4>
                    <p>
                        Learn digital marketing strategies used by global brands
                        across multiple online platforms.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-layers"></i>
                    <h4>Build a Professional Portfolio</h4>
                    <p>
                        Create real campaign samples, reports, and marketing
                        projects to showcase your skills to employers.
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
                                    <h4>Sara M</h4>
                                    <p style="text-align: justify">
                                        This course made a complex subject easy to learn. I’ve already built my first smart
                                        contract!
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/12.webp" alt="Mary Evans"
                                        class="person" />
                                    <h4>Khalid M/h4>
                                        <p style="text-align: justify">
                                            Loved the mix of Ethereum coding and Hyperledger enterprise solutions. Highly
                                            recommend it.
                                        </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/19.webp" alt="Nadia Malik"
                                        class="person" />
                                    <h4>Fatima S</h4>
                                    <p style="text-align: justify">
                                        I joined with no coding background and now I understand wallets, tokens, and
                                        contract security.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/13.webp" alt="Khalid Mansoor"
                                        class="person" />
                                    <h4>Omar T</h4>
                                    <p style="text-align: justify">
                                        ASTI’s support system and instructor guidance were very helpful throughout the
                                        course.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/Comments_68-x-68_6.png" alt="Sara Khan"
                                        class="person" />
                                    <h4>Ayesha R</h4>
                                    <p style="text-align: justify">
                                        I was working in finance, but this course helped me switch to crypto consulting.
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
    <!-- enroll-button-code-starts-here -->

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

    <!-- enroll-button-code-ends-here -->
@endsection
