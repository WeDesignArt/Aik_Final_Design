(function () {
  "use strict";

  var MOBILE_BP = 991;

  function initPeDeck() {
    var deck = document.getElementById("peDeck");
    if (!deck || typeof gsap === "undefined") return;

    var cards = Array.from(deck.querySelectorAll(".pe-card"));
    var isAnimating = false;

    function isMobile() {
      return window.innerWidth <= MOBILE_BP;
    }

    /* ── desktop: width helpers ────────────────────────── */
    function getWidths() {
      var dw = deck.offsetWidth;
      var ew = Math.round(dw * 0.555);
      var cw = Math.round((dw - ew) / (cards.length - 1));
      return { expanded: ew, collapsed: cw };
    }

    /* ── mobile: height helpers ────────────────────────── */
    function getHeights() {
      return {
        expanded: window.innerWidth <= 767 ? 340 : 380,
        collapsed: 60,
      };
    }

    /* ── border-radius: curved away from the active card ── */
    function updateBorderRadius() {
      var activeIdx = cards.findIndex(function (c) {
        return c.classList.contains("pe-card--active");
      });
      cards.forEach(function (card, idx) {
        if (idx === activeIdx) {
          card.style.borderRadius = "0";
        } else if (isMobile()) {
          /* vertical stack: round bottom of card above active, top of card below */
          card.style.borderRadius =
            idx < activeIdx ? "0 0 8px 8px" : "8px 8px 0 0";
        } else {
          /* horizontal row: round the outer edge away from active card */
          card.style.borderRadius =
            idx < activeIdx ? "8px 0 0 8px" : "0 8px 8px 0";
        }
      });
    }

    /* ── set dimensions & opacity ──────────────────────── */
    function applyInitialState() {
      if (isMobile()) {
        var h = getHeights();
        cards.forEach(function (card) {
          var a = card.classList.contains("pe-card--active");
          gsap.set(card, {
            height: a ? h.expanded : h.collapsed,
            clearProps: "width",
          });
          gsap.set(card.querySelector(".pe-card__expanded"), {
            opacity: a ? 1 : 0,
            pointerEvents: a ? "auto" : "none",
          });
          gsap.set(card.querySelector(".pe-card__collapsed"), {
            opacity: a ? 0 : 1,
          });
        });
      } else {
        var w = getWidths();
        cards.forEach(function (card) {
          var a = card.classList.contains("pe-card--active");
          gsap.set(card, {
            width: a ? w.expanded : w.collapsed,
            clearProps: "height",
          });
          gsap.set(card.querySelector(".pe-card__expanded"), {
            opacity: a ? 1 : 0,
            pointerEvents: a ? "auto" : "none",
          });
          gsap.set(card.querySelector(".pe-card__collapsed"), {
            opacity: a ? 0 : 1,
          });
        });
      }
      updateBorderRadius();
    }

    /* ── animate to new active card ────────────────────── */
    function activate(target) {
      if (isAnimating || target.classList.contains("pe-card--active")) return;
      isAnimating = true;

      var prev = deck.querySelector(".pe-card--active");
      var tl = gsap.timeline({
        onComplete: function () {
          isAnimating = false;
        },
      });

      if (isMobile()) {
        var h = getHeights();
        /* collapse prev */
        tl.to(
          prev.querySelector(".pe-card__expanded"),
          { opacity: 0, duration: 0.18, ease: "power2.out" },
          0,
        );
        tl.to(
          prev,
          { height: h.collapsed, duration: 0.5, ease: "power3.inOut" },
          0,
        );
        tl.to(
          prev.querySelector(".pe-card__collapsed"),
          { opacity: 1, duration: 0.22 },
          0.25,
        );
        /* expand target */
        tl.to(
          target.querySelector(".pe-card__collapsed"),
          { opacity: 0, duration: 0.18, ease: "power2.out" },
          0,
        );
        tl.to(
          target,
          { height: h.expanded, duration: 0.5, ease: "power3.inOut" },
          0,
        );
        tl.to(
          target.querySelector(".pe-card__expanded"),
          { opacity: 1, duration: 0.25 },
          0.28,
        );
        /* text fade-up animation */
        tl.fromTo(
          target.querySelector(".pe-card__text"),
          { y: 30, opacity: 0 },
          { y: 0, opacity: 1, duration: 0.9, ease: "power2.out" },
          0.35,
        );
      } else {
        var w = getWidths();
        /* collapse prev */
        tl.to(
          prev.querySelector(".pe-card__expanded"),
          { opacity: 0, duration: 0.18, ease: "power2.out" },
          0,
        );
        tl.to(
          prev,
          { width: w.collapsed, duration: 0.55, ease: "power3.inOut" },
          0,
        );
        tl.to(
          prev.querySelector(".pe-card__collapsed"),
          { opacity: 1, duration: 0.22 },
          0.28,
        );
        /* expand target */
        tl.to(
          target.querySelector(".pe-card__collapsed"),
          { opacity: 0, duration: 0.18, ease: "power2.out" },
          0,
        );
        tl.to(
          target,
          { width: w.expanded, duration: 0.55, ease: "power3.inOut" },
          0,
        );
        tl.to(
          target.querySelector(".pe-card__expanded"),
          { opacity: 1, duration: 0.25 },
          0.32,
        );
        /* text fade-up animation */
        tl.fromTo(
          target.querySelector(".pe-card__text"),
          { y: 30, opacity: 0 },
          { y: 0, opacity: 1, duration: 0.9, ease: "power2.out" },
          0.4,
        );
      }

      /* swap state classes & toggle icons immediately */
      prev.classList.remove("pe-card--active");
      prev.classList.add("pe-card--inactive");
      prev.querySelector(".pe-card__toggle i").className = "bi bi-plus-lg";
      gsap.set(prev.querySelector(".pe-card__expanded"), {
        pointerEvents: "none",
      });

      target.classList.remove("pe-card--inactive");
      target.classList.add("pe-card--active");
      target.querySelector(".pe-card__toggle i").className = "bi bi-dash-lg";
      gsap.set(target.querySelector(".pe-card__expanded"), {
        pointerEvents: "auto",
      });

      /* update corner rounding: curve away from the new active card */
      updateBorderRadius();
    }

    /* ── bind clicks ───────────────────────────────────── */
    cards.forEach(function (card) {
      card.addEventListener("click", function () {
        activate(this);
      });
    });

    /* ── init & resize ─────────────────────────────────── */
    applyInitialState();

    var resizeTimer;
    window.addEventListener("resize", function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(applyInitialState, 150);
    });
  }

  /* ── Trusted Partners Marquee ──────────────────── */
  function initPartnersMarquee() {
    var track = document.getElementById("partnersTrack");
    if (!track || typeof gsap === "undefined") return;

    var halfW = track.scrollWidth / 2;

    gsap.to(track, {
      x: -halfW,
      duration: halfW / 60 /* ~60 px/s — adjust for speed */,
      ease: "none",
      repeat: -1 /* seamless: at -halfW content = content at 0 */,
    });

    /* pause on hover */
    track.addEventListener("mouseenter", function () {
      gsap.globalTimeline.pause();
    });
    track.addEventListener("mouseleave", function () {
      gsap.globalTimeline.resume();
    });
  }

  if (document.readyState === "complete") {
    initPeDeck();
    initPartnersMarquee();
  } else {
    window.addEventListener("load", function () {
      initPeDeck();
      initPartnersMarquee();
    });
  }
})();

