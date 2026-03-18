<?php $page = 'Advancing Careers Through Professional Development | Know More About Us'; ?>
@extends('marketplace.layouts.front_layout')
@section('style')
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

      #program-spec:checked ~ .list label.program-spec,
      #program-module:checked ~ .list label.program-module,
      #uk-levels:checked ~ .list label.uk-levels,
      #how-to-apply:checked ~ .list label.how-to-apply,
      #program-fees:checked ~ .list label.program-fees,
      #admission-requirement:checked ~ .list label.admission-requirement,
      #accreditation:checked ~ .list label.accreditation,
      #outcome:checked ~ .list label.outcome {
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

      #program-spec:checked ~ .list .slider {
        top: 0;
      }

      #program-module:checked ~ .list .slider {
        top: 60px;
      }

      #outcome:checked ~ .list .slider {
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

      #program-spec:checked ~ .text-content .program-spec,
      #program-module:checked ~ .text-content .program-module,
      #uk-levels:checked ~ .text-content .uk-levels,
      #how-to-apply:checked ~ .text-content .how-to-apply,
      #program-fees:checked ~ .text-content .program-fees,
      #admission-requirement:checked ~ .text-content .admission-requirement,
      #accreditation:checked ~ .text-content .accreditation,
      #outcome:checked ~ .text-content .outcome {
        display: block;
      }

      #program-module:checked ~ .text-content .program-spec,
      #uk-levels:checked ~ .text-content .program-spec,
      #how-to-apply:checked ~ .text-content .program-spec,
      #program-fees:checked ~ .text-content .program-spec,
      #admission-requirement:checked ~ .text-content .program-spec,
      #accreditation:checked ~ .text-content .program-spec,
      #outcome:checked ~ .text-content .program-spec {
        display: none;
      }

      .content .list label:hover {
        color: brown;
      }

      :root {
        --ring-size: calc(min(200px, 14vw));
        --ring-border-size: calc(var(--ring-size) * 0.1);
        --ring-offset-left: calc(var(--ring-size) + var(--ring-border-size));
        --ring-offset-top: calc(
          (var(--ring-size) - var(--ring-border-size)) * 0.5
        );

        --logo-size-w: calc(
          (var(--ring-size) * 3 + var(--ring-border-size) * 2) * 1.5
        );
        --logo-size-h: calc(
          (var(--ring-size) * 1.5 - var(--ring-border-size) * 0.5) * 2
        );
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
        text-align:center;
        
        

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
      .button-enrollNow{
        display: flex;
        justify-content: center;
        align-items: center;
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
            <img
              src="/frontend/assets/images/programs-banner/webp/Education and training.webp"
              class="full-image"
              data-mask="70"
            />

            <div class="slide-content row text-center">
              <div class="col-12 mx-auto inner">
                <h1
                  data-aos="zoom-out-up"
                  data-aos-delay="400"
                  class="title effect-static-text"
                  style="font-size: 3rem !important"
                >
                  Level 3 Diploma in Education and Training
                </h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Fun Facts -->
    <section id="funfacts" class="section-3" style="padding: 0px 0 !important">
      <div class="container">
        <div class="row divided-list">
          <div class="col-md-3 col-sm-6">
            <div class="divided-col-item">
              <h4>Mode of Study</h4>
              <span>Online</span>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="divided-col-item">
              <h4>Program Duration</h4>
              <span>1 Years / 12 Months</span>
            </div>
          </div>
          <!-- <div class="col-md-3 divided-col">
            <div class="divided-col-item">
              <h4>Credits</h4>
              <span>12 Credits</span>
            </div>
          </div> -->
          <div class="col-md-3 col-sm-6">
            <div class="divided-col-item">
              <h4>QUALIFICATION</h4>
              <span>UK LEVEL 3</span>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="divided-col-item">
              <h4>FEE</h4>
              <span>1999$</span>
            </div>
          </div>
          <!-- <div class="col divided-col">
            <div class="divided-col-item">
            
              <button
                class="enroll-button"
                data-course="Level-3  Diploma in Education and Training"
                data-price="8000 AED"
                data-image=""
              >
                Enroll Now
              </button>
            </div>
          </div> -->
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
    <section id="about" class="section-1 highlights image-right">
      <div class="container">
        <div class="row">
          <div
            class="col-12 col-md-6 align-self-center text-center text-md-left"
          >
            <div class="row intro">
              <div class="col-12 p-0">
                <h3 class="featured alt">Diploma in Education and Training</h3>
                <p style="text-align: justify">
                  Find the vibrant world of schooling in Dubai with ASTI, the
                  UAE's exclusive technical academy offering vocational
                  education qualifications. Whether you're aiming to advance
                  your career, acquire new skills, or delve into a new subject,
                  ASTI provides online/on-campus programs tailored to fit your
                  busy schedule. Our courses are crafted to equip you with both
                  theoretical knowledge and practical skills essential for
                  excelling in your chosen field. Led by experienced trainers,
                  ASTI's teaching programs encourage learners to critically
                  analyze curriculum models and embrace creative teaching
                  methodologies. With a focus on fostering self-reflection and
                  professional growth, ASTI enables a dynamic learning
                  environment where collaboration thrives. Rest assured, our
                  courses adhere to the highest standards, ensuring you're
                  equipped with the expertise needed to thrive in your career
                  journey. Explore the possibilities with ASTI and embark on a
                  fulfilling educational experience in Dubai.
                </p>
                <a href="/courses/contact" class="btn primary-button button"
                >Apply Now</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <a href="#">
              <img
                src="/frontend/assets/images/level-3-diploma-in-education-and-training-1.jpg"
                class="fit-image"
                alt="Levle-3 Diploma in Education and Training"
              />
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

        <div id="section1" class="content-section">
          <div class="row">
            <div class="col-12 col-md-12 text-md-left mt-5">
              <h3 class="text-center">Course Overview</h3>
              <p>
                ASTI's foundation in education and training program dives deep
                into understanding both the cognitive and emotional well-being
                of children. Teachers gain insight into social contexts,
                transition processes, and procedures that influence children,
                empowering them to analyze these factors in their own workplace
                settings.
              </p>
              <p>
                Ideal for those aspiring to advance their careers in Education
                Management, Administration, or Senior Teaching roles, this
                diploma program encourages students to reflect on their personal
                and professional practices. By exploring various viewpoints,
                beliefs, values, and perspectives, learners develop a
                comprehensive understanding of the subject matter.
              </p>
            </div>
          </div>
        </div>

        <div id="section2" class="content-section">
          <div class="row">
            <div class="col-12 col-md-12 text-md-left mt-5">
              <h3 class="text-center">Course Objective</h3>
              <p>
                At ASTI, we blend independent study, interactive teaching, and
                academic support to facilitate your growth, allowing you to
                reflect on your progress and acquire a rich portfolio of skills,
                achievements, and experiences. Our flexible foundation in
                Education & Training program caters to individuals already
                working or aspiring to venture into the diverse field of
                education.
              </p>
              <p>
                Designed to unlock your full potential, our training and
                education program features meticulously crafted modules,
                opportunities for reflective practice, and dedicated support.
                Engaging lectures are designed to be interactive, encouraging
                dynamic discussions and fostering learning through small group
                activities. Join ASTI and tackle a journey of professional
                development where your goals are nurtured and your success is
                our priority.
              </p>
            </div>
          </div>
          <div class="row justify-content-center">
            <a href="/courses/contact" class="btn primary-button button"
              >Enquiry Now</a
            >
          </div>
        </div>

        <div id="section3" class="content-section">
          <div class="row">
            <div class="col-12 col-md-12 text-md-left mt-5">
              <h3 class="text-center">Program Modules</h3>
              <div class="table-responsive">
                <table
                  class="table table-bordered"
                  style="
                    border-collapse: collapse !important;
                    border-spacing: 0 !important;
                  "
                >
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
                      <td>
                        Understanding the Principles and Practices of Education
                        and Training
                      </td>
                      <td>20 Credits</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>
                        Understanding Roles and Responsibilities in Education
                        and Training
                      </td>
                      <td>20 Credits</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Develop Resources for Education and Training</td>
                      <td>20 Credits</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Deliver Education and Training</td>
                      <td>20 Credits</td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Evaluate Education and Training Provision</td>
                      <td>20 Credits</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Reflect on Own Practice in Education and Training</td>
                      <td>20 Credits</td>
                    </tr>

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

        <div id="section4" class="content-section">
          <div class="row">
            <div class="col-12 col-md-12 text-md-left mt-5">
              <h3 class="text-center">Program Specification</h3>
              <p>
                Enroll with our foundation in Education & training program,
                which is streamlined for an advancing career in the education
                sector. This course paves the foundation for a multitude of
                roles spanning primary and secondary education, educational
                policy, coaching, mentoring, and international development. Our
                interactive lectures are thoughtfully designed to foster active
                learning through engaging discussions and collaborative
                small-group activities. Join us and unlock your potential to
                make a positive impact in the field of education.
              </p>
              <div class="table-responsive">
                <table
                  class="table table-bordered"
                  style="
                    border-collapse: collapse !important;
                    border-spacing: 0 !important;
                  "
                >
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
                      <td>
                        Level 3 Award in Assessing Vocational Related
                        Achievement
                      </td>
                      <td>UK Level 3</td>
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

        <div id="section5" class="content-section">
          <div class="row">
            <div class="col-12 col-md-12 text-md-left mt-5">
              <h3 class="text-center">Learning outcomes</h3>
              <div class="row">
                <div class="col-md-6">
                  <ul class="learning-checklist">
                    <li>
                      <i class="icon icon-check"></i>Get to grips with the
                      duties and obligations of educators in education and
                      training.
                    </li>
                    <li>
                      <i class="icon icon-check"></i>Discover strategies for
                      fostering a secure and encouraging learning atmosphere.
                    </li>
                    <li>
                      <i class="icon icon-check"></i>Explore the dynamics
                      between educators and fellow professionals in the field.
                    </li>
                    <li>
                      <i class="icon icon-check"></i>
                      Learn about inclusive teaching and learning methods to
                      cater to diverse needs.
                    </li>
                  </ul>
                </div>
                <div class="col-md-6">
                  <ul class="learning-checklist">
                    <li>
                      <i class="icon icon-check"></i>Unlock techniques for
                      establishing an inclusive learning environment.
                    </li>
                    <li>
                      <i class="icon icon-check"></i>Gain insights into
                      assessment techniques and planning within education and
                      training.
                    </li>
                    <li>
                      <i class="icon icon-check"></i>
                      Explore involving learners and stakeholders in assessment
                      processes.
                    </li>
                    <li>
                      <i class="icon icon-check"></i>
                      Acquire skills for making informed assessment decisions.
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section
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
                <img src="/frontend/assets/images/uk-level.png" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Features -->
    <!-- enroll-button-code-starts-here -->

  <div class="button-enrollNow">
     @if(\Illuminate\Support\Facades\Auth::check())
          <button
              id="pay-button"
              class="enroll-button">
              Apply Now
          </button>
      @else
          <a
              class="enroll-button"
              href="{{route('login')}}">
              Apply Now
          </a>
      @endif


  </div>

  <!-- enroll-button-code-ends-here -->
    <section
      id="features"
      class="section-2 odd offers"
      style="padding: 40px 0 !important"
    >
      <div class="container">
        <h3 class="text-center">
          Why Choose ASTI for Diploma In Education & Training?
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

    <section
      id="about"
      class="section-3 highlights image-right"
      style="background-color: #fff"
    >
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
            <div
              class="col-md-3 divided-col"
              style="
                display: flex;
                justify-content: center;
                align-items: center;
              "
            >
              <div class="divided-col-item" style="margin: 10px; padding: 10px">
                <a href="assets/images/wes-logo.png">
                  <img src="/frontend/assets/images/wes-logo.png" alt="About Us" />
                </a>
              </div>
            </div>
            <div
              class="col-md-3 divided-col"
              style="
                display: flex;
                justify-content: center;
                align-items: center;
              "
            >
              <div class="divided-col-item" style="margin: 10px; padding: 10px">
                <a href="assets/images/sce-logo.png">
                  <img src="/frontend/assets/images/sce-logo.png" alt="About Us" />
                </a>
              </div>
            </div>
            <div
              class="col-md-3 divided-col"
              style="
                display: flex;
                justify-content: center;
                align-items: center;
              "
            >
              <div class="divided-col-item" style="margin: 10px; padding: 10px">
                <a href="assets/images/mof-logo.png">
                  <img src="/frontend/assets/images/mof-logo.png" alt="About Us" />
                </a>
              </div>
            </div>
            <div
              class="col-md-3 divided-col"
              style="
                display: flex;
                justify-content: center;
                align-items: center;
              "
            >
              <div class="divided-col-item" style="margin: 10px; padding: 10px">
                <a href="assets/images/khd-logo.png">
                  <img src="/frontend/assets/images/khd-logo.png" alt="About Us" />
                </a>
              </div>
            </div>

            <div
              class="col-md-3 divided-col"
              style="
                display: flex;
                justify-content: center;
                align-items: center;
              "
            >
              <div class="divided-col-item" style="margin: 10px; padding: 10px">
                <a href="assets/images/moh-logo.png">
                  <img src="/frontend/assets/images/moh-logo.png" alt="About Us" />
                </a>
              </div>
            </div>
            <div
              class="col-md-3 divided-col"
              style="
                display: flex;
                justify-content: center;
                align-items: center;
              "
            >
              <div class="divided-col-item" style="margin: 10px; padding: 10px">
                <a href="assets/images/qad-logo.png">
                  <img src="/frontend/assets/images/qad-logo.png" alt="About Us" />
                </a>
              </div>
            </div>
            <div
              class="col-md-3 divided-col"
              style="
                display: flex;
                justify-content: center;
                align-items: center;
              "
            >
              <div class="divided-col-item" style="margin: 10px; padding: 10px">
                <a href="assets/images/ofqual-logo.png">
                  <img src="/frontend/assets/images/ofqual-logo.png" alt="About Us" />
                </a>
              </div>
            </div>
            <div
              class="col-md-3 divided-col"
              style="
                display: flex;
                justify-content: center;
                align-items: center;
              "
            >
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
    <section
      id="features"
      class="offers"
      style="background-color: #000 !important; padding: 20px 0"
    >
      <div class="container">
        <div class="row justify-content-center items">
          <div class="col-12 col-md-12 col-lg-12" style="display: flex">
            <h4 style="color: #ff0101">
              We have changed the lives of over 300,000 students since 1995. Now
              it’s your turn!
            </h4>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a
              href="tel:+971564157272"
              class="btn primary-button"
            >
              Call Now</a
            >
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
            <h5 class="faq-title">How can I get a teacher diploma in UAE?</h5>
            <p class="faq-text">
              To obtain a teacher diploma in the UAE, you typically need to
              enroll in a recognized foundation in education & teaching program
              offered byASTI Academy. These programs usually require completing
              a series of courses and practical teaching experiences. Research
              accredited programs, meet their admission requirements, and apply
              to begin your journey toward earning a teacher diploma.
            </p>
            <button class="faq-toggle">
              <svg
                class="chevron w-6 h-6 text-gray-800 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 8"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"
                />
              </svg>

              <svg
                class="close w-6 h-6 text-gray-800 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 14"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                />
              </svg>
            </button>
          </div>
          <div class="faq">
            <h5 class="faq-title">How much is Level 3 in Dubai?</h5>
            <p class="faq-text">
              The cost of a Level 3 qualification in Dubai can vary depending on
              the specific course, institution, and delivery format (e.g.,
              full-time, part-time, online). It's advisable to research
              different training providers and compare their fees to find a
              program that fits your budget and meets your educational needs.
            </p>
            <button class="faq-toggle">
              <svg
                class="chevron w-6 h-6 text-gray-800 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 8"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"
                />
              </svg>

              <svg
                class="close w-6 h-6 text-gray-800 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 14"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                />
              </svg>
            </button>
          </div>
          <div class="faq">
            <h5 class="faq-title">
              What qualification is a foundation diploma?
            </h5>
            <p class="faq-text">
              A foundation diploma typically serves as an introductory
              qualification that provides fundamental knowledge and skills in a
              specific field or subject area. It's designed to prepare
              individuals for further education or entry-level positions in
              their chosen field. Depending on the program, a foundation diploma
              may be equivalent to a Level 3 qualification.
            </p>
            <button class="faq-toggle">
              <svg
                class="chevron w-6 h-6 text-gray-800 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 8"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"
                />
              </svg>

              <svg
                class="close w-6 h-6 text-gray-800 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 14"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                />
              </svg>
            </button>
          </div>
          <div class="faq">
            <h5 class="faq-title">
              What is a Level 3 Diploma in Education and Training in the UAE?
            </h5>
            <p class="faq-text">
              A Level 3 Diploma in Education and Training in the UAE is a
              recognized qualification designed to prepare individuals for a
              career in teaching and training. It covers essential topics such
              as teaching methodologies, lesson planning, assessment strategies,
              and classroom management. Completing this diploma can qualify you
              to teach in various educational settings.
            </p>
            <button class="faq-toggle">
              <svg
                class="chevron w-6 h-6 text-gray-800 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 8"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"
                />
              </svg>

              <svg
                class="close w-6 h-6 text-gray-800 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 14"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                />
              </svg>
            </button>
          </div>
          <div class="faq">
            <h5 class="faq-title">
              Which course is best for teaching in the UAE?
            </h5>
            <p class="faq-text">
              Several courses are suitable for teaching in the UAE, including a
              Bachelor of Education (B.Ed.), Postgraduate Certificate in
              Education (PGCE), and Level 3 Diploma in Education and Training.
              The best course for you depends on your educational background,
              career goals, and specific requirements of teaching positions in
              the UAE.
            </p>
            <button class="faq-toggle">
              <svg
                class="chevron w-6 h-6 text-gray-800 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 8"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"
                />
              </svg>

              <svg
                class="close w-6 h-6 text-gray-800 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 14"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                />
              </svg>
            </button>
          </div>
          <div class="faq">
            <h5 class="faq-title">
              What qualifications do I need to be a teacher in the UAE?
            </h5>
            <p class="faq-text">
              To work as a teacher in the UAE, you typically need a relevant
              bachelor's degree in education or a related field, such as your
              subject area of expertise. Additionally, many schools require
              teaching certification, such as a B.Ed., PGCE, or equivalent
              qualification, along with relevant teaching experience.
            </p>
            <button class="faq-toggle">
              <svg
                class="chevron w-6 h-6 text-gray-800 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 8"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"
                />
              </svg>

              <svg
                class="close w-6 h-6 text-gray-800 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 14"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                />
              </svg>
            </button>
          </div>
          <div class="faq">
            <h5 class="faq-title">
              Is B.Ed. required for teaching in the UAE?
            </h5>
            <p class="faq-text">
              While a Bachelor of Education (B.Ed.) is commonly required for
              teaching positions in the UAE, specific requirements may vary
              depending on the school or educational institution. Some schools
              may accept alternative qualifications or combinations of education
              and teaching experience. It's essential to review the job postings
              and qualifications required by prospective employers in the UAE.
            </p>
            <button class="faq-toggle">
              <svg
                class="chevron w-6 h-6 text-gray-800 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 8"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"
                />
              </svg>

              <svg
                class="close w-6 h-6 text-gray-800 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 14"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                />
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
    <section
      id="testimonials"
      class="section-3 carousel"
      style="background-color: #fff"
    >
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
                    <img
                      src="/frontend/assets/images/testimonial/29.webp"
                      alt="Adams Baker"
                      class="person"
                    />
                    <h4>Riyaa M.</h4>
                    <p style="text-align: justify">
                      Completing the Level 3 Diploma in Education and Training
                      at ASTI in the UAE was truly transformative! The
                      interactive classes and practical assignments equipped me
                      with the skills and confidence to excel as an educator.
                      Highly recommended!
                    </p>
                  </div>
                </div>
              </div>
              <div class="swiper-slide slide-center text-center item">
                <div class="row card">
                  <div class="col-12">
                    <img
                      src="/frontend/assets/images/testimonial/9.webp"
                      alt="Mary Evans"
                      class="person"
                    />
                    <h4>Ahmed K.</h4>
                    <p style="text-align: justify">
                      As a working professional, I needed a flexible program
                      that fit my schedule. The Level 3 Diploma at ASTI provided
                      just that! The supportive faculty and comprehensive
                      curriculum prepared me for success in the classroom.
                    </p>
                  </div>
                </div>
              </div>
              <div class="swiper-slide slide-center text-center item">
                <div class="row card">
                  <div class="col-12">
                    <img
                      src="/frontend/assets/images/testimonial/17.webp"
                      alt="Nadia Malik"
                      class="person"
                    />
                    <h4>Fatima Mariya</h4>
                    <p style="text-align: justify">
                      The Level 3 Diploma program at ASTI exceeded my
                      expectations! The hands-on approach to learning and
                      emphasis on real-world applications truly set me up for a
                      rewarding career in education. Thank you, ASTI!
                    </p>
                  </div>
                </div>
              </div>
              <div class="swiper-slide slide-center text-center item">
                <div class="row card">
                  <div class="col-12">
                    <img
                      src="/frontend/assets/images/testimonial/10.webp"
                      alt="Khalid Mansoor"
                      class="person"
                    />
                    <h4>Mohammed S.</h4>
                    <p style="text-align: justify">
                      The engaging lectures, practical workshops, and
                      personalized support made my learning journey both
                      enjoyable and fulfilling.
                    </p>
                  </div>
                </div>
              </div>
              <div class="swiper-slide slide-center text-center item">
                <div class="row card">
                  <div class="col-12">
                    <img
                      src="/frontend/assets/images/Comments_68-x-68_6.png"
                      alt="Sara Khan"
                      class="person"
                    />
                    <h4>Taniya H.</h4>
                    <p style="text-align: justify">
                      ASTI's Level 3 Diploma program provided me with the
                      knowledge and skills needed to thrive in the field of
                      education. The dedicated instructors and collaborative
                      learning environment made the entire experience incredibly
                      enriching.
                    </p>
                  </div>
                </div>
              </div>
              <div class="swiper-slide slide-center text-center item">
                <div class="row card">
                  <div class="col-12">
                    <img
                      src="/frontend/assets/images/Comments_68-x-68_5.png"
                      alt="Sara Khan"
                      class="person"
                    />
                    <h4>Ali R.</h4>
                    <p style="text-align: justify">
                      Studying for the Level 3 Diploma at ASTI was a
                      game-changer for me! The program's emphasis on inclusive
                      teaching methods and diverse learning styles empowered me
                      to create dynamic and engaging lessons for my students.
                    </p>
                  </div>
                </div>
              </div>
              <div class="swiper-slide slide-center text-center item">
                <div class="row card">
                  <div class="col-12">
                    <img
                      src="/frontend/assets/images/Comments_68-x-68_3.png"
                      alt="Sara Khan"
                      class="person"
                    />
                    <h4>Noor A.</h4>
                    <p style="text-align: justify">
                      ASTI's Level 3 Diploma program not only helped me develop
                      professionally but also personally. The supportive
                      community of fellow students and faculty members
                      encouraged me to push beyond my limits and achieve my
                      goals.
                    </p>
                  </div>
                </div>
              </div>
              <div class="swiper-slide slide-center text-center item">
                <div class="row card">
                  <div class="col-12">
                    <img
                      src="/frontend/assets/images/Comments_68-x-68_2.png"
                      alt="Sara Khan"
                      class="person"
                    />
                    <h4>Layla B</h4>
                    <p style="text-align: justify">
                      From practical teaching experience to theoretical
                      knowledge, I feel fully equipped to make a positive impact
                      in the classroom.
                    </p>
                  </div>
                </div>
              </div>
              <div class="swiper-slide slide-center text-center item">
                <div class="row card">
                  <div class="col-12">
                    <img
                      src="/frontend/assets/images/Comments_68-x-68_1.png"
                      alt="Sara Khan"
                      class="person"
                    />
                    <h4>Ansiba M.</h4>
                    <p style="text-align: justify">
                      Choosing ASTI for my Level 3 Diploma in Education and
                      Training was one of the best decisions I've made! The
                      program's comprehensive curriculum and hands-on approach
                      prepared me for the challenges and rewards of a career in
                      education..
                    </p>
                  </div>
                </div>
              </div>
              <div class="swiper-slide slide-center text-center item">
                <div class="row card">
                  <div class="col-12">
                    <img
                      src="/frontend/assets/images/testimonial/11.webp"
                      alt="Sara Khan"
                      class="person"
                    />
                    <h4>Omar S.</h4>
                    <p style="text-align: justify">
                      The Level 3 Diploma program at ASTI provided me with the
                      foundation I needed to pursue my passion for teaching. The
                      program's focus on reflective practice and continuous
                      improvement has been instrumental in shaping me into a
                      confident and effective educator.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </section>
    <section id="subscribe" class="section-6" style="background-color: #fff">
      <div class="content-section" style="padding-top: 0">
        <div class="row justify-content-center align-items-center">
          <div class="col-12 col-md-7 text-md-left">
            <h3 class="text-center">ASTI Online vs Other Institute</h3>
            <div class="table-responsive">
              <table
                class="table table-bordered"
                style="
                  border-collapse: collapse !important;
                  border-spacing: 0 !important;
                "
              >
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
     @if(\Illuminate\Support\Facades\Auth::check())
          <button
              id="pay-button"
              class="enroll-button">
              Register Now
          </button>
      @else
          <a
              class="enroll-button"
              href="{{route('login')}}">
              Register Now
          </a>
      @endif


  </div>

  <!-- enroll-button-code-ends-here -->

@endsection
