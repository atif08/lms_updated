<?php $page = 'Advancing Careers Through Professional Development | Know More About Us'; ?>
@extends('marketplace.layouts.front_layout')
@section('style')
    <style>
        .section-about {
            padding: 90px 20px;
        }

        .about-header {
            max-width: 800px;
            margin: 0 auto 60px;
        }

        .about-header h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .about-header p {
            font-size: 17px;
            color: #666;
            line-height: 1.6;
        }

        /* GRID */
        .about-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 34px 28px;
            height: 100%;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .about-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 44px rgba(0, 0, 0, 0.08);
        }

        .about-icon {
            font-size: 34px;
            margin-bottom: 18px;
            color: #ff3d1f;
            /* ASTI red */
        }

        .about-card h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .about-card p {
            font-size: 15px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .about-card ul {
            padding-left: 18px;
            margin-top: 10px;
        }

        .about-card ul li {
            font-size: 14px;
            color: #555;
            margin-bottom: 6px;
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .about-header h2 {
                font-size: 30px;
            }
        }

        @media (max-width: 576px) {
            .section-about {
                padding: 60px 16px;
            }

            .about-header h2 {
                font-size: 26px;
            }
        }
    </style>
@endsection
@section('content')
    <!-- Hero -->
    <section id="slider" class="hero p-0 odd featured">
        <div class="swiper-container no-slider slider-h-75">
            <div class="swiper-wrapper">
                <!-- Item 1 -->
                <div class="swiper-slide slide-center">
                    <img src="/frontend/assets/images/about us 2.webp" class="full-image" data-mask="70" />

                    <div class="slide-content row text-center">
                        <div class="col-12 mx-auto inner">
                            <h1 data-aos="zoom-out-up" data-aos-delay="400" class="title effect-static-text">
                                About Us
                            </h1>
                            <nav data-aos="zoom-out-up" data-aos-delay="800" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        About Us
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About [image] -->
    {{-- <section id="about" class="section-1 highlights image-right">
        <div class="container">
            <div class="row">
                <div
                    class="col-12 col-md-6 align-self-center text-center text-md-left"
                >
                    <div class="row intro">
                        <div class="col-12 p-0">
                            <h3 class="featured alt">Why Choose ASTI Online for Your Professional Development?</h3>
                            <p style="text-align: justify;">
                                At ASTI Online, we are dedicated to shaping professionals for tomorrow's world of work. As a
                                trusted institute of Continuing Professional Development (CPD) courses, we stand apart in
                                our commitment to practical, career-focused education that supports lifelong learning.
                            </p>
                            <p style="text-align: justify;">
                                Unlike traditional academic institutions, ASTI DWC focuses exclusively on helping
                                individuals and organizations gain relevant, recognized skills that can be immediately
                                applied in the workplace. Whether you're looking to upskill, reskill, or maintain industry
                                competence, our accredited CPD programs are designed to meet the evolving needs of today’s
                                ever-evolving job market.
                            </p>
                            <h3>Who We Are</h3>
                            <p style="text-align: justify;">
                                ASTI DWC Online is part of a growing network of professional education providers. Our
                                identity is rooted in delivering quality CPD training, with a strong emphasis on career
                                advancement, industry relevance, and flexible learning options.
                            </p>
                            <p style="text-align: justify;">
                                ASTI Online is made up of experienced trainers, industry experts, and academic advisors who
                                understand what today’s professionals need. Every course we offer is crafted to deliver not
                                just knowledge, but skill equipping capability.
                            </p>
                        </div>
                    </div>
                    <div class="row items">
                        <div class="col-12 p-0">
                            <div class="row item">
                                <div class="col-12 col-md-2 align-self-center">
                                    <i class="icon icon-badge"></i>
                                </div>
                                <div class="col-12 col-md-9 align-self-center">
                                    <h4>Our Mission</h4>
                                    <p style="text-align: justify;">
                                        Our mission is to support professionals, businesses, and learners at all levels in
                                        achieving excellence through lifelong learning. By delivering accessible, accredited
                                        CPD courses tailored to industry needs, we help individuals thrive in a
                                        fast-changing world.
                                    </p>
                                    <p>
                                        We are committed to :
                                    </p>
                                    <ul class="ps-3">
                                        <li>Delivering high-quality, practical learning experiences</li>
                                        <li>Maintaining global standards in professional development</li>
                                        <li>Fostering a culture of continuous growth</li>
                                        <li>Supporting learners through expert mentorship and modern tools</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row item">
                                <div class="col-12 col-md-2 align-self-center">
                                    <i class="icon icon-briefcase"></i>
                                </div>
                                <div class="col-12 col-md-9 align-self-center">
                                    <h4>Our Vision</h4>
                                    <p style="text-align: justify;">
                                        At ASTI DWC, our vision is to become a leading center for Continuing Professional
                                        Development (CPD) that empowers professionals with transformative learning
                                        experiences. We aim to be recognized for our innovation, practical training, and
                                        unwavering focus on building a job-ready career.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gallery col-12 col-md-6">
                    <a href="/frontend/assets/images/about1.webp">
                        <img
                            src="/frontend/assets/images/about1.webp"
                            class="fit-image"
                            alt="About Us"
                        />
                    </a>
                </div>
            </div>
        </div>
    </section> --}}
    <section id="about" class="section-about">
        <div class="container">

            <!-- SECTION HEADER -->
            <div class="about-header text-center">
                <h2>Why Choose ASTI Online for Your Professional Development?</h2>
                <p>
                    At ASTI Online, we are dedicated to shaping professionals for tomorrow’s world of work
                    through practical, career-focused, and globally recognised education.
                </p>
            </div>

            <!-- CONTENT GRID -->
            <div class="row about-grid">

                <!-- WHO WE ARE -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="about-card">
                        <div class="about-icon">
                            <i class="icon icon-badge"></i>
                        </div>
                        <h3 style="text-align: center">Who We Are</h3>
                        <p style="text-align: center">
                            ASTI Academy DWC Online is part of a growing network of professional education providers,
                            focused exclusively on Continuing Professional Development (CPD) and career
                            advancement.
                        </p>
                        <p style="text-align: center">
                            Our programs are designed by experienced trainers, industry experts, and academic
                            advisors to deliver practical skills that can be applied immediately in the workplace.
                        </p>
                    </div>
                </div>

                <!-- OUR MISSION -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="about-card">
                        <div class="about-icon">
                            <i class="icon icon-briefcase"></i>
                        </div>
                        <h3 style="text-align: center">Our Mission</h3>
                        <p style="text-align: center">
                            To support professionals and organisations through accessible, accredited CPD
                            programs that enable lifelong learning and professional excellence.
                        </p>
                        <ul style="text-align: center">
                            <li style="list-style-type: none">High-quality, practical learning experiences</li>
                            <li style="list-style-type: none">Global standards in professional development</li>
                            <li style="list-style-type: none">Continuous growth and upskilling</li>
                            <li style="list-style-type: none">Expert mentorship and modern learning tools</li>
                        </ul>
                    </div>
                </div>

                <!-- OUR VISION -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="about-card">
                        <div class="about-icon">
                            <i class="icon icon-globe"></i>
                        </div>
                        <h3 style="text-align: center">Our Vision</h3>
                        <p style="text-align: center">
                            To become a leading global centre for Continuing Professional Development,
                            recognised for innovation, practical training, and a strong focus on job-ready
                            careers.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Features -->
    <section id="features" class="section-2 odd offers" style="background-color: #eaeaea !important">
        <div class="container">
            <div class="row justify-content-center items">
                <div class="col-12 col-md-6 col-lg-6 item">
                    <a href="/frontend/assets/images/about2.webp">
                        <img src="/frontend/assets/images/about2.webp" class="fit-image" alt="About Us" />
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-6 item">
                    <div class="card no-hover">
                        <h2 class="featured" style="color: black">
                            Message From The Chairman
                        </h2>
                        <p style="text-align: justify;">
                            The institution holds firm to the belief that each of us makes
                            an astonishing difference! Indeed, astonishing differences are
                            just what institutions are about; we bring richness and value to
                            the communities we serve by providing access to higher education
                            to a diverse student body and Al Shabaka Technical Institutional
                            Academy is no exception. Deeply rooted in a commitment to
                            student success, equity, and life-long learning, Al Shabaka
                            Technical Institutional Academy is an institution in which our
                            students thrive because we are intentional and purposeful in
                            creating a learning environment focused on their evolution as
                            learners and citizens of the Human Community. This institution
                            believes deeply that every student who comes here is entitled to
                            an educational experience grounded in excellence, and that is
                            what you will find in our classrooms, in our offices, in our
                            services, in our programs, and in the way we treat our students
                            and community. We continue to be grateful to the UAE Government,
                            Ministry of Education, Government of Dubai, and Knowledge and
                            Human Development Authority, who supported the guidance of Al
                            Shabaka Technical Institutional Academy. We hope to make a
                            difference in your life, and I challenge them to make a
                            difference at Al Shabaka Technical Institutional Academy,
                            community, region, and thus the planet we live on while they are
                            here with us.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="padding:10px 0px;">
        <div class="container">

            <h2 style="color: black">
                Why Choose ASTI DWC?
            </h2>
            <ul class="custom-list">
                <li><strong>Specialized in CPD Training</strong> – Unlike broad academic institutions, we focus solely on
                    professional development.
                </li>
                <li><strong>Internationally Recognized Certification</strong> – Our CPD courses align with global standards
                    and are valued by employers.
                </li>
                <li><strong>Flexible & Accessible</strong> – Learn at your own pace through online from anywhere.</li>
                <li><strong>Industry-Specific Curriculum</strong> – Each course is updated regularly to reflect the latest
                    industry trends and practices.
                </li>
                <li><strong>Experienced Faculty</strong> – Our trainers bring real-world insights to the learning
                    experience.
                </li>
            </ul>

        </div>
    </section>

    <section style="padding: 10px 0px;">
        <div class="container">

            <h2 style="color: black">
                Who Should Enroll?
            </h2>
            <p>
                Our CPD programs are ideal for:
            </p>
            <ul>
                <li>Working professionals seeking career growth</li>
                <li>HR teams investing in employee development</li>
                <li>Fresh graduates preparing for employment</li>
                <li>Freelancers and consultants looking to validate their expertise</li>

            </ul>

        </div>
    </section>

    <!-- Subscribe -->
    <section id="subscribe" class="section-6 subscribe">
        <div class="container smaller">
            <div class="row text-center intro">
                <div class="col-12">
                    <h2 class="featured alt">Frequently Asked Questions</h2>
                </div>
            </div>
            <div class="faq-container">
                <div class="faq">
                    <h5 class="faq-title">What makes ASTI DWC different from traditional academic institutions?</h5>
                    <p class="faq-text">
                        Unlike general academic institutions, ASTI Online specializes in CPD—providing skill-focused,
                        career-aligned training for working professionals. Our approach is flexible, targeted, and designed
                        to deliver immediate workplace value.
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
                    <h5 class="faq-title">Are ASTI DWC’s CPD courses accredited?</h5>
                    <p class="faq-text">
                        Yes, all our CPD courses are accredited and align with international CPD standards. Our
                        certifications are widely recognized by employers and professional bodies.
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
                        Who can enroll in CPD courses at ASTI DWC?
                    </h5>
                    <p class="faq-text">
                        Anyone who is committed to personal and professional development can enroll—whether you're a working
                        professional, recent graduate, freelancer, or organization investing in your team.
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
                    <h5 class="faq-title">How are the courses delivered?</h5>
                    <p class="faq-text">
                        We offer flexible learning formats including online, hybrid, and in-person training, allowing
                        learners to choose what best fits their schedule and lifestyle.
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


    <section id="services" class="section-3 offers" style="padding:10px 0px">
        <div class="container">
            <div class="row text-center intro">
                <div class="col-12">
                    <h2 class="featured alt">Out Core Values</h2>
                </div>
            </div>
            <div class="row justify-content-center text-center items">
                <div class="col-12 col-md-6 col-lg-3 item">
                    <div class="card featured h-100">
                        <i class="bi bi-award icon"></i>
                        <h4>Commitment to Quality</h4>

                        <p>
                            We are dedicated to delivering training programs that meet the
                            highest standards, ensuring exceptional value.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 item">
                    <div class="card h-100">
                        <i class="bi bi-person-check icon"></i>
                        <h4>Learner-Centered Approach</h4>

                        <p>
                            Our courses are designed with the learner in mind, offering
                            engaging and flexible content.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 item">
                    <div class="card h-100">
                        <i class="bi bi-shield-check icon"></i>
                        <h4>Integrity and Transparency</h4>

                        <p>
                            We operate with honesty, fairness, and openness in all our
                            processes—from enrollment to certification.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 item">
                    <div class="card h-100">
                        <i class="bi bi-graph-up icon"></i>
                        <h4>Industry Relevance</h4>

                        <p>
                            Our curriculum is updated to align with industry trends,
                            ensuring learners gain valuable skills.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 item">
                    <div class="card h-100">
                        <i class="bi bi-lightbulb icon"></i>
                        <h4>Lifelong Learning</h4>

                        <p>
                            We encourage continuous learning, helping professionals stay
                            ahead in their careers.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 item">
                    <div class="card h-100">
                        <i class="bi bi-laptop icon"></i>
                        <h4>Innovation in Learning</h4>

                        <p>
                            We use modern teaching methods and technology to create
                            interactive learning experiences.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 item">
                    <div class="card h-100">
                        <i class="bi bi-stars icon"></i>
                        <h4>Professional Excellence</h4>

                        <p>
                            We strive for excellence in everything we do, ensuring the
                            highest quality of education.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 item">
                    <div class="card featured h-100">
                        <i class="bi bi-people icon"></i>
                        <h4>Empowerment Through Education</h4>

                        <p>
                            Our goal is to empower individuals with skills and confidence to
                            succeed professionally.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    {{-- <section id="testimonials" class="section-3 carousel" style="background-color: #fff; paddign:10px 0px;">
        <div class="overflow-holder">
            <div class="container">
                <div class="row text-center intro">
                    <div class="col-12">
                        <h3>What Our Learners Say About Us </h3>
                    </div>
                </div>
                <div class="swiper-container mid-slider items">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/test-1.jpg" alt="Adams Baker"
                                        class="person" />
                                    <h4>Samantha R. <br /> Project Coordinator</h4>
                                    <p style="text-align: justify">
                                        “ASTI DWC’s CPD course helped me upskill and land a better role in my company. The
                                        trainers were knowledgeable, and the content was directly applicable to my work.”
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/testi-2.jpg" alt="Mary Evans"
                                        class="person" />
                                    <h4>Leah M. <br /> Business Analyst</h4>
                                    <p style="text-align: justify">
                                        “Flexible, professional, and practical. The learning format was perfect for my
                                        schedule, and the certification added real value to my CV.”
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/testi-3.jpg" alt="Nadia Malik"
                                        class="person" />
                                    <h4>Fatima L. <br /> HR Manager</h4>
                                    <p style="text-align: justify">
                                        “What stood out about ASTI DWC was their commitment to quality. The training was
                                        top-notch, and the support team made my learning journey smooth.”
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

    <section style="padding: 10px 0px">
        <div class="container py-5">
            <div class="row text-center intro">
                <div class="col-12">
                    <h2 class="featured alt">Our Impact in Numbers</h2>
                </div>
            </div>
            <div class="row g-4 text-center align-items-stretch">
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card h-100">
                        <div class="stat-number">50+</div>
                        <h4 class="stat-text">CPD courses delivered</h4>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card h-100">
                        <div class="stat-number">500+</div>
                        <h4 class="stat-text">Professionals trained</h4>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card h-100">
                        <div class="stat-number">97%</div>
                        <h4 class="stat-text">Learner satisfaction rate</h4>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card h-100">
                        <div class="stat-number">30+</div>
                        <h4 class="stat-text">Industry sectors covered</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
