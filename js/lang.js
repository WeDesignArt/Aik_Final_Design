// EN/UR toggle: swaps text and innerHTML from data-en/data-ur attributes.
// Supports innerHTML (for highlight spans), input placeholders, and images.
// Toggles .is-ur only on translated elements to keep layout and un-translated copy intact.
(function () {
  "use strict";
  var STORAGE_KEY = "aikLang";

  function getStoredLang() {
    try {
      return localStorage.getItem(STORAGE_KEY) === "ur" ? "ur" : "en";
    } catch (e) {
      return "en";
    }
  }

  function setStoredLang(lang) {
    try {
      localStorage.setItem(STORAGE_KEY, lang);
    } catch (e) {}
  }

  function applyLang(lang) {
    var isUrdu = lang === "ur";
    document.documentElement.lang = isUrdu ? "ur" : "en";

    // Swap text and innerHTML preserving formatting like <span class="highlight_text">
    document.querySelectorAll("[data-en]").forEach(function (el) {
      var usingUrdu = isUrdu && el.dataset.ur;
      el.innerHTML = usingUrdu ? el.dataset.ur : el.dataset.en;
      el.classList.toggle("is-ur", !!usingUrdu);
    });

    // Swap input placeholders
    document.querySelectorAll("[data-en-placeholder]").forEach(function (el) {
      var usingUrdu = isUrdu && el.dataset.urPlaceholder;
      el.placeholder = usingUrdu ? el.dataset.urPlaceholder : el.dataset.enPlaceholder;
      el.classList.toggle("is-ur", !!usingUrdu);
    });

    // Swap images with language variants
    document.querySelectorAll("[data-src-en]").forEach(function (el) {
      el.src = (isUrdu && el.dataset.srcUr) ? el.dataset.srcUr : el.dataset.srcEn;
    });

    // Sync all toggle buttons on the page (header, drawer, etc.)
    document.querySelectorAll(".lang-toggle__btn").forEach(function (btn) {
      btn.classList.toggle("is-active", btn.dataset.lang === lang);
    });
  }

  function init() {
    applyLang(getStoredLang());

    // Event delegation so all toggle buttons (including off-canvas drawer) work reliably
    document.addEventListener("click", function (e) {
      var btn = e.target.closest(".lang-toggle__btn");
      if (!btn || !btn.dataset.lang) return;
      var newLang = btn.dataset.lang;
      setStoredLang(newLang);
      applyLang(newLang);
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
