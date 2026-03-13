<?php $page = 'Advancing Careers Through Professional Development | Know More About Us'; ?>
@extends('frontend.layouts.front_layout')
@section('style')
    <style>
        :root {
            --header-bg-color: #f5f5f5;
            --nav-item-color: #2f323a;
            --top-nav-item-color: #2f323a;
            --hero-bg-color: #f5f5f5;

            --section-1-bg-color: #eeeeee;
            --section-2-bg-color: #e5e5e5;
            --section-3-bg-color: #f5f5f5;
            --section-4-bg-color: #eeeeee;
            --section-5-bg-color: #e5e5e5;
            --section-6-bg-color: #f5f5f5;
            --section-7-bg-color: #eeeeee;

            --footer-bg-color: #191919;
        }


        .iti {
            width: 100%;
        }

        .field-phone {
            padding-left: 100px !important;
        }

        .iti__selected-country {
            background: #eeeeee;
        }

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

        /* Popup styles */
        #popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1050;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.3s ease-in-out;
        }

        #popup.active {
            visibility: visible;
            opacity: 1;
        }

        .popup-content {
            position: relative;
            background-image: url("./assets/images/popup-02-02-02.png");
            background-size: cover;
            background-position: center;
            width: 90%;
            max-width: 800px;
            height: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .close-btn:hover {
            background-color: rgba(255, 255, 255, 1);
        }

        .close-btn i {
            color: black;
        }

        .apply-btn {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background-color: white;
            color: black;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        }

        .apply-btn:hover {
            background-color: #f0f0f0;
            color: black;
        }
    </style>
    <style>
        .progress-steps {
            position: relative;
            display: flex;
            justify-content: space-between;
            margin-bottom: 3rem;
            padding: 0 1rem;
        }

        .progress-line {
            position: absolute;
            top: 20px;
            left: 50px;
            right: 50px;
            height: 4px;
            background-color: #dee2e6;
            z-index: 1;
        }

        .progress-line-fill {
            width: 33%;
            height: 100%;
            background-color: #fc5130;
            transition: width 0.3s ease;
        }

        .step {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #adb5bd;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .step.active .step-circle {
            background-color: #fc5130;
        }

        .step.active .step-text {
            color: #fc5130;
        }

        .step-text {
            font-size: 0.875rem;
            font-weight: 500;
            color: #6c757d;
            text-align: center;
        }

        .content-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: #fde8ec;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fc5130;
            font-size: 1.5rem;
            transform: rotate(-45deg);
            transition: transform 0.3s ease;
        }

        .content-section:hover .content-icon {
            transform: rotate(0deg);
        }

        @media (max-width: 768px) {
            .content-flex {
                flex-direction: column !important;
                align-items: flex-start !important;
            }

            .content-icon {
                margin-bottom: 1rem;
            }

            .progress-steps {
                padding: 0;
            }

            .progress-line {
                left: 20px;
                right: 20px;
            }

            .step-text {
                font-size: 0.75rem;
            }

            .content-section {
                padding: 0 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .progress-steps {
                margin-bottom: 2rem;
            }

            .step-circle {
                width: 32px;
                height: 32px;
                font-size: 0.875rem;
            }

            .content-icon {
                width: 40px;
                height: 40px;
                font-size: 1.25rem;
            }

            h3.h4 {
                font-size: 1.125rem;
            }

            .content-section {
                margin-bottom: 1.5rem;
            }
        }



        /* course-card-css-starts-here */
        .category-section {
            max-width: 1200px;
            margin: 0 auto 60px;
            text-align: center;
        }

        .category-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .course-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            transition: transform 0.3s;
            max-width: 260px;
            /* margin: 0 auto; */
        }

        .course-card:hover {
            transform: translateY(-5px);
        }

        .course-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .course-content {
            padding: 16px;
            text-align: left;
        }

        .course-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .course-info {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 5px;
        }

        .enroll-btn {
            text-align: center;
            display: inline-block;
            margin-top: 10px;
            padding: 10px 16px;
            background: linear-gradient(135deg, #ff8a00, #e52e71);
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            width: 90%;
            transition: background-color 0.3s;
        }

        .enroll-btn:hover {
            /* background-color: #0056b3; */
            color: #fff;
        }

        .pricing {
            display: none !important:
        }

        /* course-card-css-ends-here */
    </style>
@endsection

@section('content')
    <!-- Course-cards-starts-here -->
    <section class="category-section">
        <h2 class="category-title">Accounting and Finance Training</h2>

        <div class="grid-container">
            <!-- <div class="course-card">
                                <img
                                  src="https://via.placeholder.com/300x180?text=HTML+CSS"
                                  alt="HTML CSS Course"
                                />
                                <div class="course-content">
                                  <div class="course-name">HTML & CSS Bootcamp</div>
                                  <div class="course-info">Price: ₹999</div>
                                  <div class="course-info">Duration: 4 weeks</div>
                                  <a href="course-html-css.html" class="enroll-btn">Read More</a>
                                </div>
                              </div> -->

            <!-- <div class="course-card">
                                <img
                                  src="https://via.placeholder.com/300x180?text=JavaScript"
                                  alt="JavaScript Course"
                                />
                                <div class="course-content">
                                  <div class="course-name">JavaScript Essentials</div>
                                  <div class="course-info">Price: ₹1299</div>
                                  <div class="course-info">Duration: 6 weeks</div>
                                  <a href="course-js.html" class="enroll-btn">Read More</a>
                                </div>
                              </div> -->

            <!-- <div class="course-card">
                                <img
                                  src="https://via.placeholder.com/300x180?text=React"
                                  alt="React Course"
                                />
                                <div class="course-content">
                                  <div class="course-name">React for Beginners</div>
                                  <div class="course-info">Price: ₹1499</div>
                                  <div class="course-info">Duration: 5 weeks</div>
                                  <a href="course-react.html" class="enroll-btn">Read More</a>
                                </div>
                              </div> -->

            <div class="course-card">
                <img src="/frontend/assets/images/oracle-financial-programme-1.jpg" alt="Oracle Financial" />
                <div class="course-content">
                    <div class="course-name">Oracle Financial Courses</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/oracle-financials-training-course-in-UAE" class="enroll-btn">Read More</a>
                </div>
            </div>
        </div>
    </section>
    <!-- course-cards-ends-here -->
@endsection
