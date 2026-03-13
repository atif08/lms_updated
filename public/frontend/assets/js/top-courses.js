document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.getElementById("navbar");
    const mobileToggle = document.getElementById("mobileToggle");
    const navMenu = document.getElementById("navMenu");
    const scrollTopBtn = document.getElementById("scrollTop");
    const form = document.getElementById("mainEnrollmentForm");

    window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
            scrollTopBtn.classList.add("show");
        } else {
            navbar.classList.remove("scrolled");
            scrollTopBtn.classList.remove("show");
        }
    });

    if (!mobileToggle || !navMenu) {
        console.error("Navbar elements not found");
        return;
    }

    // ✅ Check if elements exist
    if (!mobileToggle || !navMenu) {
        console.error("Navbar toggle or menu not found in DOM");
        return;
    }

    // ✅ Toggle open/close
    mobileToggle.addEventListener("click", () => {
        console.log("Toggle clicked!");
        navMenu.classList.toggle("active");
        mobileToggle.classList.toggle("active");
    });

    navMenu.querySelectorAll("a").forEach((link) => {
        link.addEventListener("click", function (event) {
            // Only handle nav closing, not navigation itself
            navMenu.classList.remove("active");
            const spans = mobileToggle.querySelectorAll("span");
            spans[0].style.transform = "none";
            spans[1].style.opacity = "1";
            spans[2].style.transform = "none";

            // Smooth scroll (optional safety if CSS doesn't handle it)
            const targetId = this.getAttribute("href").substring(1);
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: "smooth" });
            }
        });
    });
    scrollTopBtn.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });

    // Prevent multiple listener attachments
    if (form.dataset.listenerAttached === "true") return;
    form.dataset.listenerAttached = "true";

    let isSubmitting = false; // Prevent multiple rapid submissions

    form.addEventListener("submit", async function (event) {
        event.preventDefault();

        // Stop if already submitting
        if (isSubmitting) return;
        isSubmitting = true;

        // Collect form data
        const fullName = document.getElementById("fullName").value.trim();
        const email = document.getElementById("email").value.trim();
        const phone = document.getElementById("phone").value.trim();
        const whatsapp = document.getElementById("whatsapp").value.trim();
        const program = document.getElementById("program").value.trim();
        const collegeName = document.getElementById("collegeName").value.trim();

        // Prepare payload for HubSpot API
        const payload = {
            fields: [
                { name: "firstname", value: fullName },
                { name: "email", value: email },
                { name: "phone", value: phone },
                { name: "whatsapp_number", value: whatsapp },
                { name: "program_select", value: program },
                { name: "college_name", value: collegeName },
            ],
            context: {
                pageUri: window.location.href,
                pageName: document.title,
            },
        };

        // Include HubSpot tracking cookie only if available
        const hutk = getCookie("hubspotutk");
        if (hutk) payload.context.hutk = hutk;

        // Helper function to get HubSpot tracking cookie
        function getCookie(name) {
            const v = "; " + document.cookie;
            const parts = v.split("; " + name + "=");
            if (parts.length === 2) return parts.pop().split(";").shift();
        }

        // HubSpot form details
        const portalId = "243954796";
        const formId = "4faf0875-64d7-4719-ad8b-ab32540371c2";
        const url = `https://api.hsforms.com/submissions/v3/integration/submit/${portalId}/${formId}`;

        try {
            const response = await fetch(url, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(payload),
            });

            if (!response.ok) {
                const errorText = await response.text();
                throw new Error(`HubSpot Error: ${errorText}`);
            }

            const result = await response.json();
            console.log("✅ Submission success:", result);
            alert(
                "✅ Thank you! Your enrollment has been submitted successfully."
            );
            form.reset();
        } catch (error) {
            console.error("❌ Submission error:", error);
            alert("❌ Oops! Something went wrong. Please try again later.");
        } finally {
            // Re-enable submission after complete (only if needed)
            // If you want to strictly block re-submission, comment the next line
            isSubmitting = false;
        }
    });
    const testimonialTrack = document.getElementById("testimonialTrack");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    let currentSlide = 0;
    const totalCards = document.querySelectorAll(".testimonial-card").length;

    function getCardsToShow() {
        if (window.innerWidth <= 768) {
            return 1;
        } else if (window.innerWidth <= 1024) {
            return 2;
        } else {
            return 3;
        }
    }

    function updateSlider() {
        const cardsToShow = getCardsToShow();
        const maxSlide = totalCards - cardsToShow;

        if (currentSlide > maxSlide) {
            currentSlide = maxSlide;
        }

        const cardWidth =
            testimonialTrack.querySelector(".testimonial-card").offsetWidth;
        const gap = 32;
        const offset = currentSlide * (cardWidth + gap);
        testimonialTrack.style.transform = `translateX(-${offset}px)`;
    }

    nextBtn.addEventListener("click", function () {
        const cardsToShow = getCardsToShow();
        const maxSlide = totalCards - cardsToShow;

        if (currentSlide < maxSlide) {
            currentSlide++;
            updateSlider();
        }
    });

    prevBtn.addEventListener("click", function () {
        if (currentSlide > 0) {
            currentSlide--;
            updateSlider();
        }
    });

    let resizeTimer;
    window.addEventListener("resize", function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            updateSlider();
        }, 250);
    });

    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -100px 0px",
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = "1";
                entry.target.style.transform = "translateY(0)";
            }
        });
    }, observerOptions);

    document
        .querySelectorAll(
            ".why-card, .program-card, .spec-card, .join-card, .schedule-card"
        )
        .forEach((card) => {
            card.style.opacity = "0";
            card.style.transform = "translateY(30px)";
            card.style.transition = "opacity 0.6s ease, transform 0.6s ease";
            observer.observe(card);
        });

    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                const offsetTop = target.offsetTop - 70;
                window.scrollTo({
                    top: offsetTop,
                    behavior: "smooth",
                });
            }
        });
    });
});

