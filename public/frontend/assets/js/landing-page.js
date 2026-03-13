// DOM Content Loaded Event
document.addEventListener("DOMContentLoaded", function () {
    // Initialize all functionality
    initializeAnimations();
    initializeForm();
    initializeSmoothScroll();
    initializeMobileMenu();
    initializeHeaderScroll();
    // initializeCountryCodeSync();
});

// Scroll Animations
function initializeAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("animated");

                // Add stagger effect for grid items
                if (
                    entry.target.classList.contains("feature-card") ||
                    entry.target.classList.contains("program-card") ||
                    entry.target.classList.contains("step-item")
                ) {
                    const siblings = entry.target.parentElement.children;
                    const index = Array.from(siblings).indexOf(entry.target);
                    entry.target.style.animationDelay = `${index * 0.2}s`;
                }
            }
        });
    }, observerOptions);

    // Observe elements for scroll animation
    const animatedElements = document.querySelectorAll(
        ".section-header, .feature-card, .program-card, .step-item, .contact-item, .cta-section"
    );

    animatedElements.forEach((el) => {
        el.classList.add("animate-on-scroll");
        observer.observe(el);
    });

    // Counter animation for stats
    animateCounters();
}

// Counter Animation
function animateCounters() {
    const counters = document.querySelectorAll(".stat-item h3");
    const options = {
        threshold: 0.7,
    };

    const counterObserver = new IntersectionObserver(function (entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseInt(
                    counter.textContent.replace(/[^\d]/g, "")
                );
                const suffix = counter.textContent.replace(/[\d]/g, "");

                animateCounter(counter, target, suffix);
                counterObserver.unobserve(counter);
            }
        });
    }, options);

    counters.forEach((counter) => {
        counterObserver.observe(counter);
    });
}

function animateCounter(element, target, suffix) {
    let current = 0;
    const increment = target / 50;
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target + suffix;
            clearInterval(timer);
        } else {
            element.textContent = Math.ceil(current) + suffix;
        }
    }, 30);
}

// Form Handling
function initializeForm() {
    const form = document.getElementById("enrollmentForm");
    const submitBtn = document.querySelector(".submit-btn");

    if (form) {
        form.addEventListener("submit", handleFormSubmit);

        // Real-time validation
        const inputs = form.querySelectorAll("input, select");
        inputs.forEach((input) => {
            input.addEventListener("blur", validateField);
            input.addEventListener("input", clearErrors);
        });
    }
}

function handleFormSubmit(e) {
    e.preventDefault();

    const form = e.target;
    const submitBtn = form.querySelector(".submit-btn");
    const formData = new FormData(form);

    // Validate form
    if (!validateForm(form)) {
        return;
    }

    // Show loading state
    submitBtn.classList.add("loading");
    submitBtn.disabled = true;

    // Simulate form submission (replace with actual API call)
    setTimeout(() => {
        // Success animation
        submitBtn.classList.remove("loading");
        submitBtn.innerHTML =
            '<i class="fas fa-check"></i> Application Submitted!';
        submitBtn.style.background = "#27ae60";

        // Show success message
        showNotification(
            "Thank you! Your application has been submitted successfully. We will contact you soon.",
            "success"
        );

        // Reset form after delay
        setTimeout(() => {
            form.reset();
            submitBtn.innerHTML =
                '<i class="fas fa-rocket"></i> Apply Now - Start Your Journey';
            submitBtn.style.background = "";
            submitBtn.disabled = false;
        }, 3000);
    }, 2000);
}

function validateForm(form) {
    let isValid = true;
    const requiredFields = form.querySelectorAll("[required]");

    requiredFields.forEach((field) => {
        if (!validateField({ target: field })) {
            isValid = false;
        }
    });

    return isValid;
}

function validateField(e) {
    const field = e.target;
    const value = field.value.trim();
    let isValid = true;

    // Remove existing error
    clearErrors({ target: field });

    // Check if required field is empty
    if (field.required && !value) {
        showFieldError(field, "This field is required");
        isValid = false;
    }

    // Email validation
    if (field.type === "email" && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            showFieldError(field, "Please enter a valid email address");
            isValid = false;
        }
    }

    // Phone validation
    if (field.type === "tel" && value) {
        const phoneRegex = /^[\d\s\-\+\(\)]{10,}$/;
        if (!phoneRegex.test(value)) {
            showFieldError(field, "Please enter a valid phone number");
            isValid = false;
        }
    }

    return isValid;
}

