document.querySelectorAll(".custom-carousel").forEach((carousel) => {
    const track = carousel.querySelector(".carousel-track");
    const cards = carousel.querySelectorAll(".course-card");
    const prevBtn = carousel.querySelector(".nav-arrow.left");
    const nextBtn = carousel.querySelector(".nav-arrow.right");

    let index = 0;

    function updateCarousel() {
        cards.forEach((card) => card.classList.remove("active"));
        cards[index].classList.add("active");

        const gap = 30;
        const cardWidth = cards[0].offsetWidth + gap;
        track.style.transform = `translateX(${-index * cardWidth}px)`;
    }

    nextBtn.addEventListener("click", () => {
        index = (index + 1) % cards.length;
        updateCarousel();
    });

    prevBtn.addEventListener("click", () => {
        index = (index - 1 + cards.length) % cards.length;
        updateCarousel();
    });

    updateCarousel();
});

document.addEventListener("DOMContentLoaded", () => {
    const activeUsersEl = document.getElementById("activeUsers");

    if (!activeUsersEl) {
        console.error("Element #activeUsers not found");
        return;
    }

    function generateActiveUsers() {
        const minUsers = 120;
        const maxUsers = 350;
        return Math.floor(Math.random() * (maxUsers - minUsers + 1)) + minUsers;
    }

    function updateActiveUsers() {
        const newValue = generateActiveUsers();
        activeUsersEl.textContent = newValue.toLocaleString();
    }

    // Initial load
    updateActiveUsers();

    // Update every 2–3 minutes
    setInterval(updateActiveUsers, 600000);
});