function enrollInProgram(programName) {
    const programSelect = document.getElementById("program");
    const options = Array.from(programSelect.options);

    const matchingOption = options.find(
        (option) => option.text.toLowerCase() === programName.toLowerCase()
    );

    if (matchingOption) {
        programSelect.value = matchingOption.value;
    }

    document.getElementById("enrollForm").scrollIntoView({
        behavior: "smooth",
        block: "center",
    });

    setTimeout(() => {
        document.getElementById("fullName").focus();
    }, 500);
}

//apply-now-button-code-on-nav-bar
document.getElementById("applyNowBtn").addEventListener("click", function () {
    const formSection = document.getElementById("mainEnrollmentForm");
    if (formSection) {
        formSection.scrollIntoView({ behavior: "smooth" });
    }
});

//web-3-forms-code
document
    .getElementById("contactForm")
    .addEventListener("submit", async function (e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);
        const responseEl = document.getElementById("formResponse");

        responseEl.textContent = "Sending...";

        try {
            const response = await fetch("https://api.web3forms.com/submit", {
                method: "POST",
                body: formData,
            });

            const result = await response.json();
            console.log(result); // 👈 See what Web3Forms says

            if (result.success) {
                responseEl.style.color = "green";
                responseEl.textContent =
                    "✅ Thank you! Your message has been sent successfully.";
                form.reset();
            } else {
                responseEl.style.color = "red";
                responseEl.textContent =
                    "❌ " +
                    (result.message ||
                        "Something went wrong. Please try again.");
            }
        } catch (error) {
            responseEl.style.color = "red";
            responseEl.textContent =
                "⚠️ Network error. Please check your internet connection.";
        }
    });

// limeted-time-offer
// Show popup after 5 seconds
window.addEventListener("load", () => {
    setTimeout(() => {
        document.getElementById("offerPopup").style.display = "flex";
    }, 5000);
});

// Close popup when clicking the close button
document.getElementById("offerClose").addEventListener("click", () => {
    document.getElementById("offerPopup").style.display = "none";
});

// Close popup when clicking outside the box
window.addEventListener("click", (e) => {
    const popup = document.getElementById("offerPopup");
    if (e.target === popup) {
        popup.style.display = "none";
    }
});
document.querySelector(".offer-btn").addEventListener("click", () => {
    document.getElementById("offerPopup").style.display = "none";
});
// limeted-time-offer-ends-here
