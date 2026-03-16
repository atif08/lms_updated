<?php $page = 'Advancing Careers Through Professional Development | Know More About Us'; ?>
@extends('marketplace.layouts.front_layout')
@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/landing-page.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
@endpush
@section('content')
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="/frontend/assets/images/Logo-black-N.png" alt="ASTI Academy" />
                </div>
                <nav class="nav">
                    <ul>
                        <li><a href="#programs">Programs</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </nav>
                <div class="mobile-menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section with Form -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-left">
                    <div class="hero-text">
                        <h1 class="hero-title">
                            Your Pathway to
                            <span class="highlight">Global Recognition</span> Starts Here
                        </h1>
                        <p class="hero-subtitle">
                            Affordable, Accredited, and Career-Focused Diplomas &
                            Certifications from Dubai's Leading Technical & Vocational
                            Academy
                        </p>

                        <div class="hero-features">
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>UK Ofqual Accredited Programs</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>100% Online Learning</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Globally Recognized Qualifications</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Career-Ready Skills</span>
                            </div>
                        </div>

                        <div class="hero-stats">
                            <div class="stat-item">
                                <h3>30+</h3>
                                <p>Years of Excellence</p>
                            </div>
                            <div class="stat-item">
                                <h3>700000+</h3>
                                <p>Graduates Worldwide</p>
                            </div>
                            <div class="stat-item">
                                <h3>95%</h3>
                                <p>Success Rate</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hero-right">
                    <div class="enrollment-form">
                        <div class="form-header">
                            <h3>🎓 Enroll Now & Get Started</h3>
                            <p>Take the first step towards your future!</p>
                        </div>

                        <form id="hubspot-form-landing-page" class="form">
                            <div class="form-group">
                                <input type="text" id="fullName" name="fullName" placeholder="Full Name *" required />
                            </div>

                            <div class="form-group">
                                <input type="email" id="email" name="email" placeholder="Email Address *"
                                    required />
                            </div>

                            <div class="form-row">
                                <div class="form-group phone-group">
                                    <div class="phone-wrapper">
                                        <input type="tel" id="phone-2" name="phone" placeholder="Phone Number"
                                            required />
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <input type="tel" id="whatsapp" name="whatsapp" placeholder="WhatsApp Number"
                                    required />
                            </div>

                            <div class="form-group">
                                <select id="program" name="program" required>
                                    <option value="">Select Program *</option>
                                    <option value="qualifications">Qualifications</option>
                                    <option value="professional">
                                        Professional Certifications
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <select id="elective" name="elective" required>
                                    <option value="">Select Elective</option>
                                    <!-- Options will be populated by JS -->
                                </select>
                            </div>

                            <div class="form-row">
                                <div class="form-group full-width">
                                    <select id="country" name="country" required>
                                        <option value="">Select Country *</option>
                                        <option value="guyana">🇬🇾 Guyana</option>
                                        <option value="zambia">🇿🇲 Zambia</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <!-- <div class="form-group">
                        <input
                          type="text"
                          id="city"
                          name="city"
                          placeholder="City *"
                          required
                        />
                      </div> -->
                            </div>

                            <button type="submit" class="submit-btn">
                                <i class="fas fa-rocket"></i>
                                Apply Now - Start Your Journey
                            </button>

                            <p class="form-note">
                                <i class="fas fa-shield-alt"></i>
                                Your information is secure and will not be shared.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Accreditations -->
    <section class="accreditations">
        <div class="container">
            <h4>Recognized & Accredited By</h4>
            <div class="accreditation-logos">
                <div class="logo-item">
                    <img src="/frontend/assets/images/wes-logo.png" alt="WES" />
                </div>
                <div class="logo-item">
                    <img src="/frontend/assets/images/sce-logo.png" alt="Saudi Council of Engineers" />
                </div>
                <div class="logo-item">
                    <img src="/frontend/assets/images/mof-logo.png" alt="UAE Ministry of Foreign Affairs" />
                </div>
                <div class="logo-item">
                    <img src="/frontend/assets/images/khd-logo.png" alt="KHDA" />
                </div>
                <div class="logo-item">
                    <img src="/frontend/assets/images/moh-logo.png" alt="Saudi Ministry of Higher Education" />
                </div>
                <div class="logo-item">
                    <img src="/frontend/assets/images/qad-logo.png" alt="QAD Dubai" />
                </div>
                <div class="logo-item">
                    <img src="/frontend/assets/images/ofqual-logo.png" alt="Ofqual UK" />
                </div>
                <div class="logo-item">
                    <img src="/frontend/assets/images/tvet-logo.png" alt="TVET" />
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Programs -->
    <section id="programs" class="programs">
        <div class="container">
            <div class="section-header">
                <h2>Featured Programs</h2>
                <p>
                    Choose from our comprehensive range of globally recognized
                    qualifications
                </p>
            </div>

            <div class="programs-grid">
                <!-- UK Level Diplomas -->
                <div class="program-card diploma-card">
                    <div class="card-header">
                        <i class="fas fa-graduation-cap"></i>
                        <h3 style="color:#fff">🎓 UK Level Diplomas</h3>
                        <div class="price-badge">$1,999</div>
                    </div>

                    <div class="card-content">
                        <div class="program-details">
                            <span class="duration"><i class="fas fa-clock"></i> Duration: 1 Year</span>
                        </div>

                        <ul class="program-list">
                            <li>Level-3 Foundation Diploma in Higher Education</li>
                            <li>Level-3 Diploma in Education and Training</li>
                            <li>Level-3 Foundation Diploma in Accountancy</li>
                            <li>Level-4 Diploma in Accounting and Business</li>
                            <li>Level-4 Diploma in Education and Training</li>
                            <li>Level-5 Diploma in Accounting and Business</li>
                        </ul>

                        <div class="program-benefits">
                            <div class="benefit-item">
                                <i class="fas fa-check"></i>
                                <span>Globally recognized qualifications</span>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-check"></i>
                                <span>Aligned with UK Ofqual standards</span>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-check"></i>
                                <span>Ideal for academic progression</span>
                            </div>
                        </div>

                        <button class="enroll-btn">Enroll Now</button>
                    </div>
                </div>

                <!-- Professional Certifications -->
                <div class="program-card certification-card">
                    <div class="card-header">
                        <i class="fas fa-certificate"></i>
                        <h3 style="color:#fff">📚 Professional Certifications</h3>
                        <div class="price-badge">$499</div>
                    </div>

                    <div class="card-content">
                        <div class="program-details">
                            <span class="duration"><i class="fas fa-clock"></i> Duration: 6 Months</span>
                        </div>

                        <ul class="program-list">
                            <li>Artificial Intelligence</li>
                            <li>Data Science with AI</li>
                            <li>Blockchain Technology</li>
                            <li>Python Web Development</li>
                            <li>Quantity Surveying</li>
                            <li>Biomedical Engineering</li>
                            <li>Mechatronics Engineering</li>
                            <li>Petroleum Engineering</li>
                            <li>Chemical Engineering</li>
                            <li>Property Management</li>
                            <li>Oracle Financials</li>
                        </ul>

                        <div class="program-benefits">
                            <div class="benefit-item">
                                <i class="fas fa-check"></i>
                                <span>Fast-track professional skills</span>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-check"></i>
                                <span>Practical, project-based learning</span>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-check"></i>
                                <span>Flexible online delivery</span>
                            </div>
                        </div>

                        <button class="enroll-btn">Enroll Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose ASTI -->
    <section class="why-choose">
        <div class="container">
            <div class="section-header">
                <h2>Why Choose ASTI Academy?</h2>
                <p>
                    Discover what makes us the preferred choice for professional
                    education
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3>Accredited & Government-Approved</h3>
                    <p>Recognized by KHDA, TVET, Ofqual (UK), and QAD</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h3>Affordable & Flexible</h3>
                    <p>Study online at your pace, without compromising quality</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3>Career-Ready Programs</h3>
                    <p>Industry-relevant curriculum with practical applications</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Expert Faculty</h3>
                    <p>Learn from professionals with real-world expertise</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3>Global Recognition</h3>
                    <p>Qualifications valued across the UAE and worldwide</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h3>100% Online Learning</h3>
                    <p>Study from anywhere with our advanced learning platform</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works">
        <div class="container">
            <div class="section-header">
                <h2>How Enrollment Works</h2>
                <p>Start your journey in just 3 simple steps</p>
            </div>

            <div class="steps-container">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Explore Programs</h3>
                        <p>
                            Browse our diplomas and certifications to find the perfect fit
                            for your career goals
                        </p>
                    </div>
                </div>

                <div class="step-item">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Apply Now</h3>
                        <p>
                            Submit your details through our secure application form to begin
                            your journey
                        </p>
                    </div>
                </div>

                <div class="step-item">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Start Learning</h3>
                        <p>
                            Get instant access to our online platform and begin your
                            transformation
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>About ASTI Academy</h2>
                    <p>
                        Since 1995, ASTI Academy DWC has been delivering world-class
                        vocational and technical education in Dubai. We specialize in
                        engineering, business, IT, psychology, and teacher training
                        programs—designed for affordability, flexibility, and
                        international recognition.
                    </p>

                    <p>
                        With accreditations from KHDA, TVET, Ofqual (UK), and QAD, our
                        qualifications open doors for both career advancement and higher
                        education pathways.
                    </p>

                    <div class="about-highlights">
                        <div class="highlight-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Established in 1995</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Based in Dubai, UAE</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-star"></i>
                            <span>30+ Years of Excellence</span>
                        </div>
                    </div>
                </div>

                <div class="about-image">
                    <img src="https://via.placeholder.com/500x400/fc5130/ffffff?text=ASTI+Academy+Dubai"
                        alt="ASTI Academy Dubai" />
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-header">
                <h2>Contact Us</h2>
                <p>Get in touch with our admissions team</p>
            </div>

            <div class="contact-grid">
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h4>Office Address</h4>
                            <p>
                                Dubai South Office, A1 Building, 5th Floor<br />Jebel Ali Free
                                Zone, Dubai, UAE
                            </p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h4>Phone</h4>
                            <p><a href="tel:+971549909777">+971 54 990 9777</a></p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h4>Email</h4>
                            <p>
                                <a
                                    href="mailto:registrations.dwc@astiacademy.ac.ae">registrations.dwc@astiacademy.ac.ae</a>
                            </p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h4>Office Hours</h4>
                            <p>Monday - Saturday | 8:30 AM - 8:30 PM</p>
                        </div>
                    </div>
                </div>

                <div class="cta-section">
                    <h3 style="color:#fff">Ready to Start Your Journey?</h3>
                    <p>
                        Don't wait! Transform your career with globally recognized
                        qualifications.
                    </p>
                    <button class="cta-btn">
                        <i class="fas fa-rocket"></i>
                        Apply Now & Take the First Step!
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>ASTI Academy DWC</h4>
                    <img src="/frontend/assets/images/Logo-N.png" alt="" style="width: 161px; height: 40px" />
                    <p>
                        Your pathway to global recognition starts here. Join thousands of
                        successful graduates worldwide.
                    </p>
                </div>

                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#programs">Programs</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Accreditations</h4>
                    <ul>
                        <li>KHDA Approved</li>
                        <li>TVET Certified</li>
                        <li>UK Ofqual Aligned</li>
                        <li>QAD Recognized</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 ASTI Academy DWC. All rights reserved.</p>
            </div>
        </div>
    </footer>
