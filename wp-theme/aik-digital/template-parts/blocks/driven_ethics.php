<?php
/**
 * Layout: driven_ethics
 */

$label_1  = get_sub_field( 'label_1' );
$heading_1 = get_sub_field( 'heading_1' );
$label_2  = get_sub_field( 'label_2' );
$heading_2 = get_sub_field( 'heading_2' );
$bg_image = get_sub_field( 'bg_image' );

$bg_url = ! empty( $bg_image['url'] ) ? $bg_image['url'] : AIK_THEME_URI . '/images/driven-innovation_bg.jpg';
?>
      <section class="driven-sec bg_f" style="background-image:url(<?php echo esc_url( $bg_url ); ?>)">
        <div class="container">
          <div class="driven-sec__inner">
            <div class="driven-sec__ethics-wrap" data-aos="fade-right">
              <p class="driven-sec__driven"><?php echo esc_html( $label_1 ); ?></p>
              <h2 class="driven-sec__ethics"><?php echo esc_html( $heading_1 ); ?></h2>
            </div>
            <div class="driven-sec__tagline" data-aos="fade-up" data-aos-delay="200">
              <p class="driven-sec__led"><?php echo esc_html( $label_2 ); ?></p>
              <h2 class="driven-sec__innovation"><?php echo esc_html( $heading_2 ); ?></h2>
            </div>
          </div>
        </div>
      </section>
