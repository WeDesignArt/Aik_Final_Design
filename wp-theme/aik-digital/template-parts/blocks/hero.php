<?php
/**
 * Layout: hero
 */

$heading           = get_sub_field( 'heading' );
$bg_image          = get_sub_field( 'bg_image' );
$mobile_image      = get_sub_field( 'mobile_image' );
$pill_1_icon       = get_sub_field( 'pill_1_icon' );
$pill_1_text       = get_sub_field( 'pill_1_text' );
$pill_2_icon       = get_sub_field( 'pill_2_icon' );
$pill_2_text       = get_sub_field( 'pill_2_text' );
$show_interest     = get_sub_field( 'show_no_interest_banner' );
$interest_image    = get_sub_field( 'no_interest_image' );

$hero_style        = get_sub_field( 'hero_style' ); // 'standard' | 'business' | 'inner'
$subheading        = get_sub_field( 'subheading' );
$btn_1_text        = get_sub_field( 'button_1_text' );
$btn_1_link        = get_sub_field( 'button_1_link' );
$btn_2_text        = get_sub_field( 'button_2_text' );
$btn_2_link        = get_sub_field( 'button_2_link' );
$mobile_bg_image   = get_sub_field( 'mobile_bg_image' );

$bg_url        = ! empty( $bg_image['url'] ) ? $bg_image['url'] : AIK_THEME_URI . '/images/bg-1.png';
$mobile_url    = ! empty( $mobile_image['url'] ) ? $mobile_image['url'] : AIK_THEME_URI . '/images/hero-app-mobile.png';
$mobile_bg_url = ! empty( $mobile_bg_image['url'] ) ? $mobile_bg_image['url'] : AIK_THEME_URI . '/images/bg-1.png';
$is_business   = ( 'business' === $hero_style );
$is_inner      = ( 'inner' === $hero_style );
?>
<?php if ( $is_inner ) : ?>
      <section class="home_hero_wrapper index_custom clearfix position-relative bg_primary">
        <section class="home_hero_slider custom_adjustment aik_landing overflow-hidden">
          <div class="app_link_holder">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span>Personal</span> </a>
            <a href="<?php echo esc_url( home_url( '/business' ) ); ?>"><span>Business</span> </a>
          </div>
          <article class="hero_item debit_hero_item">
            <div class="hero_img">
              <picture>
                <source media="(min-width: 575px)" srcset="<?php echo esc_url( $bg_url ); ?>">
                <img src="<?php echo esc_url( $mobile_bg_url ); ?>" alt="slide">
              </picture>
            </div>
            <div class="debit-hero-caption">
              <h1><?php echo aik_highlight( $heading ); ?></h1>
            </div>
          </article>
        </section>
      </section>
<?php elseif ( $is_business ) : ?>
      <section class="home_hero_wrapper clearfix position-relative bg_primary">
        <section class="home_hero_slider custom_size aik_landing overflow-hidden business_hero">
          <div class="app_link_holder">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span>Personal</span> </a>
            <a href="<?php echo esc_url( home_url( '/business' ) ); ?>" class="active"><span>Business</span> </a>
          </div>
          <article class="hero_item">
            <div class="hero_img">
              <picture>
                <source media="(min-width: 575px)" srcset="<?php echo esc_url( $bg_url ); ?>">
                <img src="<?php echo esc_url( $bg_url ); ?>" alt="slide">
              </picture>
            </div>
            <div class="logo_arch"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/logo-arch.svg" alt="arch" data-aos="zoom-in"></div>
            <section class="hero_main_text">
              <h1 class="hero_main_text_title home_main_title" data-aos="fade-right"><?php echo aik_highlight( $heading ); ?></h1>
              <?php if ( $subheading ) : ?>
              <p class="hero_main_text_desc" data-aos="fade-up"><?php echo aik_nl2br( $subheading ); ?></p>
              <?php endif; ?>
              <?php if ( $btn_1_text || $btn_2_text ) : ?>
              <div class="hero_btn_group d-flex align-items-center gap-3" data-aos="fade-up" data-aos-delay="100">
                <?php if ( $btn_1_text ) : ?>
                <a href="<?php echo esc_url( $btn_1_link ? $btn_1_link : 'javascript:void(0);' ); ?>" class="btn btn_fill"><?php echo esc_html( $btn_1_text ); ?></a>
                <?php endif; ?>
                <?php if ( $btn_2_text ) : ?>
                <a href="<?php echo esc_url( $btn_2_link ? $btn_2_link : 'javascript:void(0);' ); ?>" class="btn btn_fill"><?php echo esc_html( $btn_2_text ); ?></a>
                <?php endif; ?>
              </div>
              <?php endif; ?>
            </section>
            <section class="mobile_track">
              <div class="scroll_mobile"><img src="<?php echo esc_url( $mobile_url ); ?>" alt="mobile" data-aos="fade-left" data-aos-delay="200"></div>
              <?php if ( $pill_1_text ) : ?>
              <div class="mobile_pill pill_top_right" data-aos="zoom-in" data-aos-delay="300">
                <div class="mobile_pill_icon"><img src="<?php echo esc_url( ! empty( $pill_1_icon['url'] ) ? $pill_1_icon['url'] : AIK_THEME_URI . '/images/icon-arrow.svg' ); ?>" alt="icon"></div>
                <div class="mobile_pill_text"><?php echo esc_html( $pill_1_text ); ?></div>
              </div>
              <?php endif; ?>
              <?php if ( $pill_2_text ) : ?>
              <div class="mobile_pill pill_bottom_left" data-aos="zoom-in" data-aos-delay="400">
                <div class="mobile_pill_icon"><img src="<?php echo esc_url( ! empty( $pill_2_icon['url'] ) ? $pill_2_icon['url'] : AIK_THEME_URI . '/images/icon-arrow.svg' ); ?>" alt="icon"></div>
                <div class="mobile_pill_text"><?php echo esc_html( $pill_2_text ); ?></div>
              </div>
              <?php endif; ?>
            </section>
            <?php if ( $show_interest && ! empty( $interest_image['url'] ) ) : ?>
            <section class="interest_section clearfix clear ps-5">
              <div class="container-fluid">
                <div class="interest_row w-100 d-flex justify-content-between align-items-center">
                  <div class="interest_text"><img src="<?php echo esc_url( $interest_image['url'] ); ?>" alt="no interest"></div>
                </div>
              </div>
            </section>
            <?php endif; ?>
          </article>
        </section>
      </section>
