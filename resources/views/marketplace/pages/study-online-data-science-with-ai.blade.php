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

        .button-enrollNow {
            margin: 10px 0px
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
                                Data Science with AI Training Course
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

    <div class="button-enrollNow">
        @if (\Illuminate\Support\Facades\Auth::check())
            <a href="{{ route('courses.checkout', $course->slug) }}" class="enroll-button">
                Enroll Now
            </a>
        @else
            <a href="{{ route('get.register') }}?redirect={{ urlencode(route('courses.checkout', $course->slug)) }}" class="enroll-button">
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
                                How Does Data Science with AI Change Your Career Perspectives?
                            </h3>
                            <p style="text-align: justify">
                                Certification courses in Data Science are an ideal way to
                                demonstrate your competency in essential career-related
                                abilities to potential employers. ASTI's Online Data Science
                                Courses in Dubai can help you get certified while boosting
                                your data science skills, which are in high demand among
                                companies and organizations.
                            </p>
                            <a href="/courses/contact" class="btn primary-button button">Apply Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <a href="#">
                        <img src="/frontend/assets/images/data-science-witi-ai-1.jpg" class="fit-image" alt="About Us" />
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
                        <h3 class="text-center">
                            How Can Data Science Certifications Boost Your Career?
                        </h3>
                        <p>
                            By enrolling in a Data science training program you will learn
                            how to represent, maintain, and process large data sets
                            utilizing innovative techniques and methodologies, as well as
                            modern methods and tools for visual exploration. The course's
                            core modules teach the fundamental skills of a data scientist,
                            such as using machine learning, managing big data sets, and
                            creating compelling visualizations. The obtained skills will be
                            useful for business applications, industrial applications, and
                            scientific data investigation.
                        </p>
                    </div>
                </div>
            </div>

            <div id="section2" class="content-section" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Course Objective</h3>
                        <p>
                            Data science soon will be a must-have profession for every
                            company looking to fully capitalize on the data it collects.
                            There will be an expanding need for people who have the required
                            skills in mathematics, statistics, computer science, business
                            expertise, and the ability to apply developing technology to
                            practical problems.
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <h3 class="text-center">Expertise in</h3>
                    </div>
                </div>

                <div class="col-md-12 divided-col" style="display: flex; justify-content: center; align-items: center">
                    <div class="divided-col-item">

                        <img src="/frontend/assets/images/Data-Science-Mod.webp" alt="data-analysis" />

                    </div>
                </div>
            </div>

            <div class="container text-start content-section custom-pt" id="section3" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 mt-lg-5">
                        <h3 class="text-center">Course Modules</h3>
                    </div>
                </div>
                <div class="col-md-12 my-4" style="display: flex; justify-content: center; align-items: center">
                    <img src="/frontend/assets/images/Data Science_Logos.webp" />
                </div>

                <div class="custom-card-container">
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

                    <!-- Maths/Stats Card -->
                    <div class="custom-card">
                        <div class="custom-card-header">MATHS / STATS</div>
                        <div class="custom-card-body">
                            <ul>
                                <li>Linear Algebra</li>
                                <li>Calculus</li>
                                <li>Probability</li>
                                <li>Discrete Mathematics</li>
                                <li>Descriptive and Inferential statistics</li>
                                <li>Central Limit Theorem</li>
                                <li>Multivariate and regression analysis</li>
                                <li>Experimental Design</li>
                                <li>Time Series Analysis</li>
                            </ul>
                        </div>
                    </div>

                    <!-- ML / DL / NLP Card -->
                    <div class="custom-card">
                        <div class="custom-card-header">ML / DL / NLP</div>
                        <div class="custom-card-body">
                            <ul>
                                <li>Supervised, Unsupervised Learning</li>
                                <li>Algorithms, Mathematical Intuition</li>
                                <li>Perceptron, ANN, CNN, RNN</li>
                                <li>LSTM, GRU’s, Transformer Model</li>
                                <li>Feature Engineering</li>
                                <li>Data Transformation</li>
                                <li>Model Deployment</li>
                                <li>Cloud Services</li>
                                <li>Generative AI models</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Projects Card -->
                    <div class="custom-card">
                        <div class="custom-card-header">PROJECTS</div>
                        <div class="custom-card-body">
                            <ul>
                                <li>Cancer Patient Detection using Machine Learning</li>
                                <li>US Cost of Living Prediction</li>
                                <li>Multi Disease Classification</li>
                                <li>Image Detection</li>
                                <li>Facial Recognition</li>
                                <li>Object Detection</li>
                                <li>Sentiment Analyzer</li>
                                <li>Advanced Chatbots</li>
                                <li>Transformer Projects</li>
                                <li>Multi-purpose LLMs</li>
                            </ul>
                        </div>
                    </div>

                    <!-- PowerBI / Excel Card -->
                    <div class="custom-card">
                        <div class="custom-card-header">POWERBI / EXCEL</div>
                        <div class="custom-card-body">
                            <ul>
                                <li>Data Cleaning</li>
                                <li>Data PreProcessing</li>
                                <li>Data Visualization</li>
                                <li>Data Modeling</li>
                                <li>DAX (Data Analysis Expressions)</li>
                                <li>Power Query</li>
                                <li>PivotTables</li>
                                <li>Advanced Charting</li>
                                <li>Data Validation</li>
                                <li>Dashboard Design</li>
                            </ul>
                        </div>
                    </div>

                    <!-- SQL (DBMS) Card -->
                    <div class="custom-card">
                        <div class="custom-card-header">SQL (DBMS)</div>
                        <div class="custom-card-body">
                            <ul>
                                <li>Database Management System</li>
                                <li>RDBMS and Non-RDBMS</li>
                                <li>MySQL, NoSQL, PostGreySQL</li>
                                <li>DDL</li>
                                <li>DML</li>
                                <li>DQL</li>
                                <li>DCL</li>
                                <li>Schema</li>
                                <li>Joins, Nested Joins</li>
                                <li>SQL Query Optimisation</li>
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
                                        <td>3-4 Months</td>
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
                <div class="row justify-content-center">
                    <a href="/courses/contact" class="btn primary-button button">Enquiry Now</a>
                </div>
            </div>

            <div id="section5" class="content-section" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Learning outcomes</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <ul>
                                    <h5>Data Manipulation and Cleaning:</h5>
                                    <li>
                                        Mastering techniques to handle missing values, outliers,
                                        and inconsistencies.
                                    </li>
                                    <li>
                                        Proficiency in data cleaning and preprocessing using tools
                                        like Python (Pandas, NumPy) and R.
                                    </li>
                                </ul>

                                <ul>
                                    <h5>Data Exploration and Visualization:</h5>
                                    <li>
                                        Understanding data distribution, relationships, and
                                        trends.
                                    </li>
                                    <li>
                                        Creating effective visualizations using libraries like
                                        Matplotlib, Seaborn, and Plotly.
                                    </li>
                                </ul>

                                <ul>
                                    <h5>Statistical Analysis:</h5>
                                    <li>
                                        Applying statistical methods to draw meaningful insights
                                        from data.
                                    </li>
                                    <li>
                                        Using statistical software like SPSS or R for hypothesis
                                        testing, correlation analysis, and regression analysis.
                                    </li>
                                </ul>

                                <ul>
                                    <h5>Machine Learning:</h5>
                                    <li>
                                        Building predictive models using algorithms like linear
                                        regression, decision trees, random forests, and support
                                        vector machines.
                                    </li>
                                    <li>
                                        Implementing machine learning algorithms using Python
                                        libraries like Scikit-learn.
                                    </li>
                                </ul>

                                <ul>
                                    <h5>Deep Learning:</h5>
                                    <li>
                                        Perform financial forecasting using advanced analytical
                                        methods.
                                    </li>
                                    <li>
                                        Use data visualization to present financial insights to
                                        stakeholders.
                                    </li>
                                </ul>

                                <ul>
                                    <h5>Big Data Technologies:</h5>
                                    <li>
                                        Working with large datasets using tools like Hadoop,
                                        Spark, and Apache Flink.
                                    </li>
                                    <li>
                                        Leveraging cloud platforms like AWS, Azure, and GCP for
                                        scalable data processing.
                                    </li>
                                </ul>
                            </div>
                        </div>
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
    <div class="button-enrollNow">
        @if (\Illuminate\Support\Facades\Auth::check())
            <a href="{{ route('courses.checkout', $course->slug) }}" class="enroll-button">
                Enroll Now
            </a>
        @else
            <a href="{{ route('get.register') }}?redirect={{ urlencode(route('courses.checkout', $course->slug)) }}" class="enroll-button">
                Enroll Now
            </a>
        @endif


    </div>

    <!-- Features -->
    <section id="features" class="section-2 odd offers" style="padding: 40px 0 !important">
        <div class="container">
            <h3 class="text-center">
                Why Choose ASTI Dubai for the Data Science with AI Course?
            </h3>
            <div class="row justify-content-center text-center items">
                <div class="col-12 col-md-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-globe"></i>
                        <h4>Experienced Faculty</h4>
                        <p>Learn from data science experts with experience.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 item">
                    <div class="card no-hover">
                        <i class="icon icon-basket"></i>
                        <h4>Industry Partnerships</h4>
                        <p>
                            Stay ahead with a syllabus designed in collaboration with
                            leading data science professionals.
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
                    <h5 class="faq-title">
                        What is the duration of the data science certification program in
                        UAE?
                    </h5>
                    <p class="faq-text">
                        Most data science certification programs last 4 months, and it's
                        completely online and the aspirants can study.
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
                        Do I need prior experience to enroll in the program?
                    </h5>
                    <p class="faq-text">
                        No prior experience is required. The program typically offers
                        beginner-friendly modules, although familiarity with mathematics,
                        statistics, or basic programming is advantageous.
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
                        What tools and technologies will I learn during the program?
                    </h5>
                    <p class="faq-text">
                        Students will gain hands-on experience with tools and technologies
                        such as Python, R, SQL, Tableau, Power BI, Hadoop, TensorFlow, and
                        Spark, along with exposure to machine learning frameworks.
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
                        Are the certifications globally recognized?
                    </h5>
                    <p class="faq-text">
                        Yes, most programs in the UAE provide certifications that are
                        internationally recognized and qualify aspirants to work in global
                        markets. Ensure the program you choose is accredited by reputable
                        organizations.
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
                        What career opportunities are available after completing the
                        certification?
                    </h5>
                    <p class="faq-text">
                        Graduates can pursue roles like Data Scientist, Machine Learning
                        Engineer, AI Specialist, Business Analyst, and Data Engineer
                        across industries such as finance, healthcare, and technology.
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
                        What is the demand for data science professionals in the UAE?
                    </h5>
                    <p class="faq-text">
                        The UAE is a growing hub for technology and innovation, creating a
                        high demand for skilled data science professionals in industries
                        like fintech, e-commerce, healthcare, and logistics.
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
                        What kind of support is provided for job placements?
                    </h5>
                    <p class="faq-text">
                        Many institutions offer career support services, including resume
                        building, mock interviews, and networking opportunities with local
                        and international companies, to help students secure rewarding
                        roles post-graduation.
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

    <section id="why-data-analysis" class="why-section">
        <div class="container">
            <div class="why-header">
                <h3>What are the 4 reasons to study Data Analysis?</h3>
            </div>

            <div class="why-grid">
                <div class="why-card">
                    <i class="icon icon-globe"></i>
                    <h4>High Industry Demand</h4>
                    <p>
                        Data analysis is one of the fastest-growing fields, with
                        global demand for skilled professionals exceeding supply.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-basket"></i>
                    <h4>Lucrative Career Opportunities</h4>
                    <p>
                        Data analysts earn competitive salaries and can work across
                        multiple industries and domains.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-screen-smartphone"></i>
                    <h4>Global Applicability</h4>
                    <p>
                        Data analysis skills are valued worldwide and applicable
                        across industries and regions.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-layers"></i>
                    <h4>Continuous Learning & Growth</h4>
                    <p>
                        The evolving nature of data analysis offers continuous
                        opportunities for upskilling and career advancement.
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
                                    <h4>Sajini</h4>
                                    <p style="text-align: justify">
                                        As a marketing professional, I wanted to transition into a
                                        data-driven role. This online program provided the perfect
                                        blend of theoretical knowledge and practical experience.
                                        The flexible learning format allowed me to balance work
                                        and study, and the career services helped me land a great
                                        job as a data analyst.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/12.webp" alt="Mary Evans"
                                        class="person" />
                                    <h4>Raven John</h4>
                                    <p style="text-align: justify">
                                        Being an international student, I was initially concerned
                                        about the quality of online education. However, this
                                        program exceeded my expectations. The interactive
                                        sessions, experienced instructors, and global peer network
                                        made my learning experience truly enriching. I'm now
                                        confident in applying my data science skills to real-world
                                        problems.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/19.webp" alt="Nadia Malik"
                                        class="person" />
                                    <h4>Fathima</h4>
                                    <p style="text-align: justify">
                                        This program deeply delved into the latest data science
                                        tools and techniques. The hands-on projects and
                                        industry-relevant case studies allowed me to apply my
                                        knowledge to real-world scenarios. I'm excited to continue
                                        exploring data science and contribute to innovative
                                        projects.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/13.webp" alt="Khalid Mansoor"
                                        class="person" />
                                    <h4>Joe</h4>
                                    <p style="text-align: justify">
                                        I appreciate the flexibility of this online program. I
                                        could learn at my own pace and revisit topics as needed.
                                        The video lectures were well-structured, and the
                                        assignments were challenging yet rewarding. The community
                                        forums were also helpful for discussions and
                                        collaboration.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/Comments_68-x-68_6.png" alt="Sara Khan"
                                        class="person" />
                                    <h4>Mary</h4>
                                    <p style="text-align: justify">
                                        Balancing work and study can be tough, but this program
                                        made it manageable. The concise modules and practical
                                        assignments fit seamlessly into my busy schedule. The
                                        career counseling sessions were also invaluable in helping
                                        me refine my resume and prepare for interviews.
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
            <a href="{{ route('get.register') }}?redirect={{ urlencode(route('courses.checkout', $course->slug)) }}" class="enroll-button">
                Enroll Now
            </a>
        @endif


    </div>
@endsection