@endsection


@push('scripts')
    <script src="{{ asset('frontend/assets/js/landing-page.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('hubspot-form-landing-page');
            if (!form) return;

            // Avoid attaching multiple listeners
            if (form.dataset.listenerAttached) return;
            form.dataset.listenerAttached = 'true';

            // Initialize intlTelInput
            const phoneInputField = document.querySelector('#phone-2');
            if (!phoneInputField) {
                console.error('Phone input not found');
                return;
            }

            const iti = window.intlTelInput(phoneInputField, {
                initialCountry: 'ae',
                separateDialCode: true,
                utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js',
            });

            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                console.log('Form submission started');

                // Validate phone
                if (!iti.isValidNumber()) {
                    alert('Please enter a valid phone number.');
                    return;
                }

                // Get full phone number in E.164 format
                let fullPhoneNumber;
                try {
                    fullPhoneNumber = iti.getNumber(intlTelInputUtils.numberFormat.E164);
                } catch {
                    fullPhoneNumber = iti.getNumber();
                }

                // Get HubSpot UTK cookie if available
                const hutk = (document.cookie.split('; ').find(row => row.startsWith('hubspotutk=')) ||
                    '').split('=')[1];

                // Get course title
                const courseField = document.querySelector('select[name="program"]');

                // Prepare payload
                const payload = {
                    fields: [{
                            name: 'full_name',
                            value: document.querySelector('[name="fullName"]').value
                        },
                        {
                            name: 'email',
                            value: document.querySelector('[name="email"]').value
                        },
                        {
                            name: 'hs_whatsapp_phone_number',
                            value: document.querySelector('[name="whatsapp"]').value
                        },
                        {
                            name: 'user_country',
                            value: document.querySelector('select[name="country"]').value
                        },
                        {
                            name: 'elective',
                            value: document.querySelector('select[name="elective"]').value
                        },
                        {
                            name: 'mobilephone',
                            value: fullPhoneNumber
                        },
                        {
                            name: 'select_the_course',
                            value: courseField ? courseField.value : ''
                        },
                    ],
                    context: {
                        pageUri: window.location.href,
                        pageName: document.title,
                        ...(hutk ? {
                            hutk
                        } : {})
                    },
                };

                console.log('Payload:', payload);

                try {
                    // Submit to HubSpot
                    const portalId = '46404285';
                    const formId = 'f121276c-5c72-40ae-bb2a-611034d86025';
                    const endpoint =
                        `https://api.hsforms.com/submissions/v3/integration/submit/${portalId}/${formId}`;

                    const response = await fetch(endpoint, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });

                    if (response.ok) {
                        console.log('Form submitted successfully');
                        form.reset();
                        iti.setNumber('');
                        // Optional: redirect
                        window.location.href = '/thank-you';
                    } else {
                        const errorText = await response.text();
                        console.error('HubSpot submission error:', errorText);
                        alert('There was an error submitting the form. Please try again.');
                    }
                } catch (err) {
                    console.error('Network error:', err);
                    alert('Network error. Please try again later.');
                }
            });
        });
    </script>
@endpush