<?php else : ?>
      <section class="home_hero_wrapper index_custom clearfix position-relative bg_primary">
        <section class="home_hero_slider custom_adjustment aik_landing overflow-hidden">
          <div class="app_link_holder">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="active"><span>Personal</span> </a>
            <a href="<?php echo esc_url( home_url( '/business' ) ); ?>"><span>Business</span> </a>
          </div>
          <article class="hero_item">
            <div class="hero_img">
              <picture>
                <source media="(min-width: 575px)" srcset="<?php echo esc_url( $bg_url ); ?>">
                <img src="<?php echo esc_url( $bg_url ); ?>" alt="slide">
              </picture>
            </div>
            <div class="logo_arch"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/logo-arch.svg" alt="arch" data-aos="zoom-in"></div>
            <section class="aik_landing_top">
              <div class="left_text_block" data-aos="fade-right" data-aos-delay="200">
                <h2><?php echo aik_highlight( $heading ); ?></h2>
              </div>
            </section>
            <section class="mobile_track">
              <div class="scroll_mobile"><img src="<?php echo esc_url( $mobile_url ); ?>" alt="mobile" data-aos="fade-left" data-aos-delay="300"></div>
              <?php if ( $pill_1_text ) : ?>
              <div class="mobile_pill pill_left" data-aos="zoom-in" data-aos-delay="400">
                <div class="mobile_pill_icon"><img src="<?php echo esc_url( ! empty( $pill_1_icon['url'] ) ? $pill_1_icon['url'] : AIK_THEME_URI . '/images/icon-arrow.svg' ); ?>" alt="icon"></div>
                <div class="mobile_pill_text"><?php echo esc_html( $pill_1_text ); ?></div>
              </div>
              <?php endif; ?>
              <?php if ( $pill_2_text ) : ?>
              <div class="mobile_pill pill_right" data-aos="zoom-in" data-aos-delay="500">
                <div class="mobile_pill_icon"><img src="<?php echo esc_url( ! empty( $pill_2_icon['url'] ) ? $pill_2_icon['url'] : AIK_THEME_URI . '/images/icon-arrow.svg' ); ?>" alt="icon"></div>
                <div class="mobile_pill_text"><?php echo esc_html( $pill_2_text ); ?></div>
              </div>
              <?php endif; ?>
            </section>
            <?php if ( $show_interest && ! empty( $interest_image['url'] ) ) : ?>
            <section class="interest_section custom_interest_section clearfix clear">
              <div class="container">
                <div class="interest_row w-100 d-flex justify-content-between align-items-center">
                  <div class="interest_text"><img src="<?php echo esc_url( $interest_image['url'] ); ?>" alt="no interest"></div>
                </div>
              </div>
            </section>
            <?php endif; ?>
          </article>
        </section>
      </section>
<?php endif; ?>