// ========================================
// SWIPER INITIALIZATION
// ========================================
const testimonialSwiper = new Swiper("#testimonialSwiper", {
  // Slides per view
  slidesPerView: 1,

  // Space between cards
  spaceBetween: 24,

  // Loop infinitely
  loop: true,

  // Auto play - medium speed
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
    pauseOnMouseEnter: true,
  },

  // Transition speed (ms) - medium
  speed: 800,

  // Smooth easing
  autoplayDisableOnInteraction: false,

  // Dots / Pagination
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: false,
  },

  // Responsive Breakpoints
  breakpoints: {
    // Mobile
    0: {
      slidesPerView: 1,
      spaceBetween: 16,
    },

    // Tablet
    576: {
      slidesPerView: 1.5,
      spaceBetween: 20,
    },

    // Small Laptop
    768: {
      slidesPerView: 2,
      spaceBetween: 24,
    },

    // Desktop - 3 cards like image
    1024: {
      slidesPerView: 3,
      spaceBetween: 28,
    },

    // Large Desktop
    1280: {
      slidesPerView: 3,
      spaceBetween: 32,
    },
  },
});

// Media News — prev/next nav buttons use their own class (.md-news-swiper__nav--prev/--next)
// instead of Swiper's default .swiper-button-prev/-next, so no CSS is ever
// written against Swiper's own classes.
//
// Initialized on window "load" (not immediately at script-parse time) so
// Swiper measures slide widths only after post thumbnails have finished
// loading and the layout has settled — with exactly enough posts to fill
// slidesPerView (e.g. 3 posts at slidesPerView:3) there's nothing to slide
// to, so a premature/wrong width measurement stays invisible; add a 4th
// post and it suddenly needs to actually translate the wrapper, which is
// when a stale measurement shows up as overlapping/misaligned slides.
// observer/observeParents make Swiper re-measure automatically if the
// container's size still changes after that (AOS animations, late-loading
// images) as extra insurance on top of waiting for "load".
function aikInitMdNewsSwiper() {
  if ( ! document.getElementById( "mdNewsSwiper" ) ) return;

  const mdNewsSwiper = new Swiper("#mdNewsSwiper", {
    slidesPerView: 3,
    spaceBetween: 24,
    observer: true,
    observeParents: true,
    loop: true,

    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },

    navigation: {
      nextEl: ".md-news-swiper__nav--next",
      prevEl: ".md-news-swiper__nav--prev",
    },

    breakpoints: {
      // Mobile
      0: {
        slidesPerView: 1,
        spaceBetween: 16,
      },

      // Tablet
      576: {
        slidesPerView: 1.2,
        spaceBetween: 20,
      },

      // Small Laptop
      768: {
        slidesPerView: 2,
        spaceBetween: 24,
      },

      // Desktop
      1024: {
        slidesPerView: 3,
        spaceBetween: 28,
      },
    },
  });
}

