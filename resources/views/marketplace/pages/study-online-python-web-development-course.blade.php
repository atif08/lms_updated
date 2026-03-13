<?php $page = 'Advancing Careers Through Professional Development | Know More About Us'; ?>
@extends('marketplace.layouts.front_layout')
@section('style')
    <style>
        /* Basic styles */
        .custom-card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .custom-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 320px;
        }

        .custom-card-header {
            background-color: #d6d8db;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            font-weight: bold;
            text-align: center;
            color: #000;
        }

        .custom-card-body {
            padding: 20px;
        }

        .custom-card-body ul li {
            margin-bottom: 10px;
            /* color: #6f6f6f; */
        }

        .custom-margin-bottom {
            margin-bottom: 0px !important;
        }

        .custom-box-container {
            background-color: #d6d8db;
            padding: 20px;
            border-radius: 20px;
        }

        .custom-pt {
            padding-top: 50px !important;
        }

        @media (max-width: 767px) {
            .custom-pt {
                padding-top: 0px !important;
            }
        }

        .text-start {
            text-align: left;
        }

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
                                Build your programming skills in Python web development and be
                                an expert in your Niche!
                            </h1>
                        </div>
                        <!-- <div class="col-12 row align-items-center justify-content-center">
                                                                            <button
                                                                              type="button"
                                                                              class="btn primary-button"
                                                                              id="open-modal"
                                                                            >
                                                                              Download Brochure
                                                                              <i class="icon-arrow-down-circle left"></i>
                                                                            </button>
                                                                          </div> -->
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
                                How Does Python Web Development Training Improve My
                                Programming Foundations?
                            </h3>
                            <p style="text-align: justify">
                                Online Python course trains you with programming fundamentals
                                and boosts your programming skills beyond boundaries. It will
                                teach from the basics of Object-oriented programming
                                principles to advanced frameworks such as Django or Flask,
                                strengthen your problem-solving abilities, and enhance your
                                logical thinking. A thorough learning of Python web
                                development scenarios makes you capable of a job-ready future.
                                The foundation prepares you to take on more difficult
                                projects, transforming you into a confident and competent
                                programmer capable of succeeding in today's technology-driven
                                environment.
                            </p>
                            <a href="/courses/contact" class="btn primary-button button">Apply Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <a href="#">
                        <img src="/frontend/assets/images/python-web-development-course-1.jpg" class="fit-image"
                            alt="Python Web Development" />
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="section-1" style="background-color: #fff; padding: 40px 0">
        <div class="container">
            <div class="row mt--40 nav-sticky sticky-top" style="top: 84px">
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
                        </ul>
                    </main>
                </div>
            </div>

            <div id="section1" class="content-section" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Course Overview</h3>
                        <p>
                            The Python Web Development Program is an extensive program that
                            teaches you how to create dynamic, responsive, and scalable web
                            applications. Beginning with the fundamentals of Python, the
                            curriculum gradually demonstrates advanced web development
                            principles, offering a smooth learning curve for both novice and
                            experienced programmers.
                        </p>
                        <h6>The program's main highlights include:</h6>
                        <ul>
                            <li>
                                <b>Core Python Programming:</b> Understand essential concepts
                                including variables, loops, functions, and data structures.
                            </li>
                            <li>
                                <b>Web Frameworks:</b> Learn how to build strong web apps
                                using popular frameworks such as Django and Flask.
                            </li>
                            <li>
                                <b>Database Integration:</b> Learn how to connect your apps to
                                databases such as MySQL and SQLite for efficient data
                                management.
                            </li>
                            <li>
                                <b>Frontend basics:</b> Learn how to use HTML, CSS, and
                                JavaScript to create visually appealing interfaces.
                            </li>
                            <li>
                                <b>API Development:</b> Learn how to design and integrate
                                RESTful APIs to enable smooth data connectivity.
                            </li>

                            <li>
                                <b>Deployment and Maintenance:</b> Learn how to deploy web
                                apps with platforms.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="section2" class="content-section" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Course Objective</h3>
                        <p>
                            The Python Web Development Program seeks to provide students
                            with the necessary skills and knowledge to excel at developing
                            cutting-edge, scalable web applications.
                        </p>
                        <h6>The key objectives of this course are:</h6>
                        <ul>
                            <li>
                                <b>Master Python Programming:</b> Gain a thorough
                                understanding of Python foundations such as data structures,
                                object-oriented programming, and file management.
                            </li>
                            <li>
                                <b>Develop Dynamic Web Applications:</b>Use frameworks such as
                                Django and Flask to construct responsive, feature-rich
                                websites and applications.
                            </li>
                            <li>
                                <b>Implement Frontend Integration:</b> Improve web interfaces
                                by combining HTML, CSS, and JavaScript with Python-powered
                                backend services.
                            </li>
                            <li>
                                <b>Work with Databases:</b> Learn how to connect and manage
                                databases like MySQL and SQLite to ensure efficient data
                                storage and retrieval.
                            </li>
                            <li>
                                <b>Develop and consume APIs:</b> Create RESTful APIs and
                                integrate third-party APIs to allow for easy communication
                                between apps.
                            </li>

                            <li>
                                <b>Ensure online Application Security:</b> Learn the best
                                techniques for protecting online apps from common
                                vulnerabilities.
                            </li>
                            <li>
                                <b>Optimize and Debug Code:</b>Learn debugging and
                                optimization techniques to ensure high-performance and
                                error-free programs.
                            </li>
                            <li>
                                <b>Deploy Applications:</b> Get practical expertise in
                                deploying web projects to cloud platforms such as AWS, Heroku,
                                and Docker.
                            </li>
                            <li>
                                <b>Work in Collaborative Environments:</b> Learn how to
                                efficiently manage and collaborate on projects using version
                                control systems such as Git.
                            </li>
                            <li>
                                <b>Prepare for Industry Roles:</b> Create a professional
                                portfolio of web development projects to demonstrate your
                                abilities to prospective employers.
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <a href="/courses/contact" class="btn primary-button button">Enquiry Now</a>
                </div>
            </div>

            <div class="content-section">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <h3 class="text-center">Expertise in</h3>
                    </div>
                </div>

                <div class="col-md-12 divided-col" style="display: flex; justify-content: center; align-items: center">
                    <div class="divided-col-item">

                        <img src="/frontend/assets/images/Python-Mod.webp" alt="python" />

                    </div>
                </div>
            </div>

            <div class="container content-section text-start custom-pt" id="section3" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 mt-lg-5">
                        <h3 class="text-center">Course Modules</h3>
                    </div>
                </div>
                <div class="col-md-12 my-4" style="display: flex; justify-content: center; align-items: center">
                    <img src="/frontend/assets/images/python-expertises.webp" />
                </div>

                <div class="custom-card-container">
                    <!-- HTML/CSS Card -->
                    <div class="custom-card">
                        <div class="custom-card-header">HTML | CSS</div>
                        <div class="custom-card-body">
                            <ul>
                                <li>HTML5 Semantic Elements</li>
                                <li>CSS Grid and Flexbox</li>
                                <li>Responsive Design, CSS Preprocessors (Sass, LESS)</li>
                                <li>Cross-browser Compatibility, Media Queries</li>
                                <li>Web Accessibility (a11y)</li>
                                <li>CSS Animation</li>
                                <li>Advanced Selectors</li>
                                <li>Performance Optimisation</li>
                                <li>Project Work - 1</li>
                            </ul>
                        </div>
                    </div>
                    <!-- JavaScript Card -->
                    <div class="custom-card">
                        <div class="custom-card-header">JAVASCRIPT</div>
                        <div class="custom-card-body">
                            <ul>
                                <li>
                                    Introduction to JavaScript: Variables, Functions, data types
                                </li>
                                <li>
                                    First-class citizens, Operators, Loops, Conditional
                                    statements
                                </li>
                                <li>Objects in JS, Ways to create Objects, Reflection</li>
                                <li>
                                    Advanced: Closures, this keyword, Modules (traditional and
                                    modern)
                                </li>
                                <li>ES6, Callbacks, Promises, Async and Await & Generator</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Python Card -->
                    <div class="custom-card">
                        <div class="custom-card-header">PYTHON</div>
                        <div class="custom-card-body">
                            <ul>
                                <li>Introduction to programming</li>
                                <li>Data types, Operators, Conditional statements</li>
                                <li>
                                    Loops, Functions, Recursion, lambdas, List Comprehensions
                                </li>
                                <li>
                                    Classes and Objects, Exception Handling, Modules, Packages
                                </li>
                                <li>String handling, Manipulations</li>
                                <li>Numpy, Pandas, Matplotlib and Seaborn</li>
                                <li>Project Work with Assessments</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Django Card -->
                    <div class="custom-card">
                        <div class="custom-card-header">DJANGO</div>
                        <div class="custom-card-body">
                            <ul>
                                <li>
                                    Introduction to Django: Setting up projects, understanding
                                    the structure
                                </li>
                                <li>
                                    Working with models, migrations, templates, forms, and the
                                    admin interface
                                </li>
                                <li>
                                    Advanced Django Features: Using the Django REST Framework
                                    for API development
                                </li>
                                <li>
                                    Implementing authentication and permissions, signals, and
                                    middleware
                                </li>
                                <li>Deployment and Optimization</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Flask Card -->
                    <div class="custom-card">
                        <div class="custom-card-header">FLASK</div>
                        <div class="custom-card-body">
                            <ul>
                                <li>
                                    Introduction to Flask: Setting up the environment, creating
                                    routes
                                </li>
                                <li>
                                    Handling HTTP requests, working with templates (Jinja2),
                                    handling forms, and user inputs
                                </li>
                                <li>Database Integration: Using Flask-SQLAlchemy</li>
                                <li>
                                    Advanced Flask Features: Implementing authentication and
                                    authorization (login sessions, JWT)
                                </li>
                                <li>Building RESTful APIs</li>
                            </ul>
                        </div>
                    </div>
                    <!-- SQL Card -->
                    <div class="custom-card">
                        <div class="custom-card-header">SQL</div>
                        <div class="custom-card-body">
                            <ul>
                                <li>Database Management System</li>
                                <li>RDBMS and Non RDBMS</li>
                                <li>MySQL, NoSQL, PostGreySQL</li>
                                <li>DDL, DML, DQL, DCL</li>
                                <li>Schema</li>
                                <li>Joins, Nested Joins</li>
                                <li>SQL query Optimisation</li>
                            </ul>
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
                                        <th>Duration</th>
                                        <th>Class Duration</th>
                                        <th>Key Features</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>4 Months</td>
                                        <td>1.5 HRS. (Mon-Sat)</td>
                                        <td>
                                            <ul>
                                                <li>Real time use cases and projects included.</li>
                                                <li>Assured Job and Internship Opportunities</li>
                                                <li>Training material with Exercises.</li>
                                                <li>Assignments and Quizzes.</li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="section5" class="content-section" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Learning outcomes</h3>
                        <p>
                            After completing the Python Web Development Course, students
                            will acquire the following results:
                        </p>
                        <ul>
                            <li>
                                <b>Python proficiency:</b> Show that you grasp the
                                fundamentals of Python programming, such as data structures,
                                control flow, and object-oriented concepts.
                            </li>
                            <li>
                                <b>Web Application Development:</b> Create responsive,
                                user-friendly web apps with Python frameworks like Django and
                                Flask.
                            </li>
                            <li>
                                <b>Database Management Skills:</b> Connect, query, and manage
                                relational databases such as MySQL, PostgreSQL, and SQLite to
                                store and retrieve dynamic data.
                            </li>
                            <li>
                                <b>API Integration:</b> Develop and deploy RESTful APIs to
                                provide smooth connectivity between client and server systems.
                            </li>
                        </ul>
                        <p>
                            Frontend Integration: Combine Python-based backends with
                            frontend technologies such as HTML, CSS, and JavaScript to
                            create fully interactive web solutions. At the end, learners
                            should be able to:
                        </p>
                        <ul>
                            <li>Build full-stack web applications using Python.</li>
                            <li>
                                Design and implement robust and scalable web applications.
                            </li>
                            <li>Troubleshoot and debug web applications effectively.</li>
                            <li>
                                Collaborate with other developers in team-based projects.
                            </li>
                            <li>
                                Stay up-to-date with the latest trends and technologies in web
                                development.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="highlights" style="padding: 40px 0; background-color: white">
        <div class="container">
            <div class="custom-box-container row justify-content-center text-center items">
                <div class="col-12 col-md-6 col-lg-4 item custom-margin-bottom">
                    <div class="card p-0 no-hover">
                        <i class="icon fas fa-hand-holding-usd"></i>
                        <h4>High Paying Salaries</h4>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item custom-margin-bottom">
                    <div class="card p-0 no-hover">
                        <i class="icon fas fa-laptop-code"></i>
                        <h4>Most Demanding Technology</h4>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item custom-margin-bottom">
                    <div class="card p-0 no-hover">
                        <i class="icon fas fa-lightbulb"></i>
                        <h4>Versatile Applications</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="section6" style="background-color: #fff; display:none" style="padding: 10px 0px ">
        <div class="container py-5">
            <div class="col-12 col-md-12">
                <h3 class="text-center m-0">Also Includes</h3>
                <div class="row mt-4 justify-content-center">
                    <ul class="col-md-4 list-unstyled">
                        <li class="mb-3 d-flex align-items-center" style="font-size: 1.2rem">
                            <i class="fa fa-play mr-2" aria-hidden="true"></i> Doubt
                            Clearing Sessions
                        </li>
                        <li class="mb-3 d-flex align-items-center" style="font-size: 1.2rem">
                            <i class="fa fa-play mr-2" aria-hidden="true"></i> Mentorship
                            Sessions
                        </li>
                        <li class="mb-3 d-flex align-items-center" style="font-size: 1.2rem">
                            <i class="fa fa-play mr-2" aria-hidden="true"></i> Real Time
                            Projects
                        </li>
                    </ul>
                    <ul class="col-md-4 list-unstyled">
                        <li class="mb-3 d-flex align-items-center" style="font-size: 1.2rem">
                            <i class="fa fa-play mr-2" aria-hidden="true"></i> Full Day
                            Practice Labs
                        </li>
                        <li class="mb-3 d-flex align-items-center" style="font-size: 1.2rem">
                            <i class="fa fa-play mr-2" aria-hidden="true"></i> Industry
                            Expert Guest Lectures
                        </li>
                        <li class="mb-3 d-flex align-items-center" style="font-size: 1.2rem">
                            <i class="fa fa-play mr-2" aria-hidden="true"></i>Internship &
                            Job Opportunities
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

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
                Why Choose ASTI Dubai for the Python Web Development Course
            </h3>
            <div class="row justify-content-center text-center items">
                <div class="col-12 col-md-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-globe"></i>
                        <h4>Experienced Faculty</h4>
                        <p>Learn from Python programming experts with experience.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-basket"></i>
                        <h4>Industry Partnerships</h4>
                        <p>
                            Stay ahead with a syllabus designed in collaboration with
                            leading Python web development professionals.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-screen-smartphone"></i>
                        <h4>Global Opportunities</h4>
                        <p>
                            Leverage Dubai’s position as a tech hub for networking and
                            internships.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-layers"></i>
                        <h4>Supportive Learning Environment</h4>
                        <p>A conducive atmosphere for academic and personal growth.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features -->
    <section id="subscribe" class="section-6 subscribe">
        <div class="container smaller">
            <div class="row text-center intro">
                <div class="col-12">
                    <h3>Frequently Asked Questions</h3>
                </div>
            </div>
            <div class="faq-container">
                <div class="faq">
                    <h5 class="faq-title">What is the duration of the program?</h5>
                    <p class="faq-text">
                        The duration is 5 months, depending on the pace you choose and
                        whether the course is self-paced or instructor-led.
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
                        Do I need prior programming experience to join this program?
                    </h5>
                    <p class="faq-text">
                        No prior experience is required. The course starts with Python
                        fundamentals, making it suitable for beginners as well as those
                        with some programming background.
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
                    <h5 class="faq-title">What topics are covered in the program?</h5>
                    <p class="faq-text">
                        The course covers Python basics, web development frameworks
                        (Django and Flask), database integration, frontend basics, API
                        development, deployment, and secure coding practices.
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
                        Will I receive a certificate upon completion?
                    </h5>
                    <p class="faq-text">
                        Yes, a certificate of completion is provided, which can be added
                        to your resume or LinkedIn profile to showcase your skills.
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
                        Are there live sessions, or are they self-paced?
                    </h5>
                    <p class="faq-text">
                        The program offers both options. You can choose self-paced
                        learning for flexibility or live sessions for interactive learning
                        with instructors.
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
                    <h5 class="faq-title">What kind of projects will I work on?</h5>
                    <p class="faq-text">
                        You will work on hands-on projects such as creating dynamic web
                        applications, building RESTful APIs, and deploying a full-stack
                        web application. These projects help you build a professional
                        portfolio.
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
                        What tools and software do I need to get started?
                    </h5>
                    <p class="faq-text">
                        You’ll need a computer with an internet connection, a code editor
                        (such as VS Code), and Python installed. Detailed setup
                        instructions are provided during the course.
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
                        How is this course beneficial for working professionals?
                    </h5>
                    <p class="faq-text">
                        The course offers flexible scheduling, enabling professionals to
                        upskill at their own pace. It focuses on practical, job-ready
                        skills, which can be directly applied to real-world projects.
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
                        Is there any support available during the course?
                    </h5>
                    <p class="faq-text">
                        Yes, learners have access to a dedicated support team, discussion
                        forums, and instructors for doubt resolution and guidance.
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
                        What career opportunities can I expect after completing this
                        course?
                    </h5>
                    <p class="faq-text">
                        This program prepares you for roles such as Web Developer, Python
                        Developer, Full-Stack Developer, Backend Engineer, or API
                        Developer. The skills gained can also help with freelancing or
                        advancing in your current job.
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

    <section id="why-python-web" class="why-section">
        <div class="container">
            <div class="why-header">
                <h3>What are the 4 reasons to study Python Web Development?</h3>
            </div>

            <div class="why-grid">
                <div class="why-card">
                    <i class="icon icon-globe"></i>
                    <h4>High Industry Demand</h4>
                    <p>
                        Python web development is one of the fastest-growing skill
                        areas, with global demand exceeding the supply of professionals.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-basket"></i>
                    <h4>Lucrative Career Opportunities</h4>
                    <p>
                        Python developers enjoy competitive salaries and diverse
                        career paths across startups, enterprises, and tech firms.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-screen-smartphone"></i>
                    <h4>Global Applicability</h4>
                    <p>
                        Python web development skills are valued worldwide and
                        applicable across industries and regions.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-layers"></i>
                    <h4>Continuous Learning & Growth</h4>
                    <p>
                        The programming ecosystem evolves rapidly, offering
                        continuous learning and long-term career growth.
                    </p>
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
                                    <h4>Emma L</h4>
                                    <p style="text-align: justify">
                                        I had zero programming experience before starting this
                                        course, but the step-by-step approach made it so easy to
                                        follow. The instructors were patient, and the support team
                                        was always there to help. Now, I can confidently build web
                                        applications and am even working on my first freelance
                                        project!
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/12.webp" alt="Mary Evans"
                                        class="person" />
                                    <h4>Rajesh K</h4>
                                    <p style="text-align: justify">
                                        As a full-time software engineer, finding time to upskill
                                        was always a challenge. The online course fits perfectly
                                        into my schedule, allowing me to learn at my own pace
                                        while balancing work and life. The real-world projects
                                        were invaluable, and I’m already applying my new skills to
                                        enhance our company's web applications. Highly recommend
                                        it to busy professionals!
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/19.webp" alt="Nadia Malik"
                                        class="person" />
                                    <h4>Sophia Tobby</h4>
                                    <p style="text-align: justify">
                                        As a computer science student, this course complemented my
                                        academic studies perfectly. The focus on practical
                                        applications, like building RESTful APIs and integrating
                                        databases, gave me a competitive edge during internship
                                        interviews. I now feel more prepared for a career in
                                        full-stack development.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/13.webp" alt="Khalid Mansoor"
                                        class="person" />
                                    <h4>Ahmed R</h4>
                                    <p style="text-align: justify">
                                        Coming from a network administration background, I wanted
                                        to transition into web development. This program was the
                                        perfect choice. It bridged the gap between my IT knowledge
                                        and coding skills, teaching me frameworks like Django and
                                        Flask. The hands-on projects boosted my confidence to
                                        create dynamic websites from scratch.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/Comments_68-x-68_6.png" alt="Sara Khan"
                                        class="person" />
                                    <h4>Maria</h4>
                                    <p style="text-align: justify">
                                        The online Python Web Development Program was a
                                        game-changer for me as a freelance web designer. Learning
                                        Python and frameworks like Flask expanded my offerings to
                                        clients, and I’ve already landed more complex,
                                        higher-paying projects. The flexibility of the course
                                        allowed me to upskill while managing client work.
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

    <!-- enroll-button-code-ends-here -->
@endsection
@push('scripts')
@endpush
