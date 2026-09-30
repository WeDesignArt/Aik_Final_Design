<?php
/**
 * Template Name: Brand Ambassador
 *
 * Dedicated template for the Brand Ambassador page:
 * - Inner Hero
 * - Smarter Section (Feature/Spend block with brand_ambassador.png)
 * - How it Works (3 or 4 Step switcher)
 * - Brand Ambassador Bottom Banner
 * - No Footer (suppressed via footer.php)
 */

get_header();
?>
    <main role="main" class="home_content1 clearfix">
      <?php
      if ( have_rows( 'page_sections' ) ) {
		aik_render_page_sections();
	  } else {
		// Default render when page_sections Flexible Content is not yet saved
		$aik_menu_section    = is_page() ? get_field( 'menu_section' ) : null;
		$aik_personal_active = esc_attr( 'business' === $aik_menu_section ? '' : 'active' );
		$aik_business_active = esc_attr( 'business' === $aik_menu_section ? 'active' : '' );
		?>
        <!-- SECTION 1: HERO -->
        <section class="home_hero_wrapper index_custom clearfix position-relative bg_primary">
          <section class="home_hero_slider custom_adjustment aik_landing overflow-hidden">
            <div class="app_link_holder">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="<?php echo $aik_personal_active; ?>"><span data-en="Personal" data-ur="پرسنل">Personal</span></a>
              <a href="<?php echo esc_url( home_url( '/business' ) ); ?>" class="<?php echo $aik_business_active; ?>"><span data-en="Business" data-ur="بزنس">Business</span></a>
            </div>
            <article class="hero_item debit_hero_item">
              <div class="hero_img">
                <picture>
                  <source media="(min-width: 575px)" srcset="<?php echo esc_url( AIK_THEME_URI ); ?>/images/bg-1.png">
                  <img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/bg-1.png" alt="Brand Ambassador">
                </picture>
              </div>
              <div class="debit-hero-caption">
                <h1 data-en="aik Digital <span>Brand Ambassador</span>" data-ur="aik ڈیجیٹل <span>برانڈ ایمبیسیڈر</span>">aik Digital <span>Brand Ambassador</span></h1>
              </div>
            </article>
          </section>
        </section>

        <!-- SECTION 2: SMARTER SECTION -->
        <section class="smarter-sec smarter-sec--on-white brand-ambassador-smarter-sec">
          <div class="container">
            <div class="smarter-sec__inner">
              <div class="smarter-sec__left">
                <h2 class="smarter-sec__heading" data-aos="fade-right" data-en="Become an aik Digital <br><span>Brand Ambassador</span>" data-ur="ایک aik ڈیجیٹل <br><span>برانڈ ایمبیسیڈر</span> بنیں">Become an aik Digital <br><span>Brand Ambassador</span></h2>
                <p class="smarter-sec__desc" data-aos="fade-up" data-aos-delay="200" data-en="Earn PKR 200 for every successful referral by inviting your friends and family to open an AIK Digital account." data-ur="اپنے دوستوں اور خاندان کو AIK ڈیجیٹل اکاؤنٹ کھولنے کی دعوت دے کر ہر کامیاب ریفرل پر 200 روپے کمائیں۔">Earn PKR 200 for every successful referral by inviting your friends and family to open an AIK Digital account.</p>
                <p class="smarter-sec__desc" data-aos="fade-up" data-aos-delay="250" data-en="Your earnings are credited directly to your AIK Digital account after successful verification." data-ur="کامیاب تصدیق کے بعد آپ کی کمائی براہ راست آپ کے AIK ڈیجیٹل اکاؤنٹ میں منتقل کر دی جائے گی۔">Your earnings are credited directly to your AIK Digital account after successful verification.</p>
                <div class="smarter-sec__btns" data-aos="fade-up" data-aos-delay="300">
                  <a href="javascript:void(0);" class="btn_fill"><span data-en="Register Now" data-ur="ابھی رجسٹر کریں">Register Now</span></a>
                </div>
              </div>
              <div class="smarter-sec__right">
                <img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/brand_ambassador.png" alt="Become an aik Digital Brand Ambassador" data-aos="fade-left" data-aos-delay="300">
              </div>
            </div>
          </div>
          <div class="grid-left"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/left-grid-gray.png" alt="gride-img"></div>
        </section>

        <!-- SECTION 3: HOW IT WORKS (With 3 or 4 Steps switcher) -->
        <?php include AIK_THEME_DIR . '/template-parts/blocks/how_it_works.php'; ?>

        <!-- SECTION 4: BOTTOM BANNER -->
        <?php include AIK_THEME_DIR . '/template-parts/blocks/ba_banner.php'; ?>
		<?php
	  }
	  ?>
    </main>
<?php
get_footer();
