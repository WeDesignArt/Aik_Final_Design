<?php
/**
 * Layout: download_band
 * "App Download" — wide decorative-band design on desktop, stacked card
 * layout on mobile — same fields feed both; only one <section> shows per
 * screen size via Bootstrap's d-none/d-block, matching the original
 * static index.html. A separate layout from "App Download" (app_download)
 * so pages already using that one keep their existing design.
 */

$show_help    = get_sub_field( 'show_help_search' );
$help_heading = get_sub_field( 'help_heading' );
$heading_1    = get_sub_field( 'heading_line_1' );
$heading_2    = get_sub_field( 'heading_line_2' );
$logo         = get_sub_field( 'logo_image' );
$qr           = get_sub_field( 'qr_image' );
$phone        = get_sub_field( 'phone_image' );
$phone_mobile = get_sub_field( 'phone_image_mobile' );
$bg_band      = get_sub_field( 'bg_band_image' );
$bg_mobile    = get_sub_field( 'bg_image_mobile' );

$logo_url         = ! empty( $logo['url'] ) ? $logo['url'] : AIK_THEME_URI . '/images/aik_connect_logo-aik.png';
$qr_url           = ! empty( $qr['url'] ) ? $qr['url'] : AIK_THEME_URI . '/images/aik_connect_qr-code.png';
$phone_url        = ! empty( $phone['url'] ) ? $phone['url'] : AIK_THEME_URI . '/images/aik-dowload-new.png';
$phone_mobile_url = ! empty( $phone_mobile['url'] ) ? $phone_mobile['url'] : ( ! empty( $phone['url'] ) ? $phone['url'] : AIK_THEME_URI . '/images/aik-dowload-new_mb.png' );
$bg_band_url      = ! empty( $bg_band['url'] ) ? $bg_band['url'] : AIK_THEME_URI . '/images/aik_connect_download_bg.png';
$bg_mobile_url    = ! empty( $bg_mobile['url'] ) ? $bg_mobile['url'] : AIK_THEME_URI . '/images/mob-app__section_bg.jpg';
?>
      <?php if ( $show_help ) : ?>
      <section class="aik-download-help">
        <div class="container">
          <h2 class="aik-download-help__heading"><?php echo esc_html( $help_heading ); ?></h2>
          <form class="aik-download-help__search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
            <input type="text" name="s" placeholder="Search" autocomplete="off">
            <button type="submit" aria-label="Search"><i class="bi bi-send"></i></button>
          </form>
        </div>
      </section>
      <?php endif; ?>
      <section class="aik-download-section d-none d-md-block">
        <div class="aik-bg-band">
          <img src="<?php echo esc_url( $bg_band_url ); ?>" alt="">
        </div>
        <div class="container-fluid aik-download-inner">

          <div class="aik-phone-vector">
            <img src="<?php echo esc_url( $phone_url ); ?>" alt="aik app phone mockup">
          </div>

          <div class="aik-download-text"><?php echo esc_html( $heading_1 ); ?></div>

          <div class="aik-qrcode">
            <img src="<?php echo esc_url( $qr_url ); ?>" alt="QR code">
          </div>

          <div class="aik-appnow-row">
            <img src="<?php echo esc_url( $logo_url ); ?>" alt="aik logo">
            <span><?php echo esc_html( $heading_2 ); ?></span>
          </div>

        </div>
      </section>

      <section class="app-dl-section d-block d-md-none">
        <div class="app-dl-bg"><img src="<?php echo esc_url( $bg_mobile_url ); ?>" alt=""></div>
        <div class="container position-relative">
          <div class="app-dl-wrap">
            <div class="app-dl-left">
              <h2 class="app-dl-heading" data-aos="fade-left"><?php echo esc_html( $heading_1 ); ?></h2>
              <div class="app-dl-logo"><img src="<?php echo esc_url( $logo_url ); ?>" alt="aik" data-aos="fade-up"></div>
              <h2 class="app-dl-heading" data-aos="fade-left"><?php echo esc_html( $heading_2 ); ?></h2>
              <div class="mt-4 qr_mb text-center"><img src="<?php echo esc_url( $qr_url ); ?>" alt="code" class="img-fluid d-inline-block"></div>
            </div>
            <div class="app-dl-right"><img src="<?php echo esc_url( $phone_mobile_url ); ?>" alt="aik Mobile App" data-aos="fade-left"></div>
          </div>
        </div>
        <div class="app-dl-grid-bl"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/mob-app__section_left-bottom_grid.png" alt=""></div>
        <div class="app-dl-grid-tr"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/mob-app__section_top-right_grid.png" alt=""></div>
      </section>
