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
            margin: 0 auto;
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
            /* background-color: #0056b3;
                                                                                                                                                                                                                                                                                                                                                                                                            color: #fff; */
        }

        /* course-card-css-ends-here */
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

        .pricing {
            display: none
        }
    </style>
@endsection

@section('content')
    <section class="category-section">
        <h2 class="category-title">Professional Certification Online Programs at ASTI Academy DWC</h2>

        <div class="grid-container">

            <div class="course-card">
                <img src="/frontend/assets/images/biomedical-engineering-programme-1.jpg"
                    alt="Biomedical Engineering Programme" />
                <div class="course-content">
                    <div class="course-name">Biomedical Engineering Programme</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/online-biomedical-engineering-diploma-program" class="enroll-btn">Read More</a>
                </div>
            </div>

            <div class="course-card">
                <img src="/frontend/assets/images/chemical-engineering-program-1.jpg"
                    alt="Chemical Engineering Programme" />
                <div class="course-content">
                    <div class="course-name">Chemical Engineering Programme</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/online-chemical-engineering-diploma" class="enroll-btn">Read More</a>
                </div>
            </div>

            <div class="course-card">
                <img src="/frontend/assets/images/petroleum-engineering-program-1.jpg"
                    alt="Petroleum Engineering Program" />
                <div class="course-content">
                    <div class="course-name">Petroleum Engineering Programme</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/study-online-petroleum-engineering-diploma-program" class="enroll-btn">Read More</a>
                </div>
            </div>

            <div class="course-card">
                <img src="/frontend/assets/images/quantity-surveying-engineering-program-1.jpg"
                    alt="Quantity Surveying Engineering Programme" />
                <div class="course-content">
                    <div class="course-name">Quantity Surveying Engineering Program</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/online-quantity-survey-engineering-diploma" class="enroll-btn">Read More</a>
                </div>
            </div>

            <div class="course-card">
                <img src="/frontend/assets/images/property-management-programme-1.jpg"
                    alt="Property Management Programme" />
                <div class="course-content">
                    <div class="course-name">Property Management Programme</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/study-online-property-management-diploma" class="enroll-btn">Read More</a>
                </div>
            </div>
            <div class="course-card">
                <img src="/frontend/assets/images/design-engineering-programme-1.jpg" alt="Oracle Financial" />
                <div class="course-content">
                    <div class="course-name">Design Engineering Programme</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/study-online-design-engineering-program" class="enroll-btn">Read More</a>
                </div>
            </div>
            <div class="course-card">
                <img src="/frontend/assets/images/electrical-vehicle-engineering-course-1.jpg"
                    alt="Electrical Vehicle Engineering Course" />
                <div class="course-content">
                    <div class="course-name">Electrical Vehicle Engineering Course</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/online-electrical-vehicle-engineering-course" class="enroll-btn">Read More</a>
                </div>
            </div>
            <div class="course-card">
                <img src="/frontend/assets/images/mechatronics-engineering-program-1.jpg"
                    alt="Mechatronics Engineering Programme" />
                <div class="course-content">
                    <div class="course-name">Mechatronics Engineering Programme</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/online-mechatronics-engineering-diploma-program" class="enroll-btn">Read More</a>
                </div>
            </div>
            <div class="course-card">
                <img src="/frontend/assets/images/data-analysis-training-course-1.jpg"
                    alt="Data Analysis Training Course" />
                <div class="course-content">
                    <div class="course-name">Data Analysis Training Course</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/study-online-data-analysis-course" class="enroll-btn">Read More</a>
                </div>
            </div>

            <div class="course-card">
                <img src="/frontend/assets/images/data-science-witi-ai-1.jpg" alt="DAta Science with AI" />
                <div class="course-content">
                    <div class="course-name">Data Science with AI Course</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/study-online-data-science-with-ai" class="enroll-btn">Read More</a>
                </div>
            </div>



            <div class="course-card">
                <img src="/frontend/assets/images/python-web-development-course-1.jpg" alt="Python Web Development" />
                <div class="course-content">
                    <div class="course-name">Python Web Development</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/study-online-python-web-development-course" class="enroll-btn">Read More</a>
                </div>
            </div>

            <div class="course-card">
                <img src="/frontend/assets/images/block-chain-technology-programme-1.jpg"
                    alt="Blockchain Technology Programme" />
                <div class="course-content">
                    <div class="course-name">Blockchain Technology Programme</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/study-online-blockchain-and-technology-diploma-program" class="enroll-btn">Read
                        More</a>
                </div>
            </div>

            <div class="course-card">
                <img src="/frontend/assets/images/artificial-intelligence-programme-1.jpg"
                    alt="Artificial Intelligence Programme" />
                <div class="course-content">
                    <div class="course-name">Artificial Intelligence Programme</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/study-artificial-intelligence-diploma-program" class="enroll-btn">Read More</a>
                </div>
            </div>

            <div class="course-card">
                <img src="/frontend/assets/images/oracle-financial-programme-1.jpg" alt="Oracle Financial" />
                <div class="course-content">
                    <div class="course-name">Oracle Financial Courses</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/oracle-financials-training-course-in-UAE" class="enroll-btn">Read More</a>
                </div>
            </div>





            <div class="course-card">
                <img src="/frontend/assets/images/cyber-security.jpg" alt="cyber-security-with-ai" />
                <div class="course-content">
                    <div class="course-name">Cyber Security With AI</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/cyber-security-with-ai" class="enroll-btn">Read More</a>
                </div>
            </div>

            <div class="course-card">
                <img src="/frontend/assets/images/health-administration.jpg" alt="Health Administration" />
                <div class="course-content">
                    <div class="course-name">Health Administration</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/health-administration" class="enroll-btn">Read More</a>
                </div>
            </div>


            <div class="course-card">
                <img src="/frontend/assets/images/digital-marketing-management.jpg" alt="Digital Marketing Management" />
                <div class="course-content">
                    <div class="course-name">Digital Marketing Management</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/digital-marketing-management" class="enroll-btn">Read More</a>
                </div>
            </div>

            <div class="course-card">
                <img src="/frontend/assets/images/marketing-management-sales-management.jpg"
                    alt="Marketing Management & Sales" />
                <div class="course-content">
                    <div class="course-name">Marketing Management Sales Management</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/marketing-management-sales-management-programme" class="enroll-btn">Read More</a>
                </div>
            </div>
            <div class="course-card">
                <img src="/frontend/assets/images/facade-engineering.jpg" alt="Marketing Management & Sales" />
                <div class="course-content">
                    <div class="course-name">Facade Engineering</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/facade-engineering" class="enroll-btn">Read More</a>
                </div>
            </div>
            <div class="course-card">
                <img src="/frontend/assets/images/project-management.jpg" alt="Marketing Management & Sales" />
                <div class="course-content">
                    <div class="course-name">Project Management</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/project-management" class="enroll-btn">Read More</a>
                </div>
            </div>
            <div class="course-card">
                <img src="/frontend/assets/images/robotics.jpg" alt="Automation Robotics Engineering Program" />
                <div class="course-content">
                    <div class="course-name">Automation & Robotics Engineering Program</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/automation-robotics-engineering-program" class="enroll-btn">Read More</a>
                </div>
            </div>
            <div class="course-card">
                <img src="/frontend/assets/images/automative-diagnostics.jpg"
                    alt="Automation Robotics Engineering Program" />
                <div class="course-content">
                    <div class="course-name">Automotive Diagnostics Engineering Course</div>
                    <div class="course-info pricing">Price: $599</div>
                    <div class="course-info">Duration: 6 Months</div>
                    <a href="/courses/automotive-diagnostics-engineering-course" class="enroll-btn">Read More</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Courses section ends here -->

    <!-- Courses Section starts here -->
    <section class="category-section">
        <h2 class="category-title">UK Diploma Online Qualification Programs at ASTI Academy DWC</h2>

        <div class="grid-container">

            <div class="course-card">
                <img src="/frontend/assets/images/level-3-foundation-diploma-accountancy-1.jpg"
                    alt="Foundation Diploma in Accountancy" />
                <div class="course-content">
                    <div class="course-name">Level-3 Foundation Diploma in Accountancy</div>
                    <div class="course-info pricing">Price: $1999</div>
                    <div class="course-info">Duration: 12 Months/ 1 Year</div>
                    <a href="/courses/level-3-foundation-diploma-in-accountancy" class="enroll-btn">Read More</a>
                </div>
            </div>

            <div class="course-card">
                <img src="/frontend/assets/images/level-3-foundation-diploma-in-higher-education-1.jpg"
                    alt="DAta Science with AI" />
                <div class="course-content">
                    <div class="course-name">Level-3 Foundation Diploma in Higer Education</div>
                    <div class="course-info pricing">Price: $1999</div>
                    <div class="course-info">Duration: 12 Months/ 1 Year</div>
                    <a href="/courses/level-3-foundation-diploma-in-higher-education" class="enroll-btn">Read More</a>
                </div>
            </div>

            {{-- <div class="course-card">
                <img src="/frontend/assets/images/level-3-diploma-in-education-and-training-1.jpg"
                    alt="Diploma in Education and Training" />
                <div class="course-content">
                    <div class="course-name">Diploma in Education and Training</div>
                    <div class="course-info">Price: $1999</div>
                    <div class="course-info">Duration: 12 Months / 1 Year</div>
                    <a href="/courses/level-3-diploma-in-education-and-training" class="enroll-btn">Read More</a>
                </div>
            </div> --}}
            <div class="course-card">
                <img src="/frontend/assets/images/level-4-foundation-diploma-in-accountancy-1.jpg"
                    alt="Diploma in Accounting and Business" />
                <div class="course-content">
                    <div class="course-name">Level-4 Diploma in Accounting and Business</div>
                    <div class="course-info pricing">Price: $1999</div>
                    <div class="course-info">Duration: 12 Months/ 1 Year</div>
                    <a href="/courses/level-4-and-5-diploma-in-accounting-and-business" class="enroll-btn">Read More</a>
                </div>
            </div>

            <div class="course-card">
                <img src="/frontend/assets/images/level-4-diploma-in-education-and-training-1.jpg"
                    alt="Diploma in Education and Training" />
                <div class="course-content">
                    <div class="course-name">Level-4 Diploma in Education and Training</div>
                    <div class="course-info pricing">Price: $1999</div>
                    <div class="course-info">Duration: 12 Months/ 1 Year</div>
                    <a href="/courses/level-4-and-5-diploma-in-education-and-training" class="enroll-btn">Read More</a>
                </div>
            </div>
            <div class="course-card">
                <img src="/frontend/assets/images/level-4-business-management.jpg"
                    alt="Diploma in Education and Training" />
                <div class="course-content">
                    <div class="course-name">Level-4 Diploma in Business Management</div>
                    <div class="course-info pricing">Price: $1999</div>
                    <div class="course-info">Duration: 12 Months/ 1 Year</div>
                    <a href="/courses/level-4-diploma-in-business-management" class="enroll-btn">Read More</a>
                </div>
            </div>
            <div class="course-card">
                <img src="/frontend/assets/images/level-5-diploma-in-accounting-and-business-1.jpg"
                    alt="Diploma in Accounting and Business" />
                <div class="course-content">
                    <div class="course-name">Level-5 Diploma in Accounting and Business</div>
                    <div class="course-info pricing">Price: $1999</div>
                    <div class="course-info ">Duration: 12 Months/ 1 Year</div>
                    <a href="/courses/level-5-diploma-in-accounting-and-business" class="enroll-btn">Read More</a>
                </div>
            </div>
            <div class="course-card">
                <img src="/frontend/assets/images/level-5-business-management.jpg"
                    alt="Diploma in Accounting and Business" />
                <div class="course-content">
                    <div class="course-name">Level-5 Diploma in Business Management</div>
                    <div class="course-info pricing">Price: $1999</div>
                    <div class="course-info ">Duration: 12 Months/ 1 Year</div>
                    <a href="/courses/level-5-diploma-in-business-management" class="enroll-btn">Read More</a>
                </div>
            </div>





        </div>
    </section>
    <!-- Courses section ends here -->
@endsection