function showFieldError(field, message) {
    field.style.borderColor = "#e74c3c";

    let errorElement = field.parentElement.querySelector(".error-message");
    if (!errorElement) {
        errorElement = document.createElement("span");
        errorElement.className = "error-message";
        errorElement.style.cssText =
            "color: #e74c3c; font-size: 12px; margin-top: 5px; display: block;";
        field.parentElement.appendChild(errorElement);
    }

    errorElement.textContent = message;
}

function clearErrors(e) {
    const field = e.target;
    field.style.borderColor = "#e1e8ed";

    const errorElement = field.parentElement.querySelector(".error-message");
    if (errorElement) {
        errorElement.remove();
    }
}

// Notification System
function showNotification(message, type = "info") {
    const notification = document.createElement("div");
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${
                type === "success" ? "check-circle" : "info-circle"
            }"></i>
            <span>${message}</span>
            <button class="notification-close">&times;</button>
        </div>
    `;

    // Styles
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === "success" ? "#27ae60" : "#3498db"};
        color: white;
        padding: 15px 20px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        z-index: 10000;
        transform: translateX(400px);
        transition: transform 0.3s ease;
        max-width: 400px;
    `;

    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => {
        notification.style.transform = "translateX(0)";
    }, 100);

    // Close functionality
    const closeBtn = notification.querySelector(".notification-close");
    closeBtn.addEventListener("click", () => {
        notification.style.transform = "translateX(400px)";
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    });

    // Auto close after 5 seconds
    setTimeout(() => {
        if (document.body.contains(notification)) {
            notification.style.transform = "translateX(400px)";
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }
    }, 5000);
}

// Country Code Synchronization
function initializeCountryCodeSync() {
    const countrySelect = document.getElementById("country");
    const countryCodeSelect = document.getElementById("countryCode");

    if (countrySelect && countryCodeSelect) {
        countrySelect.addEventListener("change", function () {
            const selectedCountry = this.value;

            // Sync country code with selected country
            switch (selectedCountry) {
                case "guyana":
                    countryCodeSelect.value = "+592";
                    break;
                case "zambia":
                    countryCodeSelect.value = "+260";
                    break;
                default:
                    // Keep current selection
                    break;
            }
        });
    }
}

// Smooth Scroll
function initializeSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            const href = this.getAttribute("href");

            // ignore empty # links
            if (href.length > 1) {
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();

                    // check header height safely
                    const header = document.querySelector(".header");
                    const headerHeight = header ? header.offsetHeight : 0;

                    // calculate position
                    const targetPosition =
                        target.getBoundingClientRect().top +
                        window.scrollY -
                        headerHeight -
                        20;

                    // smooth scroll
                    window.scrollTo({
                        top: targetPosition,
                        behavior: "smooth",
                    });
                }
            }
        });
    });
}

// make sure it runs after DOM loads
document.addEventListener("DOMContentLoaded", initializeSmoothScroll);

// Mobile Menu
function initializeMobileMenu() {
    const menuToggle = document.querySelector(".mobile-menu-toggle");
    const nav = document.querySelector(".nav");

    if (menuToggle && nav) {
        menuToggle.addEventListener("click", function () {
            nav.classList.toggle("active");
            this.classList.toggle("active");

            // Change icon
            const icon = this.querySelector("i");
            if (this.classList.contains("active")) {
                icon.className = "fas fa-times";
            } else {
                icon.className = "fas fa-bars";
            }
        });

        // Close menu when clicking on links
        nav.querySelectorAll("a").forEach((link) => {
            link.addEventListener("click", () => {
                nav.classList.remove("active");
                menuToggle.classList.remove("active");
                menuToggle.querySelector("i").className = "fas fa-bars";
            });
        });
    }
}

