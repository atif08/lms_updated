// Mobile Navigation Toggle
const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
});

// Close mobile menu when clicking on a link
document.querySelectorAll(".nav-menu a").forEach((link) => {
    link.addEventListener("click", () => {
        hamburger.classList.remove("active");
        navMenu.classList.remove("active");
    });
});

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

// Form handling
const applicationForm = document.getElementById("applicationForm");
if (applicationForm) {
    applicationForm.addEventListener("submit", function (e) {
        e.preventDefault();

        // Get form data
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        // Basic validation
        if (
            !data.name ||
            !data.email ||
            !data.phone ||
            !data.whatsapp ||
            !data.program ||
            !data.country
        ) {
            alert("Please fill in all required fields.");
            return;
        }

        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(data.email)) {
            alert("Please enter a valid email address.");
            return;
        }

        // Phone validation (basic)
        const phoneRegex = /^\d{10,}$/;
        if (!phoneRegex.test(data.phone.replace(/\s+/g, ""))) {
            alert("Please enter a valid phone number.");
            return;
        }

        // Success message
        alert("Thank you for your application! We will contact you soon.");

        // Reset form
        this.reset();

        // Remove focus from labels
        document.querySelectorAll(".form-group label").forEach((label) => {
            label.style.top = "1rem";
            label.style.fontSize = "1rem";
            label.style.color = "#999";
        });
    });
}

// Form label animations
document
    .querySelectorAll(".form-group input, .form-group select")
    .forEach((input) => {
        input.addEventListener("focus", function () {
            const label = this.nextElementSibling;
            if (label && label.tagName === "LABEL") {
                label.style.top = "-0.5rem";
                label.style.left = "0.5rem";
                label.style.fontSize = "0.8rem";
                label.style.color = "rgb(252, 81, 48)";
                label.style.background = "white";
                label.style.padding = "0 0.5rem";
            }
        });

        input.addEventListener("blur", function () {
            const label = this.nextElementSibling;
            if (label && label.tagName === "LABEL" && !this.value) {
                label.style.top = "1rem";
                label.style.left = "1rem";
                label.style.fontSize = "1rem";
                label.style.color = "#999";
                label.style.background = "transparent";
                label.style.padding = "0";
            }
        });
    });

// FAQ Toggle functionality
document.querySelectorAll(".faq-question").forEach((question) => {
    question.addEventListener("click", function () {
        const faqItem = this.parentElement;
        const isActive = faqItem.classList.contains("active");

        // Close all FAQ items
        document.querySelectorAll(".faq-item").forEach((item) => {
            item.classList.remove("active");
        });

        // Open clicked item if it wasn't active
        if (!isActive) {
            faqItem.classList.add("active");
        }
    });
});

// Course card interactions
document.querySelectorAll(".course-card").forEach((card) => {
    card.addEventListener("mouseenter", function () {
        this.style.transform = "translateY(-10px)";
    });

    card.addEventListener("mouseleave", function () {
        this.style.transform = "translateY(0)";
    });
});

// Navbar background change on scroll
window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 100) {
        navbar.style.background = "rgba(255, 255, 255, 0.98)";
        navbar.style.boxShadow = "0 2px 20px rgba(0, 0, 0, 0.1)";
    } else {
        navbar.style.background = "rgba(255, 255, 255, 0.95)";
        navbar.style.boxShadow = "none";
    }
});

// Animate elements on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
};

const observer = new IntersectionObserver(function (entries) {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = "1";
            entry.target.style.transform = "translateY(0)";
        }
    });
}, observerOptions);

// Observe elements for animation
document
    .querySelectorAll(
        ".course-card, .benefit-card, .faculty-card, .testimonial-card, .stat-card"
    )
    .forEach((el) => {
        el.style.opacity = "0";
        el.style.transform = "translateY(30px)";
        el.style.transition = "opacity 0.6s ease, transform 0.6s ease";
        observer.observe(el);
    });

// Counter animation for statistics
function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);

    function updateCounter() {
        start += increment;
        if (start < target) {
            element.textContent = Math.floor(start);
            requestAnimationFrame(updateCounter);
        } else {
            element.textContent = target;
        }
    }

    updateCounter();
}

