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
// written against Swiper's own classes. Guarded with a null-check since not
// every page that loads this script has a Media News section.
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
// page). The feature_suite ACF layout can be added more than once per
// page, each rendering its own #featureSuiteSwiper{N} id and scoped
// .feature-suite-swiper__pagination inside it — looping over every
// .feature-suite-swiper on the page (rather than one hard-coded id, like
// aikInitMdNewsSwiper uses) initializes each instance independently with
// its own pagination instead of every instance fighting over one.
function aikInitFeatureSuiteSwipers() {
  document.querySelectorAll( ".feature-suite-swiper" ).forEach( function ( el ) {
    new Swiper( el, {
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

      // Desktop keeps every slide stretched to a shared height (matches
      // .feature-suite-slide's flex/align-items:center CSS, so a shorter
      // slide's content still sits centered in a uniform-height box). On
      // mobile that same fixed height is just the tallest slide's height
      // applied to ALL of them — a short slide shows a big empty gap
      // below its content and pushes the next section down with it.
      // autoHeight makes the slider container resize to match only the
      // currently active slide, which is what removes that gap; it's
      // scoped to <769px (same breakpoint the CSS already uses) so
      // desktop's intentional uniform-height look is untouched.
      breakpoints: {
        0: {
          autoHeight: true,
        },
        769: {
          autoHeight: false,
        },
      },

      pagination: {
        el: el.querySelector( ".feature-suite-swiper__pagination" ),
        clickable: true,
      },
    } );
  } );
}

if ( document.readyState === "complete" ) {
  aikInitFeatureSuiteSwipers();
} else {
  window.addEventListener( "load", aikInitFeatureSuiteSwipers );
}

// ========================================
// AJAX FORM SUBMISSIONS (Partner Inquiry / Feedback)
// Submits via fetch() instead of a normal browser POST, so there's no
// page reload — the button shows a loading state, then the success/error
// message replaces the form's fields in the same spot (no more tiny alert
// text buried under the button). inc/recaptcha.php's aik_recaptcha_script()
// tags the <form> with data-recaptcha-site-key/-field when reCAPTCHA v3 is
// configured; a fresh token is fetched right before each submit if so.
// Both handlers in inc/forms.php respond with wp_send_json_success()/
// wp_send_json_error(), i.e. {success:true|false, data:{message:"..."}}.
// ========================================
function aikGetRecaptchaToken( form ) {
  var siteKey = form.dataset.recaptchaSiteKey;
  if ( ! siteKey || typeof grecaptcha === "undefined" ) {
    return Promise.resolve( "" );
  }
  return new Promise( function ( resolve ) {
    grecaptcha.ready( function () {
      grecaptcha.execute( siteKey, { action: "submit" } ).then( resolve );
    } );
  } );
}

function aikBindAjaxForm( formId, alertClass, fieldsClass ) {
  var form = document.getElementById( formId );
  if ( ! form ) return;

  var alertBox = form.querySelector( "." + alertClass );
  var fieldsWrap = form.querySelector( "." + fieldsClass );
  var submitBtn = form.querySelector( 'button[type="submit"]' );
  var submitLabel = submitBtn ? submitBtn.textContent : "";

  function showAlert( message, isSuccess ) {
    if ( ! alertBox ) return;
    alertBox.textContent = message;
    alertBox.className = alertClass + " " + ( isSuccess ? "is-success" : "is-error" );
  }

  function resetButton() {
    if ( ! submitBtn ) return;
    submitBtn.disabled = false;
    submitBtn.textContent = submitLabel;
  }

  form.addEventListener( "submit", function ( e ) {
    e.preventDefault();

    // Native "required"/type validation still applies — submit was always
    // prevented above so the browser never got a chance to check on its
    // own, checkValidity()+reportValidity() run that same check by hand
    // and show the normal validation bubble UI on whatever's invalid.
    if ( ! form.checkValidity() ) {
      form.reportValidity();
      return;
    }

    if ( submitBtn ) {
      submitBtn.disabled = true;
      submitBtn.textContent = "Submitting...";
    }

    aikGetRecaptchaToken( form ).then( function ( token ) {
      var recaptchaFieldId = form.dataset.recaptchaField;
      if ( recaptchaFieldId ) {
        var recaptchaField = document.getElementById( recaptchaFieldId );
        if ( recaptchaField ) recaptchaField.value = token;
      }

      fetch( form.getAttribute( "action" ), {
        method: "POST",
        body: new FormData( form ),
        credentials: "same-origin",
      } )
        .then( function ( response ) {
          return response.json();
        } )
        .then( function ( json ) {
          var message = json.data && json.data.message ? json.data.message : "";
          showAlert( message, !! json.success );
          if ( json.success ) {
            if ( fieldsWrap ) fieldsWrap.style.display = "none";
          } else {
            resetButton();
          }
        } )
        .catch( function () {
          showAlert( "Something went wrong, please try again.", false );
          resetButton();
        } );
    } );
  } );
}

document.addEventListener( "DOMContentLoaded", function () {
  aikBindAjaxForm( "partnerInquiryForm", "pif-alert", "pif-card__fields" );
  aikBindAjaxForm( "feedbackForm", "fb-alert", "fb-card__fields" );
} );
