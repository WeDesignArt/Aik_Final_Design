// EN/UR toggle: swaps text from data-en/data-ur attributes, flips <html dir>
// for RTL. No content duplication in the DOM, no page reload. Elements
// without a data-ur (most of the site, until the client sends Urdu copy)
// just keep showing English when "ur" is selected.
// ponytail: layout stays LTR-shaped even in RTL (only text direction flips)
// -- full pixel mirroring (hero, footer grid, icon order) is deferred until
// real Urdu content shows what actually needs it.
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
    document.documentElement.lang = lang === "ur" ? "ur" : "en";

    // No blanket dir="rtl" on <html>/<body> -- almost none of the site is
    // translated yet, and forcing RTL direction onto still-English text
    // flips its punctuation/reading order (the classic ",Trusted by
    // Thousands" bug). Only the elements that actually HAVE Urdu text
    // right now get flipped, via .is-ur below; everything else (the vast
    // majority, until real content arrives) stays untouched.
    document.querySelectorAll("[data-en]").forEach(function (el) {
      var usingUrdu = lang === "ur" && el.dataset.ur;
      el.textContent = usingUrdu ? el.dataset.ur : el.dataset.en;
      el.classList.toggle("is-ur", !!usingUrdu);
    });

    // Same idea for images: <img data-src-en="..." data-src-ur="...">
    // swaps its src, for sections that need a different graphic in Urdu
    // (e.g. text baked into the image itself).
    document.querySelectorAll("[data-src-en]").forEach(function (el) {
      el.src = (lang === "ur" && el.dataset.srcUr) ? el.dataset.srcUr : el.dataset.srcEn;
    });

    document.querySelectorAll(".lang-toggle__btn").forEach(function (btn) {
      btn.classList.toggle("is-active", btn.dataset.lang === lang);
    });
  }

  document.addEventListener("DOMContentLoaded", function () {
    applyLang(getStoredLang());

    document.querySelectorAll(".lang-toggle__btn").forEach(function (btn) {
      btn.addEventListener("click", function () {
        setStoredLang(btn.dataset.lang);
        applyLang(btn.dataset.lang);
      });
    });
  });
})();
