<?php $page = 'Advancing Careers Through Professional Development | Know More About Us'; ?>
@extends('frontend.layouts.front_layout')
@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/hyderabad-landing-page.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
@endpush
@section('content')
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <h2>ASTI DWC</h2>
            </div>
            <ul class="nav-menu">
                <li><a href="#home">Home</a></li>
                <li><a href="#courses">Courses</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-background"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-left">
                    <h1 class="hero-title">
                        Advance Your Career with Industry-Focused Offline Training in Hyderabad
                    </h1>
                    <p class="hero-subtitle">
                        Experience immersive, classroom-based learning in Artificial Intelligence, Oracle Financials, Data
                        Analytics, and Block chain — designed and delivered by experts at ASTI DWC to equip you with
                        in-demand skills.
                    </p>
                    <div class="hero-stats">
                        <div class="stat">
                            <h3>5000+</h3>
                            <p>Students Trained</p>
                        </div>
                        <div class="stat">
                            <h3>95%</h3>
                            <p>Job Placement</p>
                        </div>
                        <div class="stat">
                            <h3>4.8★</h3>
                            <p>Rating</p>
                        </div>
                    </div>
                </div>
                <div class="hero-right">
                    <form class="hero-form" id="applicationForm">
                        <h3>Apply Now</h3>
                        <div class="form-group">
                            <input type="text" id="name" name="name" required />
                            <label for="name">Full Name</label>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" required />
                            <label for="email">Email Address</label>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <select id="countryCode" name="countryCode" required>
                                    <option value=""></option>
                                    <option value="+91">+91 (India)</option>

                                </select>
                                <label for="countryCode">Country Code</label>
                            </div>
                            <div class="form-group">
                                <input type="tel" id="phone" name="phone" required />
                                <label for="phone">Phone Number</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="tel" id="whatsapp" name="whatsapp" required />
                            <label for="whatsapp">WhatsApp Number</label>
                        </div>
                        <div class="form-group">
                            <select id="program" name="program" required>
                                <option value=""></option>
                                <option value="ai">Artificial Intelligence</option>
                                <option value="python">Oracle Financials</option>
                                <option value="data-analytics">Data Analytics</option>
                                <option value="blockchain">Blockchain Technology</option>
                            </select>
                            <label for="program">Program of Interest</label>
                        </div>
                        {{-- <div class="form-group">
                            <select id="country" name="country" required>
                                <option value=""></option>
                                <option value="india">India</option>
                                
                            </select>
                            <label for="country">Country</label>
                        </div> --}}
                        <button type="submit" class="btn-primary">
                            Submit Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="section-header">
                <h2>About ASTI DWC</h2>
                <p>Your trusted partner in technology education</p>
            </div>
            <div class="about-content">
                <div class="about-text">
                    <h3>Leading Offline Training in Hyderabad</h3>
                    <p>
                        ASTI DWC has been a global leader in technology education, delivering industry-relevant training to
                        thousands of learners worldwide. Recognizing the growing demand for face-to-face learning, we are
                        now extending our expertise to Hyderabad, bringing world-class offline training closer to you.
                    </p>
                    <p>
                        Our Hyderabad training centre blends the strengths of traditional classroom learning with modern,
                        cutting-edge technology infrastructure. Students benefit from expert mentorship, peer-to-peer
                        collaboration, and practical, hands-on training that prepares them for real-world challenges.
                    </p>
                    <div class="trust-indicators">
                        <div class="trust-item">
                            <i class="fas fa-award"></i>
                            <span>KHDA & TVET Recognised</span>
                        </div>
                        <div class="trust-item">
                            <i class="fas fa-users"></i>
                            <span>30+ Years of Training Excellence</span>
                        </div>
                        <div class="trust-item">
                            <i class="fas fa-handshake"></i>
                            <span>Strong Industry Collaborations</span>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=500"
                        alt="Modern Training Center" />
                </div>
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section id="courses" class="courses">
        <div class="container">
            <div class="section-header">
                <h2>Skill Development Courses in Hyderabad</h2>
                <p>Industry-recognized offline training for future-ready professionals.</p>
            </div>
            <div class="courses-grid">
                <div class="course-card" data-course="ai">
                    <div class="course-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3>Artificial Intelligence </h3>
                    <p>
                        Master AI concepts, machine learning models, and real-world projects with Python, Tensor Flow, and
                        advanced algorithms — tailored for Hyderabad’s growing tech industry.
                    </p>
                    <div class="course-duration">
                        <i class="fas fa-clock"></i>
                        <span>3 Months</span>
                    </div>
                    <button class="btn-secondary">Learn More</button>
                </div>
                <div class="course-card" data-course="python">
                    <div class="course-icon">
                        <i class="fab fa-python"></i>
                    </div>
                    <h3>Oracle Financials </h3>
                    <p>
                        Gain comprehensive training in Oracle Financials, covering modules such as General Ledger, Accounts
                        Payable, Accounts Receivable, Cash Management, and Financial Reporting. Hands-on practice with real
                        Hyderabad business scenarios and ERP applications.
                    </p>
                    <div class="course-duration">
                        <i class="fas fa-clock"></i>
                        <span>3 Months</span>
                    </div>
                    <button class="btn-secondary">Learn More</button>
                </div>
                <div class="course-card" data-course="data-analytics">
                    <div class="course-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Data Analytics </h3>
                    <p>
                        Gain expertise in data visualization, SQL, Excel, Python libraries, and Power BI. Work with live
                        datasets to develop analytics skills in line with Hyderabad’s data-driven job market.
                    </p>
                    <div class="course-duration">
                        <i class="fas fa-clock"></i>
                        <span>3 Months</span>
                    </div>
                    <button class="btn-secondary">Learn More</button>
                </div>
                <div class="course-card" data-course="blockchain">
                    <div class="course-icon">
                        <i class="fas fa-link"></i>
                    </div>
                    <h3>Block chain Technology </h3>
                    <p>
                        Learn block chain fundamentals, distributed ledger systems, Ethereum, Web3, smart contracts, and
                        crypto currency basics — shaping careers in Hyderabad’s emerging fintech ecosystem.
                    </p>
                    <div class="course-duration">
                        <i class="fas fa-clock"></i>
                        <span>3 Months</span>
                    </div>
                    <button class="btn-secondary">Learn More</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Offline Section -->
    <section class="why-offline">
        <div class="container">
            <div class="section-header">
                <h2>Why Choose Offline Training at ASTI Hyderabad?

                </h2>
                <p>Experience the power of in-person learning in India’s thriving tech hub</p>
            </div>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Peer-to-Peer Interaction</h3>
                    <p>
                        Engage in collaborative learning with classmates, exchange ideas, and build strong professional
                        networks in a dynamic classroom setting.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3>Hands-on Labs & Projects</h3>
                    <p>
                        Access advanced labs and work on real-world projects under the guidance of experienced mentors for
                        practical, industry-ready skills.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3>Direct Mentor Guidance</h3>
                    <p>
                        Benefit from immediate doubt clarification, personalized attention, and one-on-one mentorship to
                        accelerate your learning journey.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h3>Industry Networking</h3>
                    <p>
                        Expand your professional circle by connecting with Hyderabad’s tech leaders, industry experts, and
                        guest speakers through regular networking events.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>Hyderabad-Based Center</h3>
                    <p>
                        CConveniently located in the city’s thriving technology hub, our center is easily accessible for
                        both students and working professionals.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-focus"></i>
                    </div>
                    <h3>Distraction-Free Learning</h3>
                    <p>
                        Learn in a structured, focused classroom environment that encourages discipline, concentration, and
                        long-term knowledge retention.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Classroom Experience Section -->
    <section class="classroom-experience">
        <div class="container">
            <div class="section-header">
                <h2>Classroom Excellence</h2>
                <p>Modern, well-equipped spaces built to inspire focus and collaboration.</p>
            </div>
            <div class="experience-gallery">
                <div class="gallery-item">
                    <img src="https://images.pexels.com/photos/3184360/pexels-photo-3184360.jpeg?auto=compress&cs=tinysrgb&w=600"
                        alt="Modern Classroom" />
                    <div class="gallery-overlay">
                        <h3>Modern Classrooms</h3>
                        <p>Air-conditioned, well-lit spaces with latest technology</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg?auto=compress&cs=tinysrgb&w=600"
                        alt="Hands-on Training" />
                    <div class="gallery-overlay">
                        <h3>Hands-on Training</h3>
                        <p>Direct guidance from experienced instructors</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="https://images.pexels.com/photos/3184292/pexels-photo-3184292.jpeg?auto=compress&cs=tinysrgb&w=600"
                        alt="Group Learning" />
                    <div class="gallery-overlay">
                        <h3>Collaborative Learning</h3>
                        <p>Team projects and peer-to-peer interaction</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="https://images.pexels.com/photos/3184639/pexels-photo-3184639.jpeg?auto=compress&cs=tinysrgb&w=600"
                        alt="Computer Lab" />
                    <div class="gallery-overlay">
                        <h3>Advanced Labs</h3>
                        <p>High-performance computers and latest software</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Career Outcomes Section -->
    <section class="career-outcomes">
        <div class="container">
            <div class="section-header">
                <h2>Career Outcomes</h2>
                <p>Your pathway to success in Hyderabad’s thriving tech industry</p>
            </div>
            <div class="outcomes-content">
                <div class="outcomes-stats">
                    <div class="stat-card">
                        <h3>30%</h3>
                        <p>Growth in AI jobs in India last year</p>
                    </div>
                    <div class="stat-card">
                        <h3>₹8.5L</h3>
                        <p>Average salary for Oracel Developers</p>
                    </div>
                    <div class="stat-card">
                        <h3>45%</h3>
                        <p>Increase in Data Analytics roles</p>
                    </div>
                    <div class="stat-card">
                        <h3>₹12L</h3>
                        <p>Average blockchain developer salary</p>
                    </div>
                </div>
                <div class="industry-sectors">
                    <div class="sector">
                        <h4><i class="fas fa-brain"></i>Artificial Intelligence</h4>
                        <p>Applications in IT services, healthcare, finance, and e-commerce with strong hiring demand in
                            Hyderabad’s tech corridor.</p>
                    </div>
                    <div class="sector">
                        <h4><i class="fab fa-python"></i>Oracle Financials</h4>
                        <p>
                            ERP implementation, accounting systems, and business process management roles with top MNCs
                            based in Hyderabad.
                        </p>
                    </div>
                    <div class="sector">
                        <h4><i class="fas fa-chart-line"></i>Data Analytics</h4>
                        <p>
                            Opportunities in consulting, retail, banking, marketing, and business intelligence within local
                            and global firms.
                        </p>
                    </div>
                    <div class="sector">
                        <h4><i class="fas fa-link"></i>Block chain</h4>
                        <p>Growing opportunities in fintech, banking, supply chain, and start-ups in Hyderabad’s innovation
                            ecosystem.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Faculty Section -->
    <section class="faculty">
        <div class="container">
            <div class="section-header">
                <h2>Meet Our Expert Faculty</h2>
                <p>Learn from industry leaders with global expertise</p>
            </div>
            <div class="faculty-grid">
                <div class="faculty-card">
                    <div class="faculty-image">
                        <img src="https://images.pexels.com/photos/2381069/pexels-photo-2381069.jpeg?auto=compress&cs=tinysrgb&w=300"
                            alt="Dr. Rajesh Kumar" />
                    </div>
                    <div class="faculty-info">
                        <h3>Dr. Rajesh Kumar</h3>
                        <p class="faculty-title">Senior AI & ML Instructor</p>
                        <p>
                            15+ years at Google, Microsoft. PhD in Computer Science. Expert
                            in deep learning, neural networks, and AI applications.
                        </p>
                        <div class="faculty-skills">
                            <span>AI/ML</span>
                            <span>Python</span>
                            <span>TensorFlow</span>
                        </div>
                    </div>
                </div>
                <div class="faculty-card">
                    <div class="faculty-image">
                        <img src="https://images.pexels.com/photos/3184338/pexels-photo-3184338.jpeg?auto=compress&cs=tinysrgb&w=300"
                            alt="Priya Sharma" />
                    </div>
                    <div class="faculty-info">
                        <h3>Priya Sharma</h3>
                        <p class="faculty-title">Data Analytics Lead</p>
                        <p>
                            12+ years at Amazon, Flipkart. Masters in Statistics.
                            Specializes in big data analytics, business intelligence, and
                            data visualization.
                        </p>
                        <div class="faculty-skills">
                            <span>Data Analytics</span>
                            <span>SQL</span>
                            <span>Power BI</span>
                        </div>
                    </div>
                </div>
                <div class="faculty-card">
                    <div class="faculty-image">
                        <img src="https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&w=300"
                            alt="Arjun Patel" />
                    </div>
                    <div class="faculty-info">
                        <h3>Arjun Patel</h3>
                        <p class="faculty-title">Blockchain Architect</p>
                        <p>
                            10+ years in blockchain development. Former lead at Binance,
                            Coinbase. Expert in smart contracts, DeFi, and Web3
                            technologies.
                        </p>
                        <div class="faculty-skills">
                            <span>Blockchain</span>
                            <span>Solidity</span>
                            <span>Web3</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2>What Our Students Say</h2>
                <p>Success stories from ASTI Hyderabad graduates</p>
            </div>
            <div class="testimonials-slider">
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <p>
                            “ASTI Hyderabad’s offline Python training completely transformed my career. The hands-on
                            learning and mentor support helped me secure a developer role at a leading IT company.”
                        </p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://images.pexels.com/photos/2182970/pexels-photo-2182970.jpeg?auto=compress&cs=tinysrgb&w=150"
                            alt="Ankit Sharma" />
                        <div class="author-info">
                            <h4>Ankit Sharma </h4>
                            <p>Python Developer at TCS</p>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <p>
                            “The Data Analytics course at ASTI Hyderabad gave me practical, job-ready skills. The offline
                            format created great opportunities for networking and collaborative learning.”
                        </p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://images.pexels.com/photos/3184339/pexels-photo-3184339.jpeg?auto=compress&cs=tinysrgb&w=150"
                            alt="Sneha Reddy" />
                        <div class="author-info">
                            <h4>Sneha Reddy </h4>
                            <p>Data Analyst at Deloitte</p>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <p>
                            “The AI course was comprehensive and easy to follow, thanks to the expert faculty. The offline
                            training environment made complex concepts simple, and now I’m working in ML at a top startup!”
                        </p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://images.pexels.com/photos/2379005/pexels-photo-2379005.jpeg?auto=compress&cs=tinysrgb&w=150"
                            alt="Vikram Singh" />
                        <div class="author-info">
                            <h4>Vikram Singh </h4>
                            <p>ML Engineer at Zomato</p>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Comparison Table -->
    <section class="comparison">
        <div class="container">
            <div class="section-header">
                <h2>Offline vs Online Training</h2>
                <p>Why offline training gives you the edge</p>
            </div>
            <div class="comparison-table">
                <table>
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <th>Offline Classes</th>
                            <th>Online Classes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mentor Support</td>
                            <td><i class="fas fa-check-circle"></i> Direct face-to-face</td>
                            <td><i class="fas fa-times-circle"></i> Only virtual</td>
                        </tr>
                        <tr>
                            <td>Networking</td>
                            <td>
                                <i class="fas fa-check-circle"></i> Meet classmates, industry
                                events
                            </td>
                            <td><i class="fas fa-times-circle"></i> Limited</td>
                        </tr>
                        <tr>
                            <td>Focus</td>
                            <td>
                                <i class="fas fa-check-circle"></i> Classroom discipline, no
                                distractions
                            </td>
                            <td><i class="fas fa-times-circle"></i> Easily distracted</td>
                        </tr>
                        <tr>
                            <td>Practical Labs</td>
                            <td>
                                <i class="fas fa-check-circle"></i> Real-time practice with
                                trainers
                            </td>
                            <td><i class="fas fa-times-circle"></i> Limited interaction</td>
                        </tr>
                        <tr>
                            <td>Doubt Clearing</td>
                            <td>
                                <i class="fas fa-check-circle"></i> Immediate resolution
                            </td>
                            <td><i class="fas fa-times-circle"></i> Delayed responses</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Upcoming Batches Section -->
    <section id="contact" class="upcoming-batches">
        <div class="container">
            <div class="section-header">
                <h2>Upcoming Batches & Location</h2>
                <p>Join our next batch and start your transformation</p>
            </div>
            <div class="batches-content">
                <div class="batches-schedule">
                    <h3>Next Batch Dates</h3>
                    <div class="batch-item">
                        <div class="batch-course">Artificial Intelligence</div>
                        <div class="batch-date">March 15, 2025</div>
                        <div class="batch-status">Seats Available</div>
                    </div>
                    <div class="batch-item">
                        <div class="batch-course">Oracle Financials</div>
                        <div class="batch-date">March 20, 2025</div>
                        <div class="batch-status">Filling Fast</div>
                    </div>
                    <div class="batch-item">
                        <div class="batch-course">Data Analytics</div>
                        <div class="batch-date">March 25, 2025</div>
                        <div class="batch-status">Seats Available</div>
                    </div>
                    <div class="batch-item">
                        <div class="batch-course">Blockchain Technology</div>
                        <div class="batch-date">April 1, 2025</div>
                        <div class="batch-status">New Batch</div>
                    </div>
                </div>
                <div class="location-info">
                    <h3>Our Hyderabad Center</h3>
                    <div class="address">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>
                            17-1-16/A, 6th-Floor Pinnacle Towers<br />
                            Santosh Nagar, Saidabad, Hyderabad- 500059<br />
                            <br />
                            Telangana, India
                        </p>
                    </div>
                    <div class="contact-details">
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span> +91 8885501514</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>enquire@astidubai.ac.ae</span>
                        </div>
                        <div class="contact-item">
                            <i class="fab fa-whatsapp"></i>
                            <span> +91 8885501514</span>
                        </div>
                    </div>
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d195.86903955742184!2d78.50738539579042!3d17.349812815290267!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb990037f37e5d%3A0x4a81d3253a08679b!2sPinnacle%20Towers!5e1!3m2!1sen!2sin!4v1758173861926!5m2!1sen!2sin"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" width="100%" height="200" style="border: 0"
                            allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Certification Section -->
    <section class="certification">
        <div class="container">
            <div class="section-header">
                <h2>Certification & Career Support</h2>
                <p>
                    Industry-recognized credentials and comprehensive career assistance in Hyderabad
                </p>
            </div>
            <div class="certification-content">
                <div class="cert-info">
                    <h3>Industry-Recognized Certification</h3>
                    <p>
                        Upon successful completion of your course, you'll receive an ASTI Dubai Hyderabad certificate that’s
                        recognized by leading companies in the tech industry.
                        Our certificates validate your skills and knowledge, giving you a competitive edge in the Hyderabad
                        job market and beyond.

                    </p>
                    <div class="cert-features">
                        <div class="cert-feature">
                            <i class="fas fa-certificate"></i>
                            <span>Digital & Physical Certificate</span>
                        </div>
                        <div class="cert-feature">
                            <i class="fas fa-globe"></i>
                            <span> Globally Recognized</span>
                        </div>
                        <div class="cert-feature">
                            <i class="fas fa-shield-alt"></i>
                            <span>Block chain Verified</span>
                        </div>
                    </div>
                </div>
                <div class="career-support">
                    <h3>Comprehensive Career Support</h3>
                    <div class="support-items">
                        <div class="support-item">
                            <i class="fas fa-file-alt"></i>
                            <h4>Resume Building </h4>
                            <p>Professional resume review and optimization</p>
                        </div>
                        <div class="support-item">
                            <i class="fas fa-users"></i>
                            <h4>Interview Preparation</h4>
                            <p>Mock interviews and technical assessments</p>
                        </div>
                        <div class="support-item">
                            <i class="fas fa-briefcase"></i>
                            <h4>Job Placement</h4>
                            <p>Direct connections with hiring partners</p>
                        </div>
                        <div class="support-item">
                            <i class="fas fa-graduation-cap"></i>
                            <h4>Internship Programs</h4>
                            <p>Hands-on industry experience opportunities</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq">
        <div class="container">
            <div class="section-header">
                <h2>Frequently Asked Questions</h2>
                <p>Get answers to common questions about our training programs</p>
            </div>
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Do I get a certificate upon completion?</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Yes, you’ll receive a globally recognized ASTI Hyderabad certificate (digital & physical).
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>What is the duration of each course?</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Most courses run between 6 weeks to 3 months, depending on the program.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Is placement support provided in Hyderabad?</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Yes, we offer job placement assistance with top Hyderabad IT companies and start-ups.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Do I need prior programming experience?</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Not always. Many beginner-friendly courses are available, along with advanced tracks.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>What is the class schedule in Hyderabad?</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            We provide both weekday and weekend batches at our Hyderabad training centre.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>What is the class schedule?</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            We offer flexible schedules including weekday batches (9 AM - 1
                            PM), weekend batches (9 AM - 5 PM), and evening batches (6 PM -
                            9 PM) to accommodate working professionals and students.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>ASTI DWC</h3>
                    <p>
                        Empowering careers through quality technology education and
                        industry-relevant training programs.
                    </p>
                    <div class="social-links">
                        <a href="https://www.facebook.com/astionlineuae"><i class="fab fa-facebook"></i></a>
                        <a href="https://x.com/Astidwc"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/company/astiacademyonline"><i class="fab fa-linkedin"></i></a>
                        <a href="https://www.instagram.com/astiacademydwc"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Courses</h4>
                    <ul>
                        <li><a href="best-artificial-intelligence-course-in-hyderabad">Artificial Intelligence</a></li>
                        <li><a href="#">Oracle Financials</a></li>
                        <li><a href="#">Data Analytics</a></li>
                        <li><a href="#">Blockchain Technology</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Career Support</a></li>
                        <li><a href="#">Student Portal</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contact Info</h4>
                    <div class="contact-info">
                        <p>
                            <i class="fas fa-map-marker-alt"></i> 17-1-16/A, 6th-Floor Pinnacle Towers,
                            Santosh Nagar, Saidabad, Hyderabad – 500059

                        </p>
                        <p><i class="fas fa-phone"></i> +91 8885501514</p>
                        <p><i class="fas fa-envelope"></i> info@astidubai.ac.ae</p>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>
                    &copy; 2025 ASTI DWC. All rights reserved. | Privacy Policy | Terms
                    of Service
                </p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/918885501514" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>
@endsection


@push('scripts')
    <script src="{{ asset('frontend/assets/js/hyderabad-landing-page.js') }}"></script>
@endpush
