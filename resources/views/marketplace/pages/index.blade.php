<?php $page = 'Government Recognised Institution | Online Courses'; ?>
@extends('marketplace.layouts.front_layout')
@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/scrolling-card.css') }}">
@endpush
@section('content')
    <!-- Hero -->
    {{-- <section id="slider" class="hero p-0 odd">
        <div class="swiper-container full-slider featured animation slider-h-100">
            <div class="swiper-wrapper">

                <div class="swiper-slide slide-center">
                    <img data-aos="zoom-out-up" data-aos-delay="800" src="/frontend/assets/images/dwc_hero-n.webp"
                        class="hero-image  d-none d-md-block" alt="Hero Image" />
                    <div class="slide-content row" data-mask-768="70">
                        <div class="col-12 d-flex inner">
                            <div class="left align-self-center text-center text-md-left">
                                <h1 data-aos="zoom-out-up" data-aos-delay="400"
                                    class="title effect-static-text main-banner-title" style="font-size: 2rem;">
                                    ASTI Academy DWC
                                </h1>
                                <p data-aos="zoom-out-up" data-aos-delay="800" class="description">
                                    Your Gateway to a Brighter Future: Affordable,
                                    Government-Recognized Vocational and Technical Training
                                    Programs in Dubai
                                </p>
                                <a href="#contact" data-aos="zoom-out-up" data-aos-delay="1200"
                                    class="ml-auto mr-auto ml-md-0 mt-4 btn primary-button"><i class="icon-cup"></i>ENQUIRE
                                    NOW</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide slide-center">
                    <img data-aos="zoom-out-up" data-aos-delay="800" src="/frontend/assets/images/2.webp"
                        class="hero-image   d-none d-md-block" alt="Hero Image" />
                    <div class="slide-content row" data-mask-768="70">
                        <div class="col-12 d-flex inner">
                            <div class="left align-self-center text-center text-md-left">
                                <h2 data-aos="zoom-out-up" data-aos-delay="400"
                                    class="title effect-static-text main-banner-title" style="font-size: 2rem;">
                                    Demanding Accounting Skills
                                </h2>
                                <p data-aos="zoom-out-up" data-aos-delay="800" class="description">
                                    ASTI Academy DWC offers internationally recognized programs that
                                    can help you launch your dream career in Accounting &
                                    Business.
                                </p>
                                <a href="#contact" data-aos="zoom-out-up" data-aos-delay="1200"
                                    class="ml-auto mr-auto ml-md-0 mt-4 btn primary-button"><i class="icon-cup"></i>BOOK AN
                                    APPOINTMENT</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide slide-center">
                    <img data-aos="zoom-out-up" data-aos-delay="800" src="/frontend/assets/images/3.webp"
                        class="hero-image  d-none d-md-block" alt="Hero Image" />
                    <div class="slide-content row" data-mask-768="70">
                        <div class="col-12 d-flex inner">
                            <div class="left align-self-center text-center text-md-left">
                                <h2 data-aos="zoom-out-up" data-aos-delay="400"
                                    class="title effect-static-text main-banner-title" style="font-size: 2rem;">
                                    Empowering Learners for Success
                                </h2>
                                <p data-aos="zoom-out-up" data-aos-delay="800" class="description">
                                    At ASTI Academy DWC, we provide a supportive learning
                                    environment that equips you with the teaching skills and
                                    knowledge to succeed.
                                </p>
                                <a href="/courses/courses" data-aos="zoom-out-up" data-aos-delay="1200"
                                    class="ml-auto mr-auto ml-md-0 mt-4 btn primary-button"><i class="icon-cup"></i>APPLY
                                    NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section> --}}

    <section class="hero">
        <div class="hero-container">

            <!-- LEFT CONTENT -->
            <div class="hero-content">
                <span class="hero-badge">Internationally Recognised</span>

                <h1>
                    {{-- Certification Programs & <br>
                    <span>UK Level Qualifications</span> --}}
                    ASTI ACADEMY DWC
                </h1>

                <p class="hero-subtext">
                    Designed for students, graduates, and working professionals.
                    Build globally recognised skills with career-focused learning.
                </p>

                <!-- HIGHLIGHTS -->
                <div class="hero-highlights">
                    <span>UK Level 3 • 4 • 5 Diplomas</span>
                    <span>Certification Programs</span>
                    <span>Industry-Aligned Certification</span>
                    <span>Flexible Learning</span>
                </div>

                <!-- STATS -->
                <div class="hero-stats">
                    <div class="stat">
                        <strong>10,000+</strong>
                        <span>Learners Enrolled</span>
                    </div>
                    <div class="stat">
                        <strong>Global</strong>
                        <span>Recognition</span>
                    </div>
                    <div class="stat">
                        <strong>Career</strong>
                        <span>Focused Programs</span>
                    </div>
                </div>

                <!-- CTA -->
                <div class="hero-actions">
                    <a href="/courses/all-programs" class="btn-primary">Explore Programs</a>
                    <a href="#contact" class="btn-primary">Speak to an Advisor</a>
                </div>
            </div>

            <!-- RIGHT VISUAL -->
            <div class="hero-visual">
                <img src="/frontend/assets/images/group-professionals-gathered-around-laptop-f.jpeg"
                    alt="International Education">
            </div>

        </div>
    </section>

    <!-- Courses Section -->
    {{-- <section id="testimonials" class="section-5 carousel">
        <div class="overflow-holder">
            <div class="container">
                <div class="row text-center intro">
                    <div class="col-12">
                        <h2 class="featured alt">
                            Professional Certifications Programs
                        </h2>
                        <p class="text-max-800">
                            Study Online & Equipped with Internationly Recognised
                            & Accreditec Programs
                        </p>
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
                            background-image: url('/frontend/assets/images/oracle-financial-programme-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Oracle Financials</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color:#FDF5E6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Oracle
                                                    Financials</h4>
                                                <h4 style="color: black; font-size: 18px;">Price: $599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:6 Months</h4>
                                                <a href="/courses/oracle-financials-training-course-in-UAE"
                                                    class="btn primary-button button">Apply Now</a>

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
                            background-image: url('/frontend/assets/images/block-chain-technology-programme-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Blockchain Technology</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Blockchain
                                                    Technology</h4>
                                                <h4 style="color: black; font-size: 18px;">Price:$599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:6 Months</h4>
                                                <a href="/courses/study-online-blockchain-and-technology-diploma-program"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/property-management-programme-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Property Management Programme</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Property
                                                    Management</h4>
                                                <h4 style="color: black; font-size: 18px;">Price:$599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:6 Months</h4>
                                                <a href="/courses/study-online-property-management-diploma"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/design-engineering-programme-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Design Engineering Programme</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Design
                                                    Engineering</h4>
                                                <h4 style="color: black; font-size: 18px;">Price:$599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:4 Months</h4>
                                                <a href="/courses/study-online-design-engineering-program"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/artificial-intelligence-programme-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Artificial intelligence Programme</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Artificial
                                                    Intelligence</h4>
                                                <h4 style="color: black; font-size: 18px;">Price:$599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:6 Months</h4>
                                                <a href="/courses/study-artificial-intelligence-diploma-program"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/quantity-surveying-engineering-program-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Quantity Surveying Programme</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Quantity
                                                    Surveying</h4>
                                                <h4 style="color: black; font-size: 18px;">Price:$599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:6 Months</h4>
                                                <a href="/courses/online-quantity-survey-engineering-diploma"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/biomedical-engineering-programme-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Biomedical Engineering Programme</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Biomedical
                                                    Engineerign</h4>
                                                <h4 style="color: black; font-size: 18px;">Price:$599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:6 Months</h4>
                                                <a href="/courses/online-biomedical-engineering-diploma-program"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/mechatronics-engineering-program-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Mechatronics Engineering Programme</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Mechatronics
                                                    Engineering </h4>
                                                <h4 style="color: black; font-size: 18px;">Price:$599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:6 Months</h4>
                                                <a href="/courses/online-mechatronics-engineering-diploma-program"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/petroleum-engineering-program-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Petroleum Engineering Programme</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Petroleum
                                                    Engineering</h4>
                                                <h4 style="color: black; font-size: 18px;">Price:$599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:6 Months</h4>
                                                <a href="/courses/study-online-petroleum-engineering-diploma-program"
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
                            background-image: url('/frontend/assets/images/chemical-engineering-program-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Chemical Engineering Programme</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Chemical
                                                    Engineering</h4>
                                                <h4 style="color: black; font-size: 18px;">Price: $599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:6 Months</h4>
                                                <a href="/courses/online-chemical-engineering-diploma"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/electrical-vehicle-engineering-course-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Electrical Vehicle Engineering Course</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Electrical Vehicle
                                                    Engineering</h4>
                                                <h4 style="color: black; font-size: 18px;">Price:$599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:6 Months</h4>
                                                <a href="/courses/online-electrical-vehicle-engineering-course"
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
                            background-image: url('/frontend/assets/images/data-analysis-training-course-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Data Analysis Training Course</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Data Analysis
                                                    Training</h4>
                                                <h4 style="color: black; font-size: 18px;">Price:$599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:6 Months</h4>
                                                <a href="/courses/study-online-data-analysis-course"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/data-science-witi-ai-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Data Science with AI Training Course</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Data Science with
                                                    AI</h4>
                                                <h4 style="color: black; font-size: 18px;">Price:$599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:6 Months</h4>
                                                <a href="/courses/study-online-data-science-with-ai"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/python-web-development-course-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Python Web Development Course</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Python Web
                                                    Development</h4>
                                                <h4 style="color: black; font-size: 18px;">Price:$599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:6 Months</h4>
                                                <a href="/courses/study-online-python-web-development-course"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/health-administration.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Health Administration</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Health Aministration
                                                </h4>
                                                <h4 style="color: black; font-size: 18px;">Price:$599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:6 Months</h4>
                                                <a href="/courses/health-administration"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/digital-marketing-management.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Digital Marketing Management</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Digital Marketing
                                                    Management</h4>
                                                <h4 style="color: black; font-size: 18px;">Price:$599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:6 Months</h4>
                                                <a href="/courses/digital-marketing-management"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/marketing-management-sales-management.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Marketing Management Sales Management</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course:Marketing Management
                                                    Sales Management</h4>
                                                <h4 style="color: black; font-size: 18px;">Price:$599</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration:6 Months</h4>
                                                <a href="/courses/marketing-management-sales-management-programme"
                                                    class="btn primary-button button">Apply Now</a>
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

    <!-- Professional courses level3, level4,level5 courses starts here -->
    {{-- <section id="testimonials" class="section-5 carousel">
        <div class="overflow-holder">
            <div class="container">
                <div class="row text-center intro">
                    <div class="col-12">
                        <h2 class="featured alt">
                            UK Qualification Diploma Programs
                        </h2>
                        <p class="text-max-800">
                            Study Online & Equipped with International Qualification
                            Programs
                        </p>
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
                            background-image: url('/frontend/assets/images/level-3-foundation-diploma-in-higher-education-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Level-3 Foundation Diploma in Higher Education</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Level-3 Foundation
                                                    Diploma in Higher Eduacation</h4>
                                                <h4 style="color: black; font-size: 18px;">Price: $1999</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration: 12 Months</h4>
                                                <a href="/courses/level-3-foundation-diploma-in-higher-education"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/level-3-diploma-in-education-and-training-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Level-3 Diploma in Education and Training</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Level-3 Diploma in
                                                    Education and Training</h4>
                                                <h4 style="color: black; font-size: 18px;">Price: $1999</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration: 12 Months</h4>
                                                <a href="/courses/level-3-diploma-in-education-and-training"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/level-4-foundation-diploma-in-accountancy-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Level-4 Diploma in Accounting and Business</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Level-4 Diploma in
                                                    Accounting and Business</h4>
                                                <h4 style="color: black; font-size: 18px;">Price: $1999</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration: 12 Months</h4>
                                                <a href="/courses/level-4&5-diploma-in-accounting-and-business"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/level-4-diploma-in-education-and-training-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Level-4 Diploma in Education and Training</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Level-4 Diploma in
                                                    Education and Training</h4>
                                                <h4 style="color: black; font-size: 18px;">Price: $1999</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration: 12 Months</h4>
                                                <a href="/courses/level-4&5-diploma-in-education-and-training"
                                                    class="btn primary-button button">Apply Now</a>
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
                            background-image: url('/frontend/assets/images/level-5-diploma-in-accounting-and-business-1.jpg');
                          ">
                                                <div class="col-12 blurry-div">
                                                    <h4>Level-5 Diploma in Accounting and Business</h4>
                                                </div>
                                            </div>
                                            <div class="card-back" style="background-color: #fdf5e6;">
                                                <h4 style="color: black; font-size: 18px;">Course: Level 5 Diploma in
                                                    Accounting and Business</h4>
                                                <h4 style="color: black; font-size: 18px;">Price: $1999</h4>
                                                <h4 style="color: #000; font-size: 18px;">Duration: 12 Months</h4>
                                                <a href="/courses/level-5-diploma-in-accounting-and-business"
                                                    class="btn primary-button button">Apply Now</a>
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
    <!-- Professional courses level3, level4,level5 courses starts here -->
    {{-- stats-section-starts-here --}}
    <section style="padding: 10px 0" class="stats-section">
        <div class="stats-container">

            <!-- ACTIVE USERS (DYNAMIC) -->
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <h3 id="activeUsers">0</h3>
                <p>Active Users</p>
            </div>

            <!-- STATIC STATS -->
            <div class="stat-card">
                <div class="stat-icon">🎓</div>
                <h3>50+</h3>
                <p>Expert Instructors</p>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📜</div>
                <h3>65+</h3>
                <p>Certified Programs</p>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🏆</div>
                <h3>25+</h3>
                <p>Years of Excellence</p>
            </div>

        </div>
    </section>
    {{-- stats-section-ends-here --}}

    {{-- professional-certifications --}}
    <section class="course-carousel-section">
        <h2 class="section-title">Professional Certification Programs</h2>

        <div class="carousel-wrapper custom-carousel">
            <button class="nav-arrow left">&#10094;</button>

            <div class="carousel-track">
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/digital-marketing-management.jpg')"></div>
                    <div class="card-content">
                        <h4>Digital Marketing Management</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/digital-marketing-management" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/python-web-development-course-1.jpg')"></div>
                    <div class="card-content">
                        <h4>Python Web Development Course</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/study-online-python-web-development-course" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image" style="background-image:url('/frontend/assets/images/cyber-security.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Cybersecurity with AI</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/cyber-security-with-ai" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/artificial-intelligence-programme-1.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Artificial Intelligence Programme</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/study-artificial-intelligence-diploma-program" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/data-science-witi-ai-1.jpg')"></div>
                    <div class="card-content">
                        <h4>Data Science with AI Training Course</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/study-online-data-science-with-ai" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/data-analysis-training-course-1.jpg')"></div>
                    <div class="card-content">
                        <h4>Data Analysis Training Course</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/study-online-data-analysis-course" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image" style="background-image:url('/frontend/assets/images/facade-engineering.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Facade Engineering</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/facade-engineering" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/oracle-financial-programme-1.jpg')"></div>
                    <div class="card-content">
                        <h4>Oracle Financials</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/oracle-financials-training-course-in-UAE" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/block-chain-technology-programme-1.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Blockchain Technology</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/study-online-blockchain-and-technology-diploma-program" class="apply-btn">Apply
                            Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/property-management-programme-1.jpg')"></div>
                    <div class="card-content">
                        <h4>Property Management Programme</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/study-online-property-management-diploma" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/design-engineering-programme-1.jpg')"></div>
                    <div class="card-content">
                        <h4>Design Engineering Programme</h4>
                        <p>Duration: 4 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/study-online-design-engineering-program" class="apply-btn">Apply Now</a>
                    </div>
                </div>

                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/quantity-surveying-engineering-program-1.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Quantity Surveying Programme</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/online-quantity-survey-engineering-diploma" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/biomedical-engineering-programme-1.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Biomedical Engineering Programme</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/online-biomedical-engineering-diploma-program" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/mechatronics-engineering-program-1.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Mechatronics Engineering Programme</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/online-mechatronics-engineering-diploma-program" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/petroleum-engineering-program-1.jpg')"></div>
                    <div class="card-content">
                        <h4>Petroleum Engineering Programme</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/study-online-petroleum-engineering-diploma-program"
                            class="apply-btn">Details</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/chemical-engineering-program-1.jpg')"></div>
                    <div class="card-content">
                        <h4>Chemical Engineering Programme</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/online-chemical-engineering-diploma" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/electrical-vehicle-engineering-course-1.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Electrical Vehicle Engineering Course</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/online-electrical-vehicle-engineering-course" class="apply-btn">Details</a>
                    </div>
                </div>



                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/health-administration.jpg')"></div>
                    <div class="card-content">
                        <h4>Health Administration</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/health-administration" class="apply-btn">Apply Now</a>
                    </div>
                </div>

                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/marketing-management-sales-management.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Marketing Management Sales Management</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/marketing-management-sales-management-programme" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image" style="background-image:url('/frontend/assets/images/robotics.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Automation & Robotics Engineering Program</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/automation-robotics-engineering-program" class="apply-btn">Apply Now</a>
                    </div>
                </div>

                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/automative-diagnostics.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Automotive Diagnostics Engineering Course</h4>
                        <p>Duration: 6 Months</p>
                        <p class="pricee">$599</p>
                        <a href="/courses/automotive-diagnostics-engineering-course" class="apply-btn">Apply Now</a>
                    </div>
                </div>

            </div>

            <button class="nav-arrow right">&#10095;</button>
        </div>
    </section>

    {{-- UK Qualification Diploma Programs --}}
    <section style="padding: 10px 0" class="course-carousel-section">
        <h2 class="section-title">UK Qualification Diploma Programs</h2>

        <div class="carousel-wrapper custom-carousel">
            <button class="nav-arrow left">&#10094;</button>

            <div class="carousel-track">
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/level-3-foundation-diploma-accountancy-1.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Level-3 Foundation Diploma in Accountancy</h4>
                        <p>Duration: 12 Months</p>
                        <p class="pricee">$1999</p>
                        <a href="/courses/level-3-foundation-diploma-in-accountancy" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/level-3-foundation-diploma-in-higher-education-1.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Level-3 Foundation Diploma in Higher Education</h4>
                        <p>Duration: 12 Months</p>
                        <p class="pricee">$1999</p>
                        <a href="/courses/level-3-foundation-diploma-in-higher-education" class="apply-btn"
                            style="padding:1px">Apply Now</a>
                    </div>
                </div>
                {{-- <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/level-3-diploma-in-education-and-training-1.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Level-3 Diploma in Education and Training</h4>
                        <p>Duration: 12 Months</p>
                        <p class="pricee">$1999</p>
                        <a href="/courses/level-3-diploma-in-education-and-training" class="apply-btn">Apply Now</a>
                    </div>
                </div> --}}
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/level-4-foundation-diploma-in-accountancy-1.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Level-4 Diploma in Accounting and Business</h4>
                        <p>Duration: 12 Months</p>
                        <p class="pricee">$1999</p>
                        <a href="/courses/level-4-and-5-diploma-in-accounting-and-business" class="apply-btn">Apply
                            Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/level-4-diploma-in-education-and-training-1.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Level-4 Diploma in Education and Training</h4>
                        <p>Duration: 12 Months</p>
                        <p class="pricee">$1999</p>
                        <a href="/courses/level-4-and-5-diploma-in-education-and-training" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/level-4-business-management.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Level-4 Diploma in Business Management</h4>
                        <p>Duration: 12 Months</p>
                        <p class="pricee">$1999</p>
                        <a href="/courses/level-4-diploma-in-business-management" class="apply-btn">Apply Now</a>
                    </div>
                </div>

                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/level-5-diploma-in-accounting-and-business-1.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Level-5 Diploma in Accounting and Business</h4>
                        <p>Duration: 12 Months</p>
                        <p class="pricee">$1999</p>
                        <a href="/courses/level-5-diploma-in-accounting-and-business" class="apply-btn">Apply Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="card-image"
                        style="background-image:url('/frontend/assets/images/level-5-business-management.jpg')">
                    </div>
                    <div class="card-content">
                        <h4>Level-5 Diploma in Business Management</h4>
                        <p>Duration: 12 Months</p>
                        <p class="pricee">$1999</p>
                        <a href="/courses/level-5-diploma-in-business-management" class="apply-btn">Apply Now</a>
                    </div>
                </div>



            </div>

            <button class="nav-arrow right">&#10095;</button>
        </div>
    </section>

    <!-- About [image] -->
    <section style="padding: 40px 0px" id="about" class="section-1 highlights image-right">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 align-self-center text-center text-md-left">
                    <div class="row intro">
                        <div class="col-12 p-0">
                            <h2 class="featured alt">Our Accreditations & Recognitions</h2>
                            <p>
                                ASTI Academy DWC is proud to be recognized by the Government of
                                Dubai, underscoring our commitment to upholding the highest
                                educational standards. This recognition affirms our status as
                                a trusted educational institution within the UAE. Further
                                enhancing our credentials is our accreditation from the
                                Technical and Vocational Education and Training (TVET)
                                authority.<br />
                                This accreditation not only ensures that our programs meet
                                rigorous quality standards but also signifies that our
                                curriculum is designed to provide practical, hands-on learning
                                experiences that are directly applicable to the job market.
                                Students graduating from ASTI Academy DWC can be confident that
                                their education is among the best the region has to offer,
                                fully aligned with the needs of the industry and backed by the
                                assurance of governmental oversight.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row divided-list">
                        <div class="col-md-3 divided-col"
                            style=" display: flex; justify-content: center; align-items: center;">
                            <div class="divided-col-item" style="margin: 10px; padding: 10px">
                                <a href="/frontend/assets/images/wes-logo.png">
                                    <img src="/frontend/assets/images/wes-logo.png" alt="About Us" />
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 divided-col"
                            style=" display: flex; justify-content: center; align-items: center;">
                            <div class="divided-col-item" style="margin: 10px; padding: 10px">
                                <a href="/frontend/assets/images/sce-logo.png">
                                    <img src="/frontend/assets/images/sce-logo.png" alt="About Us" />
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 divided-col"
                            style=" display: flex; justify-content: center; align-items: center;">
                            <div class="divided-col-item" style="margin: 10px; padding: 10px">
                                <a href="/frontend/assets/images/mof-logo.png">
                                    <img src="/frontend/assets/images/mof-logo.png" alt="About Us" />
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 divided-col"
                            style=" display: flex; justify-content: center; align-items: center;">
                            <div class="divided-col-item" style="margin: 10px; padding: 10px">
                                <a href="/frontend/assets/images/khd-logo.png">
                                    <img src="/frontend/assets/images/khd-logo.png" alt="About Us" />
                                </a>
                            </div>
                        </div>

                        <div class="col-md-3 divided-col"
                            style=" display: flex; justify-content: center; align-items: center;">
                            <div class="divided-col-item" style="margin: 10px; padding: 10px">
                                <a href="/frontend/assets/images/moh-logo.png">
                                    <img src="/frontend/assets/images/moh-logo.png" alt="About Us" />
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 divided-col"
                            style=" display: flex; justify-content: center; align-items: center;">
                            <div class="divided-col-item" style="margin: 10px; padding: 10px">
                                <a href="/frontend/assets/images/qad-logo.png">
                                    <img src="/frontend/assets/images/qad-logo.png" alt="About Us" />
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 divided-col"
                            style=" display: flex; justify-content: center; align-items: center;">
                            <div class="divided-col-item" style="margin: 10px; padding: 10px">
                                <a href="/frontend/assets/images/ofqual-logo.png">
                                    <img src="/frontend/assets/images/ofqual-logo.png" alt="About Us" />
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 divided-col"
                            style=" display: flex; justify-content: center; align-items: center;">
                            <div class="divided-col-item" style="margin: 10px; padding: 10px">
                                <a href="/frontend/assets/images/tvet-logo.png">
                                    <img src="/frontend/assets/images/tvet-logo.png" alt="About Us" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Services -->
    <section style=" padding:40px 0" id="services" class="section-3 offers">
        <div class="container">
            <div class="row intro">
                <div class="col-12 col-md-12 align-self-center text-center text-md-left">
                    <h2 class="featured">Study at top training institute in dubai</h2>
                </div>
            </div>
            <div class="row justify-content-center text-center items">
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card featured">
                        <i class="icon icon-globe"></i>
                        <h4>Affordability of the programs</h4>
                        <p>
                            Programs without compromising on the quality of education and
                            experience provided.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card">
                        <i class="icon icon-basket"></i>
                        <h4>Internationally recognized qualifications</h4>
                        <p>
                            Each program is designed to meet international standards,
                            qualifications recognized globally.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card">
                        <i class="icon icon-screen-smartphone"></i>
                        <h4>Industry-relevant curriculum</h4>
                        <p>
                            We continuously update our courses to reflect the latest trends
                            and technologies in the industry.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card">
                        <i class="icon icon-layers"></i>
                        <h4>Supportive learning environment</h4>
                        <p>
                            We provide a range of student services, including counseling,
                            tutoring, and career advising, educational journey.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card">
                        <i class="icon icon-chart"></i>
                        <h4>Experienced and qualified instructors</h4>
                        <p>
                            With years of industry experience, they are equipped to provide
                            you with insights and knowledge that go beyond textbooks and
                            theory.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card featured">
                        <i class="icon icon-bulb"></i>
                        <h4>Graduate Faster</h4>
                        <p>
                            With intensive courses and year-round study options, you can
                            accelerate your learning and graduate sooner than traditional
                            programs allow.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Features -->
    <section style="padding:10px 0px" id="features" class="section-3 offers">
        <div class="container">
            <div class="row text-center intro">
                <div class="col-12">
                    <h2 class="featured alt">
                        Why Choose ASTI for CPD Courses?
                    </h2>
                </div>
            </div>
            <div class="row justify-content-center text-center items">
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-globe"></i>
                        <h4>Advanced Learning Platform</h4>
                        <p>
                            Experience seamless learning through our intuitive online platform—built to make training
                            easy,
                            engaging, and accessible from anywhere.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-basket"></i>
                        <h4>Globally Recognized CPD Certification</h4>
                        <p>
                            All our Continuing Professional Development courses are recognized internationally, offering
                            professional credibility and career value that employers trust.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-screen-smartphone"></i>
                        <h4>Experienced & Qualified Instructors</h4>
                        <p>
                            Learn from professionals who’ve walked the path—our trainers are active experts in their
                            fields,
                            bringing real-world knowledge to every lesson.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-layers"></i>
                        <h4 style="white-space: nowrap">Skill-equipping Curriculum</h4>
                        <p>
                            Our CPD courses are designed to deliver practical skills that you can apply immediately—no
                            theory overload, just career-ready knowledge.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-chart"></i>
                        <h4>Flexible Study Schedule</h4>
                        <p>
                            Messed with work, family, and learning? No problem. Our self-paced courses and live online
                            sessions fit your busy lifestyle.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-bulb"></i>
                        <h4>Professional Growth Support</h4>
                        <p>
                            From resume-building tips to upskilling for promotion, our programs are built to support
                            your
                            journey toward meaningful career growth.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="padding: 10px 0px">
        <div class="container">
            <div class="row text-center intro">
                <div class="col-12">
                    <h2 class="featured alt">
                        Start Learning in 3 Easy Steps
                    </h2>
                </div>
            </div>
            <div class="bg-white rounded-3 shadow-lg p-4 p-md-5 mx-auto" style="max-width: 900px;">
                <!-- Progress Steps -->
                <div class="progress-steps mb-5">
                    <div class="progress-line">
                        <div class="progress-line-fill"></div>
                    </div>

                    <!-- Step 1 -->
                    <div class="step">
                        <div class="step-circle">1</div>
                        <div class="step-text">Explore Program</div>
                    </div>

                    <!-- Step 2 - Active -->
                    <div class="step active">
                        <div class="step-circle">2</div>
                        <div class="step-text">Click Enroll & Pay</div>
                    </div>

                    <!-- Step 3 -->
                    <div class="step">
                        <div class="step-circle">3</div>
                        <div class="step-text">Start Learning</div>
                    </div>
                </div>

                <!-- Content Sections -->
                <div class="content-sections">
                    <!-- Section 1 -->
                    <div>
                        <div class="d-flex gap-4 content-flex">
                            <div class="content-icon flex-shrink-0 m-3">
                                <i class="bi bi-rocket-takeoff-fill"></i>
                            </div>
                            <div>
                                <h4>Explore the Program – Browse our wide range of courses</h4>
                                <p class="text-secondary mb-0">
                                    It's simple. Just visit our Courses, where you can browse a wide range of online
                                    programs across various industries. Each course includes detailed information about
                                    what you'll learn, the format, duration, and outcomes—so you can choose what fits
                                    your goals best.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2 -->
                    <div>
                        <div class="d-flex gap-4 content-flex">
                            <div class="content-icon flex-shrink-0 m-3">
                                <i class="bi bi-rocket-takeoff-fill"></i>
                            </div>
                            <div>
                                <h4>Click Enroll & Pay – Secure your spot in minutes</h4>
                                <p class="text-secondary mb-0">
                                    Once you've found the right course, click the "Enroll Now" button on the course
                                    page.
                                    You'll be guided through a quick and secure payment process to confirm your
                                    Admission.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3 -->
                    <div>
                        <div class="d-flex gap-4 content-flex">
                            <div class="content-icon flex-shrink-0 m-3">
                                <i class="bi bi-rocket-takeoff-fill"></i>
                            </div>
                            <div>
                                <h4>Start Learning – Get immediate access to your course and begin</h4>
                                <p class="text-secondary mb-0">
                                    As soon as your enrollment is confirmed, you'll receive an email with login
                                    credentials
                                    to access our LMS tool. From there, you can start learning immediately—no waiting,
                                    no
                                    delays.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team -->
    {{-- <section id="team" class="section-2 carousel card-white">
        <div class="overflow-holder">
            <div class="container">
                <div class="row text-center intro">
                    <div class="col-12">
                        <h2 class="featured alt">Satisfied Students & Their Stories</h2>
                    </div>
                </div>
                <div class="swiper-container mid-slider-simple items">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/1.webp" alt="Adams Baker"
                                        class="person" />
                                    <h4>Ahmed Al Mansoori</h4>
                                    <p>The ASTI Dubai accounting program is thorough and effective. The lecturer is very
                                        knowledgeable, and the lessons are well-structured. My internships and skills
                                        here
                                        boosted my confidence in accounting and business. </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/17.webp" alt="Mary Evans"
                                        class="person" />
                                    <h4>Fatima Al Nuaimi</h4>
                                    <p>ASTI Dubai has provided me with unparalleled opportunities to grow both
                                        personally
                                        and professionally. The practical application and real-life scenarios where
                                        business
                                        principles are put into practice have been extremely valuable.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/18.webp" alt="Sarah Lopez"
                                        class="person" />
                                    <h4>Sara Thomas</h4>
                                    <p>The Level 4&5 diploma in education and training program at ASTI Dubai is
                                        exceptional.
                                        The faculty's expertise and willingness to mentor students have significantly
                                        contributed to my academic and professional development.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/4.webp" alt="Joseph Hills"
                                        class="person" />
                                    <h4>Mohammed </h4>
                                    <p>Being a part of the education and training program at ASTI Dubai has been an
                                        incredible experience. The emphasis placed on education and training has
                                        provided me
                                        with a robust groundwork to pursue a career. </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/19.webp" alt="Joseph Hills"
                                        class="person" />
                                    <h4>Ayesha Farsi</h4>
                                    <p>ASTI Dubai's accounting and business program is top-notch. The focus on
                                        curriculum
                                        has aligned perfectly with my passion for sustainability. The practical
                                        experience
                                        and research opportunities have prepared me.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/20.webp" alt="Joseph Hills"
                                        class="person" />
                                    <h4>Khalid Sharif</h4>
                                    <p>The Accounting program at ASTI Dubai is comprehensive and useful. The courses are
                                        well-structured, and the faculty are highly knowledgeable. My internships and
                                        the
                                        skills I’ve gained here have given me the confidence.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Blog -->
    {{-- <section id="blog" class="section-1 showcase blog-grid masonry news">
        <div data-aos="zoom-in" data-aos-delay="200" data-aos-anchor="body" class="container">
            <div class="row text-center intro">
                <div class="col-12">
                    <h2 class="featured alt">Recent Blogs & Articles</h2>
                </div>
            </div>
            <div class="row content blog-grid masonry">
                <main class="col-12 p-0">
                    <div class="bricklayer items columns-3">
                        <div class="card p-0 item">
                            <div class="image-over">
                                <img src="/frontend/assets/images/news-4-h.webp" alt="Lorem ipsum" />
                            </div>
                            <div class="card-caption col-12 p-0">
                                <div class="card-body">
                                    <a href="javascript:void(0)">
                                        <h4>
                                            Enlightening Ideas: An Exploration into Electrical and
                                            Electronic Engineering
                                        </h4>
                                    </a>
                                </div>
                                <div class="card-footer d-lg-flex align-items-center justify-content-center">
                                    <a href="javascript:void(0)" class="d-lg-flex align-items-center"><i
                                            class="icon-user"></i> ASTI Academy</a>
                                    <a href="javascript:void(0)" class="d-lg-flex align-items-center"><i
                                            class="icon-clock"></i> April 3, 2024
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card p-0 item">
                            <div class="image-over">
                                <img src="/frontend/assets/images/news-3-h.webp" alt="Lorem ipsum" />
                            </div>
                            <div class="card-caption col-12 p-0">
                                <div class="card-body">
                                    <a href="javascript:void(0)">
                                        <h4>
                                            Leadership Essentials: Developing the Skills and
                                            Qualities of Effective Business Leaders
                                        </h4>
                                    </a>
                                </div>
                                <div class="card-footer d-lg-flex align-items-center justify-content-center">
                                    <a href="javascript:void(0)" class="d-lg-flex align-items-center"><i
                                            class="icon-user"></i>ASTI Academy</a>
                                    <a href="javascript:void(0)" class="d-lg-flex align-items-center"><i
                                            class="icon-clock"></i> March 29, 2024
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card p-0 item">
                            <div class="image-over">
                                <img src="/frontend/assets/images/news-6-h.webp" alt="Lorem ipsum" />
                            </div>
                            <div class="card-caption col-12 p-0">
                                <div class="card-body">
                                    <a href="javascript:void(0)">
                                        <h4>
                                            Mastering the Arc: Essential Welding Techniques Upskill
                                            your Career
                                        </h4>
                                    </a>
                                </div>
                                <div class="card-footer d-lg-flex align-items-center justify-content-center">
                                    <a href="javascript:void(0)" class="d-lg-flex align-items-center"><i
                                            class="icon-user"></i>ASTI Academy</a>
                                    <a href="javascript:void(0)" class="d-lg-flex align-items-center"><i
                                            class="icon-clock"></i> March 29, 2024
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section> --}}

    <section style="padding: 10px 0;">
        <div class="content-section" style=" padding:10px 0px">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-7 text-md-left mt-5">
                    <h3 class="text-center">ASTI Online vs Other Institute</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered"
                            style="
                border-collapse: collapse !important;
                border-spacing: 0 !important;
              ">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Aspect</th>
                                    <th>ASTI Online</th>
                                    <th>Other Institute</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-weight: bold">Flexibility in Schedule</td>
                                    <td>
                                        Allows students to set their own study hours, balancing
                                        work, family, and personal commitments.
                                    </td>
                                    <td>
                                        Requires adherence to fixed class schedules, limiting
                                        flexibility for those with busy or unpredictable routines.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold">Cost-Effectiveness</td>
                                    <td>
                                        Saves money on commuting, housing, and campus-related fees,
                                        making education more affordable.
                                    </td>
                                    <td>
                                        Involves additional expenses like transportation,
                                        accommodation, and campus services, increasing the overall
                                        cost of education.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold">Accessibility</td>
                                    <td>
                                        Accessible to anyone with an internet connection, allowing
                                        learners from any geographic location to study.
                                    </td>
                                    <td>
                                        Requires physical presence, making it difficult for students
                                        living far from the institution or in rural areas.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold">Self-Paced Learning</td>
                                    <td>
                                        Offers the ability to learn at one’s own pace, providing
                                        more time to grasp difficult concepts or accelerate through
                                        familiar material.
                                    </td>
                                    <td>
                                        Follows a rigid pace dictated by the curriculum, which might
                                        not suit every student’s learning style.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold">Learning Resources</td>
                                    <td>
                                        Utilizes a variety of multimedia resources like videos,
                                        podcasts, and interactive materials, catering to different
                                        learning styles.
                                    </td>
                                    <td>
                                        Relies mostly on traditional textbooks and in-person
                                        lectures, offering fewer varied learning tools.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold">Technological Skills</td>
                                    <td>
                                        Improves digital literacy as students use technology
                                        platforms, online collaboration tools, and virtual
                                        communication, skills crucial in today’s job market.
                                    </td>
                                    <td>
                                        Involves less frequent use of advanced technology for
                                        coursework, leading to less development of tech-savvy
                                        skills.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold">Time Management</td>
                                    <td>
                                        Encourages the development of strong time management skills
                                        as students handle deadlines and independent study.
                                    </td>
                                    <td>
                                        Provides a structured environment, which may not foster as
                                        much growth in personal time management abilities.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Subscribe -->
    <section style="padding: 10px 0px" id="subscribe" class="section-6 subscribe">
        <div class="container smaller">
            <div class="row text-center intro">
                <div class="col-12">
                    <h2 class="featured alt">Frequently Asked Questions</h2>
                </div>
            </div>
            <div class="faq-container">
                <div class="faq">
                    <h5 class="faq-title">What is a CPD Program?</h5>
                    <p class="faq-text">
                        A Continuing Professional Development (CPD) program is a structured approach to learning that
                        helps
                        professionals develop, enhance, and maintain their skills and knowledge throughout their working
                        lives. CPD goes beyond formal education, offering practical learning in the form of courses,
                        workshops, seminars, or self-managed online modules. CPD helps working professionals stay
                        competent,
                        confident, and relevant in their field—regardless of industry.
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
                    <h5 class="faq-title">How Does Continuing Professional Development (CPD) Impact Your Career?</h5>
                    <p class="faq-text">
                        CPD plays a significant role in career growth. It demonstrates a proactive commitment to
                        personal
                        and professional development, which is highly valued by employers. Whether you’re aiming for a
                        promotion, changing careers, or simply keeping your skills current, CPD boosts your professional
                        credibility and opens doors to new opportunities. It also helps build resilience in a rapidly
                        evolving job market by ensuring your knowledge aligns with industry standards.
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
                        Which course is best for accounting jobs in Dubai?
                    </h5>
                    <p class="faq-text">
                        For those aiming to pursue accounting careers in Dubai, a Diploma
                        in Accounting & Business is highly recommended. These courses are
                        tailored to meet the requirements of Dubai’s dynamic financial
                        sectors and provide a pathway to professional recognition. Course
                        is suitable for working professionals or who are seeking
                        promotions from current positions.
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
                    <h5 class="faq-title">How do I get certified to teach in Dubai?</h5>
                    <p class="faq-text">
                        To become a certified teacher in Dubai, you must obtain a teaching
                        license through the Knowledge and Human Development Authority
                        (KHDA). This typically involves completing a teaching
                        qualification, followed by passing the Teacher Licensing System
                        (TLS) exams in the UAE and TVET.
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
                        Which course is best for teaching in the UAE?
                    </h5>
                    <p class="faq-text">
                        The best courses for aspiring teachers in the UAE are the teaching
                        and education diploma in UAE . These programs are designed to
                        cover educational theories, pedagogy, and practical teaching
                        experience, aligning with the UAE’s educational standards.
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
                        Is CPD Certification Recognized in the UAE?
                    </h5>
                    <p class="faq-text">
                        Yes, CPD certifications are widely accepted in the UAE in most industries. These are recognized
                        as a
                        sign of quality and proof of continuous improvement by employers and professional bodies. While
                        CPD
                        is not mandated by law, it is mostly a personal career choice that can advance your professional
                        standing and professional growth in the country.
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
                    <h5 class="faq-title">Can I get a job with a CPD certificate?</h5>
                    <p class="faq-text">
                        A CPD certificate will not necessarily secure a job by itself, but it will enhance your
                        prospects of
                        getting one. It shows that you are committed to ongoing learning and professional development—a
                        fact
                        that will endear you to hiring managers. In tough labor markets, an accredited CPD course can
                        help
                        you stand out by showing that you have a current skill set and that you are willing to invest in
                        career development.
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
                        Does a CPD course have an exam?
                    </h5>
                    <p class="faq-text">
                        Not every CPD course includes exams. Courses are structured to prioritize practical knowledge,
                        everyday life applicability, and ease of learning. Some courses can include assessments,
                        quizzes, or
                        final projects to support the learning process and to determine your understanding of the
                        subject
                        matter. Every course will state whether an assessment is included in the course so students can
                        choose the format that works best for them.
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
@endsection

@push('scripts')
    <script src="{{ asset('frontend/assets/js/scrolling-card.js') }}"></script>
@endpush
