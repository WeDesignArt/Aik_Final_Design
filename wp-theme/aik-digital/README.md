# aik digital — WordPress theme

Custom WordPress theme built from the static aik digital site, driven by **ACF Pro Flexible Content**.

## Requirements
- WordPress (recent version)
- **ACF Pro** plugin, active, before you activate this theme (so the field groups in `acf-json/` import automatically)

## Install
1. Zip the `aik-digital` folder itself (so the zip's top level is `aik-digital/`, not its contents loose).
2. In wp-admin: **Plugins → Add New → Upload Plugin**, install & activate **Advanced Custom Fields PRO** first (with your license key under ACF → Updates).
3. **Appearance → Themes → Add New → Upload Theme**, upload the zip, then **Activate**.
   - (Alternative: FTP/SFTP the `aik-digital` folder into `wp-content/themes/` directly, then activate from Appearance → Themes.)
4. Go to **Custom Fields → Field Groups** and confirm you see: *Page Sections*, *Footer & Social Settings*, *Testimonial Details*. If they don't appear automatically, use the "Sync" button ACF shows next to each — this pulls them in from the theme's `acf-json/` folder.
5. **Appearance → Menus** — create a menu, add your pages, assign it to the "Primary Menu" location.
6. **Theme Settings** (in the wp-admin sidebar) — fill in footer About text, Quick/Feature/Useful links, social URLs, app store URLs, copyright name.
7. Create the 10 pages and populate their **Page Sections** field following `wp-theme/CONTENT-GUIDE.md` in this repo.
8. **Settings → Reading** — set "Your homepage displays" to a static page, and choose the Home page as the front page.
9. **Posts → Categories** — add a "News" category, then publish news posts into it (used by the News section's query).
10. **Testimonials** (wp-admin sidebar) — add the 5 testimonial posts listed in `CONTENT-GUIDE.md`.

## What's editable vs. structural
- Editable per-page: everything under **Page Sections** on each Page.
- Editable site-wide: **Theme Settings** (footer/social) and the **Primary Menu**.
- Structural (theme code, not meant to be edited in wp-admin): header/off-canvas menu markup, search drawer, footer layout, the Partner Inquiry Form's field list (`template-parts/blocks/pif_form.php` — only its heading/subtext are ACF fields; submissions post to `inc/forms.php` and are saved under **Partner Inquiries**).

## Manual QA checklist after install
- [ ] Preloader logo animation plays once on page load, then reveals the page
- [ ] Off-canvas menu opens/closes (hamburger icon top-left)
- [ ] Search drawer opens on the search icon, closes on Esc/backdrop/close button
- [ ] Testimonials slider auto-plays and swipes on mobile widths
- [ ] Footer columns collapse into an accordion under 768px width
- [ ] Partner Inquiry Form (connect page) submits and redirects back with a confirmation message; the submission appears under **Partner Inquiries**
- [ ] Newsletter form in the footer submits without a PHP error
