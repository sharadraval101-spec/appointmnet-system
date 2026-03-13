// =================== FAQ DROPDOWN ===================
document.querySelectorAll(".faq-item").forEach(item => {
    item.addEventListener("click", () => {
        document.querySelectorAll(".faq-item").forEach(el => {
            if (el !== item) {
                el.classList.remove("active");
                const icon = el.querySelector(".icon");
                if (icon) icon.textContent = "+";
            }
        });
        item.classList.toggle("active");
        const icon = item.querySelector(".icon");
        if (icon) icon.textContent = item.classList.contains("active") ? "−" : "+";
    });
});


// =================== ABOUT US COUNTERS ===================
const counters = document.querySelectorAll(".counter");
if (counters.length > 0) {
    counters.forEach(counter => {
        counter.innerText = "0";

        const updateCounter = () => {
            const target = +counter.getAttribute("data-target");
            const current = +counter.innerText;
            const increment = target / 200;

            if (current < target) {
                counter.innerText = `${Math.ceil(current + increment)}`;
                setTimeout(updateCounter, 20);
            } else {
                counter.innerText = target;
            }
        };

        updateCounter();
    });
}


// =================== CLIENT FEEDBACK SLIDER ===================
const container = document.querySelector(".client_feedback_container");
const leftBtn = document.querySelector(".left_btn");
const rightBtn = document.querySelector(".right_btn");

if (container && leftBtn && rightBtn) {
    leftBtn.addEventListener("click", () => {
        container.scrollBy({ left: -300, behavior: "smooth" });
    });

    rightBtn.addEventListener("click", () => {
        container.scrollBy({ left: 300, behavior: "smooth" });
    });
}


// =================== GSAP ANIMATIONS ===================
if (typeof gsap !== "undefined") {
    // Hero section text fade + slide
    if (document.querySelector(".service_container_part1_heading_text h2")) {
        gsap.from(".service_container_part1_heading_text h2", {
            y: 50,
            opacity: 0,
            duration: 1,
            ease: "power3.out"
        });
    }

    if (document.querySelector(".service_container_part1_small_text p")) {
        gsap.from(".service_container_part1_small_text p", {
            y: 30,
            opacity: 0,
            duration: 1,
            delay: 0.3,
            ease: "power3.out"
        });
    }

    if (document.querySelector(".book-appointment-contact button")) {
        gsap.from(".book-appointment-contact button", {
            scale: 0.8,
            opacity: 0,
            duration: 0.8,
            delay: 0.6,
            ease: "back.out(1.7)"
        });
    }

    if (document.querySelector(".service_container_part_2 img")) {
        gsap.from(".service_container_part_2 img", {
            x: 100,
            opacity: 0,
            duration: 1,
            ease: "power2.out"
        });
    }

    if (document.querySelector(".service_container_part_4")) {
        gsap.from(".service_card", {
            scrollTrigger: {
                trigger: ".service_container_part_4",
                start: "top 80%",
                toggleActions: "play none none reset"
            },
            y: 50,
            opacity: 0,
            stagger: 0.2,
            duration: 0.8,
            ease: "power3.out"
        });
    }
}

// HERO SECTION
gsap.from(".main-text-heading h1", {
    y: 50,
    opacity: 0,
    duration: 1,
    ease: "power3.out"
});

gsap.from(".small-text", {
    y: 30,
    opacity: 0,
    delay: 0.3,
    duration: 1,
    ease: "power3.out"
});

gsap.from(".book-appointment-contact", {
    scale: 0.8,
    opacity: 0,
    delay: 0.6,
    duration: 0.8,
    ease: "back.out(1.7)"
});

gsap.from(".contant-img-main img", {
    x: 100,
    opacity: 0,
    duration: 1,
    ease: "power2.out"
});

// DENTAL INFO CARDS
gsap.from(".info-page", {
    scrollTrigger: {
        trigger: ".our-dental-info",
        start: "top 80%"
    },
    y: 50,
    opacity: 0,
    stagger: 0.2,
    duration: 0.8,
    ease: "power3.out"
});

