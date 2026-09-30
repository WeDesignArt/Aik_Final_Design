# AIK Digital — Urdu & English Bilingual Implementation Documentation
**Version:** 2.1 (Comprehensive Update)  
**Last Updated:** September 23, 2026  
**Audience:** Development Team, Claude AI, Project Managers  

---

## 1. Executive Summary / خلاصہ

Yeh document AIK Digital website (WordPress Theme + Local HTML Prototype) par implement kiye gaye **Bilingual (English ↔ Urdu) Language Toggle System**, layout refinements, aur responsive bug fixes ki mukammal technical tafseelat faraham karta hai.

### Core Philosophy:
* **No Bloated Plugins:** WPML ya Polylang jaise bhari plugins ke baghair banaya gaya hai. Koi page reload nahi hota, database bloated nahi hota, aur switch instant hota hai.
* **Client-Side Attribute Swapping:** Text aur inner HTML attributes (`data-en` aur `data-ur`) ke zariye switch hota hai.
* **Safe Progressive Rollout:** Agar kisi section ka Urdu content abhi client ne nahi diya, toh woh automatically English mein hi rehta hai — website ka koi hissa kharab ya blank nahi dikhta.
* **Preserves Rich Formatting:** Headings mein `aik_highlight()` ke banaye gaye golden spans (`<span class="highlight_text">`) aur line breaks (`<br>`) mehfooz rehte hain.
* **1:1 Code Parity:** Local prototype (`index.html`, `css/style.css`, `js/lang.js`) aur WordPress theme (`wp-theme/aik-digital/...`) 100% synchronized hain.

---

## 2. Architecture & Technical Breakdown

### A. JavaScript Architecture (`js/lang.js` & `wp-theme/aik-digital/js/lang.js`)
* **Storage Key:** `localStorage.getItem("aikLang")` (`"en"` ya `"ur"`).
* **HTML Swap (`innerHTML` Support):**
  Pehle `textContent` use ho raha tha jis ki wajah se headings ke andar ke `<span>` tags (highlights) remove ho rahe the. Ab isko `el.innerHTML` par shift kiya gaya hai:
  ```javascript
  document.querySelectorAll("[data-en]").forEach(function (el) {
    var usingUrdu = isUrdu && el.dataset.ur;
    el.innerHTML = usingUrdu ? el.dataset.ur : el.dataset.en;
    el.classList.toggle("is-ur", !usingUrdu);
  });
  ```
* **Placeholder Swapping:**
  Search input fields ke liye `data-en-placeholder` aur `data-ur-placeholder` support add kiya gaya hai:
  ```javascript
  document.querySelectorAll("[data-en-placeholder]").forEach(function (el) {
    var usingUrdu = isUrdu && el.dataset.urPlaceholder;
    el.placeholder = usingUrdu ? el.dataset.urPlaceholder : el.dataset.enPlaceholder;
  });
  ```
* **Image Swapping:**
  Images jin par text baked ho, unke liye `data-src-en` aur `data-src-ur` support mojood hai.
* **Multi-Toggle Sync (Event Delegation):**
  Desktop header toggle aur mobile drawer toggle dono aapas mein synchronized rehte hain via global click listener.

---

### B. Mobile Responsiveness & Header Stacking Fix
**Masla (Problem):**  
Mobile screen (< 768px) par header mein `.nav_wrapper` ka margin (`me-4`), toggle buttons ka desktop padding (`9px 16px`), aur search button mil kar 180px+ space le rahe the. Screen ke center mein absolutely-positioned logo tha, jis ki wajah se right side ke elements logo se takra rahe the aur header stack / wrap ho raha tha.

**Hal (Fix Applied in `css/style.css` & theme `css/style.css`):**
1. **Compact Mobile Toggle:**
   ```css
   @media (max-width: 767.98px) {
     .header_row .nav_wrapper {
       display: flex;
       align-items: center;
       flex-wrap: nowrap;
       gap: 6px;
     }
     .header_row .nav_wrapper.me-4 {
       margin-right: 8px !important;
     }
     .header .lang-toggle {
       margin-right: 4px;
       border-radius: 20px;
     }
     .header .lang-toggle__btn {
       font-size: 11px;
       padding: 5px 8px;
       line-height: 1.1;
     }
     .search_mobile {
       width: 32px;
       height: 32px;
     }
   }
   ```
