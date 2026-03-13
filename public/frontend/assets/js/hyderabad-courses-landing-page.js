// Mobile Menu Toggle
const hamburger = document.getElementById("hamburger");
const navMenu = document.getElementById("navMenu");

hamburger.addEventListener("click", () => {
    navMenu.classList.toggle("active");
    hamburger.classList.toggle("active");
});

// Close mobile menu when clicking on a link
document.querySelectorAll(".nav-menu a").forEach((link) => {
    link.addEventListener("click", () => {
        navMenu.classList.remove("active");
        hamburger.classList.remove("active");
    });
});

// Navbar scroll effect
// document.addEventListener("DOMContentLoaded", () => {
//     const navbar = document.getElementById("navbar");

//     window.addEventListener("scroll", () => {
//         if (window.scrollY > 50) {
//             navbar.classList.add("scrolled");
//         } else {
//             navbar.classList.remove("scrolled");
//         }
//     });
// });

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            target.scrollIntoView({
                behavior: "smooth",
                block: "start",
            });
        }
    });
});

//form-code
const registrationForm = document.getElementById("registrationForm");

registrationForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    // Collect form data
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);

    // Basic validation (ensure required fields are present)
    if (
        !data.name ||
        !data.email ||
        !data.phone ||
        !data.program ||
        !data.user_country
    ) {
        alert("Please fill in all required fields.");
        return;
    }

    // Map your fields → HubSpot properties
    // NOTE: The property 'firstname', 'email', etc. must exist or be the correct internal property names in HubSpot.
    const fields = [
        { name: "firstname", value: data.name },
        { name: "email", value: data.email },
        { name: "mobilephone", value: data.phone },
        { name: "whatsapp", value: data.whatsapp || "" },
        { name: "course", value: data.program },
        { name: "user_country", value: data.user_country }, // NEW - country (required)
        { name: "when_you_want_to_enroll", value: data.enrollWhen || "" },
        // NEW - optional enroll time
    ];

    // HubSpot details
    const portalId = "243693259";
    const formId = "3e5e15c6-dff2-406e-90dd-c1a414377516";

    // Button feedback
    const submitButton = this.querySelector('button[type="submit"]');
    const originalText = submitButton.innerHTML;
    submitButton.innerHTML =
        '<i class="fas fa-spinner fa-spin"></i> Submitting...';
    submitButton.disabled = true;

    try {
        const response = await fetch(
            `https://api-na2.hsforms.com/submissions/v3/integration/submit/${portalId}/${formId}`,
            {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ fields }),
            }
        );

        if (response.ok) {
            // SUCCESS: reset form and redirect to thank-you page (no popup)
            this.reset();

            // Change this to your actual thank-you page URL (relative or absolute)
            // Example: '/thank-you.html' or 'https://www.yoursite.com/thank-you'
            window.location.href = "/courses/thank-you";
            return;
        } else {
            const err = await response.json();
            console.error("HubSpot error:", err);
            alert("Submission failed. Please try again.");
        }
    } catch (error) {
        console.error("Error:", error);
        alert("Something went wrong. Please try again.");
    } finally {
        submitButton.innerHTML = originalText;
        submitButton.disabled = false;
    }
});

// FAQ Accordion
document.querySelectorAll(".faq-question").forEach((question) => {
    question.addEventListener("click", () => {
        const faqItem = question.parentElement;
        const isActive = faqItem.classList.contains("active");

        // Close all other FAQ items
        document.querySelectorAll(".faq-item").forEach((item) => {
            item.classList.remove("active");
        });

        // Toggle current item
        if (!isActive) {
            faqItem.classList.add("active");
        }
    });
});

// Intersection Observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add("fade-in-up");
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe all sections for animation
document.querySelectorAll("section").forEach((section) => {
    observer.observe(section);
});

// Sticky CTA visibility
const stickyCTA = document.getElementById("stickyCTA");
const heroSection = document.getElementById("hero");

window.addEventListener("scroll", () => {
    const heroBottom = heroSection.offsetTop + heroSection.offsetHeight;

    if (window.scrollY > heroBottom) {
        stickyCTA.style.display = "block";
    } else {
        stickyCTA.style.display = "none";
    }
});