// Header Scroll Effect
function initializeHeaderScroll() {
    const header = document.querySelector(".header");
    let lastScrollY = window.scrollY;

    window.addEventListener("scroll", () => {
        const currentScrollY = window.scrollY;

        // Add/remove scrolled class for styling
        if (currentScrollY > 100) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }

        // Hide/show header on scroll
        if (currentScrollY > lastScrollY && currentScrollY > 100) {
            header.style.transform = "translateY(-100%)";
        } else {
            header.style.transform = "translateY(0)";
        }

        lastScrollY = currentScrollY;
    });
}

// Scroll to Form Function
// function scrollToForm() {
//     const form = document.querySelector(".enrollment-form");
//     if (form) {
//         const headerHeight = document.querySelector(".header").offsetHeight;
//         const formPosition = form.offsetTop - headerHeight - 20;

//         window.scrollTo({
//             top: formPosition,
//             behavior: "smooth",
//         });

//         // Highlight form
//         form.style.transform = "scale(1.02)";
//         form.style.boxShadow = "0 25px 50px rgba(252, 81, 48, 0.2)";

//         setTimeout(() => {
//             form.style.transform = "";
//             form.style.boxShadow = "";
//         }, 1000);
//     }
// }

// Enhanced Hover Effects
document.addEventListener("DOMContentLoaded", function () {
    // Program cards hover effect
    const programCards = document.querySelectorAll(".program-card");
    programCards.forEach((card) => {
        card.addEventListener("mouseenter", function () {
            this.style.transform = "translateY(-15px) scale(1.02)";
        });

        card.addEventListener("mouseleave", function () {
            this.style.transform = "";
        });
    });

    // Feature cards hover effect
    const featureCards = document.querySelectorAll(".feature-card");
    featureCards.forEach((card) => {
        card.addEventListener("mouseenter", function () {
            const icon = this.querySelector(".feature-icon");
            icon.style.transform = "scale(1.15) rotate(10deg)";
            icon.style.background = "linear-gradient(135deg, #ffa726, #ff7043)";
        });

        card.addEventListener("mouseleave", function () {
            const icon = this.querySelector(".feature-icon");
            icon.style.transform = "";
            icon.style.background = "";
        });
    });

    // Button hover effects
    const buttons = document.querySelectorAll(
        ".submit-btn, .enroll-btn, .cta-btn"
    );
    buttons.forEach((button) => {
        button.addEventListener("mouseenter", function () {
            this.style.transform = "translateY(-3px) scale(1.05)";
        });

        button.addEventListener("mouseleave", function () {
            this.style.transform = "";
        });
    });
});

// Form Field Focus Effects
document.addEventListener("DOMContentLoaded", function () {
    const formInputs = document.querySelectorAll(".form input, .form select");

    formInputs.forEach((input) => {
        input.addEventListener("focus", function () {
            this.parentElement.style.transform = "translateY(-2px)";
            this.style.boxShadow = "0 8px 25px rgba(252, 81, 48, 0.15)";
        });

        input.addEventListener("blur", function () {
            this.parentElement.style.transform = "";
            if (!this.value) {
                this.style.boxShadow = "";
            }
        });

        // Keep shadow if field has value
        input.addEventListener("input", function () {
            if (this.value) {
                this.style.boxShadow = "0 5px 15px rgba(252, 81, 48, 0.1)";
            } else {
                this.style.boxShadow = "";
            }
        });
    });
});

// Parallax Effect for Hero Section
window.addEventListener("scroll", function () {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector(".hero");
    const heroContent = document.querySelector(".hero-content");

    if (hero && heroContent) {
        const rate = scrolled * -0.5;
        heroContent.style.transform = `translateY(${rate}px)`;
    }
});