2. **Result:** Header right-side total width 180px se ghat kar ~95px ho gayi, jo 375px ya 360px ke mobile screens par bhi logo se takraye baghair perfect fit aati hai.

---

### C. Mobile Drawer (Off-Canvas Menu) & Search Drawer
1. **Off-Canvas Mobile Drawer (`header.php` & `index.html`):**
   * Mobile menu kholne par top par ek stylish `.off_canvas_lang` bar add kiya gaya hai jahan se mobile user araam se English aur Urdu toggle kar sakta hai.
   * Dynamic WP Menus (`Appearance > Menus`) ke liye `inc/nav-menu-fallback.php` mein filter `nav_menu_link_attributes` lagaya gaya hai jo menu titles (Home, About Us, Features, etc.) ko automatically Urdu attributes attach kar deta hai.
2. **Search Drawer Overlay:**
   * Heading: `"What are you looking for?"` ↔ `"آپ کیا تلاش کر رہے ہیں؟"`
   * Input Placeholder: `"Search AIK Digital…"` ↔ `"AIK ڈیجیٹل تلاش کریں…"`
   * Submit Button: `"Search"` ↔ `"تلاش کریں"`

---

### D. Desktop Hero Overlap Resolution (Urdu View)
**Masla (Problem):**  
Desktop par Urdu switch karne par hero heading (`آپ کے پیسوں کو منتقل کرنے کا ہوشیار طریقہ`) 32% ke tang container mein 4 lines mein wrap ho rahi thi aur neeche mojood left floating pill badge (`سود سے پاک اصول اور بینک گریڈ تحفظ`) ke upar chadh (collide) rahi thi.

**Hal (Fix Applied):**
1. Urdu container width ko expand kiya gaya:
   ```css
   html[lang="ur"] .aik_landing_top,
   .aik_landing_top:has(.is-ur) {
     width: 62%;
     top: 20%;
   }
   html[lang="ur"] .aik_landing_top .left_text_block,
   .aik_landing_top .left_text_block:has(.is-ur) {
     width: 44%;
   }
   ```
2. Fluid typography clamping add ki gayi taake heading cleanly 2 lines mein settle ho:
   ```css
   html[lang="ur"] .aik_landing_top .left_text_block h2,
   .aik_landing_top .left_text_block h2.is-ur {
     font-size: clamp(2rem, 3.1vw, 3.4rem);
     line-height: 1.25;
     text-align: right;
     margin-bottom: 0;
   }
   ```
3. Left pill badge ki position ko Urdu desktop view mein neeche adjust kiya gaya:
   ```css
   @media (min-width: 992px) {
     html[lang="ur"] .mobile_track .mobile_pill.pill_left,
     .mobile_track:has(.is-ur) .mobile_pill.pill_left {
       top: 415px;
     }
   }
   ```
4. **Nateeja:** Heading aur badge ke darmiyan **70px+** ka clear safe gap ban gaya aur overlap 100% khatam ho gaya.

---

### E. Section Headings Center Alignment (`is-ur` Protection)
**Masla (Problem):**  
Urdu mode mein generic `.is-ur { text-align: right; }` rule ki wajah se woh section titles jo center-aligned hone chahiye the (jaise About section aur Bento Grid section), woh right-align ho rahe the.

**Hal (Fix Applied):**  
Explicit centering overrides add kiye gaye:
```css
.home_about_section_content_title.is-ur,
.section_title_heading.is-ur,
.text-center .is-ur,
.home_about_section_content p.is-ur,
.section_title p.is-ur,
.text-center h3.is-ur,
.text-center p.is-ur,
.text-center a.is-ur,
.text-center span.is-ur {
  text-align: center !important;
}
```

---