if ( document.readyState === "complete" ) {
  aikInitMdNewsSwiper();
} else {
  window.addEventListener( "load", aikInitMdNewsSwiper );
}

// "Explore Our Feature Suite" slider — one slide fully visible at a time,
// autoplays every 7s, drag/swipe with mouse or touch, mousewheel also
// steps a slide (mousewheel module is already part of the bundled
// vendor.js Swiper build, same as the other Swiper instances on this
// page). Same window "load" + observer pattern as aikInitMdNewsSwiper for
// the same reason — measuring slide width before images/AOS have settled
// is invisible with few slides and only shows up as broken later.
function aikInitFeatureSuiteSwiper() {
  if ( ! document.getElementById( "featureSuiteSwiper" ) ) return;

  new Swiper( "#featureSuiteSwiper", {
    slidesPerView: 1,
    loop: true,
    observer: true,
    observeParents: true,
    grabCursor: true,

    autoplay: {
      delay: 7000,
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },

    mousewheel: {
      forceToAxis: true,
    },

    speed: 700,

    pagination: {
      el: ".feature-suite-swiper__pagination",
      clickable: true,
    },
  } );
}

if ( document.readyState === "complete" ) {
  aikInitFeatureSuiteSwiper();
} else {
  window.addEventListener( "load", aikInitFeatureSuiteSwiper );
}
