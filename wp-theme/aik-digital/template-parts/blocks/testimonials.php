<?php
/**
 * Layout: testimonials
 */

$heading        = get_sub_field( 'heading' );
$heading_ur     = get_sub_field( 'heading_ur' );
$description    = get_sub_field( 'description' );
$description_ur = get_sub_field( 'description_ur' );
$testimonial_ids = get_sub_field( 'testimonials' );

if ( empty( $testimonial_ids ) ) {
	return;
}
?>
      <section class="cf-section x_spacing">
        <div class="container">
          <div class="cf-header text-center" data-aos="fade-up">
            <h2 data-en="<?php echo esc_attr( aik_highlight( $heading ) ); ?>" data-ur="<?php echo esc_attr( aik_highlight( $heading_ur ? $heading_ur : $heading ) ); ?>"><?php echo aik_highlight( $heading ); ?></h2>
            <?php if ( $description ) : ?>
            <p data-en="<?php echo esc_attr( aik_nl2br( $description ) ); ?>" data-ur="<?php echo esc_attr( aik_nl2br( $description_ur ? $description_ur : $description ) ); ?>"><?php echo aik_nl2br( $description ); ?></p>
            <?php endif; ?>
          </div>
          <div class="cf-wrapper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper" id="testimonialSwiper">
              <div class="swiper-wrapper">
                <?php foreach ( $testimonial_ids as $testimonial_id ) :
					$role        = get_field( 'role', $testimonial_id );
					$role_ur     = get_field( 'role_ur', $testimonial_id );
					$rating      = (int) get_field( 'rating', $testimonial_id );
					$headline    = get_field( 'headline', $testimonial_id );
					$headline_ur = get_field( 'headline_ur', $testimonial_id );
					$quote       = get_field( 'quote', $testimonial_id );
					$quote_ur    = get_field( 'quote_ur', $testimonial_id );
					?>
                <div class="swiper-slide">
                  <div class="cf-card">
                    <div class="cf-top">
                      <div>
                        <h5><?php echo esc_html( get_the_title( $testimonial_id ) ); ?></h5><span data-en="<?php echo esc_attr( $role ); ?>" data-ur="<?php echo esc_attr( $role_ur ? $role_ur : $role ); ?>"><?php echo esc_html( $role ); ?></span>
                      </div>
                      <div class="cf-stars"><?php echo esc_html( str_repeat( '★', max( 0, min( 5, $rating ) ) ) ); ?></div>
                    </div>
                    <?php if ( $headline ) : ?><h4 data-en="<?php echo esc_attr( $headline ); ?>" data-ur="<?php echo esc_attr( $headline_ur ? $headline_ur : $headline ); ?>"><?php echo esc_html( $headline ); ?></h4><?php endif; ?>
                    <?php if ( $quote ) : ?><p data-en="<?php echo esc_attr( $quote ); ?>" data-ur="<?php echo esc_attr( $quote_ur ? $quote_ur : $quote ); ?>"><?php echo esc_html( $quote ); ?></p><?php endif; ?>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </section>