// PATIENTS MEET SECTION
gsap.from(".about-meet-text-heading h2", {
    scrollTrigger: {
        trigger: ".patients-to-meet",
        start: "top 80%"
    },
    x: -50,
    opacity: 0,
    duration: 1,
    ease: "power3.out"
});

gsap.from(".patients-meet-sec-2 img", {
    scrollTrigger: {
        trigger: ".patients-to-meet",
        start: "top 80%"
    },
    x: 50,
    opacity: 0,
    duration: 1,
    ease: "power3.out"
});

// CHOOSE TREATMENT LIST
gsap.from(".choose_treatment_list li", {
    scrollTrigger: {
        trigger: ".choose_tratment",
        start: "top 80%"
    },
    x: -30,
    opacity: 0,
    stagger: 0.15,
    duration: 0.6,
    ease: "power2.out"
});

// VIDEO SECTION
gsap.from(".video_heading h2, .video_small_text p", {
    scrollTrigger: {
        trigger: ".main_video_contant",
        start: "top 85%"
    },
    y: 40,
    opacity: 0,
    stagger: 0.2,
    duration: 0.8,
    ease: "power3.out"
});

gsap.from(".video_player iframe", {
    scrollTrigger: {
        trigger: ".main_video_contant",
        start: "top 80%"
    },
    scale: 0.8,
    opacity: 0,
    duration: 1,
    ease: "back.out(1.7)"
});

// HERO ANIMATION
gsap.from(".hero h1", {
    y: 50,
    opacity: 0,
    duration: 1,
    ease: "power3.out"
});

gsap.from(".hero p", {
    y: 30,
    opacity: 0,
    delay: 0.3,
    duration: 1,
    ease: "power3.out"
});

// ABOUT SECTION
gsap.from(".about h2, .about p", {
    scrollTrigger: {
        trigger: ".about",
        start: "top 80%"
    },
    y: 40,
    opacity: 0,
    stagger: 0.2,
    duration: 0.8,
    ease: "power2.out"
});

// DOCTORS
gsap.from(".doctor-card", {
    scrollTrigger: {
        trigger: ".doctors",
        start: "top 80%"
    },
    y: 60,
    opacity: 0,
    stagger: 0.2,
    duration: 0.9,
    ease: "back.out(1.7)"
});

// SERVICES
gsap.from(".service", {
    scrollTrigger: {
        trigger: ".services",
        start: "top 80%"
    },
    scale: 0.8,
    opacity: 0,
    stagger: 0.2,
    duration: 0.8,
    ease: "back.out(1.7)"
});

// STATS COUNTER
const counter = document.querySelectorAll(".counter");
const speed = 200; // lower is faster

counter.forEach(counter => {
    let started = false;
    ScrollTrigger.create({
        trigger: counter,
        start: "top 85%",
        onEnter: () => {
            if (!started) {
                started = true;
                const updateCount = () => {
                    const target = +counter.getAttribute("data-target");
                    const count = +counter.innerText;
                    const increment = target / speed;

                    if (count < target) {
                        counter.innerText = Math.ceil(count + increment);
                        setTimeout(updateCount, 20);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCount();
            }
        }
    });
});

// CTA
gsap.from(".cta h2, .cta p, .cta button", {
    scrollTrigger: {
        trigger: ".cta",
        start: "top 80%"
    },
    y: 40,
    opacity: 0,
    stagger: 0.2,
    duration: 0.8,
    ease: "power3.out"
});

//search bar 

document.getElementById("userSearch").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#userTable tbody tr");

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        if (text.includes(filter)) {
            row.style.display = "";
        } else {
            row.style.display = "none";

        }
    });
});

//   Dashboard Count 

document.querySelectorAll('.count').forEach(el => {
    const target = parseInt(el.dataset.target || el.textContent || 0, 10);
    let current = 0;
    const duration = 800;
    const stepTime = Math.max(12, Math.floor(duration / (target || 1)));
    const step = () => {
        current += Math.ceil(target / (duration / stepTime));
        if (current >= target) {
            el.textContent = target;
        } else {
            el.textContent = current;
            requestAnimationFrame(step);
        }
    };
    requestAnimationFrame(step);
});