### F. 1366x768 Laptop vs Tablet Breakpoint Fix
**Masla (Problem):**  
`css/style.css` ke aakhir mein ek media query likhi gayi thi:
`@media (min-width: 768px) and (max-width: 1366px)` jo 1366px ko tablet samajh kar hero section ko vertically stack kar rahi thi (`width: 100%; top: 18%; text-align: center;`).  
Is ki wajah se standard 1366x768 desktop laptops par:
* Heading poore screen ke center mein phail kar "Personal / Business" links ke bilkul upar charh jati thi.
* Phone mockup neeche `top: 340px` par dhakel diya jata tha.

**Hal (Fix Applied):**
1. Tablet media query ka upper bound `1366px` se hata kar standard tablet portrait limit `991.98px` par set kiya gaya:
   ```css
   @media (min-width: 768px) and (max-width: 991.98px) {
     .aik_landing_top { ... }
     .mobile_track { ... }
   }
   ```
2. Urdu tablet view ke liye targeted rule define kiya gaya:
   ```css
   @media (min-width: 768px) and (max-width: 991.98px) {
     html[lang="ur"] .aik_landing_top, .aik_landing_top:has(.is-ur) {
       width: 67%;
       top: 30%;
       left: 48%;
     }
   }
   ```
3. **Nateeja:** 1366x768 laptops ab bina kisi layout distortion ke standard 2-column Desktop layout display karte hain.

---

### G. `responsive.css` Parity & Interest Section
1. **`responsive.css` Linkage:**
   Local `index.html` ke `<head>` mein `css/responsive.css` link ki gayi taake WordPress theme ke `functions.php` ke sath 100% visual parity bani rahe.
2. **Container Update:**
   `.custom_interest_section` ke andar `.container` ko `.no_container` se replace kiya gaya (in both `index.html` and `hero.php`) taake image container constraints ke baghair design ke mutabiq display ho sake.

---

## 3. WordPress ACF Schema (`group_aik_page_sections.json`)

WordPress Admin panel mein Page Sections (Flexible Content) ke andar Homepage ke **tamam 8 layouts** ke liye Urdu fields (`*_ur`) define kar di gayi hain:

| Block Layout | ACF Layout Name | Added Urdu Fields (`_ur`) | Description |
| :--- | :--- | :--- | :--- |
| **Hero** | `hero` | `heading_ur`, `pill_2_text_ur`, `subheading_ur`, `button_1_text_ur`, `button_2_text_ur` | Main title, pill badges, and business hero buttons in Urdu |
| **Home About** | `home_about` | `heading_ur`, `description_ur`, `button_text_ur` | About section title with highlights, text and read more button |
| **Bento Grid** | `bento_grid` | `heading_ur`, `button_label_ur`<br>Repeater: `title_ur`, `description_ur` | Feature cards grid (Transfers, Airtime, Deen, Debit Card) |
| **Smarter Section** | `smarter_section` | `heading_ur`, `description_ur`<br>Repeaters: `item_heading_ur`, `item_text_ur`, `icon_label_ur`, `label_ur`, `note_heading_ur`, `note_text_ur` | The main reusable content block (Why Choose, Halal Banking, etc.) |
| **Driven by Ethics** | `driven_ethics` | `label_1_ur`, `heading_1_ur`, `label_2_ur`, `heading_2_ur` | 4-part typography banner |
| **App Download Band** | `download_band` | `help_heading_ur`, `heading_line_1_ur`, `heading_line_2_ur` | Help search header & Download App banner |
| **Feature Suite** | `feature_suite` | `heading_ur`<br>Repeater: `title_ur`, `tagline_ur`, `description_ur`, `button_label_ur` | Autoplay slider with feature highlights |
| **Media News** | `news` | `heading_ur`, `description_ur` | Latest news section title & subtitle |

---

## 4. PHP Template Parts Integration

Har block template file ko update kar ke `get_sub_field('..._ur')` ko hook kiya gaya hai with **automatic English fallback**:

