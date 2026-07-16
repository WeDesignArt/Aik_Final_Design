<?php
/**
 * Layout: app_download
 */

$heading_1 = get_sub_field( 'heading_line_1' );
$heading_2 = get_sub_field( 'heading_line_2' );
$logo      = get_sub_field( 'logo_image' );
$qr        = get_sub_field( 'qr_image' );
$bg_image  = get_sub_field( 'bg_image' );

$bg_url  = ! empty( $bg_image['url'] ) ? $bg_image['url'] : AIK_THEME_URI . '/images/mob-app__section_bg.jpg';
$logo_url = ! empty( $logo['url'] ) ? $logo['url'] : AIK_THEME_URI . '/images/mob-app__section_logo.png';
$qr_url  = ! empty( $qr['url'] ) ? $qr['url'] : AIK_THEME_URI . '/images/qr-download.jpg';
?>
      <section class="app-dl-section bg_f" style="background-image:url(<?php echo esc_url( $bg_url ); ?>)">
        <div class="container position-relative">
          <div class="app-dl-wrap">
            <div class="app-dl-left">
              <h2 class="app-dl-heading" data-aos="fade-left"><?php echo esc_html( $heading_1 ); ?></h2>
              <div class="app-dl-logo"><img src="<?php echo esc_url( $logo_url ); ?>" alt="aik" data-aos="fade-up"></div>
              <h2 class="app-dl-heading" data-aos="fade-left"><?php echo esc_html( $heading_2 ); ?></h2>
              <div class="mt-4 text-center"><img src="<?php echo esc_url( $qr_url ); ?>" alt="code" class="img-fluid d-inline-block"></div>
            </div>
            <div class="app-dl-right"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/mob-app__section_cellphone.png" alt="aik Mobile App" data-aos="fade-left"></div>
          </div>
        </div>
        <div class="app-dl-grid-bl"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/mob-app__section_left-bottom_grid.png" alt=""></div>
        <div class="app-dl-grid-tr"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/mob-app__section_top-right_grid.png" alt=""></div>
        <div class="app-dl-diamond" data-aos="zoom-in"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/yellow-outlined-vector.png" alt=""></div>
      </section>
