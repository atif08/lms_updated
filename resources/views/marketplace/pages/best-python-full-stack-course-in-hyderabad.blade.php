<?php $page = 'Advanced Python Full-Stack Training with Real-Time Projects'; ?>
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
                        Master <span class="gradient-text">Python Web Development</span> with
                        Hands-On Offline Training
                    </h1>
                    <p class="hero-subtitle">
                        Join our intensive Python Web Development program with expert mentors, real-world projects, and
                        classroom-based sessions. Build industry-ready skills in full-stack web development with
                        personalized mentor guidance.
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
                <h2>Why Choose Our Python Web Development Offline Training?</h2>
                <p>
                    Experience the power of classroom-based Python learning with personalized attention.
                </p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3>Hands-On Classroom Training</h3>
                    <p>
                        Learn Python from scratch to advanced concepts including Flask, Django, REST APIs, HTML, CSS,
                        JavaScript, and Database Integration with real-time instructor guidance.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <h3>Real-World Projects</h3>
                    <p>
                        Work on live web applications, e-commerce platforms, portfolio websites, and API integrations to
                        gain practical, job-ready experience.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3>Industry-Recognized Certification</h3>
                    <p>
                        Earn Python Web Development Certification recognized globally to boost your career opportunities in
                        IT and software development.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3>Personalized Mentor Guidance</h3>
                    <p>
                        Get one-on-one mentorship from Python-certified professionals who will guide you throughout your web
                        development journey.
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
                <p>What You’ll Master in Oracle Financials </p>
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
    <section class="course-curriculum" id="course-highlightss">
        <h2>Course Curriculum</h2>

        <div class="accordion">

            <!-- Core Python -->
            <div class="accordion-item">
                <button class="accordion-header">Core Python</button>
                <div class="accordion-content">
                    <ul>
                        <li>Overview of Programming Languages</li>
                        <li>Getting Started with Python</li>
                        <li>Installing and Using Python Tools</li>
                        <li>Core Python Language Concepts</li>
                        <li>Working Modes in Python (Interactive & Script)</li>
                        <li>Input and Output Operations in Python</li>
                        <li>Python Operators and Expressions</li>
                        <li>Data Types and Variables in Python</li>
                        <li>Control Flow and Conditional Statements</li>
                        <li>String Manipulation Techniques</li>
                        <li>Bytes, ByteArray, and Range Data Handling</li>
                        <li>Lists in Python: Creation and Operations</li>
                        <li>Tuples in Python: Properties and Usage</li>
                        <li>Sets and Frozen Sets in Python</li>
                        <li>Dictionaries in Python: Keys and Values</li>
                        <li>Python Comprehensions (List, Dict, Set)</li>
                        <li>The NoneType Object in Python</li>
                        <li>Defining and Using Functions</li>
                        <li>Working with Python Modules</li>
                        <li>Understanding Python Packages</li>
                        <li>Error and Exception Handling in Python</li>
                        <li>Using Regular Expressions (re module)</li>
                        <li>File Handling and Stream Operations</li>
                        <li>Leveraging the Collections Module</li>
                    </ul>
                </div>
            </div>

            <!-- Advanced Python -->
            <div class="accordion-item">
                <button class="accordion-header">Advanced Python</button>
                <div class="accordion-content">
                    <ul>
                        <li>Advanced Concepts in Python</li>
                        <li>Principles of Object-Oriented Programming (OOP)</li>
                        <li>Working with the OS Module</li>
                        <li>Introduction to Multi-threading in Python</li>
                        <li>Python Logging Techniques</li>
                        <li>Handling Date and Time in Python</li>
                        <li>Memory Management and Garbage Collection</li>
                        <li>Python Database Connectivity (PDBC)</li>
                        <li>Network and Socket Programming in Python</li>
                        <li>GUI Development with Tkinter and Turtle</li>
                    </ul>
                </div>
            </div>

            <!-- NumPy -->
            <div class="accordion-item">
                <button class="accordion-header">NumPy</button>
                <div class="accordion-content">
                    <ul>
                        <li>Introduction to NumPy: Understanding its Importance and Features</li>
                        <li>Creating NumPy Arrays: Techniques and Best Practices</li>
                        <li>Array Attributes and Supported NumPy Data Types</li>
                        <li>Difference Between Views and Copies of Arrays</li>
                        <li>Indexing, Slicing, and Advanced Indexing in NumPy Arrays</li>
                        <li>Iterating Over Elements of an ndarray Efficiently</li>
                        <li>Performing Arithmetic Operations on Arrays</li>
                        <li>Broadcasting: Rules and Applications in NumPy</li>
                        <li>Array Manipulation Functions for Reshaping and Resizing</li>
                        <li>Combining Multiple Arrays into a Single Array</li>
                        <li>Splitting Arrays into Multiple Sub-arrays</li>
                        <li>Sorting Elements in NumPy Arrays</li>
                        <li>Searching and Finding Elements in an ndarray</li>
                        <li>Inserting Elements into NumPy Arrays</li>
                        <li>Deleting Elements from NumPy Arrays</li>
                        <li>Matrix Multiplication Using the dot() Function</li>
                        <li>Using the Matrix Class in NumPy for Structured Computations</li>
                        <li>Linear Algebra Operations via the linalg Module</li>
                        <li>Input and Output Operations with NumPy</li>
                        <li>Performing Basic Statistical Analysis with NumPy</li>
                        <li>Applying NumPy Mathematical Functions for Computations</li>
                        <li>Finding Unique Elements and Counting Occurrences in Arrays</li>
                    </ul>
                </div>
            </div>

            <!-- Pandas -->
            <div class="accordion-item">
                <button class="accordion-header">Pandas</button>
                <div class="accordion-content">
                    <ul>
                        <li>Introduction to Pandas: Overview and Importance</li>
                        <li>Setting Up the Environment for Pandas</li>
                        <li>Basics of Data Structures in Pandas</li>
                        <li>Working with Series in Pandas</li>
                        <li>Working with DataFrames: Creation and Manipulation</li>
                        <li>Understanding Panels (3D Data Structures)</li>
                        <li>Core Functionality of Pandas</li>
                        <li>Descriptive Statistics for Data Analysis</li>
                        <li>Applying Functions to Data (map, apply, applymap)</li>
                        <li>Reindexing and Aligning Data</li>
                        <li>Iterating Over Data Structures</li>
                        <li>Sorting Data in Pandas</li>
                        <li>Handling and Processing Text Data</li>
                        <li>Customization and Options in Pandas</li>
                        <li>Indexing and Selecting Specific Data</li>
                        <li>Using Built-in Statistical Functions</li>
                        <li>Window Functions for Rolling Computations</li>
                        <li>Aggregating Data Using GroupBy Operations</li>
                        <li>Managing Missing Data in Datasets</li>
                        <li>Advanced GroupBy Techniques</li>
                        <li>Merging and Joining Datasets</li>
                        <li>Concatenating Multiple DataFrames</li>
                        <li>Working with Date and Time Data</li>
                        <li>Performing Operations with Timedelta</li>
                        <li>Handling Categorical Data</li>
                        <li>Data Visualization with Pandas</li>
                        <li>Input and Output Tools (CSV, Excel, JSON, SQL)</li>
                        <li>Working with Sparse Data</li>
                        <li>Common Caveats and Gotchas</li>
                        <li>Comparing Pandas Operations with SQL</li>
                    </ul>
                </div>
            </div>

            <!-- Matplotlib -->
            <div class="accordion-item">
                <button class="accordion-header">Matplotlib</button>
                <div class="accordion-content">
                    <ul>
                        <li>Introduction to Matplotlib: Overview and Importance</li>
                        <li>Basics of Line Plots</li>
                        <li>Advanced Techniques for Line Plots</li>
                        <li>Adding Grid Lines to Charts</li>
                        <li>Incorporating Legends in Plots</li>
                        <li>Customizing Tick Locations and Labels</li>
                        <li>Setting Axis Limits Using xlim() and ylim()</li>
                        <li>Configuring Axis Scales (Linear, Logarithmic, etc.)</li>
                        <li>Exploring Plotting Styles and Themes</li>
                        <li>Functional / Procedural vs Object-Oriented Approaches in Plotting</li>
                        <li>Creating Bar Charts and Bar Graphs</li>
                        <li>Designing Pie Charts</li>
                        <li>Plotting Histograms for Data Distribution</li>
                        <li>Scatter Plots for Relationship Analysis</li>
                        <li>Creating Subplots for Multiple Visuals</li>
                        <li>Plotting Geographic Data Using Base map</li>
                        <li>Three-Dimensional (3D) Plotting in Matplotlib</li>
                        <li>Creating Animations and Dynamic Visuals</li>
                    </ul>
                </div>
            </div>

            <!-- HTML -->
            <div class="accordion-item">
                <button class="accordion-header">HTML</button>
                <div class="accordion-content">
                    <ul>
                        <li>Introduction to Web Development: Overview and Basics</li>
                        <li>Getting Started with HTML</li>
                        <li>Understanding HTML Document Structure</li>
                        <li>Presentational and Formatting Tags in HTML</li>
                        <li>Working with Titles and HTML Entities</li>
                        <li>Using Attributes in HTML Elements</li>
                        <li>Adding Images and Hyperlinks with Anchor Tags</li>
                        <li>Creating and Managing Lists in HTML</li>
                        <li>Using the Div Tag for Layouts and Containers</li>
                        <li>Designing Tables in HTML</li>
                        <li>Introduction to HTML Forms</li>
                        <li>Exploring HTML Form Controls</li>
                        <li>Additional Form Elements and Controls</li>
                        <li>HTML5: New Semantic and Structural Elements</li>
                    </ul>
                </div>
            </div>

            <!-- CSS -->
            <div class="accordion-item">
                <button class="accordion-header">CSS</button>
                <div class="accordion-content">
                    <ul>
                        <li>Introduction to CSS: Purpose and Fundamentals</li>
                        <li>Understanding CSS Selectors and Their Types</li>
                        <li>Exploring the CSS Box Model</li>
                        <li>Styling HTML Elements with CSS</li>
                        <li>Advanced Techniques in Cascading Style Sheets</li>
                    </ul>
                </div>
            </div>

            <!-- JavaScript -->
            <div class="accordion-item">
                <button class="accordion-header">JavaScript</button>
                <div class="accordion-content">
                    <ul>
                        <li>Introduction to JavaScript: Overview and Uses</li>
                        <li>Implementing JavaScript in Web Pages</li>
                        <li>JavaScript Variables and Data Types</li>
                        <li>Working with JavaScript Operators</li>
                        <li>Control Flow Statements in JavaScript</li>
                        <li>Arrays: Creation, Manipulation, and Methods</li>
                        <li>Functions in JavaScript</li>
                        <li>Functional Expressions and Arrow Functions</li>
                        <li>String Handling and Manipulation in JavaScript</li>
                        <li>Working with JavaScript Objects</li>
                        <li>Using JavaScript Constructors</li>
                        <li>DOM (Document Object Model) – Understanding the Document Object</li>
                        <li>DOM Elements: Accessing and Manipulating HTML Elements</li>
                        <li>Event Handling in the DOM</li>
                        <li>BOM (Browser Object Model) – Window Object Overview</li>
                        <li>Form Validations and Regular Expressions in JavaScript</li>
                        <li>Introduction to Bootstrap for Responsive Web Design</li>
                    </ul>
                </div>
            </div>

            <!-- Django With Rest API -->
            <div class="accordion-item">
                <button class="accordion-header">Django With Rest API</button>
                <div class="accordion-content">
                    <ul>
                        <li>Introduction to Django: Overview and Key Features</li>
                        <li>Installing Django & Atom, and Developing Your First Web Application</li>
                        <li>Working with Templates and Managing Static Files</li>
                        <li>Understanding Views and URL Routing</li>
                        <li>Models and Database Integration in Django</li>
                        <li>Handling Forms and Validation in Django</li>
                        <li>Advanced Template Features and Techniques</li>
                        <li>Session Management in Django Applications</li>
                        <li>User Authentication and Authorization</li>
                        <li>Class-Based Views (CBVs) and CRUD Operations with CBVs & FBVs</li>
                        <li>Working with Django ORM for Database Queries</li>
                        <li>Advanced Model Concepts and Relationships</li>
                        <li>Introduction to Django REST Framework (DRF) for APIs</li>
                        <li>Testing and Debugging Django Applications</li>
                        <li>Caching Strategies and Performance Optimization</li>
                        <li>Advanced Topics in Django Forms</li>
                        <li>Security Best Practices in Django Applications</li>
                        <li>Django Signals and Asynchronous Task Handling</li>
                        <li>Deployment of Django Projects in Production</li>
                        <li>WebSockets and Real-Time Communication</li>
                        <li>Project Development, Implementation, and Refinement</li>
                    </ul>
                </div>
            </div>

            <!-- Flask -->
            <div class="accordion-item">
                <button class="accordion-header">Flask</button>
                <div class="accordion-content">
                    <ul>
                        <li>Introduction to Flask: Overview and Key Features</li>
                        <li>Developing Web Applications Using Flask</li>
                        <li>Handling Web Forms and Processing User Input</li>
                        <li>Integrating Databases and Managing Data Storage</li>
                        <li>User Authentication and Authorization in Flask</li>
                        <li>Building RESTful APIs with Flask</li>
                        <li>Deployment Strategies and Application Scaling</li>
                        <li>Exploring Advanced Flask Topics and Best Practices</li>
                    </ul>
                </div>
            </div>

            <!-- Database -->
            <div class="accordion-item">
                <button class="accordion-header">Database</button>
                <div class="accordion-content">
                    <ul>
                        <li>MySQL (Relational Database Management System)</li>
                        <li>MongoDB (NoSQL Document Database)</li>
                    </ul>
                </div>
            </div>

            <!-- Tools -->
            <div class="accordion-item">
                <button class="accordion-header">Tools</button>
                <div class="accordion-content">
                    <ul>
                        <li>Fundamentals of AWS (Amazon Web Services)</li>
                        <li>Version Control with Git</li>
                        <li>Introduction to Docker and Containerization</li>
                        <li>Kubernetes for Container Orchestration</li>
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
                            <span>Face-to-face interaction with web development mentors</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check"></i>
                            <span>Instant doubt resolution</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check"></i>
                            <span>Peer coding and group projects</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check"></i>
                            <span>Hands-on lab sessions for real web apps</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check"></i>
                            <span>Better focus & structured practice</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check"></i>
                            <span>Networking opportunities with industry experts</span>
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
                <h2>Who Should Join?</h2>
                <p>Perfect for anyone looking to excel in technology</p>
            </div>
            <div class="audience-grid">
                <div class="audience-card">
                    <div class="audience-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3>Students & Freshers</h3>
                    <p>
                        Build a strong foundation in Python and web technologies to kickstart your career as a web
                        developer.
                    </p>
                    <div class="audience-benefits">
                        <span>Career Foundation </span>
                        <span>Job Readiness </span>
                        <span>Practical Exposure</span>
                    </div>
                </div>
                <div class="audience-card">
                    <div class="audience-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3>Working Professionals</h3>
                    <p>
                        Upgrade your skills, switch to web development, or enhance your tech stack for better opportunities.
                    </p>
                    <div class="audience-benefits">
                        <span>Career Growth </span>
                        <span>Salary Boost </span>
                        <span>Skill Upgrade</span>
                    </div>
                </div>
                <div class="audience-card">
                    <div class="audience-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3>Entrepreneurs</h3>
                    <p>
                        learn to build and deploy scalable web applications for your own business ventures.
                    </p>
                    <div class="audience-benefits">
                        <span>Tech Leadership</span>
                        <span>Business Growth </span>
                        <span>Innovation Edge</span>
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
                        <h3>Dr. Avinash Reddy </h3>
                        <p class="instructor-role">Senior Python & Django Consultant </p>
                        <p class="instructor-bio">
                            15+ Years’ Experience in Full-Stack Web Development.
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
                        <h3>Ashritha Reddy </h3>
                        <p class="instructor-role">Full-Stack Developer & Architect </p>
                        <p class="instructor-bio">
                            Specialized in Django, Flask, ReactJS & REST APIs
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
                        <h3>Mahesh </h3>
                        <p class="instructor-role">Software Engineering Director </p>
                        <p class="instructor-bio">
                            Expert in scalable backend systems & deployment strategies.
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
                        <h3>₹6–10 LPA</h3>
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
                            <h4>Python Web Developer </h4>
                            <p>₹6–12 LPA</p>
                        </div>
                        <div class="role-card">
                            <i class="fas fa-chart-bar"></i>
                            <h4>Django/Flask Developer </h4>
                            <p>₹8–14 LPA</p>
                        </div>
                        <div class="role-card">
                            <i class="fas fa-code"></i>
                            <h4>Full-Stack Developer </h4>
                            <p>₹9–15 LPA</p>
                        </div>
                        <div class="role-card">
                            <i class="fas fa-link"></i>
                            <h4>Backend API Developer </h4>
                            <p>₹7–13 LPA</p>
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
                <p>Success Stories from Our Python Web Development Graduates</p>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <img src="" />
                        <div class="student-info">
                            <h4>Madhu Kumar </h4>
                            <p>Python Developer @ Infosys</p>
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
                        “The practical projects in Django helped me land my first job as a web developer within months.”
                    </p>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <img src="" />
                        <div class="student-info">
                            <h4>Meghana</h4>
                            <p>Full-Stack Developer @ Deloitte</p>
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
                        “Coming from a non-CS background, the structured Python Web Development course gave me
                        industry-ready skills.”
                    </p>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <img src="" />
                        <div class="student-info">
                            <h4>Suresh Naik </h4>
                            <p>Suresh Reddy </p>
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
                        “The real-world projects and mentor guidance made me confident in building scalable web apps.”
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
                        <h3>Do I need prior programming knowledge for Python Web Development?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            No, this course is beginner-friendly and covers basics step by step.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Which frameworks are covered in Python Web Development?
                        </h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            You’ll learn Django, Flask, and other popular web frameworks.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Will I build real projects in Python Web Development?
                        </h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Yes, you’ll work on live web apps and industry-level projects.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Is there placement support after Python Web Development training?
                        </h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Yes, we provide 100% placement assistance with leading companies.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Can working professionals join the Python Web Development course?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Yes, we offer flexible evening and weekend batches for professionals.
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
                    Join thousands of successful students who choose Python Web Development training for
                    accelerated learning
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
                        <i class="fas fa-graduation-cap"></i>
                        ASTI DWC
                    </div>
                    <p>
                        Transforming careers with hands-on Python Web Development training. Build real-world web
                        applications using Django, Flask, and modern tools with guidance from industry-certified mentors in
                        Hyderabad.
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
                            <span>+91 8885501514</span>
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
        <a href="https://wa.me/918885501514" class="whatsapp-float" target="_blank">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('frontend/assets/js/hyderabad-courses-landing-page.js') }}"></script>
@endpush
