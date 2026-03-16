<?php $page = 'ASTI ACADEMY DWC - Global Certifications & Professional Courses'; ?>
@extends('marketplace.layouts.front_layout')
@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/top-courses.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
@endpush
@section('content')
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <div class="logo">
                    <img style="width: 150px" src="/frontend/assets/images/Asti_DWC_Regular Logo.png" alt=" ASTI Academy " />
                </div>
                <button class="mobile-toggle" id="mobileToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    {{-- <li><a href="#why-choose">Why Choose Us</a></li> --}}
                    <li><a href="#programs">Programs</a></li>
                    {{-- <li><a href="#who-should-join">Who Should Join</a></li>
                <li><a href="#careers">Career Opportunities</a></li>
                <li><a href="#success">Success Stories</a></li> --}}
                    <li><a href="#schedule">Schedule</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><button class="btn-primary" id="applyNowBtn">Apply Now</button></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-left">
                    <h1 class="hero-title">
                        Transform Your Career with
                        <span class="highlight">Global Certifications</span>
                    </h1>
                    <p class="hero-description">
                        Join ASTI ACADEMY DWC and unlock your potential with
                        industry-leading courses recognized worldwide. Empower yourself
                        with skills that matter in today's competitive market.
                    </p>
                    <div class="hero-features">
                        <div class="feature-item">
                            <i class="fas fa-certificate"></i>
                            <span>Global Recognition</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-users"></i>
                            <span>Expert Instructors</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-clock"></i>
                            <span>Flexible Learning</span>
                        </div>
                    </div>
                    <div class="hero-buttons">
                        <button class="btn btn-primary"
                            onclick="document.getElementById('enrollForm').scrollIntoView({behavior: 'smooth'})">
                            Enroll Now
                        </button>
                        <button class="btn btn-secondary"
                            onclick="document.getElementById('programs').scrollIntoView({behavior: 'smooth'})">
                            View Programs
                        </button>
                    </div>
                </div>
                <div class="hero-right">
                    <div class="enrollment-form" id="enrollForm">
                        <h3 class="form-title">Start Your Journey Today</h3>
                        <form id="mainEnrollmentForm">
                            <div class="form-group">
                                <label for="fullName">Full Name</label>
                                <input type="text" id="fullName" name="firstname" placeholder="Enter your full name"
                                    required />
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="Enter your email"
                                    required />
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number"
                                    required />
                            </div>

                            <div class="form-group">
                                <label for="whatsapp">WhatsApp Number</label>
                                <input type="tel" id="whatsapp" name="whatsapp_number"
                                    placeholder="Enter your WhatsApp number" required />
                            </div>

                            <div class="form-group">
                                <label for="program">Select Program</label>
                                <select id="program" name="program_select" required>
                                    <option value="">Choose a program</option>
                                    <option value="cyber-security">Cyber Security</option>
                                    <option value="digital-marketing">Digital Marketing</option>
                                    <option value="property-management">Property Management</option>
                                    <option value="business-management">Business Management</option>
                                    <option value="artificial-intelligence">Artificial Intelligence</option>
                                    <option value="accounting-finance">Accounting and Finance</option>
                                    <option value="business-intelligence">
                                        Business Intelligence and Analytics
                                    </option>
                                    <option value="web-development">Web Development</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="collegeName">Coupon Code</label>
                                <input type="text" id="collegeName" name="college_name"
                                    placeholder="Enter your coupon code" required />
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">
                                Submit Enrollment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about" id="about">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">About ASTI ACADEMY DWC</h2>
                <p class="section-subtitle">
                    Empowering Future Leaders Through Excellence in Education
                </p>
            </div>
            <div class="about-content">
                <div class="about-image">
                    <img src="https://images.pexels.com/photos/3184292/pexels-photo-3184292.jpeg?auto=compress&cs=tinysrgb&w=800"
                        alt="About ASTI Academy" />
                    <div class="about-badge">
                        <i class="fas fa-award"></i>
                        <span>Globally Recognized</span>
                    </div>
                </div>
                <div class="about-text">
                    <h3>Your Gateway to Global Success</h3>
                    <p>
                        ASTI ACADEMY DWC is a premier educational institution dedicated to
                        providing world-class training and globally recognized
                        certifications. We bridge the gap between academic knowledge and
                        industry requirements, ensuring our students are equipped with
                        practical skills that employers value.
                    </p>
                    <p>
                        Our comprehensive programs are designed by industry experts and
                        delivered through cutting-edge teaching methodologies. We focus on
                        hands-on learning, real-world projects, and personalized
                        mentorship to ensure every student achieves their career goals.
                    </p>
                    <div class="about-stats">
                        <div class="stat-item">
                            <h4>5000+</h4>
                            <p>Students Trained</p>
                        </div>
                        <div class="stat-item">
                            <h4>8</h4>
                            <p>Premium Programs</p>
                        </div>
                        <div class="stat-item">
                            <h4>95%</h4>
                            <p>Success Rate</p>
                        </div>
                        <div class="stat-item">
                            <h4>50+</h4>
                            <p>Expert Instructors</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="why-choose" id="why-choose">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Why Choose ASTI ACADEMY DWC</h2>
                <p class="section-subtitle">Excellence that Sets Us Apart</p>
            </div>
            <div class="why-choose-grid">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3>Global Recognition</h3>
                    <p>
                        Our certifications are recognized worldwide, opening doors to
                        international career opportunities and enhancing your professional
                        credibility.
                    </p>
                </div>
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3>Expert Instructors</h3>
                    <p>
                        Learn from industry veterans with years of practical experience
                        who bring real-world insights into every lesson.
                    </p>
                </div>
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3>Hands-On Learning</h3>
                    <p>
                        Engage in practical projects and case studies that prepare you for
                        real workplace challenges and scenarios.
                    </p>
                </div>
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <h3>Flexible Schedules</h3>
                    <p>
                        Choose from weekday, weekend, or evening batches that fit
                        seamlessly into your busy lifestyle.
                    </p>
                </div>
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3>Career Support</h3>
                    <p>
                        Benefit from our dedicated career services including resume
                        building, interview preparation, and job placement assistance.
                    </p>
                </div>
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fas fa-infinity"></i>
                    </div>
                    <h3>Lifetime Access</h3>
                    <p>
                        Get unlimited access to course materials, updates, and our alumni
                        network for continuous learning and growth.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= AI In Your Role ================= -->
    <!-- ================= AI-Driven Programs Section ================= -->
    <section class="programs ai-programs" id="programs">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">AI-Driven Professional Certificate Programs</h2>
                <p class="section-subtitle">
                    Each program at <strong>ASTI Academy</strong> is powered by Artificial Intelligence — designed to help
                    you
                    master your field <b>and learn how to apply AI tools effectively in your professional role.</b>
                </p>
            </div>

            <div class="programs-grid">
                <!-- Cyber Security -->
                <div class="program-card">
                    <div class="program-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3>Cyber Security</h3>
                    <p>Learn how AI helps detect, predict, and prevent threats faster with automated security analysis and
                        log monitoring tools.</p>
                </div>

                <!-- Digital Marketing -->
                <div class="program-card">
                    <div class="program-icon"><i class="fas fa-bullhorn"></i></div>
                    <h3>Digital Marketing</h3>
                    <p>Use AI for content generation, ad optimization, and customer insights — boosting campaigns with
                        predictive data analytics.</p>
                </div>

                <!-- Property Management -->
                <div class="program-card">
                    <div class="program-icon"><i class="fas fa-building"></i></div>
                    <h3>Property Management</h3>
                    <p>Automate tenant communication, schedule maintenance, and analyze property performance using
                        AI-powered dashboards.</p>
                </div>

                <!-- Business Management -->
                <div class="program-card">
                    <div class="program-icon"><i class="fas fa-briefcase"></i></div>
                    <h3>Business Management</h3>
                    <p>Leverage AI for decision-making, team analytics, and business forecasting to enhance strategic
                        operations and leadership.</p>
                </div>

                <!-- Artificial Intelligence -->
                <div class="program-card">
                    <div class="program-icon"><i class="fas fa-brain"></i></div>
                    <h3>Artificial Intelligence</h3>
                    <p>Master prompt engineering, machine learning basics, and the integration of AI in real-world workflows
                        and automations.</p>
                </div>

                <!-- Accounting and Finance -->
                <div class="program-card">
                    <div class="program-icon"><i class="fas fa-calculator"></i></div>
                    <h3>Accounting & Finance</h3>
                    <p>Automate financial reporting, identify data anomalies, and streamline budgeting through AI-powered
                        insights and tools.</p>
                </div>

                <!-- Business Intelligence and Analytics -->
                <div class="program-card">
                    <div class="program-icon"><i class="fas fa-chart-bar"></i></div>
                    <h3>Business Intelligence & Analytics</h3>
                    <p>Transform raw data into insights with AI visualization tools, predictive analytics, and automated
                        reporting dashboards.</p>
                </div>

                <!-- Web Development -->
                <div class="program-card">
                    <div class="program-icon"><i class="fas fa-code"></i></div>
                    <h3>Web Development</h3>
                    <p>Build smarter applications with AI coding assistants, code generators, and intelligent design &
                        testing automation tools.</p>
                </div>
            </div>

            <div class="ai-note">
                <i class="fas fa-robot"></i>
                <p><strong>AI in Every Program:</strong> At ASTI Academy, we don’t just teach concepts — we teach you how to
                    apply AI in your daily work, no matter your career path.</p>
            </div>
        </div>
    </section>


    <section class="programs" id="programs">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Our Premium Programs</h2>
                <p class="section-subtitle">Choose Your Path to Success</p>
            </div>
            <div class="programs-grid">
                <div class="program-card" data-program="cyber-security">
                    <div class="program-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Cyber Security</h3>
                    <p>
                        Master the art of protecting digital assets and become a certified
                        cybersecurity professional.
                    </p>
                    <ul class="program-features">
                        <li><i class="fas fa-check"></i> Ethical Hacking</li>
                        <li><i class="fas fa-check"></i> Network Security</li>
                        <li><i class="fas fa-check"></i> Threat Analysis</li>
                    </ul>
                    <button class="btn btn-outline" onclick="enrollInProgram('Cyber Security')">
                        Learn More
                    </button>
                </div>
                <div class="program-card" data-program="digital-marketing">
                    <div class="program-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h3>Digital Marketing</h3>
                    <p>
                        Become a digital marketing expert and drive business growth
                        through strategic online campaigns.
                    </p>
                    <ul class="program-features">
                        <li><i class="fas fa-check"></i> SEO & SEM</li>
                        <li><i class="fas fa-check"></i> Social Media Marketing</li>
                        <li><i class="fas fa-check"></i> Content Strategy</li>
                    </ul>
                    <button class="btn btn-outline" onclick="enrollInProgram('Digital Marketing')">
                        Learn More
                    </button>
                </div>
                <div class="program-card" data-program="property-management">
                    <div class="program-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3>Property Management</h3>
                    <p>
                        Excel in real estate management with comprehensive training in
                        property operations and tenant relations.
                    </p>
                    <ul class="program-features">
                        <li><i class="fas fa-check"></i> Real Estate Operations</li>
                        <li><i class="fas fa-check"></i> Tenant Management</li>
                        <li><i class="fas fa-check"></i> Financial Planning</li>
                    </ul>
                    <button class="btn btn-outline" onclick="enrollInProgram('Property Management')">
                        Learn More
                    </button>
                </div>
                <div class="program-card" data-program="business-management">
                    <div class="program-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Business Management</h3>
                    <p>
                        Develop essential leadership and management skills to lead
                        organizations successfully.
                    </p>
                    <ul class="program-features">
                        <li><i class="fas fa-check"></i> Strategic Planning</li>
                        <li><i class="fas fa-check"></i> Operations Management</li>
                        <li><i class="fas fa-check"></i> Leadership Skills</li>
                    </ul>
                    <button class="btn btn-outline" onclick="enrollInProgram('Business Management')">
                        Learn More
                    </button>
                </div>
                <div class="program-card" data-program="artificial-intelligence">
                    <div class="program-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h3>Artificial Intelligence</h3>
                    <p>
                        Dive into the future with AI and machine learning technologies
                        that are reshaping industries.
                    </p>
                    <ul class="program-features">
                        <li><i class="fas fa-check"></i> Machine Learning</li>
                        <li><i class="fas fa-check"></i> Neural Networks</li>
                        <li><i class="fas fa-check"></i> AI Applications</li>
                    </ul>
                    <button class="btn btn-outline" onclick="enrollInProgram('Artificial Intelligence')">
                        Learn More
                    </button>
                </div>
                <div class="program-card" data-program="accounting-finance">
                    <div class="program-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h3>Accounting & Finance</h3>
                    <p>
                        Master financial management and accounting principles for a
                        successful career in finance.
                    </p>
                    <ul class="program-features">
                        <li><i class="fas fa-check"></i> Financial Analysis</li>
                        <li><i class="fas fa-check"></i> Tax Management</li>
                        <li><i class="fas fa-check"></i> Auditing</li>
                    </ul>
                    <button class="btn btn-outline" onclick="enrollInProgram('Accounting and Finance')">
                        Learn More
                    </button>
                </div>
                <div class="program-card" data-program="business-intelligence">
                    <div class="program-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3>Business Intelligence & Analytics</h3>
                    <p>
                        Transform data into actionable insights and drive strategic
                        business decisions.
                    </p>
                    <ul class="program-features">
                        <li><i class="fas fa-check"></i> Data Visualization</li>
                        <li><i class="fas fa-check"></i> Predictive Analytics</li>
                        <li><i class="fas fa-check"></i> Business Reporting</li>
                    </ul>
                    <button class="btn btn-outline" onclick="enrollInProgram('Business Intelligence and Analytics')">
                        Learn More
                    </button>
                </div>
                <div class="program-card" data-program="web-development">
                    <div class="program-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3>Web Development</h3>
                    <p>
                        Build modern, responsive websites and applications with
                        cutting-edge web technologies.
                    </p>
                    <ul class="program-features">
                        <li><i class="fas fa-check"></i> Front-end Development</li>
                        <li><i class="fas fa-check"></i> Back-end Systems</li>
                        <li><i class="fas fa-check"></i> Full Stack Skills</li>
                    </ul>
                    <button class="btn btn-outline" onclick="enrollInProgram('Web Development')">
                        Learn More
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="program-specs" id="program-specs">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Program Specifications</h2>
                <p class="section-subtitle">What You'll Get From Our Programs</p>
            </div>
            <div class="specs-grid">
                <div class="spec-card">
                    <div class="spec-number">01</div>
                    <h3>Duration</h3>
                    <p>
                        Comprehensive programs ranging from 3 to 6 months, designed to fit
                        your schedule while ensuring thorough learning.
                    </p>
                </div>
                <div class="spec-card">
                    <div class="spec-number">02</div>
                    <h3>Certification</h3>
                    <p>
                        Globally recognized certificates upon completion, accredited by
                        international bodies and valued by employers worldwide.
                    </p>
                </div>
                <div class="spec-card">
                    <div class="spec-number">03</div>
                    <h3>Learning Mode</h3>
                    <p>
                        Flexible online and offline classes with live sessions, recorded
                        lectures, and interactive workshops.
                    </p>
                </div>
                <div class="spec-card">
                    <div class="spec-number">04</div>
                    <h3>Projects</h3>
                    <p>
                        Hands-on capstone projects and real-world case studies to build
                        your portfolio and practical experience.
                    </p>
                </div>
                <div class="spec-card">
                    <div class="spec-number">05</div>
                    <h3>Support</h3>
                    <p>
                        24/7 technical support, dedicated mentors, and active student
                        community for continuous assistance.
                    </p>
                </div>
                <div class="spec-card">
                    <div class="spec-number">06</div>
                    <h3>Resources</h3>
                    <p>
                        Access to premium learning materials, industry tools, software
                        licenses, and exclusive webinars.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="learning-options" id="learning-options">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Flexible Learning – Online, Offline and Hybrid Options</h2>
                <p class="section-subtitle">
                    We provide our courses through Online, Offline, and Hybrid modes — choose the one that best fits your
                    lifestyle.
                </p>
            </div>

            <div class="learning-grid">
                <!-- Online Learning -->
                <div class="learning-card">
                    <div class="learning-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3>Online Learning</h3>
                    <ul>
                        <li>Attend live interactive classes from anywhere</li>
                        <li>Access recorded sessions anytime</li>
                        <li>24/7 support and learning materials</li>
                    </ul>
                </div>

                <!-- Offline Learning -->
                <div class="learning-card">
                    <div class="learning-icon">
                        <i class="fas fa-school"></i>
                    </div>
                    <h3>Offline Learning</h3>
                    <ul>
                        <li>Experience in-person mentorship and labs</li>
                        <li>Hands-on training at our campus</li>
                        <li>Collaborate directly with peers and instructors</li>
                    </ul>
                </div>

                <!-- Hybrid Learning -->
                <div class="learning-card">
                    <div class="learning-icon">
                        <i class="fas fa-people-arrows"></i>
                    </div>
                    <h3>Hybrid Learning</h3>
                    <ul>
                        <li>Enjoy the best of both online and offline flexibility</li>
                        <li>Alternate between virtual and classroom sessions</li>
                        <li>Personalized learning path to suit your schedule</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <section class="who-should-join" id="who-should-join">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Who Should Join</h2>
                <p class="section-subtitle">
                    Perfect For Ambitious Professionals at Any Stage
                </p>
            </div>
            <div class="join-grid">
                <div class="join-card">
                    <i class="fas fa-user-graduate"></i>
                    <h3>Fresh Graduates</h3>
                    <p>
                        Launch your career with industry-relevant skills and
                        certifications that make you stand out to employers.
                    </p>
                </div>
                <div class="join-card">
                    <i class="fas fa-user-tie"></i>
                    <h3>Working Professionals</h3>
                    <p>
                        Upskill and advance your career with specialized knowledge in your
                        field or transition to a new domain.
                    </p>
                </div>
                <div class="join-card">
                    <i class="fas fa-exchange-alt"></i>
                    <h3>Career Switchers</h3>
                    <p>
                        Make a successful career transition with comprehensive training
                        designed for professionals changing fields.
                    </p>
                </div>
                <div class="join-card">
                    <i class="fas fa-rocket"></i>
                    <h3>Entrepreneurs</h3>
                    <p>
                        Gain essential business and technical skills to start, manage, and
                        grow your own successful venture.
                    </p>
                </div>
                <div class="join-card">
                    <i class="fas fa-users"></i>
                    <h3>Team Leaders</h3>
                    <p>
                        Enhance your leadership capabilities and technical expertise to
                        manage teams more effectively.
                    </p>
                </div>
                <div class="join-card">
                    <i class="fas fa-globe-asia"></i>
                    <h3>International Students</h3>
                    <p>
                        Access globally recognized programs that open doors to
                        opportunities in any country around the world.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="careers" id="careers">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Career Opportunities</h2>
                <p class="section-subtitle">
                    Unlock Endless Possibilities After Graduation
                </p>
            </div>
            <div class="careers-content">
                {{-- <div class="careers-image">
                <img src="https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg?auto=compress&cs=tinysrgb&w=800"
                    alt="Career Opportunities" />
            </div> --}}
                <div class="careers-list">
                    <div class="career-item">
                        <div class="career-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="career-info">
                            <h3>Job Placement Assistance</h3>
                            <p>
                                Connect with our network of 200+ hiring partners across
                                various industries for guaranteed interview opportunities.
                            </p>
                        </div>
                    </div>
                    <div class="career-item">
                        <div class="career-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <div class="career-info">
                            <h3>Industry Connections</h3>
                            <p>
                                Network with industry leaders, attend exclusive hiring events,
                                and join our active alumni community.
                            </p>
                        </div>
                    </div>
                    <div class="career-item">
                        <div class="career-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="career-info">
                            <h3>Interview Preparation</h3>
                            <p>
                                Get personalized coaching, mock interviews, and feedback to
                                ace your dream job interviews.
                            </p>
                        </div>
                    </div>
                    <div class="career-item">
                        <div class="career-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="career-info">
                            <h3>Resume Building</h3>
                            <p>
                                Professional resume and portfolio creation services to
                                showcase your skills effectively.
                            </p>
                        </div>
                    </div>
                    <div class="career-item">
                        <div class="career-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="career-info">
                            <h3>Competitive Salaries</h3>
                            <p>
                                Our graduates secure positions with average salary increases
                                of 40-60% in their new roles.
                            </p>
                        </div>
                    </div>
                    <div class="career-item">
                        <div class="career-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="career-info">
                            <h3>Career Growth</h3>
                            <p>
                                Continuous support and advanced courses to help you climb the
                                career ladder faster.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="success-stories" id="success">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Success Stories</h2>
                <p class="section-subtitle">Hear From Our Accomplished Graduates</p>
            </div>
            <div class="testimonials-slider">
                <div class="testimonial-track" id="testimonialTrack">
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&w=200"
                                alt="Student" />
                            <div class="testimonial-info">
                                <h4>Sarah Johnson</h4>
                                <p>Cyber Security Graduate</p>
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
                            "ASTI Academy transformed my career! The Cyber Security program
                            gave me practical skills and the confidence to secure a role at
                            a leading tech firm. The instructors were phenomenal and the
                            support was incredible."
                        </p>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="https://images.pexels.com/photos/1222271/pexels-photo-1222271.jpeg?auto=compress&cs=tinysrgb&w=200"
                                alt="Student" />
                            <div class="testimonial-info">
                                <h4>Michael Chen</h4>
                                <p>Digital Marketing Graduate</p>
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
                            "The Digital Marketing course exceeded my expectations. Within 3
                            months of graduation, I started my own agency. The real-world
                            projects and mentorship made all the difference."
                        </p>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="https://images.pexels.com/photos/733872/pexels-photo-733872.jpeg?auto=compress&cs=tinysrgb&w=200"
                                alt="Student" />
                            <div class="testimonial-info">
                                <h4>Priya Sharma</h4>
                                <p>AI Graduate</p>
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
                            "The AI program at ASTI Academy is world-class. I went from zero
                            coding knowledge to building machine learning models. Now I'm
                            working as an AI Engineer at a Fortune 500 company!"
                        </p>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="https://images.pexels.com/photos/1516680/pexels-photo-1516680.jpeg?auto=compress&cs=tinysrgb&w=200"
                                alt="Student" />
                            <div class="testimonial-info">
                                <h4>David Martinez</h4>
                                <p>Web Development Graduate</p>
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
                            "Best investment I ever made! The Web Development program was
                            comprehensive and practical. I landed a job before even
                            completing the course. Thank you ASTI Academy!"
                        </p>
                    </div>
                </div>
                <button class="slider-btn prev" id="prevBtn">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="slider-btn next" id="nextBtn">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    <section class="schedule" id="schedule">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Class Schedule</h2>
                <p class="section-subtitle">
                    Flexible Timings to Suit Your Lifestyle
                </p>
            </div>
            <div class="schedule-grid">
                <div class="schedule-card">
                    <div class="schedule-icon">
                        <i class="fas fa-sun"></i>
                    </div>
                    <h3>Weekday Morning</h3>
                    <p class="schedule-time">9:00 AM - 12:00 PM</p>
                    <p>Monday to Friday</p>
                    <ul class="schedule-features">
                        <li><i class="fas fa-check"></i> Perfect for early risers</li>
                        <li><i class="fas fa-check"></i> Interactive live sessions</li>
                        <li><i class="fas fa-check"></i> Afternoon free for practice</li>
                    </ul>
                </div>
                <div class="schedule-card featured">
                    <div class="popular-badge">Most Popular</div>
                    <div class="schedule-icon">
                        <i class="fas fa-moon"></i>
                    </div>
                    <h3>Weekday Evening</h3>
                    <p class="schedule-time">6:00 PM - 9:00 PM</p>
                    <p>Monday to Friday</p>
                    <ul class="schedule-features">
                        <li>
                            <i class="fas fa-check"></i> Ideal for working professionals
                        </li>
                        <li><i class="fas fa-check"></i> After-work convenience</li>
                        <li><i class="fas fa-check"></i> Dedicated mentor support</li>
                    </ul>
                </div>
                <div class="schedule-card">
                    <div class="schedule-icon">
                        <i class="fas fa-calendar-week"></i>
                    </div>
                    <h3>Weekend Batch</h3>
                    <p class="schedule-time">10:00 AM - 4:00 PM</p>
                    <p>Saturday & Sunday</p>
                    <ul class="schedule-features">
                        <li><i class="fas fa-check"></i> Full-day immersive learning</li>
                        <li><i class="fas fa-check"></i> Weekdays completely free</li>
                        <li><i class="fas fa-check"></i> Extended practice sessions</li>
                    </ul>
                </div>
            </div>
            <div class="schedule-note">
                <i class="fas fa-info-circle"></i>
                <p>
                    All batches include recorded. Special
                    one-on-one sessions available upon request.
                </p>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Get In Touch</h2>
                <p class="section-subtitle">We're Here to Answer Your Questions</p>
            </div>
            <div class="contact-content">
                <div class="contact-info">
                    <h3>Contact Information</h3>
                    <p>
                        Reach out to us through any of the following channels. Our team is
                        ready to assist you!
                    </p>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Visit Us</h4>
                            <p>17-1-16/A, 6th-Floor Pinnacle Towers, <br>
                                Santosh Nagar, Saidabad, Hyderabad- 500059</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Call Us</h4>
                            <p>+91 8885514426<br />Mon-Fri: 10AM - 7PM</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Email Us</h4>
                            <p>enquire@astidubai.ac.ae</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="contact-details">
                            <h4>WhatsApp</h4>
                            <p>+91 8885514426<br /> Quick Response</p>
                        </div>
                    </div>
                    <div class="social-links">
                        <a href="https://www.facebook.com/astionlineuae" class="social-icon"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="https://x.com/Astidwc" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/company/astiacademyonline/posts/" class="social-icon"><i
                                class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.instagram.com/astiacademydwc/" class="social-icon"><i
                                class="fab fa-instagram"></i></a>
                        {{-- <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a> --}}
                    </div>
                </div>
                <div class="contact-form-wrapper">
                    <h3>Send Us a Message</h3>
                    <form class="contact-form" id="contactForm" action="https://api.web3forms.com/submit"
                        method="POST">
                        <input type="hidden" name="access_key" value="227f4ea0-71b3-4cc4-987d-efa2b7fa3718" />
                        <input type="hidden" name="from_name" value="ASTI Website Contact Form" />

                        <div class="form-row">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Your Name" required />
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Your Email" required />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <input type="tel" name="phone" placeholder="Phone Number" required />
                            </div>
                            <div class="form-group">
                                <select name="subject" required>
                                    <option value="">Select Subject</option>
                                    <option value="admission">Admission Inquiry</option>
                                    <option value="programs">Program Details</option>
                                    <option value="schedule">Schedule Information</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                        <p id="formResponse" style="margin-top:10px; font-weight:500;"></p>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <i class="fas fa-graduation-cap"></i>
                        <span>ASTI ACADEMY DWC</span>
                    </div>
                    <p>
                        Empowering professionals with globally recognized certifications
                        and industry-relevant skills for a successful career.
                    </p>
                    <div class="footer-social">
                        <a href="https://www.facebook.com/astionlineuae"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://x.com/Astidwc"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/company/astiacademyonline/posts/"><i
                                class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.instagram.com/astiacademydwc/"><i class="fab fa-instagram"></i></a>
                        {{-- <a href="#"><i class="fab fa-youtube"></i></a> --}}
                    </div>
                </div>
                {{-- <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#programs">Our Programs</a></li>
                    <li><a href="#why-choose">Why Choose Us</a></li>
                    <li><a href="#careers">Career Support</a></li>
                    <li><a href="#success">Success Stories</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Programs</h3>
                <ul class="footer-links">
                    <li><a href="#programs">Cyber Security</a></li>
                    <li><a href="#programs">Digital Marketing</a></li>
                    <li><a href="#programs">Artificial Intelligence</a></li>
                    <li><a href="#programs">Web Development</a></li>
                    <li><a href="#programs">Business Management</a></li>
                </ul>
            </div> --}}
                <div class="footer-section">
                    <h3>Contact Info</h3>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-map-marker-alt"></i> 17-1-16/A, 6th-Floor Pinnacle Towers,
                            Santosh Nagar, Saidabad, Hyderabad- 500059
                        </li>
                        <li><i class="fas fa-phone"></i> +91 8885514426</li>
                        <li><i class="fas fa-envelope"></i> enquire@astidubai.ac.ae</li>
                        <li><i class="fab fa-whatsapp"></i> +91 8885514426</li>
                    </ul>
                </div>
            </div>
            {{-- <div class="footer-bottom">
            <p>&copy; 2025 ASTI ACADEMY DWC. All Rights Reserved.</p>
            <div class="footer-bottom-links">
                <a href="#">Privacy Policy</a>
                <span>|</span>
                <a href="#">Terms & Conditions</a>
                <span>|</span>
                <a href="#">Refund Policy</a>
            </div>
        </div> --}}
        </div>
    </footer>

    <!-- ================= Limited Time Offer Popup ================= -->
    <div class="offer-popup" id="offerPopup">
        <div class="offer-content">
            <button class="offer-close" id="offerClose">&times;</button>
            <div class="offer-body">
                <h2><span>🔥 Flat 50% OFF</span> on All Courses!</h2>
                <p>Hurry up! This limited-time offer expires soon. <br> Learn AI-Driven Skills and Get Certified Today.</p>
                <a href="#mainEnrollmentForm" class="offer-btn">Enroll Now</a>
            </div>
        </div>
    </div>


    <button class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </button>
@endsection
@push('scripts')
    <script src="{{ asset('frontend/assets/js/top-courses.js') }}"></script>
    <!-- HubSpot Tracking Code for ASTI DWC -->
    <script type="text/javascript" id="hs-script-loader" async defer src="//js-na1.hs-scripts.com/243954796.js"></script>
@endpush
