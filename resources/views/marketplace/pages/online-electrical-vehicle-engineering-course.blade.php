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
                                Electrical Vehicle Engineering Course
                            </h1>
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
            <a class="enroll-button" href="{{ route('login') }}">
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
                                Electrical Vehicle Engineering Course
                            </h3>
                            <p style="text-align: justify">
                                The Electrical Vehicle Engineering Course at ASTI Academy is
                                designed to equip students and professionals with the
                                necessary skills and knowledge to excel in the fast-growing
                                electric vehicle (EV) industry. This fully online course
                                covers all aspects of electric vehicle technology, from design
                                and development to maintenance and repair. With the rise in
                                demand for electric vehicles globally, this online electric
                                vehicle course is perfect for those looking to advance their
                                careers or enter this exciting field.
                            </p>
                            <a href="/courses/contact" class="btn primary-button button">Apply Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <a href="#">
                        <img src="/frontend/assets/images/electrical-vehicle-engineering-course-1.jpg" class="fit-image"
                            alt="Electrical Vehicle Engineering Program" />
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
                                <a href="#section5"><span>Learning outcomes</span> </a>
                            </li>
                        </ul>
                    </main>
                </div>
            </div>

            <div id="section1" class="content-section" style="padding: 10px 0px">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Course Overview</h3>
                        <p>
                            The Electrical Vehicle Engineering Course offers a comprehensive
                            overview of the fundamental principles of electric vehicle
                            technology, including electric motors, battery systems, power
                            electronics, and vehicle dynamics. Through a combination of
                            theoretical instruction and practical case studies, students
                            will gain in-depth knowledge of how electric vehicles are
                            designed, tested, and maintained. This EV course online also
                            provides hands-on learning through virtual simulations, allowing
                            students to apply their learning to real-world scenarios. By
                            completing this online electric vehicle engineering course,
                            students will be prepared to meet the demands of the rapidly
                            evolving EV industry.
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <a href="/courses/contact" class="btn primary-button button">Enquiry Now</a>
                </div>
            </div>

            <div id="section2" class="content-section" style="padding: 10px 0px">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Course Objective</h3>
                        <p>
                            The primary objective of the Electrical Vehicle Engineering
                            Course is to provide students with the technical expertise
                            required to work in the electric vehicle industry. The course
                            aims to:
                        </p>
                        <ul>
                            <li>
                                Provide a deep understanding of electric vehicle components,
                                systems, and operations.
                            </li>
                            <li>
                                Develop skills in diagnosing, maintaining, and repairing
                                electric vehicles.
                            </li>
                            <li>
                                Prepare students to work with modern EV technologies,
                                including power electronics and battery management systems.
                            </li>
                            <li>
                                Equip students with knowledge of the latest trends and
                                innovations in electric vehicle technology.
                            </li>
                            <li>
                                Foster problem-solving abilities in the design and testing of
                                electric vehicles.
                            </li>
                            <li>
                                Offer an internationally recognized certification upon course
                                completion.
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
                                        <td>Module 1: Introduction to Electric Vehicles</td>
                                        <td>4 Hours</td>
                                        <td>An overview of electric vehicles (EVs), their types, benefits, and the
                                            technological advances driving the transition to sustainable transportation.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Module 2: EV Drivetrain Systems</td>
                                        <td>6 Hours</td>
                                        <td>Focuses on the components and working principles of EV drivetrains, including
                                            electric motors, transmissions, and power electronics that enable efficient
                                            vehicle movement.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 3: Battery Technology and Energy Storage Systems</td>
                                        <td>8 Hours</td>
                                        <td>Explores the types of batteries used in EVs, energy storage solutions, and the
                                            latest advancements in battery performance, charging, and management.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 4: Electric Vehicle Charging Infrastructure</td>
                                        <td>6 Hours</td>
                                        <td>Examines the systems and technologies required for EV charging, including
                                            charging stations, power distribution, and emerging standards for fast-charging.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Module 5: Vehicle Control Systems and Software</td>
                                        <td>6 Hours</td>
                                        <td>Covers the integration of control systems and software in EVs, including energy
                                            management, vehicle dynamics, and autonomous driving features.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 6: Thermal Management in Electric Vehicles</td>
                                        <td>4 Hours</td>
                                        <td>Focuses on the techniques used to manage temperature in EVs, particularly in the
                                            battery, powertrain, and cabin, to ensure performance and longevity.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 7: Sustainable Manufacturing and Recycling of EV Components</td>
                                        <td>4 Hours</td>
                                        <td>Discusses environmentally friendly manufacturing processes, sustainable sourcing
                                            of materials, and recycling of EV components to minimize ecological impact.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 8: EV Performance, Safety, and Testing</td>
                                        <td>4 Hours</td>
                                        <td>Covers the key aspects of evaluating EV performance, including safety standards,
                                            crash testing, energy efficiency, and durability testing.</td>
                                    </tr>
                                    <tr>
                                        <td>Module 9: Future Trends in Electric Vehicle Technology</td>
                                        <td>4 Hours</td>
                                        <td>Exploration of future technologies and trends in the EV industry.</td>
                                    </tr>
                                </tbody>
                            </table>
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
                                        Understand the fundamental principles of electric vehicle
                                        operation, including electric motors, power electronics,
                                        and battery systems.
                                    </li>
                                    <li>
                                        Gain proficiency in diagnosing and maintaining electric
                                        vehicles using industry-standard tools and techniques.
                                    </li>
                                    <li>
                                        Develop skills in electric vehicle design, including
                                        powertrain systems and energy storage solutions.
                                    </li>
                                    <li>
                                        Understand the safety protocols and standards for handling
                                        electric vehicles and their components.
                                    </li>
                                    <li>
                                        Analyze the environmental and sustainability benefits of
                                        electric vehicle technology.
                                    </li>
                                    <li>
                                        Obtain practical experience through virtual simulations
                                        and real-world case studies.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="about" class="section-1 highlights image-right" style="padding: 40px 0">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 align-self-center text-center">
                    <div class="row intro">
                        <div class="col-12 p-0">
                            <h3 class="featured alt">UK Level System</h3>
                            <img src="/frontend/assets/images/uk-level.png" />
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
            <a class="enroll-button" href="{{ route('login') }}">
                Apply Now
            </a>
        @endif


    </div>
    <!-- Features -->
    <section id="features" class="section-2 odd offers" style="padding: 40px 0 !important">
        <div class="container">
            <h3 class="text-center">
                Why Choose ASTI Online for the Electrical Vehicle Engineering Course?
            </h3>
            <div class="row justify-content-center text-center items">
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-globe"></i>
                        <h4>Flexible Online Learning</h4>
                        <p>
                            Our EV course online offers the flexibility to study from
                            anywhere, allowing you to balance work and education.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-basket"></i>
                        <h4>Comprehensive Curriculum</h4>
                        <p>
                            The course covers all aspects of electric vehicle technology,
                            from design to maintenance and repair.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-screen-smartphone"></i>
                        <h4>Advanced Learning</h4>
                        <p>
                            Engage in virtual simulations and case studies that provide
                            practical experience in electric vehicle engineering.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-layers"></i>
                        <h4>Industry-Recognized Certification</h4>
                        <p>
                            Upon completion, you’ll receive an internationally recognized
                            electric vehicle certification course that opens doors to new
                            career opportunities.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-book-open"></i>
                        <h4>Career Support</h4>
                        <p>
                            Benefit from ASTI’s dedicated career services, helping you
                            secure roles in the growing electric vehicle industry.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-graduation"></i>
                        <h4>Pathway to Higher Qualifications</h4>
                        <p>
                            The Level 3 Engineering Diploma is the perfect stepping stone to
                            further qualifications in engineering.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features -->

    <section id="about" class="section-3 highlights image-right" style="background-color: #fff">
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
                        What is the duration of the Electrical Vehicle Engineering Course?
                    </h5>
                    <p class="faq-text">
                        The course typically takes 6 to 12 months to complete, depending
                        on your study schedule.
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
                    <h5 class="faq-title">Is the course recognized internationally?</h5>
                    <p class="faq-text">
                        Yes, this electric vehicle certification course is internationally
                        recognized, providing you with the qualifications needed to work
                        in the EV industry worldwide.
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
                    <h5 class="faq-title">Can I study while working full-time?</h5>
                    <p class="faq-text">
                        Yes, the course is designed to be flexible, allowing working
                        professionals to study at their own pace through Electric Vehicles
                        Courses Online.
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
                        What are the entry requirements for the Electrical Vehicle
                        Engineering Course?
                    </h5>
                    <p class="faq-text">
                        A high school diploma or equivalent is typically required, along
                        with a strong interest in electric vehicle technology.
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
                    <h5 class="faq-title">What topics are covered in the course?</h5>
                    <p class="faq-text">
                        The course covers electric motors, power electronics, battery
                        systems, vehicle dynamics, safety standards, and diagnostics in
                        electric vehicles.
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
                    <h5 class="faq-title">How is the course delivered online?</h5>
                    <p class="faq-text">
                        The course is delivered entirely online via ASTI Academy’s
                        learning platform, which includes live sessions, recorded
                        lectures, and virtual simulations.
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
                        What kind of support will I receive during the course?
                    </h5>
                    <p class="faq-text">
                        You will have access to academic advisors, experienced faculty,
                        and career services to support you throughout your learning
                        journey.
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
                        course?
                    </h5>
                    <p class="faq-text">
                        Graduates can pursue careers in electric vehicle design,
                        development, diagnostics, and maintenance, among other roles in
                        the EV industry.
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
                        Does the course include practical training?
                    </h5>
                    <p class="faq-text">
                        Yes, the course includes virtual simulations and case studies that
                        provide practical, hands-on learning experiences in electric
                        vehicle technology.
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
                        What is the cost of the course, and are there any financial aid
                        options available?
                    </h5>
                    <p class="faq-text">
                        For information on tuition fees and available financial aid,
                        please contact ASTI Academy directly.
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
    <!-- <section id="features" class="section-3" style="background-color: #fff">
                              <div class="container">
                                <div class="row text-center intro">
                                  <div class="col-12">
                                    <h3>What are 4 reasons to study accounting?</h3>
                                  </div>
                                </div>
                                <div class="row justify-content-center text-center items">
                                  <div class="col-12 col-md-6 col-lg-6 item">
                                    <div class="card no-hover">
                                      <i class="icon icon-globe"></i>
                                      <h4>Booming Career Opportunities</h4>
                                      <p>
                                        Accounting offers a wide range of career paths, from public
                                        accounting firms to corporate finance departments, providing
                                        stability and competitive salaries.
                                      </p>
                                    </div>
                                  </div>
                                  <div class="col-12 col-md-6 col-lg-6 item">
                                    <div class="card no-hover">
                                      <i class="icon icon-basket"></i>
                                      <h4>Global Relevance</h4>
                                      <p>
                                        Accounting principles are universal, making it a valuable skill
                                        set that transcends borders and industries, offering
                                        opportunities for international careers.
                                      </p>
                                    </div>
                                  </div>
                                  <div class="col-12 col-md-6 col-lg-6 item">
                                    <div class="card no-hover">
                                      <i class="icon icon-screen-smartphone"></i>
                                      <h4>Key Business Insights</h4>
                                      <p>
                                        Understanding financial statements and performance metrics
                                        empowers individuals to make informed business decisions,
                                        driving growth and profitability.
                                      </p>
                                    </div>
                                  </div>
                                  <div class="col-12 col-md-6 col-lg-6 item">
                                    <div class="card no-hover">
                                      <i class="icon icon-layers"></i>
                                      <h4 style="white-space: nowrap">
                                        Continuous Learning and Growth
                                      </h4>
                                      <p>
                                        Accounting is a dynamic field that constantly evolves with
                                        changing regulations and technologies, offering ample
                                        opportunities for professional development and advancement.
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section> -->

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
                                    <h4>Leila, Kuwait</h4>
                                    <p style="text-align: justify">
                                        This is one of the best electric vehicle certification
                                        courses available online. I highly recommend it to anyone
                                        interested in the EV industry.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/12.webp" alt="Mary Evans"
                                        class="person" />
                                    <h4>Ahmed, UAE</h4>
                                    <p style="text-align: justify">
                                        ASTI Academy’s online electric vehicle course helped me
                                        transition into the EV industry. The flexibility of the
                                        online format was perfect for my busy schedule.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/13.webp" alt="Khalid Mansoor"
                                        class="person" />
                                    <h4>Khalid, Bahrain</h4>
                                    <p style="text-align: justify">
                                        I gained practical skills that I could apply directly to
                                        my job in electric vehicle maintenance.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/Comments_68-x-68_6.png" alt="Sara Khan"
                                        class="person" />
                                    <h4>Sarah, UAE</h4>
                                    <p style="text-align: justify">
                                        The electric vehicle training course at ASTI exceeded my
                                        expectations, and the faculty was incredibly supportive.
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

    <section id="subscribe" class="section-6" style="background-color: #fff" style="padding: 10px 0px">
        <div class="content-section" style="padding-top: 0;">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-7 text-md-left ">
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

    <div class="button-enrollNow">
        @if (\Illuminate\Support\Facades\Auth::check())
            <button id="pay-button" class="enroll-button">
                Register Now
            </button>
        @else
            <a class="enroll-button" href="{{ route('login') }}">
                Register Now
            </a>
        @endif


    </div>
@endsection
