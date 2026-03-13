const electives = {
    "professional-certification": [
        "Blockchain Technology Programme",
        "Artificial Intelligence Programme",
        "Data Analysis Training Course",
        "Python Web Development Course",
        "Property Management Programme",
        "Design Engineering Programme",
        "Biomedical Engineering Programme",
        "Chemical Engineering Programme",
        "Mechatronics Engineering Programme",
        "Petroleum Engineering Programme",
        "Quantity Surveying Engineering Programme",
        "Electrical Vehicle Engineering Course",
        "Oracle Financial Programme",
        "Digital Marketing With AI",
        "Cyber Security With AI",
    ],

    "qualification-programs": [
        "Foundation Diploma in Accountancy – UK Level 3",
        "Diploma in Education & Training – UK Level 3",
        "Diploma in Higher Education Studies – UK Level 3",
        "Diploma in Accounting and Business – UK Level 4",
        "Diploma in Education & Training – UK Level 4",
        "Diploma in Accounting and Business – UK Level 5",
    ],
};

document.addEventListener("DOMContentLoaded", function () {
    const mobileToggle = document.getElementById("mobileToggle");
    const navMenu = document.getElementById("navMenu");
    const navbar = document.getElementById("navbar");
    const programSelect = document.getElementById("program");
    const electiveSelect = document.getElementById("elective");
    const applicationForm = document.getElementById("applicationForm");
    const faqQuestions = document.querySelectorAll(".faq-question");
    const testimonialTrack = document.getElementById("testimonialTrack");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    let currentSlide = 0;
    const totalSlides = document.querySelectorAll(".testimonial-card").length;

    mobileToggle.addEventListener("click", function () {
        mobileToggle.classList.toggle("active");
        navMenu.classList.toggle("active");
    });

    navMenu.querySelectorAll("a").forEach((link) => {
        link.addEventListener("click", function () {
            mobileToggle.classList.remove("active");
            navMenu.classList.remove("active");
        });
    });

    window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });

    programSelect.addEventListener("change", function () {
        const selectedProgram = this.value;
        electiveSelect.innerHTML = '<option value="">Select Elective</option>';

        if (selectedProgram && electives[selectedProgram]) {
            electives[selectedProgram].forEach((elective) => {
                const option = document.createElement("option");
                option.value = elective.toLowerCase().replace(/\s+/g, "-");
                option.textContent = elective;
                electiveSelect.appendChild(option);
            });
        }
    });

    applicationForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        // Collect all the field values
        const fullName = document.getElementById("fullName").value.trim();
        const email = document.getElementById("email").value.trim();
        const phone =
            document.getElementById("phoneCode").value +
            document.getElementById("phone").value.trim();
        const whatsapp =
            document.getElementById("whatsappCode").value +
            document.getElementById("whatsapp").value.trim();
        const program = document.getElementById("program").value;
        const elective = document.getElementById("elective").value;
        const country = document.getElementById("country").value;
        const coupon = document.getElementById("coupon").value.trim();

        // Create HubSpot submission payload
        const formData = {
            fields: [
                { name: "firstname", value: fullName },
                { name: "email", value: email },
                { name: "phone", value: phone },
                { name: "whatsapp_number", value: whatsapp },
                { name: "select_program", value: program },
                { name: "select_elective", value: elective },
                { name: "country", value: country },
                { name: "college_nama", value: coupon },
            ],
        };

        try {
            const response = await fetch(
                "https://api.hsforms.com/submissions/v3/integration/submit/243954796/f904be25-35c1-4f13-83b1-969e5a65d078",
                {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(formData),
                }
            );

            if (response.ok) {
                alert("✅ Application submitted successfully!");
                applicationForm.reset();
                document.getElementById("elective").innerHTML =
                    '<option value="">Select Elective</option>';
            } else {
                const errorText = await response.text();
                console.error("HubSpot error:", errorText);
                alert("⚠️ Submission failed. Please try again later.");
            }
        } catch (err) {
            console.error("Network error:", err);
            alert("⚠️ Network error. Please try again later.");
        }
    });

    faqQuestions.forEach((question) => {
        question.addEventListener("click", function () {
            const faqItem = this.parentElement;
            const isActive = faqItem.classList.contains("active");

            document.querySelectorAll(".faq-item").forEach((item) => {
                item.classList.remove("active");
            });

            if (!isActive) {
                faqItem.classList.add("active");
            }
        });
    });

    function updateSlider() {
        const offset = -currentSlide * 100;
        testimonialTrack.style.transform = `translateX(${offset}%)`;
    }

    nextBtn.addEventListener("click", function () {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlider();
    });

    prevBtn.addEventListener("click", function () {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlider();
    });

    setInterval(function () {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlider();
    }, 5000);

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
            ".feature-card, .course-card, .stat-card, .different-item"
        )
        .forEach((el) => {
            el.style.opacity = "0";
            el.style.transform = "translateY(30px)";
            el.style.transition = "opacity 0.6s ease, transform 0.6s ease";
            observer.observe(el);
        });

    const statNumbers = document.querySelectorAll(".stat-number");
    const statsObserver = new IntersectionObserver(
        function (entries) {
            entries.forEach((entry) => {
                if (
                    entry.isIntersecting &&
                    !entry.target.classList.contains("counted")
                ) {
                    entry.target.classList.add("counted");
                    animateNumber(entry.target);
                }
            });
        },
        { threshold: 0.5 }
    );

    statNumbers.forEach((stat) => {
        statsObserver.observe(stat);
    });

    function animateNumber(element) {
        const text = element.textContent;
        const hasPlus = text.includes("+");
        const hasPercent = text.includes("%");
        const number = parseInt(text.replace(/\D/g, ""));

        if (isNaN(number)) return;

        let current = 0;
        const increment = number / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= number) {
                current = number;
                clearInterval(timer);
            }
            element.textContent =
                Math.floor(current).toLocaleString() +
                (hasPlus ? "+" : "") +
                (hasPercent ? "%" : "");
        }, 30);
    }

    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                const offsetTop = target.offsetTop - 80;
                window.scrollTo({
                    top: offsetTop,
                    behavior: "smooth",
                });
            }
        });
    });
});
