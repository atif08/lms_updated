<?php $page = 'Advancing Careers Through Professional Development | Know More About Us'; ?>
@extends('frontend.layouts.front_layout')
@section('style')
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
            margin-top: 10px;
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
@endsection
@section('content')
    <!-- Hero -->
    <section id="slider" class="hero p-0 odd">
        <div class="swiper-container no-slider slider-h-75">
            <div class="swiper-wrapper">
                <!-- Item 1 -->
                <div class="swiper-slide slide-center">
                    <img src="/frontend/assets/images/programs-banner/webp/Accounting.webp" class="full-image"
                        data-mask="70" />

                    <div class="slide-content row text-center">
                        <div class="col-12 mx-auto inner">
                            <h1 data-aos="zoom-out-up" data-aos-delay="400" class="title effect-static-text"
                                style="font-size: 3rem !important">
                                Level 3 Foundation Diploma in Accountancy
                            </h1>
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
                    <span>Level 3</span>
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
            <a class="enroll-button" href="{{ route('get.login') }}">
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
                            <h3 class="featured alt">Foundation Diploma in Accountancy</h3>
                            <p style="text-align: justify">
                                Dubai is an ideal destination for those pursuing a career in
                                accounting, as it serves as an international hub for experts
                                in finance and business. The best place to start for your
                                accounting profession is offered by ASTI's accounting
                                foundation courses in Dubai. Students can benefit from the
                                vibrant business atmosphere of the city while learning the
                                foundations of accounting, finance, and business through a
                                wide range of foundation accounting courses offered.
                            </p>
                            <p style="text-align: justify">
                                Students can select from an array of accounting and finance
                                programs adapted to their requirements and objectives, ranging
                                from entry-level qualifying programs to more advanced courses.
                                These courses, address financial statements, tax planning, and
                                accounting principles, will give you the expertise and skills
                                you need to thrive in the evolving accounting industry. Thus,
                                if you're prepared to begin your adventure in the fascinating
                                field of accounting, sign up with ASTI today for one of the
                                best foundation accounting courses in Dubai and start along
                                the path to a prosperous future!
                            </p>
                            <a href="/courses/contact" class="btn primary-button button">Apply Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <a href="#">
                        <img src="/frontend/assets/images/level-3-foundation-diploma-accountancy-1.jpg" class="fit-image"
                            alt="Level-3 Foundation Diploma in Accountancy" />
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
                            The "Level 3 Foundation Diploma in Accountancy" is a
                            UK-accredited program designed to introduce learners to the
                            fundamentals of accounting and finance. Offered by **ASTI
                            Dubai**, this course is ideal for students and early-career
                            professionals seeking to build essential skills in bookkeeping,
                            financial documentation, and business communication. It lays a
                            strong foundation for further study or entry-level roles in
                            accounting departments.
                        </p>
                        <p>
                            The Online Foundation Diploma in Accounting typically takes 12
                            months complete, depending on your pace of study and prior
                            knowledge. Upon successful completion of the program, you will
                            receive a recognized diploma in accounting from ASTI Academy,
                            empowering you to pursue exciting career opportunities in
                            accounting and finance.
                        </p>
                    </div>
                </div>
            </div>

            <div id="section2" class="content-section" style="padding: 10px 0px ">
                <div class="row">
                    <div class="col-12 col-md-12 text-md-left mt-5">
                        <h3 class="text-center">Course Objective</h3>
                        <p>
                            To equip learners with a clear understanding of core accounting
                            principles, financial systems, and cost control, while preparing
                            them for higher qualifications and practical job roles in
                            finance.
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <a href="/courses/contact" class="btn primary-button button">Enquiry Now</a>
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
                                        <th>S.no</th>
                                        <th>Unit Title</th>
                                        <th>Credits</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Recording Financial Transactions</td>
                                        <td>20 Credits</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Management Information</td>
                                        <td>20 Credits</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Maintaining Financial Records</td>
                                        <td>20 Credits</td>
                                    </tr>

                                    <tr>
                                        <th colspan="2" style="text-align: center">TOTAL</th>
                                        <td>60 Credits</td>
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
                        <p>
                            ASTI's Level 3 Accounting foundation curriculum is designed to
                            give students the information and abilities needed for a further
                            education. The Level 3 Accounting Foundation course is
                            meticulously crafted to provide students with a comprehensive
                            understanding of accounting principles and practices. Designed
                            for individuals with little to no prior accounting knowledge,
                            this course serves as a solid foundation for further studies or
                            entry-level positions in the accounting field.
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
                                        <td>Foundation Diploma In Accountancy</td>
                                        <td>UK Level 3</td>
                                        <td>Accredited</td>
                                        <td>60 Credits</td>
                                        <td>Globally Recognized</td>
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
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="learning-checklist">
                                    <li>
                                        <i class="icon icon-check"></i>Demonstrate a clear
                                        understanding of fundamental accounting principles,
                                        including the accounting equation, accruals, and
                                        prepayments.
                                    </li>
                                    <li>
                                        <i class="icon icon-check"></i> Implement double-entry
                                        bookkeeping techniques to record financial transactions
                                        accurately and maintain balanced ledgers.
                                    </li>
                                    <li>
                                        <i class="icon icon-check"></i>Proficiently prepare
                                        financial statements, including income statements, balance
                                        sheets, and cash flow statements, adhering to relevant
                                        accounting standards.
                                    </li>
                                    <li>
                                        <i class="icon icon-check"></i>
                                        Interpret financial statements to assess the financial
                                        health and performance of an organization, identifying key
                                        areas of strength and improvement.
                                    </li>
                                    <li>
                                        <i class="icon icon-check"></i>Apply management accounting
                                        techniques, such as cost accounting and budgeting, to
                                        assist in decision-making and performance evaluation.
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="learning-checklist">
                                    <li>
                                        <i class="icon icon-check"></i>Understand basic taxation
                                        principles and regulations, including income tax, VAT, and
                                        corporation tax, and their implications for individuals
                                        and businesses.
                                    </li>
                                    <li>
                                        <i class="icon icon-check"></i>
                                        Utilize accounting software and technology proficiently to
                                        streamline financial processes, record transactions, and
                                        generate reports accurately.
                                    </li>
                                    <li>
                                        <i class="icon icon-check"></i>
                                        Apply ethical principles and professional standards in
                                        accounting practices, ensuring integrity, transparency,
                                        and confidentiality in financial reporting and
                                        decision-making.
                                    </li>
                                    <li>
                                        <i class="icon icon-check"></i>
                                        Effectively communicate financial information to
                                        stakeholders, both orally and in writing, using
                                        appropriate terminology and formats.
                                    </li>
                                    <li>
                                        <i class="icon icon-check"></i>
                                        Recognize the importance of lifelong learning and
                                        professional development in the accounting field, seeking
                                        opportunities to enhance knowledge and skills in line with
                                        industry trends and advancements.
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

    <!-- enroll-button-code-starts-here -->

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

    <!-- enroll-button-code-ends-here -->
    <!-- Features -->
    <section id="features" class="section-2 odd offers" style="padding: 40px 0 !important">
        <div class="container">
            <h3 class="text-center">
                Why Choose ASTI for Foundation in Accounting?
            </h3>
            <div class="row justify-content-center text-center items">
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-globe"></i>
                        <h4>Expert Faculty</h4>
                        <p>
                            At ASTI, you'll learn from experienced professionals who are
                            experts in their field. Our faculty members bring real-world
                            expertise and insights into the classroom, enriching your
                            learning experience.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-basket"></i>
                        <h4>Comprehensive Curriculum</h4>
                        <p>
                            Our Foundation in Accounting program covers all essential
                            topics, providing you with a solid understanding of accounting
                            principles, practices, and techniques.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-screen-smartphone"></i>
                        <h4>Practical Learning</h4>
                        <p>
                            We believe in hands-on learning experiences. Through case
                            studies, projects, and practical exercises, you'll apply
                            theoretical concepts to real-world scenarios, enhancing your
                            problem-solving abilities and critical thinking skills.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-layers"></i>
                        <h4>Career Opportunities</h4>
                        <p>
                            Completing your Foundation in Accounting at ASTI opens doors to
                            various career paths in accounting, finance, auditing, and more.
                            Our program equips you with the qualifications and credentials
                            sought after by employers worldwide.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-book-open"></i>
                        <h4>Flexible Learning Options</h4>
                        <p>
                            We understand that students have diverse schedules and
                            commitments. That's why we offer flexible learning options,
                            including online courses and part-time study programs, allowing
                            you to pursue your education while balancing other
                            responsibilities.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 item">
                    <div class="card no-hover">
                        <i class="icon icon-graduation"></i>
                        <h4>Supportive Learning Environment</h4>
                        <p>
                            At ASTI, we prioritize student success. Our supportive learning
                            environment, personalized attention from faculty, and
                            comprehensive student support services ensure that you have
                            everything you need to thrive academically and professionally.
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
                        What is the foundation level in accounting?
                    </h5>
                    <p class="faq-text">
                        The foundation level in accounting is an introductory program
                        designed to provide students with fundamental knowledge and skills
                        in accounting principles, practices, and techniques. It serves as
                        a solid base for further education and career advancement in the
                        field of accounting.
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
                    <h5 class="faq-title">What is the foundation in accountancy?</h5>
                    <p class="faq-text">
                        The foundation in accountancy is a comprehensive course that
                        covers essential topics such as financial accounting, management
                        accounting, taxation, and auditing. It equips students with the
                        necessary skills and knowledge to pursue a career in accounting or
                        related fields.
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
                        How long is the foundation in accountancy?
                    </h5>
                    <p class="faq-text">
                        The duration of the foundation in an accountancy program typically
                        varies, but it commonly ranges from 6 months to 1 year, depending
                        on the institution and the mode of study (full-time or part-time).
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
                        What are the subjects in foundation in accountancy?
                    </h5>
                    <p class="faq-text">
                        Subjects in the foundation in accountancy program may include
                        financial accounting, management accounting, business mathematics,
                        business communication, taxation, auditing, and basic economics.
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
                        Which accounting certification is best in Dubai?
                    </h5>
                    <p class="faq-text">
                        When considering the best accounting certification in Dubai, it's
                        important to look for a program that not only provides complete
                        knowledge and practical skills but also offers recognized
                        qualification that can enhance your career prospects. By enrolling
                        in a Level 3 Accounting course in Dubai, you not only gain a
                        prestigious certification but also equip yourself with the skills
                        and knowledge needed to excel in the dynamic field of accounting.
                        This makes it an excellent choice for those aspiring to build a
                        successful career in accounting in Dubai.
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
                        Which online course is best for an accountant job?
                    </h5>
                    <p class="faq-text">
                        ASTI Academy's online foundation diploma in accounting is an
                        excellent choice for individuals seeking to start a career in
                        accounting. It offers a comprehensive curriculum, flexible
                        learning options, and industry-relevant skills to prepare you for
                        various roles in accounting and finance.
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
                        How can I become a certified accountant in Dubai?
                    </h5>
                    <p class="faq-text">
                        To become a certified accountant in Dubai, you can pursue
                        professional accounting qualifications such as ACCA, CPA, CMA, or
                        CIMA. These certifications typically require passing exams,
                        meeting experience requirements, and adhering to professional
                        ethics.
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
                        Which course is best for an accountant after 12th?
                    </h5>
                    <p class="faq-text">
                        After completing 12th grade, aspiring accountants can pursue ASTI
                        Academy's online foundation diploma in accounting. This program
                        provides a solid foundation in accounting principles and prepares
                        students for further studies or entry-level accounting positions.
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
                                    <img src="/frontend/assets/images/testimonial/21.webp" alt="Adams Baker"
                                        class="person" />
                                    <h4>Aisha Ahmed</h4>
                                    <p style="text-align: justify">
                                        The Level 3 Foundation in Accounting Diploma at ASTI Dubai
                                        was a fantastic stepping stone for my accounting career.
                                        The program provided a strong foundation in accounting
                                        principles and practices, preparing me for further studies
                                        and the professional world. The flexible schedule allowed
                                        me to balance my studies with my work commitments.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/2.webp" alt="Mary Evans"
                                        class="person" />
                                    <h4>Omar Khan</h4>
                                    <p style="text-align: justify">
                                        I was impressed by the knowledgeable and supportive
                                        instructors at ASTI. They made complex accounting concepts
                                        understandable and provided me with the opportunity to
                                        apply my knowledge through practical exercises. The
                                        program boosted my confidence and helped me secure an
                                        internship at a reputable accounting firm.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/22.webp" alt="Nadia Malik"
                                        class="person" />
                                    <h4>Maria Fernandez</h4>
                                    <p style="text-align: justify">
                                        As someone with no prior accounting experience, I found
                                        the Level 3 Foundation program very accessible. The
                                        instructors used clear explanations and real-world
                                        examples to make the learning process engaging. The
                                        program not only equipped me with accounting skills but
                                        also improved my critical thinking and problem-solving
                                        abilities.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/3.webp" alt="Khalid Mansoor"
                                        class="person" />
                                    <h4>David Lee</h4>
                                    <p style="text-align: justify">
                                        Earning the Level 3 Foundation in Accounting Diploma from
                                        ASTI Dubai opened doors to exciting career opportunities.
                                        The program's focus on international accounting standards
                                        makes it valuable for those aiming for a global career
                                        path. I highly recommend this program to anyone interested
                                        in pursuing a career in accounting.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/25.webp" alt="Sara Khan"
                                        class="person" />
                                    <h4>Fatima Hassan</h4>
                                    <p style="text-align: justify">
                                        The program offered a perfect blend of theoretical
                                        knowledge and practical application. I particularly
                                        enjoyed the group projects, which allowed me to
                                        collaborate with classmates and develop my communication
                                        skills. The program equipped me with the skills to
                                        confidently handle accounting tasks in a professional
                                        setting.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/Comments_68-x-68_1.png" alt="Sara Khan"
                                        class="person" />
                                    <h4>John Mathew</h4>
                                    <p style="text-align: justify">
                                        ASTI's Level 3 Foundation in Accounting Diploma program
                                        provided me with the necessary skills to transition from
                                        another field into accounting. The program's flexible
                                        learning options allowed me to learn at my own pace. The
                                        career guidance services offered by ASTI were also very
                                        helpful in preparing me for job interviews.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/Comments_68-x-68_6.png" alt="Sara Khan"
                                        class="person" />
                                    <h4>Sarah Al Mulla</h4>
                                    <p style="text-align: justify">
                                        The program exceeded my expectations. The instructors were
                                        passionate about accounting and made learning enjoyable.
                                        The small class sizes allowed for personalized attention
                                        and individual support. I highly recommend this program to
                                        anyone who wants to gain a solid foundation in accounting
                                        for further studies or pursuing a career as an accountant.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/Comments_68-x-68_2.png" alt="Sara Khan"
                                        class="person" />
                                    <h4>Khalid Mohammed</h4>
                                    <p style="text-align: justify">
                                        The Level 3 Foundation in Accounting Diploma program at
                                        ASTI Dubai provided me with the essential skills to start
                                        my own bookkeeping business. I learned about various
                                        accounting software programs commonly used in the
                                        industry, which gave me a competitive edge in the job
                                        market.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/Comments_68-x-68_3.png" alt="Sara Khan"
                                        class="person" />
                                    <h4>Elena Petrova</h4>
                                    <p style="text-align: justify">
                                        As an international student, I found ASTI Dubai's
                                        welcoming and supportive environment very helpful. The
                                        program not only enhanced my accounting knowledge but also
                                        improved my English language skills. I am confident that
                                        the skills and qualifications I gained from this program
                                        will be valuable assets in my accounting career.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center text-center item">
                            <div class="row card">
                                <div class="col-12">
                                    <img src="/frontend/assets/images/testimonial/8.webp" alt="Sara Khan"
                                        class="person" />
                                    <h4>Michael Jones</h4>
                                    <p style="text-align: justify">
                                        Earning the Level 3 Foundation in Accounting Diploma at
                                        ASTI Dubai was a wise investment. The program helped me
                                        gain valuable knowledge and skills in a short period. The
                                        program's curriculum is comprehensive and covers all the
                                        essential aspects of accounting. I highly recommend this
                                        program to anyone looking to kickstart their accounting
                                        career in Dubai.
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
    <section id="subscribe" class="section-6" style="background-color: #fff; padding:10px 0">
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
            <a class="enroll-button" href="{{ route('get.login') }}">
                Enroll Now
            </a>
        @endif


    </div>

    <!-- enroll-button-code-ends-here -->
@endsection
