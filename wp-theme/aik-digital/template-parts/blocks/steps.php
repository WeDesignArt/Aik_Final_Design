<?php
/**
 * Layout: steps
 * Numbered step cards entered directly as a repeater — NOT real WordPress
 * Posts. Kept separate from the "news" layout because the markup (numbered
 * badge, alternating accent color, no date/Read More/See More) is entirely
 * different from a real news card.
 */

$heading     = get_sub_field( 'heading' );
$description = get_sub_field( 'description' );
$steps       = get_sub_field( 'steps_list' );
?>
      <section class="md-news-section position-relative overflow-hidden">
        <div class="container">
          <div class="md-news-header" data-aos="fade-up">
            <h2 class="md-news-title"><?php echo aik_highlight( $heading ); ?></h2>
            <?php if ( $description ) : ?>
            <p class="md-news-subtitle"><?php echo aik_nl2br( $description ); ?></p>
            <?php endif; ?>
          </div>
          <?php if ( ! empty( $steps ) ) : ?>
          <div class="md-news x_spacing order-steps">
            <div class="row g-4">
              <?php foreach ( $steps as $i => $step ) :
				$num          = str_pad( $i + 1, 2, '0', STR_PAD_LEFT );
				$is_alternate = ( 1 === $i % 2 );
				?>
              <div class="col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $i * 100 ); ?>">
                <article class="news-single mb-3">
                  <?php if ( ! empty( $step['image']['url'] ) ) : ?>
                  <div class="news-single-media"><a href="javascript:void(0);"><img src="<?php echo esc_url( $step['image']['url'] ); ?>" alt="<?php echo esc_attr( $step['title'] ); ?>"></a></div>
                  <?php endif; ?>
                  <div class="news-single-content step-info<?php echo $is_alternate ? ' step-info--green' : ''; ?>">
                    <span class="step-info__num"><?php echo esc_html( $num ); ?></span>
                    <div class="step-info__body">
                      <h2 class="step-info__title"><?php echo esc_html( $step['title'] ); ?></h2>
                      <?php if ( $step['description'] ) : ?>
                      <p class="step-info__desc"><?php echo aik_nl2br( $step['description'] ); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                </article>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endif; ?>
        </div>
        <div class="grid-left"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/left-grid-gray.png" alt="gride-img"></div>
        <div class="grid-right"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/right-grid-gray.png" alt="gride-img"></div>
      </section>