// CTA button click handlers
document.querySelectorAll(".btn-primary").forEach((button) => {
    if (
        button.textContent.includes("Apply Now") ||
        button.textContent.includes("Register Now")
    ) {
        button.addEventListener("click", () => {
            document.getElementById("hero").scrollIntoView({
                behavior: "smooth",
            });

            // Focus on the form
            setTimeout(() => {
                document.querySelector('input[name="name"]').focus();
            }, 500);
        });
    }
});

// Demo class button handlers
document.querySelectorAll(".btn-primary, .btn-secondary").forEach((button) => {
    if (
        button.textContent.includes("Demo") ||
        button.textContent.includes("Counselling")
    ) {
        button.addEventListener("click", () => {
            // You can integrate with calendly or similar booking system
            alert("Please Fill Up The Form To Know More Details");
        });
    }
});

// Form input animations
document
    .querySelectorAll(".form-group input, .form-group select")
    .forEach((input) => {
        input.addEventListener("focus", function () {
            this.parentElement.classList.add("focused");
        });

        input.addEventListener("blur", function () {
            if (!this.value) {
                this.parentElement.classList.remove("focused");
            }
        });

        // Check if input has value on page load
        if (input.value) {
            input.parentElement.classList.add("focused");
        }
    });

// Country code and phone number sync
const countryCodeSelect = document.querySelector('select[name="countryCode"]');
const phoneInput = document.querySelector('input[name="phone"]');

countryCodeSelect.addEventListener("change", function () {
    phoneInput.focus();
});

// WhatsApp number auto-fill
const whatsappInput = document.querySelector('input[name="whatsapp"]');

phoneInput.addEventListener("blur", function () {
    if (this.value && !whatsappInput.value) {
        whatsappInput.value = this.value;
    }
});

// Add loading state to all primary buttons
document.querySelectorAll(".btn-primary").forEach((button) => {
    button.addEventListener("click", function () {
        if (this.type !== "submit" && !this.textContent.includes("Apply Now")) {
            const originalText = this.innerHTML;
            this.innerHTML =
                '<i class="fas fa-spinner fa-spin"></i> Loading...';
            this.disabled = true;

            setTimeout(() => {
                this.innerHTML = originalText;
                this.disabled = false;
            }, 1500);
        }
    });
});

// Statistics counter animation
const statCards = document.querySelectorAll(".stat-card h3, .stat h3");

const countUp = (element, target) => {
    let current = 0;
    const increment = target / 50;
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent =
                target +
                (element.textContent.includes("%")
                    ? "%"
                    : element.textContent.includes("K")
                    ? "K"
                    : "+");
            clearInterval(timer);
        } else {
            const value = Math.floor(current);
            element.textContent =
                value +
                (element.textContent.includes("%")
                    ? "%"
                    : element.textContent.includes("K")
                    ? "K"
                    : "+");
        }
    }, 20);
};

const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            const text = entry.target.textContent;
            const value = parseInt(text.replace(/[^0-9]/g, ""));
            if (value > 0) {
                countUp(entry.target, value);
                statsObserver.unobserve(entry.target);
            }
        }
    });
});

statCards.forEach((card) => {
    statsObserver.observe(card);
});

// Add hover effects to cards
document
    .querySelectorAll(
        ".feature-card, .highlight-card, .audience-card, .instructor-card, .testimonial-card"
    )
    .forEach((card) => {
        card.addEventListener("mouseenter", function () {
            this.style.transform = "translateY(-10px) scale(1.02)";
        });

        card.addEventListener("mouseleave", function () {
            this.style.transform = "translateY(0) scale(1)";
        });
    });

// Console welcome message
console.log(`
🚀 Welcome to EduTech Pro Landing Page!
   
✨ Features:
   • Responsive Design
   • Smooth Animations  
   • Interactive Forms
   • Modern UI/UX
   
📧 For support: info@edutechpro.com
`);

// Initialize page
document.addEventListener("DOMContentLoaded", () => {
    // Hide sticky CTA initially
    // stickyCTA.style.display = "none";

    // Add fade-in class to hero section
    document.getElementById("hero").classList.add("fade-in-up");

    console.log("✅ EduTech Pro Landing Page initialized successfully!");
});

// accordion-toggle
document.querySelectorAll(".accordion-header").forEach((btn) => {
    btn.addEventListener("click", () => {
        const item = btn.parentElement;
        const isActive = item.classList.contains("active");

        // Close all items
        document.querySelectorAll(".accordion-item").forEach((other) => {
            other.classList.remove("active");
        });

        // Toggle clicked one
        if (!isActive) {
            item.classList.add("active");
        }
    });
});
