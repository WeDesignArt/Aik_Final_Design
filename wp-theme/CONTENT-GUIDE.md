# aik digital — WordPress Content Entry Guide

This is the page-by-page recipe for rebuilding each of the 10 static pages inside WordPress once the `aik-digital` theme (and ACF Pro) is active. For every page: create a new **Page**, set its title/slug to match the original file, then in the block editor add a **Page Sections** Flexible Content row for each section listed below, in the order given, and fill in the fields shown.

Notes that apply everywhere:
- Any field value written as `Spend **Smarter,** the **Halal** Way` means: type it exactly like that (with the `**`) — the theme automatically turns `**word**` into the yellow/highlighted span, so don't manually add HTML.
- "Image:" lines reference the original filename from `images/` in the old static site — just upload that same file from the project's `images/` folder when creating each page.
- Buttons/links that pointed to `javascript:void(0);` in the old site (i.e. not wired to a real destination yet) are noted as **(placeholder link — set the real URL)**.
- The 5 testimonials are the *same* 5 people on every page that has a Testimonials section — create them **once** as Testimonial posts (list at the bottom of this doc), then just pick them in the Testimonials layout's relationship field on each page.
- "News" sections pull from real WordPress Posts in a category — create a **News** category (Posts → Categories) and publish a post per news item, instead of typing them into the section fields. Don't use News for a fixed numbered-step section (like Debit Card's "How to Order") — use the **Steps** layout instead, which is built for exactly that and doesn't need any WordPress Posts.
- The Hero layout has 3 **Hero Style** options — always set this correctly or the page gets the wrong hero markup: `Standard` (Home only — heading + app mockup + pills), `Business` (Business page only — adds Subheading + 2 buttons), `Inner Page` (every other page — Debit Card, Deen, Payroll, Safa, Tijarat, Aghaaz, What's New, Connect — a shorter hero with just a centered heading over the background image). Inner Page also has an optional **Mobile Background Image** field; leave it blank to fall back to `bg-1.png` like the original site does on every one of these pages.
- Smarter Section has a **Bullet List Items** repeater (Item Heading + Item Text pairs) — use it instead of Description whenever a section says *"styled as a 'why choose' list"* or *"Key Features"* (marked below with a table of items to enter). It renders as a bulleted list with each item's heading highlighted in yellow, matching the original design — don't type the whole thing into the plain Description field, that only renders as a flat paragraph with the list formatting lost. Don't type a trailing colon on the heading, it's added automatically.
- **Extra CSS Class** accepts multiple space-separated classes (e.g. `why-choose-sec debit_custom_why-choose-sec`) — type them exactly like that, with a space between.
- Smarter Section's **Background Style** defaults to `Default` (the dark textured overlay seen on most sections). Only the sections explicitly marked `Background Style: None` or `Background Style: Custom Background Image` below need that field touched — everywhere else, leave it on the default.
- Smarter Section also has **Left Grid Decoration** / **Right Grid Decoration** selects (None / corner positions) for the small decorative grid graphics some sections have in the corners — only set these where explicitly noted below; most sections don't use them. These aren't fully audited for every section on every page yet — if a section in the original design has a `grid-left`/`grid-right` graphic that looks off after publishing, match its corner to what you see in the static `.html` file and set the corresponding select field.

---

## 1. Home (`index.html` → set as the site's Front Page under Settings → Reading)

**Section 1 — Hero**
- Heading: `The Smarter Way to Move **Your Money**`
- Background Image: `bg-1.png`
- Mobile Screenshot Image: `hero-app-mobile.png`
- Pill 1 Icon: `icon-arrow.svg` — Pill 1 Text: `Riba-free principles and protected by bank-grade`
- Pill 2 Icon: `icon-arrow.svg` — Pill 2 Text: `Utilities & Transfers all in one place`
- Show "No Interest" Banner: Yes — Image: `no-interest-light.png`

**Section 2 — Home About**
- Heading: `Experience a **borderless** **digital** wallet where Shariah compliance meets high **velocity banking**`
- Description: `Manage, spend, and grow your wealth with aik digital the future of the Halal economy in your pocket.`
- Button Text: `Read More` — Button Link: **(placeholder link)**

**Section 3 — Bento Grid**
- Heading: `Enjoy a **Better Payment** Experience`
- Cards (icon / image / title / description):
  1. `grid-icon-transfer.svg` / `grid-transfer.jpg` / **Instant Transfers** / "Send funds to friends, family, or bank accounts in seconds. Secure, seamless, and entirely hassle-free."
  2. `grid-icon-airtime.svg` / `grid-airtime.jpg` / **Easy Airtime** / "Never run out of talk time or data. Top up any network instantly, anytime, anywhere."
  3. `grid-icon-deen.svg` / `grid-deen.jpg` / **aik Deen** / "Experience Islamic banking at its finest with aik Deen — one-day Sharia-compliant financing crafted for your daily needs."
  4. `grid-icon-debit.svg` / `grid-debit.jpg` / **Debit Card** / "Manage your aik digital debit card with ease. Control spending limits."
  5. `grid-icon-bill.svg` / `grid-bill.jpg` / **Bill Payment** / "Pay all your utility bills in one place electricity, gas, water, internet, and more."
  6. `grid-icon-takaful.svg` / `grid-takaful.jpg` / **Takaful** / "Protect what matters most with Sharia-compliant Takaful insurance plans tailored to your lifestyle and needs."

**Section 4 — Smarter Section**
- Heading: `Spend **Smarter,** the **Halal** Way`
- Description: `Make every transaction more meaningful with aik digital. Whether you're shopping, paying bills, or managing daily expenses, our platform helps you stay in control with smart insights and seamless payments.`
- Image: `smarter-mobile-design.png` — Image Position: Right
- Buttons: `Physical Card` **(placeholder link)**, `Virtual Card` **(placeholder link)**
- Background Style: `Default` — Extra CSS Class: *(leave blank)*

**Section 5 — Driven Ethics**
- Label 1: `Driven by` — Heading 1: `Ethics`
- Label 2: `Led by` — Heading 2: `Innovation.`
- Background Image: `driven-innovation_bg.jpg`

**Section 6 — Testimonials**
- Heading: `Trusted by **Thousands**, **Perfected** for You.`
- Description: `Discover how aik digital is transforming the way people manage their finances with simplicity, security, and trust. Powered by aik deen, our users experience a seamless and Shariah-compliant financial journey designed for modern lifestyles.`
- Testimonials: pick all 5 (see list at bottom)

**Section 7 — App Download**
- Heading Line 1: `Download` — Heading Line 2: `App Now`
- Logo Image: `mob-app__section_logo.png`
- QR Code Image: `qr-download.jpg`
- Background Image: `mob-app__section_bg.jpg`

**Section 8 — News**
- Heading: `Our Media News`
- Description: `Stay informed with the latest updates, expert insights, and practical guides on digital finance and Islamic banking. From everyday money tips to Shariah-compliant financial knowledge, explore content designed to help you make smarter, more ethical financial decisions.`
- Category: News — Number of Posts: `3`
- (Publish 3 posts in the News category: "Ashfaque Ahmed highlights aik's mission to promote Riba-free digital banking in Pakistan.", "aik celebrates Independence Day with 14% cashback on all transactions.", "Mettis Global highlights aik as a game-changer in Pakistan's digital banking landscape." — with featured images `md-news-1.jpg`, `md-news-2.jpg`, `md-news-3.jpg`.)

---

## Testimonial posts to create once (Testimonials menu in wp-admin)

| Post Title (name) | Role | Rating | Headline | Quote |
|---|---|---|---|---|
| Ahmed Raza | Small Business Owner | 5 | A Truly Reliable Digital Banking Experience | aik digital has completely simplified how I manage my business transactions. Everything is fast, secure, and easy to use. What I appreciate most is the Shariah-compliant approach through aik deen it gives me peace of mind while handling my finances. |
| Sara Ali | Freelancer | 5 | Seamless & Hassle-Free Transfers | As a freelancer, I receive payments from multiple clients. aik digital makes it incredibly easy to track and manage every transaction without any hidden fees or complications. |
| Usman Khan | Startup Founder | 5 | Perfect for Modern Entrepreneurs | Running a startup means I need quick access to my finances. aik digital's intuitive dashboard and real-time notifications keep me informed at every step of the way. |
| Bilal Ahmed | Restaurant Owner | 5 | Fast & Smooth Everyday Banking | Managing daily cash flow for my restaurant used to be stressful. With aik digital, deposits and withdrawals are instant, and the interface is beautifully simple. |
| Ayesha Malik | Graphic Designer | 5 | Easy Invoice & Payment Tracking | I love how aik digital helps me track client invoices and payments all in one place. No more spreadsheets — everything is automated and crystal clear. |

*(These same 5 are reused wherever a Testimonials section appears in the pages below — no need to recreate them.)*

---

## 2. Debit Card (`debit-card.html`)

**Section 1 — Hero**
- Hero Style: `Inner Page` *(short, centered-heading hero used on this and the other inner pages below — leave Mobile Background Image blank, it falls back to bg-1.png)*
- Heading: `**aik** Debit **Card**`
- Background Image: `bg-1.png`

**Section 2 — Smarter Section**
- Extra CSS Class: `debit_custom_smarter-sec`
- Background Style: `None` *(this section has no dark overlay in the original — white background)*
- Left Grid Decoration: `Bottom Left` — Right Grid Decoration: `None`
- Heading: `Your Key to **Everyday Savings**`
- Description: `Unlock exclusive discounts on the things you love every single day. Why should you pay full price when you don't have to? The aik Card is built to help you save money instantly on your everyday spending. Whether you are dining out with your friends, taking care of your health and wellness, or shopping for your daily essentials, your aik Card brings premium rewards right to your fingertips. It is the simplest way to make your money go further without changing your lifestyle.`
- Image: `debit_card_main.png` — Image Position: Right

**Section 3 — Smarter Section** *(styled as a "why choose" list)*
- Extra CSS Class: `why-choose-sec debit_custom_why-choose-sec`
- Background Style: `Default` *(dark textured overlay)*
- Heading: `Why Choose the **aik Card?**`
- Bullet List Items (leave Description blank):
  | Item Heading | Item Text |
  |---|---|
  | Instant Savings at Checkout | There is no need to wait around for points to accumulate or for cash back to hit your account. You get real, immediate discounts directly at the register when you use your card. |
  | Categories That Matter | We partner with the businesses you actually use. Enjoy great deals on dining, cafes, healthcare, fitness, and many more categories. |
  | Seamless and Easy Experience | The card works smoothly wherever you spend. Just present your card at any of our partner merchants and watch your total bill drop instantly. |
- Image: `debit_aik_card.png` — Image Position: Left

**Section 4 — Steps (How-To / Order Process)** *(NOT the News layout — News pulls from real WordPress Posts and renders a date badge + "Read More" + "See More" archive link, which this section doesn't have. Steps is a separate layout for exactly this: a fixed, numbered set of cards you type directly.)*
- Heading: `How to **Order** Your **aik Card**`
- Description: `Getting your hands on an aik Card is quick, effortless, and completely digital. You do not need to fill out complicated paperwork or wait in long lines. You can complete the entire process in just a few minutes right from your smartphone.`
- Steps (image / title / description):
  1. `debit-card-1.png` / **Download & open the aik app** / "Log into your account or sign up on your mobile device."
  2. `debit-card-2.png` / **Request your card** / "Head over to the card section inside the app, review the details, and complete the quick ordering process."
  3. `debit-card-3.png` / **Start saving** / "Once your order is complete, you are ready to visit our partner locations, use your card, and enjoy instant savings on the spot."
- *(The numbered badge "01/02/03" and the alternating accent color on every other card are automatic — nothing to set per step for that.)*

**Section 5 — Smarter Section** *(text-only, background image, no side image)*
- Extra CSS Class: `custom-smarter-sec`
- Background Style: `Custom Background Image` — Background Image (Desktop): `debit_saving.png` — Background Image (Mobile): `debit_saving-mb.png`
- Heading: `Start **Saving** Today`
- Description: `Stop missing out on the discounts you deserve. Join the growing aik community today, download the app, and order your personalized card to unlock a smarter way to spend and save.`
- Image: *(leave blank — this section has no side image, it uses Background Image above instead)*

**Section 6 — Testimonials**
- Heading: `Trusted by **Thousands**, **Perfected** for You.`
- Description: `Discover how aik digital is transforming the way people manage their finances with simplicity, security, and trust. Powered by aik deen, our users experience a seamless and Shariah-compliant financial journey designed for modern lifestyles.`
- Testimonials: pick all 5 (see list above)

---

## 3. aik Deen (`deen.html`)

**Section 1 — Hero**
- Hero Style: `Inner Page`
- Heading: `**aik** Deen`
- Background Image: `aik-deen-bg.png`

**Section 2 — Smarter Section**
- Extra CSS Class: `debit_custom_smarter-sec`
- Heading: `Aligning **Your Finances** with Your Faith`
- Description: `Bring spiritual value to your daily routine without leaving your banking app. aik Deen is a comprehensive suite of Islamic lifestyle services built right into the aik digital banking app. Designed for all our users, it blends everyday financial convenience with essential spiritual tools, offering a truly holistic Islamic digital banking experience that supports your faith and your lifestyle.`
- Image: `deen-finance.png` — Image Position: Left

**Section 3 — Smarter Section**
- Extra CSS Class: `connect_custom_why-chose-sec deen-sec`
- Heading: `Core Features for Your **Daily** Spiritual **Journey**`
- Bullet List Items (leave Description blank):
  | Item Heading | Item Text |
  |---|---|
  | Digital Quran & Daily Quotes | Carry the Holy Quran with you wherever you go. Access clear digital text and find daily inspiration through beautifully curated Islamic quotes. |
  | Accurate Azaan Alerts & Islamic Calendar | Never miss a prayer with timely, location-based Azaan notifications. Stay perfectly aligned with important Islamic dates, holy days, and fasting times. |
  | Digital Tasbeeh & Live Streaming | Count your dhikr effortlessly with our simple digital Tasbeeh counter, and stay connected to holy sites with live streaming. |
  | Comprehensive Hajj & Umrah Guide | Access step-by-step guidance, essential checklists, and spiritual advice to help you prepare for your pilgrimage. |
- Image: `deen-feature.png` — Image Position: Left

**Section 4 — Smarter Section** *(text-only, background image)*
- Extra CSS Class: `custom-smarter-sec deen-smarter-sec connect_smarter-sec`
- Heading: `Financial Convenience Meets **Spiritual Value**`
- Description: `At aik, we believe your banking app should reflect who you are. With aik Deen, we have brought together all the essential tools of an Islamic lifestyle app and paired them with our modern digital banking features. This means you no longer need to switch between multiple apps to check your balance, pay bills, and track your daily spiritual goals. Everything you need to manage your day and your faith is now in one secure, unified space.`
- Image: *(leave blank — background-only: `deen_saving.png`)*

**Section 5 — Smarter Section**
- Extra CSS Class: `debit_custom_smarter-sec`
- Heading: `Experience a More **Meaningful Digital** Journey`
- Description: `Start enriching your daily routine today. Update or download the aik app, head over to the aik Deen section, and discover a smarter, more mindful way to connect your financial life with your spiritual goals.`
- Image: `deen_journey.png` — Image Position: Left

**Section 6 — Testimonials**
- Heading: `Trusted by **Thousands**, **Perfected** for You.`
- Description: `Discover how aik digital is transforming the way people manage their finances with simplicity, security, and trust. Powered by aik deen, our users experience a seamless and Shariah-compliant financial journey designed for modern lifestyles.`
- Testimonials: pick all 5 (see list above)

---

## 4. Payroll Solutions (`payroll-solution.html`)

**Section 1 — Hero**
- Hero Style: `Inner Page`
- Heading: `**Payroll** solutions`
- Background Image: `payroll-solution.png`

**Section 2 — Smarter Section**
- Extra CSS Class: `debit_custom_smarter-sec`
- Heading: `Streamline Your Business with **Corporate Payroll Solutions**`
- Description: `Simplify your workforce management and take the hassle out of payday. Our Payroll Solutions offer a robust, secure, and highly efficient system designed specifically for corporate clients. Whether you choose to automate disbursements through a backend integration or manage them manually via our dedicated Corporate Portal, you can ensure your team gets paid accurately and on time, every single time.`
- Image: `payroll-solution-frame.png` — Image Position: Left

**Section 3 — Smarter Section**
- Extra CSS Class: `connect_custom_why-chose-sec deen-sec`
- Heading: `Key Features of Our **Payroll System**`
- Bullet List Items (leave Description blank):
  | Item Heading | Item Text |
  |---|---|
  | Flexible Disbursement Options | Distribute employee salaries seamlessly by integrating our backend system directly into your internal HR software, or manage the entire process on your own terms using our user-friendly Corporate Portal. |
  | Robust and Secure Architecture | Protect your sensitive corporate financial information and employee data with top-tier security protocols, multi-factor authentication, and secure data pipelines. |
  | Scalable for Corporate Enterprises | Built to support high-volume transactions, our payroll platform smoothly accommodates your growing workforce. |
  | Instant, Mass Transfers | Disburse salaries across multiple employee bank accounts at the exact same time with just a few clicks. |
- Image: `payroll-system.png` — Image Position: Left

**Section 4 — Smarter Section** *(text-only, background image)*
- Extra CSS Class: `custom-smarter-sec deen-smarter-sec connect_smarter-sec`
- Heading: `Modernizing **Enterprise Salary** Management`
- Description: `Managing corporate payroll should not require juggling messy spreadsheets or dealing with manual banking delays. Our Payroll Solutions integrate into your existing business workflows, bridging the gap between your finance department and your team's bank accounts. By utilizing the dedicated Corporate Portal or a backend setup, your HR and finance teams can minimize human error, reduce administrative overhead, and enjoy transparent reporting and audit trails for every transaction.`
- Image: *(leave blank — background-only: `payroll-enterprise.png`)*

**Section 5 — Smarter Section**
- Extra CSS Class: `debit_custom_smarter-sec`
- Heading: `Optimize Your **Corporate Payroll** Today`
- Description: `Upgrade your business infrastructure with a payroll system built for speed, control, and reliability. Contact our corporate banking team today to set up your account or integrate our backend solutions into your ecosystem.`
- Image: `payroll-corporate.png` — Image Position: Right

**Section 6 — Testimonials**
- Heading: `Trusted by **Thousands**, **Perfected** for You.`
- Description: `Discover how aik digital is transforming the way people manage their finances with simplicity, security, and trust. Powered by aik deen, our users experience a seamless and Shariah-compliant financial journey designed for modern lifestyles.`
- Testimonials: pick all 5 (see list above)

---

## 5. Safa (`safa.html`)

**Section 1 — Hero**
- Hero Style: `Inner Page`
- Heading: `**Safa**`
- Background Image: `aghaaz-bg.png`

**Section 2 — Smarter Section**
- Extra CSS Class: `debit_custom_smarter-sec`
- Heading: `Financial **Freedom** and **Saving,** Designed for Women`
- Description: `Take complete control of your financial future with a platform built entirely around your lifestyle, goals, and family needs. Safa is a women-focused digital banking solution that combines everyday convenience with smart saving tools, secure insurance, and community rewards. It is designed to simplify how you manage, save, and grow your money, giving you the financial independence and peace of mind you deserve.`
- Image: `ahaaz-financial.png` — Image Position: Right

**Section 3 — Smarter Section**
- Extra CSS Class: `connect_custom_why-chose-sec deen-sec`
- Heading: `Key Features Built for Your **Financial Success**`
- Bullet List Items (leave Description blank):
  | Item Heading | Item Text |
  |---|---|
  | Asaan Digital / Bachat Account | Open a hassle-free digital savings account in just a few minutes right from your phone with minimal paperwork. |
  | Personalized Debit Cards & Transaction Rewards | Carry a debit card that reflects your style and earn transaction-based rewards and exclusive discounts. |
  | Digital Budgeting & Family Expense Tools | Track your monthly spending, set smart savings goals, and manage shared family expenses easily. |
  | Secure EFU Takaful Coverage | Safa includes trusted EFU Takaful insurance coverage for you and your loved ones. |
- Image: `aghaaz-featur1es.png` — Image Position: Left

**Section 4 — Smarter Section**
- Extra CSS Class: `debit_custom_smarter-sec`
- Heading: `A Smarter Way to **Manage Life** and **Money**`
- Description: `Safa is more than just a bank account; it is a financial companion designed to fit into your busy schedule. Whether you are managing a household budget, saving up for a major milestone, or organizing a community committee, Safa brings all these pieces together in one secure, elegant app interface. You no longer need separate spreadsheets or multiple apps to keep your family's finances aligned and protected.`
- Image: `aghaaz-life.png` — Image Position: Right

**Section 5 — Smarter Section** *(text-only, background image)*
- Extra CSS Class: `custom-smarter-sec deen-smarter-sec connect_smarter-sec`
- Heading: `Experience a More **Meaningful Digital** Journey`
- Description: `Start enriching your daily routine today. Update or download the aik app, head over to the aik Deen section, and discover a smarter, more mindful way to connect your financial life with your spiritual goals.`
- Image: *(leave blank — background-only: `aghaaz-journey.png`)*

**Section 6 — Testimonials**
- Heading: `Trusted by **Thousands**, **Perfected** for You.`
- Description: `Discover how aik digital is transforming the way people manage their finances with simplicity, security, and trust. Powered by aik deen, our users experience a seamless and Shariah-compliant financial journey designed for modern lifestyles.`
- Testimonials: pick all 5 (see list above)

---

## 6. aik Tijarat (`tijarat.html`)

**Section 1 — Hero**
- Hero Style: `Inner Page`
- Heading: `**aik** Tijarat`
- Background Image: `aik-tijarat-bg.png`

**Section 2 — Smarter Section**
- Extra CSS Class: `debit_custom_smarter-sec`
- Heading: `The Ultimate **Merchant App** for SMEs`
- Description: `Take your business operations to the next level with a digital platform built specifically for small and medium-sized enterprises (SMEs). aik Tijarat is a powerful merchant application designed to help business owners effortlessly manage their financial transactions and daily operations. By replacing manual paperwork with secure, efficient digital tools, aik Tijarat gives you everything you need to run, track, and scale your business right from your smartphone.`
- Image: `tijarat_frame.png` — Image Position: Left

**Section 3 — Smarter Section**
- Extra CSS Class: `connect_custom_why-chose-sec deen-sec`
- Heading: `Key Features to **Streamline** Your **Business** Operations`
- Bullet List Items (leave Description blank):
  | Item Heading | Item Text |
  |---|---|
  | Accept Digital Payments with Ease | Give your customers the freedom to pay digitally. |
  | Real-Time Sales & Transaction Tracking | Automatically log every incoming payment and view detailed transaction histories instantly. |
  | Effortless Cash Flow Management | Monitor your cash inflows and outflows in real time. |
  | Secure and Efficient Digital Tools | Advanced encryption and security protocols keep every payment and financial record secure. |
- Image: `tijarat_streamlined.png` — Image Position: Left

**Section 4 — Smarter Section** *(text-only, background image)*
- Extra CSS Class: `custom-smarter-sec deen-smarter-sec connect_smarter-sec`
- Heading: `Simplify Your Day-to-Day **Business Activities**`
- Description: `Running an SME comes with plenty of challenges, but managing your money shouldn't be one of them. aik Tijarat acts as a dedicated digital assistant for your storefront, office, or mobile business. By unifying payment acceptance, sales analytics, and cash flow monitoring into a single, intuitive interface, you can reduce administrative errors, save precious time, and focus entirely on what matters most — growing your customer base and expanding your business.`
- Image: *(leave blank — background-only: `tijarat_activities_bg.png`)*

**Section 5 — Smarter Section**
- Extra CSS Class: `debit_custom_smarter-sec`
- Heading: `Ready to **Digitize** Your **Business?**`
- Description: `Join thousands of modern merchants who are breaking free from manual record-keeping. Download the aik Tijarat app today, set up your merchant profile, and start experiencing a smarter, more secure way to manage your business operations.`
- Image: `tijarat_digitilise.png` — Image Position: Right

**Section 6 — Testimonials**
- Heading: `Trusted by **Thousands**, **Perfected** for You.`
- Description: `Discover how aik digital is transforming the way people manage their finances with simplicity, security, and trust. Powered by aik deen, our users experience a seamless and Shariah-compliant financial journey designed for modern lifestyles.`
- Testimonials: pick all 5 (see list above)

---

## 7. What's New (`whats_new.html`)

**Section 1 — Hero**
- Hero Style: `Inner Page`
- Heading: `**What's** New`
- Background Image: `bg-1.png` *(the original reuses the generic homepage background here — flag to the client that this page may want its own dedicated hero image)*

**Section 2 — Smarter Section**
- Extra CSS Class: `debit_custom_smarter-sec`
- Heading: `Introducing the **2.1.1 Release**`
- Description: `Upgrade your digital banking experience with our latest update. The 2.1.1 Release brings a massive wave of new features, smarter integrations, and enhanced security tools directly to your consumer app. From effortless investing and travel booking to specialized account types and proactive security, we are making it easier and safer than ever to manage your entire lifestyle in one single place.`
- Image: `new_release.png` — Image Position: Right

**Section 3 — Smarter Section**
- Extra CSS Class: `connect_custom_why-chose-sec deen-sec`
- Heading: `Discover the **Latest Features** and Enhancements`
- Description: `Smart Wealth Management with Mutual Funds (JSIL). Safa — Women-Focused Financial Space. Aghaaz — Minor Accounts for the Next Generation. Seamless Travel & Ticketing via Bookme. Integrated Protection with EFU and Web doc. Proactive Risk Scoring and Security Alerts.` *(6-item list — see full long-form copy for each item on request; once you have it, enter it as Bullet List Items like the other "Key Features" sections above, not as one Description block)*
- Image: `whats_new_features.png` — Image Position: Left

**Section 4 — Smarter Section**
- Extra CSS Class: `debit_custom_smarter-sec connect-sec-custom`
- Heading: `aik App. **Limitless Possibilities.**`
- Description: `The 2.1.1 Release transforms your digital wallet into a holistic lifestyle companion. By bridging the gap between traditional banking, smart investments, essential health protection, and travel planning, you no longer need to jump between multiple apps to get things done. We have unified your daily financial transactions, long-term saving goals, and family security needs into one smooth, beautifully designed interface.`
- Image: `whats_new_possiblities.png` — Image Position: Right

**Section 5 — Smarter Section** *(text-only, background image)*
- Extra CSS Class: `custom-smarter-sec deen-smarter-sec connect_smarter-sec`
- Heading: `Upgrade and Explore **Version 2.1.1** Today`
- Description: `Don't miss out on these powerful new tools. Head over to the Google Play Store or Apple App Store, update your aik app to the latest version, and start exploring a smarter way to manage your life and money.`
- Image: *(leave blank — background-only: `whats_new_journey.png`)*

**Section 6 — App Download**
- Heading Line 1: `Download` — Heading Line 2: `App Now`
- Logo Image: `mob-app__section_logo.png`
- QR Code Image: `qr-download.jpg`
- Background Image: `mob-app__section_bg.jpg`
- *Note: the original also has hidden (`d-none`) Google Play / Apple Store badges with placeholder `#` links — not shown live, nothing to enter unless the client wants store badges turned on.*

**Section 7 — Testimonials**
- Heading: `Trusted by **Thousands**, **Perfected** for You.`
- Description: `Discover how aik digital is transforming the way people manage their finances with simplicity, security, and trust. Powered by aik deen, our users experience a seamless and Shariah-compliant financial journey designed for modern lifestyles.`
- Testimonials: pick all 5 (see list above)

---

## 8. Aghaaz (`aghaaz.html`)

**Section 1 — Hero**
- Hero Style: `Inner Page`
- Heading: `**Aghaaz**`
- Background Image: `aghaaz-bg.png`

**Section 2 — Smarter Section**
- Extra CSS Class: `debit_custom_smarter-sec`
- Heading: `Building **Smart Financial Habits** for the **Next** Generation`
- Description: `Empower your children with the tools they need to navigate the financial world confidently. Aghaaz is a dedicated digital banking account designed for minors under the age of 18, opened easily by a parent or guardian. By introducing younger generations to digital money management early on, we drive financial inclusion while keeping safety at the absolute forefront. It is the perfect first step toward a lifetime of smart money choices.`
- Image: `ahaaz-financial.png` — Image Position: Right

**Section 3 — Smarter Section**
- Extra CSS Class: `connect_custom_why-chose-sec deen-sec`
- Heading: `Key Features Built for **Parents** and **Teens**`
- Bullet List Items (leave Description blank):
  | Item Heading | Item Text |
  |---|---|
  | Easy Parent-Managed Setup | Open your child's Aghaaz account directly from your own app interface with minimal fuss. |
  | Complete Parental Controls | View all account activity, set custom daily or monthly transaction limits, and manage spending permissions instantly. |
  | Personalized Debit Cards | Give your children a sense of independence and financial ownership. |
  | Full Spending Oversight | Receive real-time notifications whenever your child uses their card or app. |
- Image: `aghaaz-features.png` — Image Position: Left

**Section 4 — Smarter Section**
- Extra CSS Class: `debit_custom_smarter-sec`
- Heading: `A Smarter Way to **Manage Life** and **Money**`
- Description: `Aghaaz bridges the gap between trusting your children with money and keeping them secure. It gives teens the practical experience of managing a real budget, making digital payments, and understanding the value of money, while protecting them from overspending. Rather than relying on physical cash allowances, you can instantly transfer pocket money, monitor spending habits, and guide their financial learning experience in an environment you completely control.`
- Image: `aghaaz-life.png` — Image Position: Right

**Section 5 — Smarter Section** *(text-only, background image)*
- Extra CSS Class: `custom-smarter-sec deen-smarter-sec connect_smarter-sec`
- Heading: `Start Their **Financial Journey** Today`
- Description: `Give your children an early advantage in learning money management. Log into the aik app, navigate to the Aghaaz section, and open a minor account today to start their journey toward financial literacy.`
- Image: *(leave blank — background-only: `aghaaz-journey.png`)*

**Section 6 — Testimonials**
- Heading: `Trusted by **Thousands**, **Perfected** for You.`
- Description: `Discover how aik digital is transforming the way people manage their finances with simplicity, security, and trust. Powered by aik deen, our users experience a seamless and Shariah-compliant financial journey designed for modern lifestyles.`
- Testimonials: pick all 5 (see list above)

---

## 9. Business (`business.html`)

**Section 1 — Hero**
- Heading: `One Ecosystem. Infinite Commercial **Growth.**`
- Background Image: `bg-1.png`
- Hero Style: `Business` *(this reveals the Subheading + Button 1/2 fields and repositions the pills to match the design)*
- Subheading: `Scale your business with Pakistan's premium Shariah-compliant digital financial network.`
- Button 1 Text: `Get Started Digitally` — Button 1 Link: **(placeholder link)**
- Button 2 Text: `Speak to an Expert` — Button 2 Link: **(placeholder link)**
- Mobile Screenshot Image: `hero-business-app.png`
- Pill 1 Icon: `icon-arrow.svg` — Pill 1 Text: `Eliminate the friction of cash and expensive POS hardware.` *(renders top-right in Business style)*
- Pill 2 Icon: `icon-arrow.svg` — Pill 2 Text: `Achieve perfect operational visibility.` *(renders bottom-left in Business style)*

**Section 2 — Home About**
- Heading: `In a fast-evolving **digital economy,** modern enterprises shouldn't have to choose between **cutting-edge technology** and their core values.`
- Description: `aik digital provides an agile, Riba-free ecosystem where businesses can thrive without compromise.`
- Button Text: `Read More` — Button Link: **(placeholder link)**

**Section 3 — Bento Grid**
- Heading: `Enjoy a **Better Payment** Experience`
- Custom Grid Layout: `Yes` *(makes the 3rd card span full-width as a featured card, matching business.html — only used here since this page has exactly 3 cards)*
- Cards (icon / image / title / description):
  1. `business_icon_1.svg` / `business_card_1.jpg` / **Merchant Solutions** / "Empowering Your Storefront, Digitalizing Your Sales."
  2. `business_icon_2.svg` / `business_card_2.png` / **Enterprise Solutions** / "Industrial-Grade Infrastructure for High-Volume Scale."
  3. `business_icon_3.svg` / `business_card_3.jpg` / **Financial Wellness & Retention** / "Investing in the People Behind the Progress."

**Section 4 — Smarter Section** *(text-only, background image)*
- Extra CSS Class: `custom-smarter-sec`
- Heading: `Smart Banking. **Pure Values.**`
- Description: `Step into the future of ethical commerce. Optimize your corporate cash flow, disburse high-volume payments instantly, and experience seamless, Riba-free business settlements. Transform your checkout experience with instant QR payments that eliminate the hassle of physical cash and expensive hardware — allowing your business to accept secure, contactless transactions from any banking app, built entirely on Shariah-compliant principles.`
- Image: *(leave blank — background-only: `bs-smarter-bg.png`)*

**Section 5 — Driven Ethics** ⚠️ *hidden on the original site (`d-none` class) — confirm with the client whether it should go live here*
- Label 1: `Banking That Moves With You` — Heading 1: *(none — this variant only has a title + two short taglines, doesn't map cleanly to the Driven Ethics fields; simplest is: Label 1 = "No Queues. No Paperwork.", Heading 1 = "Just Tap", Label 2 = "", Heading 2 = "and go.")*
- Background Image: `business_bg_tap_and_go.png`

**Section 6 — Testimonials**
- Heading: `Trusted by **Thousands**, **Perfected** for You.`
- Description: `Discover how aik digital is transforming the way people manage their finances with simplicity, security, and trust. Powered by aik Deen, our users experience a seamless and Shariah-compliant financial journey designed for modern lifestyles.`
- Testimonials: pick all 5 (see list above)

**Section 7 — App Download**
- Heading Line 1: `Download` — Heading Line 2: `App Now`
- Logo Image: `mob-app__section_logo.png`
- QR Code Image: `qr-download.jpg`
- Background Image: `mob-app__section_bg.jpg`

**Section 8 — News**
- Heading: `Our Media News`
- Description: `Stay informed with the latest updates, expert insights, and practical guides on digital finance and Islamic banking. From everyday money tips to Shariah-compliant financial knowledge, explore content designed to help you make smarter, more ethical financial decisions.`
- Category: News — Number of Posts: `3` *(same 3 News posts created for the Home page)*

---

## 10. aik Connect (`connect.html`)

**Section 1 — Hero**
- Hero Style: `Inner Page`
- Heading: `**aik** Connect`
- Background Image: `aik-connect-bg.png`

**Section 2 — Smarter Section**
- Extra CSS Class: `debit_custom_smarter-sec connect-sec-custom`
- Heading: `Welcome to **aik Connect**`
- Description: `Smarter Open Banking for Modern Business. Discover the power of truly connected financial operations. aik Connect is a fully independent vertical built to give corporate businesses the freedom, speed, and security of modern open banking APIs. By separating our advanced connectivity tools from standard business banking, we ensure your enterprise has a dedicated space to build, integrate, and scale seamlessly.`
- Image: `conect_frame.png` — Image Position: Right

**Section 3 — Smarter Section**
- Extra CSS Class: `connect_custom_why-chose-sec`
- Heading: `Why Choose **aik Connect?**`
- Bullet List Items (leave Description blank):
  | Item Heading | Item Text |
  |---|---|
  | Dedicated Open Banking Ecosystem | A separate, specialized vertical designed explicitly for advanced open banking integrations and secure data sharing. |
  | Tailored for Corporate Businesses & Merchants | Built to handle the high volume, complex workflows, and strict security standards modern enterprise operations require. |
  | Seamless Shariah Compliant Financial Connectivity | Effortlessly bridge the gap between your internal software and essential banking networks. |
- Image: `connect_features.png` — Image Position: Left

**Section 4 — Smarter Section** *(text-only, background image)*
- Extra CSS Class: `custom-smarter-sec connect_smarter-sec`
- Heading: `Experience a **Dedicated Integration** Space`
- Description: `We understand that open banking demands a reliable, standalone environment. By placing aik Connect under its own dedicated open banking framework, we give your development and product teams the focus they need to launch features faster. You can manage APIs, oversee financial data pipelines, and scale your connectivity without the clutter of a traditional corporate banking setup.`
- Image: *(leave blank — background-only: `connect_saving.png`)*

**Section 5 — Partner Inquiry Form**
- Heading: `Ready to **Transform** Your **Financial** Operations?`
- Subtext: `Take control of your data, simplify your integrations, and see what a dedicated open banking vertical can do for your organization. Partner with aik Connect today to build the future of your corporate business infrastructure.`
- *(The form fields themselves — Name, Email, Mobile, Company, Service, Message, consent checkbox — are fixed in the theme, nothing to configure.)*

**Section 6 — App Download**
- Heading Line 1: `Download` — Heading Line 2: `App Now`
- Logo Image: `mob-app__section_logo.png`
- QR Code Image: `qr-download.jpg`
- Background Image: `mob-app__section_bg.jpg`

**Section 7 — Testimonials**
- Heading: `Trusted by **Thousands**, **Perfected** for You.`
- Description: `Discover how aik digital is transforming the way people manage their finances with simplicity, security, and trust. Powered by aik deen, our users experience a seamless and Shariah-compliant financial journey designed for modern lifestyles.`
- Testimonials: pick all 5 (see list above)

---

## Flags for the client / dev team (from the source content, not something to fix silently)
- `business.html`'s Driven Ethics section is currently hidden (`d-none`) on the old site — confirm whether it should appear on the new page.
- The Business-page hero now has a "Hero Style: Business" option (subheading + 2 buttons + repositioned pills) — see Section 1 above. The Debit Card page's 3-step "How to Order" section now has its own dedicated "Steps" layout (see Section 4 above) instead of misusing the News layout.
- Minor content inconsistencies in the original (casing of "deen"/"Deen", a missing space in one heading, a couple of misspelled image filenames like `conect_frame.png`) were preserved as-is above; clean them up during entry if desired, they don't need to be reproduced.
