<?php
/**
 * Layout: driven_ethics
 */

$label_1     = get_sub_field( 'label_1' );
$label_1_ur  = get_sub_field( 'label_1_ur' );
$heading_1   = get_sub_field( 'heading_1' );
$heading_1_ur = get_sub_field( 'heading_1_ur' );
$label_2     = get_sub_field( 'label_2' );
$label_2_ur  = get_sub_field( 'label_2_ur' );
$heading_2   = get_sub_field( 'heading_2' );
$heading_2_ur = get_sub_field( 'heading_2_ur' );
$bg_image    = get_sub_field( 'bg_image' );

$bg_url = ! empty( $bg_image['url'] ) ? $bg_image['url'] : AIK_THEME_URI . '/images/driven-innovation_bg.jpg';
?>
      <section class="driven-sec bg_f" style="background-image:url(<?php echo esc_url( $bg_url ); ?>)">
        <div class="container">
          <div class="driven-sec__inner">
            <div class="driven-sec__ethics-wrap" data-aos="fade-right">
              <p class="driven-sec__driven" data-en="<?php echo esc_attr( $label_1 ); ?>" data-ur="<?php echo esc_attr( $label_1_ur ? $label_1_ur : $label_1 ); ?>"><?php echo esc_html( $label_1 ); ?></p>
              <h2 class="driven-sec__ethics" data-en="<?php echo esc_attr( $heading_1 ); ?>" data-ur="<?php echo esc_attr( $heading_1_ur ? $heading_1_ur : $heading_1 ); ?>"><?php echo esc_html( $heading_1 ); ?></h2>
            </div>
            <div class="driven-sec__tagline" data-aos="fade-up" data-aos-delay="200">
              <p class="driven-sec__led" data-en="<?php echo esc_attr( $label_2 ); ?>" data-ur="<?php echo esc_attr( $label_2_ur ? $label_2_ur : $label_2 ); ?>"><?php echo esc_html( $label_2 ); ?></p>
              <h2 class="driven-sec__innovation" data-en="<?php echo esc_attr( $heading_2 ); ?>" data-ur="<?php echo esc_attr( $heading_2_ur ? $heading_2_ur : $heading_2 ); ?>"><?php echo esc_html( $heading_2 ); ?></h2>
            </div>
          </div>
        </div>
      </section>
