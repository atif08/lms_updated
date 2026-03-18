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

        /* .divided-list {
                                                                display: flex;
                                                                flex-wrap: wrap;
                                                                justify-content: space-between;
                                                              }

                                                              .divided-col {
                                                                flex: 0 0 20%;
                                                                min-width: 160px;
                                                                box-sizing: border-box;
                                                              } */

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

        .button-enrollNow {
            display: flex;
            justify-content: center;
            align-items: center;
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
                    <img src="/frontend/assets/images/programs-banner/webp/accounting and business.webp" class="full-image"
                        data-mask="70" />

                    <div class="slide-content row text-center">
                        <div class="col-12 mx-auto inner">
                            <h1 data-aos="zoom-out-up" data-aos-delay="400" class="title effect-static-text"
                                style="font-size: 3rem !important">
                                Level 4 Diploma In Accounting & Business
                            </h1>
                        </div>
                        <div class="col-12 row align-items-center justify-content-center">
                            <!-- <button
                                                                          type="button"
                                                                          class="btn primary-button"
                                                                          id="open-modal"
                                                                        >
                                                                          Download Brochure
                                                                          <i class="icon-arrow-down-circle left"></i>
                                                                        </button> -->
                        </div>
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
    <!-- enroll-button-code-starts-here -->

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

    <!-- enroll-button-code-ends-here -->
    <!-- About [image] -->
    <section id="about" class="section-1 highlights image-right" style="padding: 20px 0px ">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 align-self-center text-center text-md-left">
                    <div class="row intro">
                        <div class="col-12 p-0">
                            <h3 class="featured alt">Diploma In Accounting & Business</h3>
                            <p style="text-align: justify">
                                The ASTI, UAE Level 5 Diploma in Accounting and Business
                                Programs has been designed to prepare you for an international
                                workplace by teaching you how to receive, analyze, and convey
                                accounting and other information. Acquiring a distinct
                                collection of accounting and managerial abilities to assess
                                and scrutinize the organization and sectoral patterns will
                                provide you a better comprehension of how monetary matters
                                impact businesses. Financial accounting, managerial
                                accounting, corporate finance, company strategy, and other
                                subjects are all covered in our accounting and business
                                courses.
                            </p>
                            <p style="text-align: justify">
                                With a business and accounting diploma from ASTI Dubai, United
                                Arab Emirates, you will be prepared to handle financial and
                                other information in a worldwide workplace by learning how to
                                receive, interpret, and express it. There is a dearth of
                                graduate personnel with training and experience in both
                                accounting and business management in this rapidly evolving
                                company environment. Working in multidisciplinary business
                                teams that tackle actual business problems in fields as varied
                                as management consulting, company development, innovation,
                                accounting, public finance, and entrepreneurship would suit
                                you well.
                            </p>
                            <a href="/courses/contact" class="btn primary-button button">Apply Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <a href="#">
                        <img src="/frontend/assets/images/level-4-foundation-diploma-in-accountancy-1.jpg" class="fit-image"
                            alt="Level-4 Diploma in Accounting and Business" />
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

            <div id="section1" class="content-section" style="padding: 10px 0px">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Course Overview</h3>
                        <p>
                            The "Level 4 Diploma in Accounting and Business" is a UK-accredited qualification designed to
                            develop a strong foundation in accounting principles, financial reporting, business operations,
                            and decision-making. Ideal for students, early-career professionals, and aspiring finance
                            professionals, this diploma provides the essential knowledge to thrive in modern business
                            environments or progress to further studies.
                        </p>
                    </div>
                </div>
            </div>

            <div id="section2" class="content-section" style="padding: 10px 0px">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Course Objective</h3>
                        <p>
                            This program aims to equip learners with essential business and accounting knowledge, critical
                            thinking abilities, and practical skills for financial analysis and decision-making. It prepares
                            students for roles in the finance sector and serves as a stepping stone to Level 5 or
                            university-level education.
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <a href="/courses/contact" class="btn primary-button button">Enquiry Now</a>
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
                                        <th>S.no</th>
                                        <th>Unit Title</th>
                                        <th>Credits</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Academic Writing and Research Skills</td>
                                        <td>20 Credits</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Business and the Economic Environment</td>
                                        <td>20 Credits</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Principles of Financial Accounting</td>
                                        <td>20 Credits</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Quantative Methods in a Business Context</td>
                                        <td>20 Credits</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Management Accounting</td>
                                        <td>20 Credits</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Leading and Managing Teams</td>
                                        <td>20 Credits</td>
                                        <!-- </tr>
                                                                            <tr>
                                                                              <td>7</td>
                                                                              <td>Financial Management</td>
                                                                              <td>20 Credits</td>
                                                                            </tr>
                                                                            <tr>
                                                                              <td>8</td>
                                                                              <td>Financial Planning and Control</td>
                                                                              <td>20 Credits</td>
                                                                            </tr>
                                                                            <tr>
                                                                              <td>9</td>
                                                                              <td>Financial Reporting</td>
                                                                              <td>20 Credits</td>
                                                                            </tr>
                                                                            <tr>
                                                                              <td>10</td>
                                                                              <td>Taxation Principles and Practices</td>
                                                                              <td>20 Credits</td>
                                                                            </tr>
                                                                            <tr>
                                                                              <td>11</td>
                                                                              <td>People Management</td>
                                                                              <td>20 Credits</td>
                                                                            </tr>
                                                                            <tr>
                                                                              <td>12</td>
                                                                              <td>
                                                                                Business Ethics and Corporate Social Responsibility
                                                                              </td>
                                                                              <td>20 Credits</td>
                                                                            </tr> -->
                                    <tr>
                                        <th colspan="2" style="text-align: center">TOTAL</th>
                                        <td>120 Credits</td>
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
                        <p>
                            ASTI's Level 5 Accounting and Business Diploma curriculum is
                            designed to give students the information and abilities needed
                            for a middle or senior managing role in an organization, where
                            they may be responsible for risk, investment, and financial
                            management. The ability to manage, plan, and account for money
                            remains the ultimate test of company success and the primary
                            engine of growth in all sectors, from manufacturing to banking
                            and from large service industries to small firms. You'll have
                            the know-how to put accounting principles and procedures to use
                            in the professional setting.
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered"
                                style="
                    border-collapse: collapse !important;
                    border-spacing: 0 !important;
                  ">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Qualification Title</th>
                                        <th>Qualification Level</th>
                                        <th>Accreditation status</th>
                                        <th>Credit Equivalence</th>
                                        <th>Recognition</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Diploma In Accounting & Business</td>
                                        <td>UK Level 4</td>
                                        <td>Accredited</td>
                                        <td>120 Credits</td>
                                        <td>Globally Recognized</td>
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
                            <div class="col-md-6">
                                <h6>Accounting & Business Career Pathways</h6>

                                <p>
                                    Employers respect the skills and knowledge you will gain
                                    from this degree greatly for work in management and
                                    business, and they will enable you to pursue a variety of
                                    career options. Possibilities in many other fields can arise
                                    from a business and accounting degree. Numerous commercial
                                    fields, including banking, insurance, financial services,
                                    and general management, are open to you.
                                </p>

                                <h6>Business Manager</h6>
                                <p>
                                    Business managers are in charge of all administrative and
                                    clerical employees as well as all organizational functions.
                                    Typically, this covers spending plans, budgets, supplies,
                                    and equipment. Leading and supervising all aspects of the
                                    business's operations is within the purview of a business
                                    manager.
                                </p>

                                <h6>Internal auditor</h6>
                                <p>
                                    An internal auditor (IA) is a skilled individual whose job
                                    it is to conduct unbiased, independent assessments of a
                                    business's operational and financial operations. They work
                                    to make sure businesses run smoothly and adhere to the right
                                    protocols.
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6>Tax Consultant / Tax Advisor</h6>
                                <p>
                                    A tax consultant offers guidance and assistance on a range
                                    of tax matters to people, companies, and organizations.
                                    Typical tasks include researching tax legislation, preparing
                                    and filing tax forms, offering tax planning advice, and
                                    defending clients in court when dealing with the tax
                                    authorities.
                                </p>
                                <h6>Account Manager</h6>
                                <p>
                                    The responsibility of ensuring that every department
                                    satisfies the demands of its clients and customers falls on
                                    the account manager. They respond to client concerns,
                                    resolve their problems, and uphold a favorable rapport that
                                    will benefit both sides in future business dealings.
                                </p>
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
    <!-- enroll-button-code-starts-here -->

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

    <!-- enroll-button-code-ends-here -->
    <!-- Features -->
    <section id="features" class="section-2 odd offers" style="padding: 40px 0 !important">
        <div class="container">
            <h3 class="text-center">
                Why Choose ASTI for Diploma In Accounting & Business?
            </h3>
            <div class="row justify-content-center text-center items">
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-globe"></i>
                        <h4>Expand Your Global Opportunities</h4>
                        <p>
                            Diploma in Accounting & business is recognized both locally and
                            internationally, ensuring that your credentials are respected
                            wherever your career takes you.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-basket"></i>
                        <h4>Learn from the Best</h4>
                        <p>
                            Our instructors are experienced professionals with years of
                            practical experience in the field of accounting and business.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-screen-smartphone"></i>
                        <h4>Stay Ahead with Industry-Relevant Skills</h4>
                        <p>
                            The curriculum for the Online diploma in accounting & business
                            is designed to meet the needs of today's dynamic educational
                            environments.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-layers"></i>
                        <h4>Balance Your Studies with Work</h4>
                        <p>
                            Understanding the busy schedules of our students, a flexible
                            online learning options for the Diploma in accounting and
                            business program.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-book-open"></i>
                        <h4>Bridge Technical and Vocational Practice</h4>
                        <p>
                            These connections not only enhance your learning experience but
                            also increase your employment prospects post-graduation.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-graduation"></i>
                        <h4>Thrive in a Hub of Educational Innovation</h4>
                        <p>
                            Studying in Dubai, a bustling metropolis known for its
                            cutting-edge educational practices and multicultural
                            environment, provides an added advantage.
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
                        Which accounting certification is best in the UAE?
                    </h5>
                    <p class="faq-text">
                        The diploma in accounting and business is widely recognized as one
                        of the best accounting certifications in the UAE. With its global
                        reputation and comprehensive curriculum, which equips
                        professionals with the skills and knowledge required to excel in
                        the field of accounting.
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
                        What is the entry requirement for a diploma in accounting?
                    </h5>
                    <p class="faq-text">
                        The entry requirements for a Diploma in Accounting typically
                        include a high school diploma or equivalent UK Level 3
                        qualification. Some programs may also require basic math skills
                        and proficiency in English. At ASTI Academy, we welcome students
                        from diverse educational backgrounds and provide support to help
                        them succeed in their studies with Level 4 & Level 5 online
                        diplomas.
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
                    <h5 class="faq-title">Which diploma is best for an accountant?</h5>
                    <p class="faq-text">
                        The Diploma in Accounting & Business offered by ASTI Academy is
                        highly regarded for aspiring accountants. This comprehensive
                        program covers essential accounting principles, financial
                        management, taxation, and business practices, providing thorough
                        basics for a successful career in accounting.
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
                        What level is a diploma in accounting and business?
                    </h5>
                    <p class="faq-text">
                        The Diploma in Accounting & Business offered by ASTI Academy is
                        typically classified as a Level 4 or Level 5 qualification, the
                        duration of the program up to 6 to 9 months with TVET and KHDA
                        Accreditation. These levels correspond to the complexity and depth
                        of knowledge required, ensuring that graduates are well- prepared
                        for professional roles in accounting and business.
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
                        What will you learn from ASTI’s Accounting & Business diploma
                        Course?
                    </h5>
                    <p class="faq-text">
                        ASTI’s Accounting & Business diploma course covers a wide range of
                        topics, including financial accounting, management accounting,
                        business law, taxation, and financial management. Students will
                        gain practical skills in financial analysis, budgeting, and
                        reporting, preparing them for entry-level accounting positions or
                        further studies in the field.
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
                        Who can join ASTI’s Accounting & Business diploma Course?
                    </h5>
                    <p class="faq-text">
                        The Accounting & Business diploma course at ASTI Academy is open
                        to individuals from all educational backgrounds who are passionate
                        about pursuing a career in accounting or related fields. Whether
                        you are a recent high school graduate or a working professional
                        seeking to enhance your skills, this program is designed to
                        accommodate your needs and goals. Also this program helps working
                        professionals to complete the course without taking a career
                        break.
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
    <section id="why-accounting" class="why-section">
        <div class="container">
            <div class="why-header">
                <h3>What are the 4 reasons to study Accounting?</h3>
            </div>

            <div class="why-grid">
                <div class="why-card">
                    <i class="icon icon-globe"></i>
                    <h4>Booming Career Opportunities</h4>
                    <p>
                        Accounting offers diverse career paths—from public accounting
                        firms to corporate finance—providing stability and competitive
                        salary potential.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-basket"></i>
                    <h4>Global Relevance</h4>
                    <p>
                        Accounting principles are universal, making it a valuable skill
                        across industries and countries, with strong international
                        career opportunities.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-screen-smartphone"></i>
                    <h4>Key Business Insights</h4>
                    <p>
                        Understand financial statements and performance metrics to
                        make informed business decisions that drive growth and
                        profitability.
                    </p>
                </div>

                <div class="why-card">
                    <i class="icon icon-layers"></i>
                    <h4>Continuous Learning & Growth</h4>
                    <p>
                        Accounting evolves with regulations and technology, offering
                        continuous professional development and long-term career
                        advancement.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- Testimonials -->
    {{-- <section id="testimonials" class="section-4 carousel">
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
                                    <img src="/frontend/assets/images/testimonial/26.webp" alt="Adams Baker"
                                        class="person" />
                                    <h4>Fatima Ahmed</h4>
                                    <p style="text-align: justify">
                                        Completing ASTI's Online Diploma in Accounting and
                                        Business online in just 6 months was a great achievement
                                        for my career. The practical insights gained from this
                                        Level 5 accredited course equipped me with the necessary
                                        skills.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/5.webp" alt="Mary Evans"
                                        class="person" />
                                    <h4>Ali Hassan</h4>
                                    <p style="text-align: justify">
                                        As a busy entrepreneur, the flexibility of ASTI's online
                                        Diploma in Accounting and Business was invaluable. The
                                        comprehensive curriculum and TVET accreditation of this
                                        9-month course helped me gain a deeper understanding.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/27.webp" alt="Nadia Malik"
                                        class="person" />
                                    <h4>Nadia Malik</h4>
                                    <p style="text-align: justify">
                                        Enrolling in ASTI's Level 4 & Level 5 Diploma in
                                        Accounting and Business was one of the best decisions I
                                        made for my career. The course content was highly relevant
                                        to my profession, and the online learning format allowed
                                        me to balance work .
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/6.webp" alt="Khalid Mansoor"
                                        class="person" />
                                    <h4>Khalid Mansoor</h4>
                                    <p style="text-align: justify">
                                        ASTI's Diploma in Accounting and Business provided me with
                                        the necessary qualifications and skills to advance in my
                                        career as an auditor. The Level 5 accreditation and TVET
                                        recognition enhanced the credibility .
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/Comments_68-x-68_6.png" alt="Sara Khan"
                                        class="person" />
                                    <h4>Sara Khan</h4>
                                    <p style="text-align: justify">
                                        I found ASTI's Level 4 & Level5 OnlineDiploma in
                                        Accounting and Business to be incredibly practical and
                                        relevant to my role as a small business owner. The 6-
                                        month online course format allowed me to learn at my own
                                        pace.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/Comments_68-x-68_5.png" alt="Sara Khan"
                                        class="person" />
                                    <h4>Mohammed Ibrahim</h4>
                                    <p style="text-align: justify">
                                        Completing ASTI's Diploma in Accounting and Business has
                                        been a helpful tool in my career progression. The course's
                                        Level 4 & 5 accreditation and TVET recognition opened up
                                        new opportunities for me in the finance industry.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/Comments_68-x-68_2.png" alt="Sara Khan"
                                        class="person" />
                                    <h4>Aisha Abdullah</h4>
                                    <p style="text-align: justify">
                                        ASTI's Diploma in Accounting and Business provided me with
                                        the skills and knowledge needed to kick-start my career in
                                        accounting. The Level 5 education standard and TVET
                                        accreditation gave me confidence in the quality.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/Comments_68-x-68_4.png" alt="Sara Khan"
                                        class="person" />
                                    <h4>Youssef Mahmoud</h4>
                                    <p style="text-align: justify">
                                        The comprehensive curriculum and practical approach of
                                        ASTI's Diploma in Accounting and Business prepared me well
                                        for my role as a tax consultant. The 9-month online course
                                        format allowed me to continue working while upgrading my
                                        skills.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/Comments_68-x-68_3.png" alt="Sara Khan"
                                        class="person" />
                                    <h4>Lina Khalid</h4>
                                    <p style="text-align: justify">
                                        Enrolling in ASTI's Level 4 & 5 Diploma in Accounting and
                                        Business was a turning point in my career. The course's
                                        TVET accreditation and focus on practical applications
                                        helped me transition smoothly into my role as a banking
                                        professional.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/7.webp" alt="Sara Khan"
                                        class="person" />
                                    <h4>Ahmed Ali</h4>
                                    <p style="text-align: justify">
                                        As a student pursuing a career in accounting, ASTI's
                                        Diploma in Accounting and Business provided me with a
                                        solid foundation to build upon. The Level 5 education
                                        standard and online learning options allowed me to gain
                                        industry.
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
    <section id="subscribe" class="section-6" style="background-color: #fff; padding; 20px 0px">
        <div class="content-section" style="padding-top: 0">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-7 text-md-left">
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
                                        Saves money on commuting, housing, and campus-related
                                        fees, making education more affordable.
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
                                        Requires physical presence, making it difficult for
                                        students living far from the institution or in rural
                                        areas.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold">Self-Paced Learning</td>
                                    <td>
                                        Offers the ability to learn at one’s own pace, providing
                                        more time to grasp difficult concepts or accelerate
                                        through familiar material.
                                    </td>
                                    <td>
                                        Follows a rigid pace dictated by the curriculum, which
                                        might not suit every student’s learning style.
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
                                        Encourages the development of strong time management
                                        skills as students handle deadlines and independent study.
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

    <!-- enroll-button-code-starts-here -->

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

    <!-- enroll-button-code-ends-here -->
@endsection
