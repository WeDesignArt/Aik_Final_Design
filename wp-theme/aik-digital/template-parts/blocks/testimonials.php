<?php
/**
 * Layout: testimonials
 */

$heading     = get_sub_field( 'heading' );
$description = get_sub_field( 'description' );
$testimonial_ids = get_sub_field( 'testimonials' );

if ( empty( $testimonial_ids ) ) {
	return;
}
?>
      <section class="cf-section x_spacing">
        <div class="container">
          <div class="cf-header text-center" data-aos="fade-up">
            <h2><?php echo aik_highlight( $heading ); ?></h2>
            <?php if ( $description ) : ?>
            <p><?php echo aik_nl2br( $description ); ?></p>
            <?php endif; ?>
          </div>
          <div class="cf-wrapper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper" id="testimonialSwiper">
              <div class="swiper-wrapper">
                <?php foreach ( $testimonial_ids as $testimonial_id ) :
					$role     = get_field( 'role', $testimonial_id );
					$rating   = (int) get_field( 'rating', $testimonial_id );
					$headline = get_field( 'headline', $testimonial_id );
					$quote    = get_field( 'quote', $testimonial_id );
					?>
                <div class="swiper-slide">
                  <div class="cf-card">
                    <div class="cf-top">
                      <div>
                        <h5><?php echo esc_html( get_the_title( $testimonial_id ) ); ?></h5><span><?php echo esc_html( $role ); ?></span>
                      </div>
                      <div class="cf-stars"><?php echo esc_html( str_repeat( '★', max( 0, min( 5, $rating ) ) ) ); ?></div>
                    </div>
                    <?php if ( $headline ) : ?><h4><?php echo esc_html( $headline ); ?></h4><?php endif; ?>
                    <?php if ( $quote ) : ?><p><?php echo esc_html( $quote ); ?></p><?php endif; ?>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </section>
