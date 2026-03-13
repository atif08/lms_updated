<?php $page = 'Advancing Careers Through Professional Development | Know More About Us'; ?>
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
                    <i class="fas fa-graduation-cap"></i>
                    ASTI DWC
                </div>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#course-highlights">Course</a></li>
                    <li><a href="#instructors">Instructors</a></li>
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
                        Master <span class="gradient-text">Blockchain Technology</span> with
                        Hands-On Offline Training
                    </h1>
                    <p class="hero-subtitle">
                        Join our intensive offline program in Hyderabad with expert blockchain mentors, real-world projects,
                        and classroom learning. Gain industry-ready blockchain development skills with personalized guidance
                        and peer collaboration.
                    </p>
                    <div class="hero-features">
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>100% Offline Classroom Training</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Industry Expert Blockchain Mentors</span>
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
                <h2>Why Choose Our Blockchain Training in Hyderabad?</h2>
                <p>
                    Experience the power of classroom-based blockchain learning with personalized attention.
                </p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3>Hands-On Classroom Training</h3>
                    <p>
                        Learn blockchain concepts directly from expert instructors with interactive sessions, real-time
                        coding, and feedback.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <h3>Real-World Blockchain Projects</h3>
                    <p>
                        Build decentralized apps (DApps), smart contracts, and blockchain-based solutions that mirror
                        industry needs.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3>Industry-Recognized Certification</h3>
                    <p>
                        Earn a blockchain certification valued by top companies and enhance your career in fintech, supply
                        chain, Web3, and more.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3>Personalized Mentor Guidance</h3>
                    <p>
                        Get one-on-one mentorship from blockchain professionals who will guide you in mastering Bitcoin,
                        Ethereum, Hyperledger, and emerging Web3 technologies.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Highlights -->
    <section id="course-highlights" class="course-highlights-section">
        <div class="container">
            <div class="section-header">
                <h2>What You'll Master</h2>
                <p>What You’ll Master in Blockchain Technology</p>
            </div>
            <div class="highlights-grid">
                <div class="highlight-card">
                    <div class="highlight-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3>Blockchain Fundamentals</h3>
                    <p>
                        Understand distributed ledger technology, consensus mechanisms, and cryptography basics.
                    </p>
                    <ul>
                        <li>Blockchain Basics & History</li>
                        <li>Cryptography & Hash Functions</li>
                        <li>Consensus Algorithms (PoW, PoS, PoA)</li>
                        <li>Smart Contracts</li>
                    </ul>
                </div>
                <div class="highlight-card">
                    <div class="highlight-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3>Smart Contracts & DApps</h3>
                    <p>
                        Master Solidity, Ethereum, and Web3.js for creating decentralized applications.
                    </p>
                    <ul>
                        <li>Solidity Programming</li>
                        <li>Ethereum Virtual Machine (EVM)</li>
                        <li>DApp Development</li>
                        <li>Token Standards (ERC-20, ERC-721, ERC-1155)</li>
                    </ul>
                </div>
                <div class="highlight-card">
                    <div class="highlight-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3>Enterprise Blockchain</h3>
                    <p>
                        Learn Hyperledger Fabric, Corda, and private blockchain frameworks.
                    </p>
                    <ul>
                        <li>Permissioned Blockchains</li>
                        <li>Chaincode Development</li>
                        <li>Identity & Access Control</li>
                        <li>Blockchain Integration for Businesses</li>
                    </ul>
                </div>
                <div class="highlight-card">
                    <div class="highlight-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Real-World Blockchain Projects</h3>
                    <p>
                        Build end-to-end blockchain solutions with practical, industry-relevant use cases.
                    </p>
                    <ul>
                        <li>Cryptocurrency Wallet Development</li>
                        <li>NFT Marketplace</li>
                        <li>Supply Chain Blockchain System</li>
                        <li>Decentralized Finance (DeFi) Application</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Offline Benefits -->
    <section id="offline-benefits" class="offline-benefits-section">
        <div class="container">
            <div class="section-header">
                <h2>Offline Learning Advantage</h2>
                <p>Why classroom training beats online learning</p>
            </div>
            <div class="comparison-container">
                <div class="comparison-card offline">
                    <h3><i class="fas fa-school"></i> Offline Training</h3>
                    <div class="benefits-list">
                        <div class="benefit">
                            <i class="fas fa-check"></i>
                            <span>Face-to-face interaction with instructors</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check"></i>
                            <span>Instant doubt resolution</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check"></i>
                            <span>Peer learning and networking</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check"></i>
                            <span>Hands-on lab sessions</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check"></i>
                            <span>Better focus and discipline</span>
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
                            <i class="fas fa-times"></i>
                            <span>Limited instructor interaction</span>
                        </div>
                        <div class="benefit limited">
                            <i class="fas fa-times"></i>
                            <span>Delayed doubt resolution</span>
                        </div>
                        <div class="benefit limited">
                            <i class="fas fa-times"></i>
                            <span>Isolated learning experience</span>
                        </div>
                        <div class="benefit limited">
                            <i class="fas fa-times"></i>
                            <span>Self-setup challenges</span>
                        </div>
                        <div class="benefit limited">
                            <i class="fas fa-times"></i>
                            <span>Distractions at home</span>
                        </div>
                        <div class="benefit limited">
                            <i class="fas fa-times"></i>
                            <span>Limited networking</span>
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
                        Recent graduates or final year students looking to build
                        industry-ready skills and kickstart their tech career with
                        practical knowledge.
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
                    <h3>Working Professionals</h3>
                    <p>
                        Experienced professionals seeking to upskill, switch careers, or
                        stay ahead in the rapidly evolving tech landscape.
                    </p>
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
                        Business owners and startup founders who want to understand AI,
                        blockchain, and emerging technologies for their ventures.
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
    <section id="instructors" class="instructors-section">
        <div class="container">
            <div class="section-header">
                <h2>Meet Your Expert Mentors</h2>
                <p>Learn from industry veterans with real-world experience</p>
            </div>
            <div class="instructors-grid">
                <div class="instructor-card">
                    <div class="instructor-image">
                        <img src="https://images.pexels.com/photos/2381069/pexels-photo-2381069.jpeg?auto=compress&cs=tinysrgb&w=400"
                            alt="Dr. Sarah Johnson" />
                    </div>
                    <div class="instructor-info">
                        <h3>Dr. Ananya Reddy </h3>
                        <p class="instructor-role">Block chain Lead at Infosys</p>
                        <p class="instructor-bio">
                            12+ years of experience in distributed ledger technologies. Published 40+ papers on block chain
                            consensus.
                        </p>
                        <div class="instructor-stats">
                            <span><i class="fas fa-users"></i> 5000+ Students</span>
                            <span><i class="fas fa-star"></i> 4.9 Rating</span>
                        </div>
                    </div>
                </div>
                <div class="instructor-card">
                    <div class="instructor-image">
                        <img src="https://images.pexels.com/photos/2379005/pexels-photo-2379005.jpeg?auto=compress&cs=tinysrgb&w=400"
                            alt="Mark Rodriguez" />
                    </div>
                    <div class="instructor-info">
                        <h3>Rajesh Kumar </h3>
                        <p class="instructor-role">Senior Blockchain Architect (Ex-Amazon)</p>
                        <p class="instructor-bio">
                            15 years in software engineering. Expert in Solidity, Hyperledger Fabric & DeFi systems.
                        </p>
                        <div class="instructor-stats">
                            <span><i class="fas fa-users"></i> 3500+ Students</span>
                            <span><i class="fas fa-star"></i> 4.8 Rating</span>
                        </div>
                    </div>
                </div>
                <div class="instructor-card">
                    <div class="instructor-image">
                        <img src="https://images.pexels.com/photos/2381069/pexels-photo-2381069.jpeg?auto=compress&cs=tinysrgb&w=400"
                            alt="Priya Sharma" />
                    </div>
                    <div class="instructor-info">
                        <h3>Priya Iyer </h3>
                        <p class="instructor-role">Web3 & FinTech Specialist</p>
                        <p class="instructor-bio">
                            Former Head of Blockchain Research at a FinTech company. Specialized in NFTs, crypto exchanges &
                            tokenomics.
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
                        <h3>$85K</h3>
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
                            <h4>Block chain Developer</h4>
                            <p>₹9L–15L</p>
                        </div>
                        <div class="role-card">
                            <i class="fas fa-chart-bar"></i>
                            <h4>Smart Contract Engineer </h4>
                            <p>₹10L–18L</p>
                        </div>
                        <div class="role-card">
                            <i class="fas fa-code"></i>
                            <h4>Web3 Developer </h4>
                            <p>₹8L–14L</p>
                        </div>
                        <div class="role-card">
                            <i class="fas fa-link"></i>
                            <h4>Crypto Analyst </h4>
                            <p>₹7L–12L</p>
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
                <p>Success Stories from Our Blockchain Graduates</p>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <img src="https://images.pexels.com/photos/2381069/pexels-photo-2381069.jpeg?auto=compress&cs=tinysrgb&w=150"
                            alt="Student" />
                        <div class="student-info">
                            <h4>Rahul Sharma </h4>
                            <p>Blockchain Developer at TCS</p>
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
                        “The hands-on blockchain projects gave me real confidence. I landed my job within 2 months!”
                    </p>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <img src="https://images.pexels.com/photos/2379005/pexels-photo-2379005.jpeg?auto=compress&cs=tinysrgb&w=150"
                            alt="Student" />
                        <div class="student-info">
                            <h4>Sneha Reddy </h4>
                            <p>Web3 Engineer at Polygon</p>
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
                        “The offline classes in Hyderabad were amazing. I built my first NFT marketplace project here.”
                    </p>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <img src="https://images.pexels.com/photos/2381069/pexels-photo-2381069.jpeg?auto=compress&cs=tinysrgb&w=150"
                            alt="Student" />
                        <div class="student-info">
                            <h4>Vikram Rao </h4>
                            <p>Smart Contract Developer at Wipro</p>
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
                        “Thanks to the mentorship, I shifted from traditional software to blockchain with a 70% salary
                        hike.”
                    </p>
                </div>
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
                            <p><strong>ASTI DWC Training Center</strong></p>
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
                        <h3>Is the blockchain certification industry-recognized?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Yes, it’s recognized by top IT companies and blockchain startups.
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
                            Not mandatory. We cover basics and guide beginners step by step.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>What are the fees and installment options?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Affordable with easy EMI/instalment plans available.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Do you provide placement support in Hyderabad?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Yes, with 500+ hiring partners and dedicated job assistance.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Can I attend offline classes while working? </h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Yes, we offer evening and weekend batches for professionals.
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
                    Join thousands of successful students who chose offline training for
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
                        Transforming careers through hands-on block chain training. Join the future of decentralized
                        technology with expert mentors and real-world block chain projects.
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
                        <li><a href="#">AI & Machine Learning</a></li>
                        <li><a href="#">Data Science</a></li>
                        <li><a href="#">Python Development</a></li>
                        <li><a href="#">Blockchain Technology</a></li>
                        <li><a href="#">Cybersecurity</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Company</h3>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Our Instructors</a></li>
                        <li><a href="#">Success Stories</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
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
