<?php
/**
 * Footer: newsletter strip + aik-footer body. Column links, social links,
 * badges and copyright text come from the ACF "Theme Settings" options
 * page, with sensible fallbacks so the footer still looks right before an
 * editor fills those fields in.
 */

$about_text   = get_field( 'footer_about_text', 'option' );
$quick_links  = get_field( 'footer_quick_links', 'option' );
$feature_links = get_field( 'footer_feature_links', 'option' );
$useful_links = get_field( 'footer_useful_links', 'option' );
$facebook_url = get_field( 'social_facebook_url', 'option' );
$twitter_url  = get_field( 'social_twitter_url', 'option' );
$instagram_url = get_field( 'social_instagram_url', 'option' );
$play_store_url = get_field( 'app_google_play_url', 'option' );
$app_store_url  = get_field( 'app_apple_store_url', 'option' );
$copyright_text = get_field( 'footer_copyright_text', 'option' );

if ( empty( $about_text ) ) {
	$about_text = "Skip the paperwork and the hassle. aik by BankIslami lets you open an Asaan Digital Account (ADA) in minutes on Pakistan's premier Islamic digital banking platform.";
}
if ( empty( $quick_links ) ) {
	$quick_links = array(
		array( 'label' => 'Home', 'link' => home_url( '/' ) ),
		array( 'label' => 'About us', 'link' => '#' ),
		array( 'label' => 'New Media', 'link' => '#' ),
		array( 'label' => 'Help', 'link' => '#' ),
		array( 'label' => 'Contact us', 'link' => '#' ),
	);
}
if ( empty( $feature_links ) ) {
	$feature_links = array(
		array( 'label' => 'Digital Account Opening', 'link' => '#' ),
		array( 'label' => 'Money Transfer', 'link' => '#' ),
		array( 'label' => 'Mobile Load', 'link' => '#' ),
		array( 'label' => 'Utility Bill Payments', 'link' => '#' ),
		array( 'label' => 'Debit Card', 'link' => home_url( '/debit-card' ) ),
	);
}
if ( empty( $useful_links ) ) {
	$useful_links = array(
		array( 'label' => 'Disclaimer', 'link' => '#' ),
		array( 'label' => 'Support', 'link' => '#' ),
		array( 'label' => 'FAQ', 'link' => '#' ),
	);
}
if ( empty( $facebook_url ) ) {
	$facebook_url = 'https://www.facebook.com/profile.php?id=61570502862817';
}
if ( empty( $instagram_url ) ) {
	$instagram_url = 'https://www.instagram.com/aikofficial1/';
}
if ( empty( $copyright_text ) ) {
	$copyright_text = 'aik Bankislami';
}
?>
    <footer class="aik-footer position-relative overflow-hidden">
      <section class="aik-newsletter footer_content">
        <div class="container">
          <div class="aik-newsletter__wrap">
            <div class="aik-newsletter__text">
              <h2>Subscribe To Our <span>Weekly Newsletter</span></h2>
            </div>
            <form class="aik-newsletter__form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
              <input type="hidden" name="action" value="aik_newsletter_subscribe">
              <input type="email" name="email" class="aik-newsletter__input" placeholder="Email" required>
              <button type="submit" class="aik-newsletter__btn">Subscribe Now <i class="bi bi-arrow-right-circle-fill"></i></button>
            </form>
          </div>
        </div>
      </section>
      <div class="container footer_content">
        <hr class="aik-footer__hr">
      </div>
      <div class="aik-footer__body footer_content">
        <div class="container">
          <div class="aik-footer__grid">
            <div class="aik-footer__col aik-footer__col--brand">
              <div class="aik-footer__logo"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/footer-aik-logo.png" alt="AIK BankIslami"></div>
              <h6 class="aik-footer__heading">About Company</h6>
              <p class="aik-footer__desc"><?php echo esc_html( $about_text ); ?></p>
            </div>
            <div class="aik-footer__col">
              <h6 class="aik-footer__heading">Quick Links</h6>
              <ul class="aik-footer__links">
                <?php foreach ( $quick_links as $link ) : ?>
                  <li><a href="<?php echo esc_url( $link['link'] ); ?>"><?php echo esc_html( $link['label'] ); ?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="aik-footer__col">
              <h6 class="aik-footer__heading">Features</h6>
              <ul class="aik-footer__links">
                <?php foreach ( $feature_links as $link ) : ?>
                  <li><a href="<?php echo esc_url( $link['link'] ); ?>"><?php echo esc_html( $link['label'] ); ?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="aik-footer__col">
              <h6 class="aik-footer__heading">Useful Links</h6>
              <ul class="aik-footer__links">
                <?php foreach ( $useful_links as $link ) : ?>
                  <li><a href="<?php echo esc_url( $link['link'] ); ?>"><?php echo esc_html( $link['label'] ); ?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="aik-footer__col aik-footer__col--app">
              <h6 class="aik-footer__heading">Download App</h6>
              <div class="aik-footer__badges">
                <a href="<?php echo esc_url( $play_store_url ? $play_store_url : '#' ); ?>" class="aik-footer__badge"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/g-play.svg" alt="Get it on Google Play"></a>
                <a href="<?php echo esc_url( $app_store_url ? $app_store_url : '#' ); ?>" class="aik-footer__badge"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/apple-store.svg" alt="Download on the App Store"></a>
              </div>
              <h6 class="aik-footer__heading aik-footer__heading--social">Social Platform</h6>
              <div class="aik-footer__social">
                <a href="<?php echo esc_url( $facebook_url ); ?>" target="_blank" class="aik-footer__social-btn" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="<?php echo esc_url( $twitter_url ? $twitter_url : '#' ); ?>" class="aik-footer__social-btn" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" class="aik-footer__social-btn" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container footer_content">
        <div class="aik-footer__bottom">
          <div class="aik-footer__bottom-inner">
            <p class="aik-footer__copy">&copy; Copyright <span><?php echo esc_html( $copyright_text ); ?> <span class="fullYear"></span>.</span> All rights reserved.</p>
            <nav class="aik-footer__legal"><a href="javascript:void(0);">Privacy Policy</a> <span class="aik-footer__pipe">|</span> <a href="javascript:void(0);">Terms &amp; Conditions</a></nav>
          </div>
        </div>
      </div>
      <div class="grid-left"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/left-grid-white.png" alt="gride-img"></div>
      <div class="grid-right"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/right-grid-white.png" alt="gride-img"></div>
      <div class="footer-overlay"></div>
    </footer>
  </div>
  <?php wp_footer(); ?>
  <script>// Set current year in footer
    document.addEventListener('DOMContentLoaded', function () {
      const preloader = document.querySelector(".preloader");
      const yellow = document.querySelector(".preloader .cls-2");
      const whites = document.querySelectorAll(".preloader .cls-1");
      const siteContent = document.querySelector(".site-content");

      document.querySelectorAll('.fullYear').forEach(function (el) {
        el.textContent = new Date().getFullYear();
      });

      if (typeof gsap === "undefined") return;

      gsap.set(".preloader-logo svg", { visibility: "visible" });
      gsap.set(siteContent, { opacity: 0 });
      gsap.set(yellow, { opacity: 0, scale: 0.8, transformOrigin: "center center" });
      gsap.set(whites, { opacity: 0, y: 20 });

      const tl = gsap.timeline();

      tl.to(yellow, { opacity: 1, scale: 1, duration: 0.8, ease: "back.out(2)" })
        .to(whites, { opacity: 1, y: 0, duration: 0.5, stagger: 0.02, ease: "power2.out" }, "-=0.3")
        .to({}, { duration: 0.6 })
        .to(siteContent, { opacity: 1, duration: 0.6, ease: "power2.out" }, "-=0.2")
        .to(preloader, {
          yPercent: -100,
          duration: 1,
          ease: "power4.inOut",
          onComplete: function () { preloader.remove(); }
        }, "-=0.2");

      const phone = document.querySelector(".scroll_mobile");
      if (!phone) return;

      window.addEventListener("mousemove", (e) => {
        const x = (e.clientX / window.innerWidth - 0.5);
        const y = (e.clientY / window.innerHeight - 0.5);

        gsap.to(phone, {
          x: -x * 40,
          y: -y * 40,
          rotateY: x * 15,
          rotateX: -y * 15,
          duration: 1,
          ease: "power3.out"
        });
      });
    });</script>

  <!-- Mobile Footer Accordion -->
  <script>
    (function () {
      function initFooterAccordion() {
        if (window.innerWidth > 767) return;

        var cols = document.querySelectorAll(
          '.aik-footer__col:not(.aik-footer__col--brand):not(.aik-footer__col--app)'
        );

        cols.forEach(function (col) {
          var firstHeading = col.querySelector('.aik-footer__heading');
          if (!firstHeading || firstHeading.dataset.accInit) return;
          firstHeading.dataset.accInit = 'true';

          var body = document.createElement('div');
          body.className = 'footer-acc-body';

          var toMove = [];
          var sibling = firstHeading.nextElementSibling;
          while (sibling) {
            toMove.push(sibling);
            sibling = sibling.nextElementSibling;
          }
          toMove.forEach(function (el) { body.appendChild(el); });
          col.appendChild(body);

          var arrow = document.createElement('span');
          arrow.className = 'footer-acc-arrow';
          arrow.setAttribute('aria-hidden', 'true');
          arrow.innerHTML = '<i class="bi bi-arrow-right"></i>';
          firstHeading.appendChild(arrow);

          firstHeading.addEventListener('click', function () {
            col.classList.toggle('is-open');
          });
        });
      }

      document.addEventListener('DOMContentLoaded', initFooterAccordion);
    })();
  </script>

  <script>
    (function () {
      var overlay = document.getElementById("searchOverlay");
      var input = document.getElementById("searchInput");
      var searchBtn = document.querySelector(".search-btn");
      var closeBtn = document.getElementById("searchClose");
      var backdrop = document.querySelector(".srch-backdrop");

      if (!overlay || !searchBtn) return;

      function openSearch() {
        overlay.classList.add("is-open");
        document.body.style.overflow = "hidden";
        setTimeout(function () { if (input) input.focus(); }, 440);
      }

      function closeSearch() {
        overlay.classList.remove("is-open");
        document.body.style.overflow = "";
        if (input) input.value = "";
      }

      searchBtn.addEventListener("click", openSearch);
      if (closeBtn) closeBtn.addEventListener("click", closeSearch);
      if (backdrop) backdrop.addEventListener("click", closeSearch);
      document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && overlay.classList.contains("is-open")) closeSearch();
      });
    })();
  </script>
</body>

</html>