// Dynamic Background Animation
function createFloatingElements() {
    const hero = document.querySelector(".hero");
    if (!hero) return;

    // Create floating elements
    for (let i = 0; i < 20; i++) {
        const element = document.createElement("div");
        element.className = "floating-element";
        element.style.cssText = `
            position: absolute;
            width: ${Math.random() * 10 + 5}px;
            height: ${Math.random() * 10 + 5}px;
            background: rgba(255, 167, 38, 0.3);
            border-radius: 50%;
            top: ${Math.random() * 100}%;
            left: ${Math.random() * 100}%;
            animation: float ${Math.random() * 10 + 10}s linear infinite;
            pointer-events: none;
        `;

        hero.appendChild(element);
    }

    // Add CSS animation
    const style = document.createElement("style");
    style.textContent = `
        @keyframes float {
            0% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
}

// Initialize floating elements
document.addEventListener("DOMContentLoaded", createFloatingElements);

// Lazy Loading for Images
function initializeLazyLoading() {
    const images = document.querySelectorAll("img[data-src]");

    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove("lazy");
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach((img) => imageObserver.observe(img));
}

// Performance Optimization
function optimizePerformance() {
    // Debounce scroll events
    let ticking = false;

    function updateOnScroll() {
        // Your scroll-based animations here
        ticking = false;
    }

    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateOnScroll);
            ticking = true;
        }
    }

    window.addEventListener("scroll", requestTick);
}

// Initialize performance optimizations
document.addEventListener("DOMContentLoaded", optimizePerformance);

// Form Auto-save (localStorage alternative using sessionStorage concept)
let formDataStore = {};

function initializeFormAutoSave() {
    const form = document.getElementById("enrollmentForm");
    if (!form) return;

    const inputs = form.querySelectorAll("input, select");

    // Save form data on input change
    inputs.forEach((input) => {
        input.addEventListener("input", function () {
            formDataStore[this.name] = this.value;
        });

        // Load saved data on page load
        if (formDataStore[input.name]) {
            input.value = formDataStore[input.name];
        }
    });
}

// Enhanced Mobile Experience
function initializeMobileEnhancements() {
    // Touch-friendly hover effects for mobile
    if ("ontouchstart" in window) {
        const cards = document.querySelectorAll(".feature-card, .program-card");

        cards.forEach((card) => {
            card.addEventListener("touchstart", function () {
                this.classList.add("touch-active");
            });

            card.addEventListener("touchend", function () {
                setTimeout(() => {
                    this.classList.remove("touch-active");
                }, 150);
            });
        });
    }

    // Prevent zoom on input focus for iOS
    const inputs = document.querySelectorAll("input, select");
    inputs.forEach((input) => {
        input.addEventListener("focus", function () {
            if (window.innerWidth < 768) {
                document
                    .querySelector('meta[name="viewport"]')
                    .setAttribute(
                        "content",
                        "width=device-width, initial-scale=1, maximum-scale=1"
                    );
            }
        });

        input.addEventListener("blur", function () {
            if (window.innerWidth < 768) {
                document
                    .querySelector('meta[name="viewport"]')
                    .setAttribute(
                        "content",
                        "width=device-width, initial-scale=1"
                    );
            }
        });
    });
}

// Initialize all mobile enhancements
document.addEventListener("DOMContentLoaded", function () {
    initializeMobileEnhancements();
    initializeFormAutoSave();
});

// Accessibility Improvements
function initializeAccessibility() {
    // Add skip link
    const skipLink = document.createElement("a");
    skipLink.href = "#main-content";
    skipLink.textContent = "Skip to main content";
    skipLink.className = "skip-link";
    skipLink.style.cssText = `
        position: absolute;
        top: -40px;
        left: 6px;
        background: #000;
        color: #fff;
        padding: 8px;
        text-decoration: none;
        z-index: 10000;
        border-radius: 4px;
    `;

    skipLink.addEventListener("focus", () => {
        skipLink.style.top = "6px";
    });

    skipLink.addEventListener("blur", () => {
        skipLink.style.top = "-40px";
    });

    document.body.insertBefore(skipLink, document.body.firstChild);

    // Add main content landmark
    const hero = document.querySelector(".hero");
    if (hero) {
        hero.id = "main-content";
        hero.setAttribute("role", "main");
    }
}

// Initialize accessibility features
document.addEventListener("DOMContentLoaded", initializeAccessibility);

// Add CSS for touch active states
const mobileStyles = document.createElement("style");
mobileStyles.textContent = `
    .touch-active {
        transform: translateY(-10px) scale(1.02) !important;
        box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
    }
    
    .skip-link:focus {
        top: 6px !important;
    }
    
    @media (max-width: 768px) {
        .nav {
            position: fixed;
            top: 70px;
            right: -100%;
            background: white;
            width: 80%;
            height: calc(100vh - 70px);
            padding: 40px 20px;
            box-shadow: -5px 0 15px rgba(0,0,0,0.1);
            transition: right 0.3s ease;
            z-index: 999;
        }
        
        .nav.active {
            right: 0;
        }
        
        .nav ul {
            flex-direction: column;
            gap: 20px;
        }
        
        .nav a {
            font-size: 18px;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
    }
    
    .header.scrolled {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }
`;

document.head.appendChild(mobileStyles);

//mappin of qualificatiions with the professional certificates
// Course data mapping
const courses = {
    qualifications: [
        {
            value: "level3-foundation-higher-education",
            text: "Level-3 Foundation Diploma in Higher Education",
        },
        {
            value: "level3-education-training",
            text: "Level-3 Diploma in Education and Training",
        },
        {
            value: "level3-foundation-accountancy",
            text: "Level-3 Foundation Diploma in Accountancy",
        },
        {
            value: "level4-accounting-business",
            text: "Level-4 Diploma in Accounting and Business",
        },
        {
            value: "level4-education-training",
            text: "Level-4 Diploma in Education and Training",
        },
        {
            value: "level5-accounting-business",
            text: "Level-5 Diploma in Accounting and Business",
        },
    ],
    professional: [
        {
            value: "blockchain-technology-programme",
            text: "Block Chain Technology Programme",
        },
        {
            value: "artificial-intelligence-programme",
            text: "Artificial Intelligence Programme",
        },
        {
            value: "data-analysis-training-course",
            text: "Data Analysis Training Course",
        },
        {
            value: "python-webdevelopment-course",
            text: "Python Webdevelopment Course",
        },
        {
            value: "engineering-architecture-design",
            text: "Engineering, Architecture and Design",
        },
        {
            value: "property-management-programme",
            text: "Property Management Programme",
        },
        {
            value: "design-engineering-programme",
            text: "Design Engineering Programme",
        },
        {
            value: "biomedical-engineering-programme",
            text: "Biomedical Engineering Programme",
        },
        {
            value: "chemical-engineering-programme",
            text: "Chemical Engineering Programme",
        },
        {
            value: "mechatronics-engineering-programme",
            text: "Mechatronics Engineering Programme",
        },
        {
            value: "petroleum-engineering-programme",
            text: "Petroleum Engineering Programme",
        },
        {
            value: "quantity-surveying-engineering-programme",
            text: "Quantity Surveying Engineering Programme",
        },
        {
            value: "electrical-vehicle-engineering-programme",
            text: "Electrical Vehicle Engineering Programme",
        },
        { value: "accounting-finance", text: "Accounting and Finance" },
        {
            value: "oracle-financial-programme",
            text: "Oracle Financial Programme",
        },
    ],
};

document.getElementById("program").addEventListener("change", function () {
    const elective = document.getElementById("elective");
    const selected = this.value;

    // Clear old options
    elective.innerHTML = '<option value="">Select Elective</option>';

    // Populate based on selection
    if (courses[selected]) {
        courses[selected].forEach((course) => {
            const option = document.createElement("option");
            option.value = course.value;
            option.textContent = course.text;
            elective.appendChild(option);
        });
    }
});

//explore-buttons
document.querySelectorAll(".enroll-btn").forEach((btn) => {
    btn.addEventListener("click", function () {
        const form = document.getElementById("enrollmentForm");
        if (form) {
            form.scrollIntoView({
                behavior: "smooth",
            });
        }
    });
});

// No inline handlers needed
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".cta-btn, .enroll-btn").forEach((btn) => {
        btn.addEventListener("click", () => {
            const form = document.querySelector("#enrollmentForm");
            if (form) {
                form.scrollIntoView({ behavior: "smooth" });
            }
        });
    });
});

//header-and-footer-buttons
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({ behavior: "smooth" });
            }
        });
    });
});