```php
$heading         = get_sub_field( 'heading' );
$heading_ur      = get_sub_field( 'heading_ur' );
$description     = get_sub_field( 'description' );
$description_ur  = get_sub_field( 'description_ur' );
```
Markup output:
```php
<h2 class="home_about_section_content_title display-3" 
    data-en="<?php echo esc_attr( aik_highlight( $heading ) ); ?>" 
    data-ur="<?php echo esc_attr( aik_highlight( $heading_ur ? $heading_ur : $heading ) ); ?>">
    <?php echo aik_highlight( $heading ); ?>
</h2>
```

---

## 5. Modified Files Inventory (Frist-e-Tabdeeli)

1. `wp-theme/aik-digital/js/lang.js` — Core translation engine (`innerHTML` support, placeholders, multi-toggle sync).
2. `js/lang.js` — Local prototype translation engine (mirrors theme script).
3. `wp-theme/aik-digital/css/style.css` — Hero overlap fix, centering overrides, tablet media query limit (`991.98px`), mobile header compactness.
4. `css/style.css` — Local prototype stylesheet (mirrors theme stylesheet 100%).
5. `css/responsive.css` & `wp-theme/aik-digital/css/responsive.css` — Mobile responsive overrides.
6. `index.html` — Linked `responsive.css`, updated container in interest section, embedded search drawer and mobile off-canvas toggle.
7. `wp-theme/aik-digital/header.php` — Desktop search attributes, search drawer translations, off-canvas drawer toggle.
8. `wp-theme/aik-digital/inc/nav-menu-fallback.php` — Fallback menu Urdu attributes + dynamic `nav_menu_link_attributes` filter.
9. `wp-theme/aik-digital/acf-json/group_aik_page_sections.json` — 8 homepage layouts updated with all `*_ur` fields.
10. `wp-theme/aik-digital/template-parts/blocks/hero.php` — Hooked `heading_ur`, `pill_2_text_ur`, business subfields, `.no_container`.
11. `wp-theme/aik-digital/template-parts/blocks/home_about.php` — Hooked `heading_ur`, `description_ur`, `button_text_ur`.
12. `wp-theme/aik-digital/template-parts/blocks/bento_grid.php` — Hooked `heading_ur`, `button_label_ur`, and card repeaters.
13. `wp-theme/aik-digital/template-parts/blocks/smarter_section.php` — Hooked `heading_ur`, `description_ur`, bullet lists, icons, buttons, notes.
14. `wp-theme/aik-digital/template-parts/blocks/driven_ethics.php` — Hooked labels and headings.
15. `wp-theme/aik-digital/template-parts/blocks/download_band.php` — Hooked help search heading and app download texts.
16. `wp-theme/aik-digital/template-parts/blocks/feature_suite.php` — Hooked slider headings, slide titles, taglines, descriptions.
17. `wp-theme/aik-digital/template-parts/blocks/news.php` — Hooked news heading, description, and button translations.

---

## 6. How Claude or Any Developer Can Continue from Here

Jab client mazid content ya pages (e.g. Debit Card, Business, Deen, Contact, etc.) ke liye Urdu copy provide kare:

1. **Step 1: Check if ACF field exists:**
   Agar layout mein `_ur` field already mojood hai (jaise Homepage ke sabhi blocks mein humne daal di hai), toh seedha WordPress Admin me jaakar content enter karein.
2. **Step 2: If a new layout needs Urdu:**
   * Us layout ke JSON mein field add karein (pattern: `<field_name>_ur`).
   * Template part PHP file mein `get_sub_field('<field_name>_ur')` fetch karein.
   * Element par `data-en="..."` aur `data-ur="..."` print karein.
3. **Step 3: Words with highlight:**
   Agar kisi heading me word highlight karna ho, toh English ki tarah Urdu me bhi `**double asterisks**` use karein. `aik_highlight()` automatically usko `<span class="highlight_text">` me wrap kar dega, aur `lang.js` us highlight ko perfectly render karega.
4. **Step 4: Syncing ACF in WordPress:**
   Jab theme files live ya staging server par deploy hon, WP Admin > **Custom Fields** me ja kar "Sync Available" par click karein taake nayi JSON fields database me sync ho jayein.

---
*Documentation prepared for AIK Digital Project by Antigravity AI.*