// Animate statistics when they come into view
const statsObserver = new IntersectionObserver(
    function (entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const statElement = entry.target.querySelector("h3");
                const text = statElement.textContent;
                const number = parseInt(text.replace(/\D/g, ""));

                if (number) {
                    statElement.textContent = "0";
                    setTimeout(() => {
                        animateCounter(statElement, number);
                        // Add back the suffix
                        setTimeout(() => {
                            if (text.includes("%")) {
                                statElement.textContent = number + "%";
                            } else if (text.includes("L")) {
                                statElement.textContent = "₹" + number + "L";
                            } else if (text.includes("★")) {
                                statElement.textContent = number + "★";
                            } else if (text.includes("+")) {
                                statElement.textContent = number + "+";
                            }
                        }, 2000);
                    }, 500);
                }

                statsObserver.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.5 }
);

document.querySelectorAll(".stat, .stat-card").forEach((stat) => {
    statsObserver.observe(stat);
});

// Gallery hover effects
document.querySelectorAll(".gallery-item").forEach((item) => {
    item.addEventListener("mouseenter", function () {
        const overlay = this.querySelector(".gallery-overlay");
        const img = this.querySelector("img");

        if (overlay) overlay.style.transform = "translateY(0)";
        if (img) img.style.transform = "scale(1.1)";
    });

    item.addEventListener("mouseleave", function () {
        const overlay = this.querySelector(".gallery-overlay");
        const img = this.querySelector("img");

        if (overlay) overlay.style.transform = "translateY(100%)";
        if (img) img.style.transform = "scale(1)";
    });
});

// WhatsApp button pulse animation
const whatsappButton = document.querySelector(".whatsapp-float");
if (whatsappButton) {
    setInterval(() => {
        whatsappButton.style.animation = "none";
        setTimeout(() => {
            whatsappButton.style.animation = "pulse 2s infinite";
        }, 10);
    }, 5000);
}

// Course card click handlers
document.querySelectorAll(".course-card .btn-secondary").forEach((button) => {
    button.addEventListener("click", function (e) {
        e.stopPropagation();
        const courseCard = this.closest(".course-card");
        const courseName = courseCard.querySelector("h3").textContent;

        // Scroll to application form and pre-select the course
        const form = document.getElementById("applicationForm");
        const programSelect = document.getElementById("program");

        if (form && programSelect) {
            // Pre-select the course in the dropdown
            const courseMap = {
                "Artificial Intelligence": "ai",
                "Python Programming": "python",
                "Data Analytics": "data-analytics",
                "Blockchain Technology": "blockchain",
            };

            programSelect.value = courseMap[courseName] || "";

            // Trigger label animation
            const label = programSelect.nextElementSibling;
            if (label) {
                label.style.top = "-0.5rem";
                label.style.left = "0.5rem";
                label.style.fontSize = "0.8rem";
                label.style.color = "rgb(252, 81, 48)";
                label.style.background = "white";
                label.style.padding = "0 0.5rem";
            }

            // Scroll to form
            form.scrollIntoView({ behavior: "smooth", block: "center" });

            // Focus on name field
            setTimeout(() => {
                document.getElementById("name").focus();
            }, 1000);
        }
    });
});

// Initialize page
document.addEventListener("DOMContentLoaded", function () {
    // Set initial form label positions for filled inputs
    document
        .querySelectorAll(".form-group input, .form-group select")
        .forEach((input) => {
            if (input.value) {
                const label = input.nextElementSibling;
                if (label && label.tagName === "LABEL") {
                    label.style.top = "-0.5rem";
                    label.style.left = "0.5rem";
                    label.style.fontSize = "0.8rem";
                    label.style.color = "rgb(252, 81, 48)";
                    label.style.background = "white";
                    label.style.padding = "0 0.5rem";
                }
            }
        });

    // Add loading animation to page
    document.body.style.opacity = "0";
    setTimeout(() => {
        document.body.style.transition = "opacity 0.5s ease";
        document.body.style.opacity = "1";
    }, 100);
});
