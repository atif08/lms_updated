<?php $page = 'Professional Data Analysis Training with Real-World Simulations'; ?>
@extends('frontend.layouts.front_layout')
@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/hyderabad-courses-landing-page.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
@endpush
@section('content')
    <!-- Navigation -->
    <nav class="navbarr" id="navbar">
        <div class="container">
            <div class="nav-content">
                <div class="logo">

                    <img style="width: 150px" src="/frontend/assets/images/Asti_DWC_Regular Logo.png"
                        alt=" ASTI Academy " />
                </div>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#course-highlightss">Course</a></li>
                    {{-- <li><a href="#instructors">Instructors</a></li> --}}
                    <li><a href="#testimonials">Reviews</a></li>
                    <li><a href="#schedule">Schedule</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><button class="btn-primary">Apply Now</button></li>
                </ul>
                <div class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="hero-section">
        <div class="container">
            <div class="hero-content">
                <!-- Left Content -->
                <div class="hero-left">
                    <div class="rating-badge">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span>Trusted by 10,000+ Students</span>
                    </div>
                    <h1 class="hero-title">
                        Master <span class="gradient-text">Data Analysis</span> with
                        Hands-On Offline Training
                    </h1>
                    <p class="hero-subtitle">
                        Join our intensive Data Analysis program with expert mentors, hands-on projects, and classroom-based
                        sessions. Build industry-ready skills in data cleaning, visualization, statistical analysis, and
                        business intelligence using real-world datasets, with personalized mentor guidance throughout the
                        program.
                    </p>
                    <div class="hero-features">
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>100% Offline Classroom Training</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Industry Expert Mentors</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Guaranteed Job Placement</span>
                        </div>
                    </div>
                    <div class="hero-buttons">
                        <button class="btn-primary btn-large">
                            <i class="fas fa-play"></i>
                            Watch Demo Class
                        </button>
                        <button class="btn-secondary btn-large">
                            <i class="fas fa-phone"></i>
                            Book Free Counselling
                        </button>
                    </div>
                </div>

                <!-- Right Form -->
                <div class="hero-right">
                    <div class="registration-form">
                        <div class="form-header">
                            <h3>Start Your Journey Today</h3>
                            <p>Register for Free Demo Class</p>
                        </div>
                        <form id="registrationForm">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Full Name" required />
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email Address" required />
                            </div>

                            <div class="form-group phone-group">
                                <select name="countryCode" class="country-code">
                                    <option value="+91" selected>+91 (IN) India</option>
                                    <option value="+1">+1 (US) United States</option>
                                    <option value="+44">+44 (UK) United Kingdom</option>
                                    <option value="+971">+971 (AE) United Arab Emirates</option>
                                    <option value="+61">+61 (AU) Australia</option>
                                    <option value="+1">+1 (CA) Canada</option>
                                    <option value="+65">+65 (SG) Singapore</option>
                                    <option value="+60">+60 (MY) Malaysia</option>
                                    <option value="+94">+94 (LK) Sri Lanka</option>
                                    <option value="+92">+92 (PK) Pakistan</option>
                                    <option value="+966">+966 (SA) Saudi Arabia</option>
                                    <option value="+974">+974 (QA) Qatar</option>
                                    <option value="+968">+968 (OM) Oman</option>
                                    <option value="+973">+973 (BH) Bahrain</option>
                                    <option value="+965">+965 (KW) Kuwait</option>
                                    <option value="+20">+20 (EG) Egypt</option>
                                    <option value="+27">+27 (ZA) South Africa</option>
                                    <option value="+254">+254 (KE) Kenya</option>
                                    <option value="+234">+234 (NG) Nigeria</option>
                                    <option value="+81">+81 (JP) Japan</option>
                                    <option value="+82">+82 (KR) South Korea</option>
                                    <option value="+86">+86 (CN) China</option>
                                    <option value="+852">+852 (HK) Hong Kong</option>
                                    <option value="+853">+853 (MO) Macau</option>
                                    <option value="+886">+886 (TW) Taiwan</option>
                                    <option value="+62">+62 (ID) Indonesia</option>
                                    <option value="+63">+63 (PH) Philippines</option>
                                    <option value="+84">+84 (VN) Vietnam</option>
                                    <option value="+66">+66 (TH) Thailand</option>
                                    <option value="+31">+31 (NL) Netherlands</option>
                                    <option value="+33">+33 (FR) France</option>
                                    <option value="+34">+34 (ES) Spain</option>
                                    <option value="+39">+39 (IT) Italy</option>
                                    <option value="+49">+49 (DE) Germany</option>
                                    <option value="+41">+41 (CH) Switzerland</option>
                                    <option value="+46">+46 (SE) Sweden</option>
                                    <option value="+45">+45 (DK) Denmark</option>
                                    <option value="+358">+358 (FI) Finland</option>
                                    <option value="+47">+47 (NO) Norway</option>
                                    <option value="+7">+7 (RU) Russia</option>
                                    <option value="+380">+380 (UA) Ukraine</option>
                                    <option value="+48">+48 (PL) Poland</option>
                                    <option value="+420">+420 (CZ) Czech Republic</option>
                                    <option value="+43">+43 (AT) Austria</option>
                                    <option value="+32">+32 (BE) Belgium</option>
                                    <option value="+352">+352 (LU) Luxembourg</option>
                                    <option value="+353">+353 (IE) Ireland</option>
                                    <option value="+40">+40 (RO) Romania</option>
                                    <option value="+36">+36 (HU) Hungary</option>
                                    <option value="+30">+30 (GR) Greece</option>
                                    <option value="+351">+351 (PT) Portugal</option>
                                    <option value="+90">+90 (TR) Turkey</option>
                                    <option value="+64">+64 (NZ) New Zealand</option>
                                    <option value="+55">+55 (BR) Brazil</option>
                                    <option value="+54">+54 (AR) Argentina</option>
                                    <option value="+56">+56 (CL) Chile</option>
                                    <option value="+57">+57 (CO) Colombia</option>
                                    <option value="+52">+52 (MX) Mexico</option>
                                    <option value="+58">+58 (VE) Venezuela</option>
                                </select>
                                <input type="tel" name="phone" placeholder="Phone Number" required />
                            </div>

                            <div class="form-group">
                                <input type="tel" name="whatsapp" placeholder="WhatsApp Number" required />
                            </div>

                            <div class="form-group">
                                <select name="program" required>
                                    <option value="">Select Program</option>
                                    <option value="Python Web Development">Python Web Development</option>
                                    <option value="Digital Marketing">Digital Marketing</option>
                                    <option value="Cyber Security">Cyber Security</option>
                                    <option value="Data Analysis">Data Analysis</option>
                                </select>
                            </div>

                            <!-- NEW: Country names (required like your commented code had) -->
                            <div class="form-group">
                                <select name="user_country" required>
                                    <option value="">Select Country</option>
                                    <option value="India">India</option>
                                    <option value="United States">United States</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Japan">Japan</option>
                                    <option value="South Korea">South Korea</option>
                                    <option value="China">China</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Macau">Macau</option>
                                    <option value="Taiwan">Taiwan</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Vietnam">Vietnam</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="France">France</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Finland">Finland</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Russia">Russia</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Chile">Chile</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Venezuela">Venezuela</option>
                                </select>

                            </div>


                            <!-- NEW: Optional "When you want to enroll" -->
                            <div class="form-group">
                                <input type="text" name="enrollWhen"
                                    placeholder="When you want to enroll (optional)" />
                            </div>


                            <button type="submit" class="btn-primary btn-full">
                                Register Now - It's Free!
                            </button>
                        </form>

                        <div class="form-footer">
                            <p>
                                <i class="fas fa-lock"></i> Your information is 100% secure
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why This Course -->
    <section id="why-course" class="why-course-section">
        <div class="container">
            <div class="section-header">
                <h2>Why Choose Data Analysis Offline Training? </h2>
                <p>
                    Experience the power of classroom-based Data Analysis learning with personalized attention.
                </p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3>Hands-On Classroom Training </h3>
                    <p>
                        Learn essential data analysis tools and techniques with live instructor guidance, focusing on
                        practical, hands-on learning.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <h3>Real-World Projects </h3>
                    <p>
                        Work on real-world datasets involving data cleaning, analysis, visualization, and business insights
                        to gain practical experience.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3>Industry-Recognized Certification </h3>
                    <p>
                        Earn Data Analysis certifications that are widely recognized and valued by employers across
                        industries.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3>Personalized Mentor Guidance</h3>
                    <p>
                        Receive one-on-one mentorship from experienced data analysts to guide you throughout your learning
                        journey.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Highlights -->
    <section id="course-highlights" class="course-highlights-section" style="display: none">
        <div class="container">
            <div class="section-header">
                <h2>What You'll Master</h2>
                <p>What You’ll Master in Cyber Security </p>
            </div>
            <div class="highlights-grid">
                <div class="highlight-card">
                    <div class="highlight-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3>Oracle Financials Fundamentals</h3>
                    <p>
                        Build a strong foundation in Oracle Financials applications to manage core accounting processes:
                    </p>
                    <ul>
                        <li>General Ledger (GL) Setup & Reporting</li>
                        <li>Accounts Payable (AP)</li>
                        <li>Accounts Receivable (AR)</li>
                        <li>Cash Management (CM)</li>
                    </ul>
                </div>
                <div class="highlight-card">
                    <div class="highlight-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3>Advanced Oracle Financials</h3>
                    <p>
                        Master advanced features to enhance efficiency and financial control:
                    </p>
                    <ul>
                        <li>Multi-Org Concepts</li>
                        <li>Financial Reporting Studio (FRS)</li>
                        <li>Sub ledger Accounting (SLA)</li>

                    </ul>
                </div>
                <div class="highlight-card">
                    <div class="highlight-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3>Integration & Real-Time Scenarios</h3>
                    <p>
                        Apply your learning to real-world Oracle ERP workflows and business scenarios:
                    </p>
                    <ul>
                        <li>Procure-to-Pay (P2P) Cycle</li>
                        <li>Order-to-Cash (O2C) Cycle</li>
                        <li>ERP Implementation Lifecycle</li>

                    </ul>
                </div>
                <div class="highlight-card">
                    <div class="highlight-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Real-World Oracle Projects</h3>
                    <p>
                        Get hands-on project experience to strengthen your portfolio and industry readiness:
                    </p>
                    <ul>
                        <li>End-to-end ERP implementation projects</li>
                        <li>General Ledger & Consolidation Projects</li>
                        <li>Procure-to-Pay (P2P) Case Studies</li>
                        <li>Order-to-Cash (O2C) Case Studies</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Curriculum Section -->
    <section id="course-highlightss" class="course-curriculum">
        <h2>Course Curriculum</h2>

        <div class="accordion">

            <div class="accordion-item">
                <button class="accordion-header">Data Analysis Fundamentals</button>
                <div class="accordion-content">
                    <ul>
                        <li>Introduction to Data Analysis and Analytics Lifecycle</li>
                        <li>Types of Data: Structured, Semi-Structured, and Unstructured</li>
                        <li>Data Collection Methods and Sources</li>
                        <li>Data Cleaning and Preprocessing Techniques</li>
                        <li>Exploratory Data Analysis (EDA)</li>
                        <li>Basic Statistical Concepts for Analysis</li>
                        <li>Understanding Business Problems Using Data</li>
                    </ul>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">Python for Data Analysis</button>
                <div class="accordion-content">
                    <ul>
                        <li>Introduction to Python Programming</li>
                        <li>Data Types, Operators, and Conditional Statements</li>
                        <li>Loops, Functions, and Recursion</li>
                        <li>Lambda Functions and List Comprehensions</li>
                        <li>Classes, Objects, and Exception Handling</li>
                        <li>Modules, Packages, and File Handling</li>
                        <li>String Handling and Data Manipulation</li>
                        <li>NumPy for Numerical Computing</li>
                        <li>Pandas for Data Analysis and Transformation</li>
                        <li>Data Visualization using Matplotlib and Seaborn</li>
                        <li>Mini Projects and Assessments</li>
                    </ul>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">SQL for Data Analysis</button>
                <div class="accordion-content">
                    <ul>
                        <li>Introduction to Database Management Systems</li>
                        <li>Understanding RDBMS and NoSQL Databases</li>
                        <li>MySQL Database Fundamentals</li>
                        <li>SQL Data Definition Language (DDL)</li>
                        <li>SQL Data Manipulation Language (DML)</li>
                        <li>SQL Data Control Language (DCL)</li>
                        <li>Database Schema Design</li>
                        <li>Joins and Nested Queries</li>
                        <li>Subqueries and Views</li>
                        <li>SQL Query Optimization Techniques</li>
                    </ul>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">Microsoft Excel for Data Analysis</button>
                <div class="accordion-content">
                    <ul>
                        <li>Introduction to Microsoft Excel</li>
                        <li>Advanced Excel Functions and Formulas</li>
                        <li>Data Cleaning and Preparation in Excel</li>
                        <li>Data Analysis using Pivot Tables</li>
                        <li>Advanced Charting Techniques</li>
                        <li>Dashboard Creation in Excel</li>
                        <li>Importing Data from Text Files and Databases</li>
                    </ul>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">Power BI</button>
                <div class="accordion-content">
                    <ul>
                        <li>Connecting to Multiple Data Sources</li>
                        <li>Data Modeling and Relationships</li>
                        <li>Creating Interactive Dashboards and Reports</li>
                        <li>Data Visualization using Charts and Graphs</li>
                        <li>Measures and Calculations using DAX</li>
                        <li>Advanced DAX Functions</li>
                        <li>Drill-Through and Hierarchies</li>
                        <li>Real-Time Data Streaming</li>
                    </ul>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">Looker Studio (Google Data Studio)</button>
                <div class="accordion-content">
                    <ul>
                        <li>Introduction to Looker Studio</li>
                        <li>Connecting to Data Sources</li>
                        <li>Creating Dashboards and Reports</li>
                        <li>Using Views, Fields, and Filters</li>
                        <li>Derived Fields and Calculated Metrics</li>
                        <li>Merging Data from Multiple Sources</li>
                        <li>Introduction to LookML</li>
                        <li>Dynamic Data Sync using Google Sheets</li>
                    </ul>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">Capstone Project</button>
                <div class="accordion-content">
                    <ul>
                        <li>Understanding Real-World Business Requirements</li>
                        <li>Data Collection and Data Cleaning</li>
                        <li>Exploratory Data Analysis and Insights</li>
                        <li>Data Visualization and Dashboard Creation</li>
                        <li>Business Reporting and Presentation</li>
                        <li>End-to-End Project using Python, SQL, Excel, and BI Tools</li>
                    </ul>
                </div>
            </div>


        </div>
    </section>
    <!-- Offline Benefits -->
    <section id="offline-benefits" class="offline-benefits-section">
        <div class="container">
            <div class="section-header">
                <h2>Choose Your Learning Style:</h2>
                <p>Classroom or Online</p>
            </div>
            <div class="comparison-container">
                <div class="comparison-card offline">
                    <h3><i class="fas fa-school"></i> Offline Training</h3>
                    <div class="benefits-list">
                        <div class="benefit">
                            <i class="fas fa-check"></i>
                            <span>Face-to-face interaction with Data Analysis experts</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check"></i>
                            <span>Instant doubt resolution</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check"></i>
                            <span>Peer learning & networking</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check"></i>
                            <span>Hands-on lab practice</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check"></i>
                            <span>Better focus & discipline</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check"></i>
                            <span>Industry networking opportunities</span>
                        </div>
                    </div>
                </div>
                <div class="vs-divider">
                    <span>VS</span>
                </div>
                <div class="comparison-card online">
                    <h3><i class="fas fa-laptop"></i> Online Training</h3>
                    <div class="benefits-list">
                        <div class="benefit limited">
                            <i class="fas fa-check"></i>
                            <span>Learn from anywhere at your pace</span>
                        </div>
                        <div class="benefit limited">
                            <i class="fas fa-check"></i>
                            <span>Flexible schedule to fit your lifestyle</span>
                        </div>
                        <div class="benefit limited">
                            <i class="fas fa-check"></i>
                            <span>Access to recorded sessions anytime</span>
                        </div>
                        <div class="benefit limited">
                            <i class="fas fa-check"></i>
                            <span>Connect with peers virtually</span>
                        </div>
                        <div class="benefit limited">
                            <i class="fas fa-check"></i>
                            <span>Self-paced learning to master concepts</span>
                        </div>
                        <div class="benefit limited">
                            <i class="fas fa-check"></i>
                            <span>Cost-effective and convenient</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Target Audience -->
    <section id="target-audience" class="target-audience-section">
        <div class="container">
            <div class="section-header">
                <h2>Who Should Join? </h2>
                <p>Perfect for anyone looking to excel in Data Analysis.</p>
            </div>
            <div class="audience-grid">
                <div class="audience-card">
                    <div class="audience-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3>Students & Fresher’s</h3>
                    <p>
                        Build strong data analysis foundations and kick-start your career in analytics and data-driven
                        roles.
                    </p>
                    <div class="audience-benefits">
                        <span>Career Foundation</span>
                        <span>Industry Exposure</span>
                        <span>Job Readiness</span>
                    </div>
                </div>
                <div class="audience-card">
                    <div class="audience-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3>Working Professionals </h3>
                    <p>
                        Upskill or transition into high-demand data analysis and business intelligence roles. </p>
                    <div class="audience-benefits">
                        <span>Career Growth</span>
                        <span>Skill Upgrade</span>
                        <span>Salary Increase</span>
                    </div>
                </div>
                <div class="audience-card">
                    <div class="audience-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3>Entrepreneurs</h3>
                    <p>
                        Leverage data insights to drive smarter decisions, optimize operations, and accelerate business
                        growth.
                    </p>
                    <div class="audience-benefits">
                        <span>Tech Leadership</span>
                        <span>Innovation Edge</span>
                        <span>Business Growth</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Instructor Profiles -->
    <section id="instructors" class="instructors-section" style="display: none">
        <div class="container">
            <div class="section-header">
                <h2>Meet Your Expert Mentors</h2>
                <p>Learn from industry veterans with real-world experience</p>
            </div>
            <div class="instructors-grid">
                <div class="instructor-card">
                    <div class="instructor-image">
                        <img src="" />
                    </div>
                    <div class="instructor-info">
                        <h3>Dr. Anil Reddy </h3>
                        <p class="instructor-role">Cybersecurity Consultant </p>
                        <p class="instructor-bio">
                            15+ years in network security & penetration testing.
                        </p>
                        <div class="instructor-stats">
                            <span><i class="fas fa-users"></i> 5000+ Students</span>
                            <span><i class="fas fa-star"></i> 4.9 Rating</span>
                        </div>
                    </div>
                </div>
                <div class="instructor-card">
                    <div class="instructor-image">
                        <img src="" />
                    </div>
                    <div class="instructor-info">
                        <h3>Sneha Gupta </h3>
                        <p class="instructor-role">Cloud Security Specialist </p>
                        <p class="instructor-bio">
                            Expert in AWS, Azure, and cloud security compliance.
                        </p>
                        <div class="instructor-stats">
                            <span><i class="fas fa-users"></i> 3500+ Students</span>
                            <span><i class="fas fa-star"></i> 4.8 Rating</span>
                        </div>
                    </div>
                </div>
                <div class="instructor-card">
                    <div class="instructor-image">
                        <img src="" />
                    </div>
                    <div class="instructor-info">
                        <h3>Rahul Verma </h3>
                        <p class="instructor-role">Ethical Hacking Trainer </p>
                        <p class="instructor-bio">
                            Specialized in ethical hacking, malware analysis & forensics.
                        </p>
                        <div class="instructor-stats">
                            <span><i class="fas fa-users"></i> 4200+ Students</span>
                            <span><i class="fas fa-star"></i> 4.9 Rating</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Career Outcomes -->
    <section id="career-outcomes" class="career-outcomes-section">
        <div class="container">
            <div class="section-header">
                <h2>Career Opportunities</h2>
                <p>Unlock high-paying opportunities in the tech industry</p>
            </div>
            <div class="outcomes-grid">
                <div class="career-stats">
                    <div class="stat-card">
                        <h3>95%</h3>
                        <p>Job Placement Rate</p>
                    </div>
                    <div class="stat-card">
                        <h3>$40K</h3>
                        <p>Average Starting Salary</p>
                    </div>
                    <div class="stat-card">
                        <h3>500+</h3>
                        <p>Hiring Partners</p>
                    </div>
                    <div class="stat-card">
                        <h3>3 Months</h3>
                        <p>Average Job Timeline</p>
                    </div>
                </div>
                <div class="job-roles">
                    <h3>Popular Job Roles</h3>
                    <div class="roles-grid">
                        <div class="role-card">
                            <i class="fas fa-robot"></i>
                            <h4>Data Analyst </h4>
                            <p>₹5L–8L</p>
                        </div>
                        <div class="role-card">
                            <i class="fas fa-chart-bar"></i>
                            <h4>Business Analyst </h4>
                            <p>₹6L–10L</p>
                        </div>
                        <div class="role-card">
                            <i class="fas fa-code"></i>
                            <h4>Power BI / BI Analyst</h4>
                            <p>₹7L–12L</p>
                        </div>
                        <div class="role-card">
                            <i class="fas fa-link"></i>
                            <h4>Junior Data Scientist </h4>
                            <p>₹8L–14L</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="testimonials-section">
        <div class="container">
            <div class="section-header">
                <h2>Success Stories</h2>
                <p>Success stories from our Data Analysis Graduates</p>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <img src="" />
                        <div class="student-info">
                            <h4>Anjali Verma </h4>
                            <p>Data Analyst at Wipro</p>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="testimonial-text">
                        “The hands-on data analysis projects helped me build strong analytical thinking. I secured a Data
                        Analyst role within three months of completing the program.”
                    </p>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <img src="" />
                        <div class="student-info">
                            <h4>Megha Rao </h4>
                            <p>Business Analyst at Zomato</p>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="testimonial-text">
                        “Coming from a non-technical background, the structured training and mentor support made my
                        transition into data analysis smooth and confidence-building.”
                    </p>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <img src="" />
                        <div class="student-info">
                            <h4>Suresh Reddy </h4>
                            <p>Senior Data Analyst</p>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="testimonial-text">
                        “The practical exposure to Excel, SQL, and Power BI was the highlight. I now work confidently on
                        real-world datasets and dashboards.”
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- dream-job-section -->
    <section class="dream-job-section">
        <div class="container">
            <h2>
                Thousands of students achieved their <span>dream job</span> at
            </h2>

            <div class="company-logos">
                <img src="/frontend/assets/images/Amazon_logo.svg.png" alt="Amazon">
                <img src="/frontend/assets/images/google-logo-2.webp" alt="Google">
                <img src="/frontend/assets/images/microsoft-logo-2.png" alt="Microsoft">
                <img src="/frontend/assets/images/Goldman-Sachs-Logo.png" alt="Goldman Sachs">
                <img src="/frontend/assets/images/paypal-logo.png" alt="PayPal">
                <img src="/frontend/assets/images/samsung-logo-2.png" alt="Samsung">
                <img src="/frontend/assets/images/salesforce-logo.png" alt="Salesforce">
                <img src="/frontend/assets/images/NetApp-Symbol.png" alt="NetApp">
                <img src="/frontend/assets/images/Hitachi-logo.jpg" alt="Hitachi">
                <img src="/frontend/assets/images/jpmorgan-logo.jpg" alt="JPMorgan">
                <img src="/frontend/assets/images/ibm-logo.png" alt="IBM">
                <img src="/frontend/assets/images/dell-logo.png" alt="Dell">
                <img src="/frontend/assets/images/deloitte-logo.png" alt="Deloitte">
                <img src="/frontend/assets/images/kpmg.png" alt="KPMG">
                <img src="/frontend/assets/images/mercedes-logo.png" alt="Mercedes-Benz">
                <img src="/frontend/assets/images/ey-logo.png" alt="EY">

            </div>
        </div>
    </section>



    <!-- Class Schedule -->
    <section id="schedule" class="schedule-section">
        <div class="container">
            <div class="section-header">
                <h2>Class Schedule & Location</h2>
                <p>Flexible timings to fit your lifestyle</p>
            </div>
            <div class="schedule-container">
                <div class="schedule-info">
                    <div class="schedule-card">
                        <h3><i class="fas fa-calendar"></i> Batch Timings</h3>
                        <div class="timing-options">
                            <div class="timing">
                                <strong>Weekday Morning</strong>
                                <span>9:00 AM - 12:00 PM</span>
                            </div>
                            <div class="timing">
                                <strong>Weekday Evening</strong>
                                <span>6:00 PM - 9:00 PM</span>
                            </div>
                            <div class="timing">
                                <strong>Weekend Intensive</strong>
                                <span>Saturday & Sunday 10:00 AM - 5:00 PM</span>
                            </div>
                        </div>
                    </div>
                    <div class="schedule-card">
                        <h3><i class="fas fa-clock"></i> Course Duration</h3>
                        <div class="duration-info">
                            <div class="duration">
                                <strong>Full Program:</strong>
                                <span>3 Months</span>
                            </div>
                            <div class="duration">
                                <strong>Total Hours:</strong>
                                <span>72+ Hours</span>
                            </div>
                            <div class="duration">
                                <strong>Projects:</strong>
                                <span>15+ Real Projects</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="location-info">
                    <div class="location-card">
                        <h3><i class="fas fa-map-marker-alt"></i> Campus Location</h3>
                        <div class="location-details">
                            <p><strong>ASTI Academy DWC - Hyderabad Branch Office</strong></p>
                            <p>17-1-16/A, 6th-Floor Pinnacle Towers</p>
                            <p>Santosh Nagar, Saidabad</p>
                            <p>Hyderabad- 500059</p>
                            <div class="location-features">
                                <div class="feature">
                                    <i class="fas fa-wifi"></i>
                                    <span>High-Speed WiFi</span>
                                </div>
                                <div class="feature">
                                    <i class="fas fa-laptop"></i>
                                    <span>Modern Lab Setup</span>
                                </div>
                                <div class="feature">
                                    <i class="fas fa-coffee"></i>
                                    <span>Cafeteria & Break Areas</span>
                                </div>
                                <div class="feature">
                                    <i class="fas fa-car"></i>
                                    <span>Free Parking</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="faq-section">
        <div class="container">
            <div class="section-header">
                <h2>Frequently Asked Questions</h2>
                <p>Get answers to common questions about our program</p>
            </div>
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Is the certification industry-recognized?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Yes, our Data Analysis certification is globally recognized and highly valued by top IT
                            companies.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Do I need prior coding knowledge?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            No, basic computer knowledge is enough. We start from fundamentals before moving to advanced
                            Data Analysis tools & techniques.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>What are the fees & installment options?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            We provide flexible fee structures with easy installment options to support learners.

                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Is there placement support in Hyderabad?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Yes, we offer dedicated placement support with leading Data Analysis hiring partners.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Can I attend classes while working full-time? </h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Absolutely! We provide weekday, evening, and weekend batches for working professionals.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section id="final-cta" class="final-cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Transform Your Career?</h2>
                <p>
                    Join thousands of students who choose offline Data Analysis training for accelerated learning
                </p>
                <div class="cta-stats">
                    <div class="stat">
                        <h3>10,000+</h3>
                        <p>Students Trained</p>
                    </div>
                    <div class="stat">
                        <h3>95%</h3>
                        <p>Job Placement</p>
                    </div>
                    <div class="stat">
                        <h3>500+</h3>
                        <p>Hiring Partners</p>
                    </div>
                </div>
                <div class="cta-buttons">
                    <button class="btn-primary btn-large">
                        <i class="fas fa-rocket"></i>
                        Apply Now - Limited Seats
                    </button>
                    <button class="btn-secondary btn-large">
                        <i class="fas fa-calendar-check"></i>
                        Book Free Demo Class
                    </button>
                </div>
                <div class="urgency-text">
                    <p>
                        <i class="fas fa-clock"></i> <strong>Hurry!</strong> Only 12 seats
                        left in next batch starting Monday
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <img style="width: 150px" src="/frontend/assets/images/Asti_DWC_Regular Logo.png"
                            alt=" ASTI Academy " />
                    </div>
                    <p>
                        Transforming data and analytics careers through hands-on Data Analysis training. Gain expertise in
                        data cleaning, visualization, statistical analysis, business intelligence, and more with
                        industry-experienced mentors in Hyderabad.
                    </p>
                    <div class="social-links">
                        <a href="https://www.facebook.com/astionlineuae"><i class="fab fa-facebook"></i></a>
                        <a href="https://x.com/Astidwc"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/company/astiacademyonline"><i class="fab fa-linkedin"></i></a>

                        <a href="https://www.instagram.com/astiacademydwc"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h3>Courses</h3>
                    <ul>


                        <li><a href="/courses/best-python-full-stack-course-in-hyderabad">Python Web Development</a></li>
                        <li><a href="/courses/best-digital-marketing-course-in-hyderabad">Digital Marketing</a></li>
                        <li><a href="/courses/best-cyber-security-course-in-hyderabad">Cybersecurity</a></li>
                    </ul>
                </div>
                {{-- <div class="footer-section">
                    <h3>Company</h3>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Our Instructors</a></li>
                        <li><a href="#">Success Stories</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div> --}}
                <div class="footer-section">
                    <h3>Contact Info</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>17-1-16/A, 6th-Floor Pinnacle Towers
                                Santosh Nagar, Saidabad, Hyderabad- 500059</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+91 8885514426</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>enquire@astidubai.ac.ae</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <span>Mon-Fri: 10AM-7PM</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p>&copy; 2025 ASTI DWC. All rights reserved.</p>
                    <div class="footer-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Refund Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Sticky CTA -->
    <div class="sticky-cta" id="stickyCTA">
        <a href="https://wa.me/918885514426" class="whatsapp-float" target="_blank">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('frontend/assets/js/hyderabad-courses-landing-page.js') }}"></script>
@endpush
