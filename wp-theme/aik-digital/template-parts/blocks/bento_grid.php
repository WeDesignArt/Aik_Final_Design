<?php
/**
 * Layout: bento_grid
 */

$heading     = get_sub_field( 'heading' );
$cards       = get_sub_field( 'cards' );
$custom_grid = get_sub_field( 'custom_grid' );

/**
 * main.css lays this grid out with fixed grid-column spans keyed to these
 * exact modifier classes (.bento-card--transfers{grid-column:span 6} etc.)
 * — a plain .bento-card with no modifier gets no span and collapses to a
 * single narrow column. There's no per-card "layout" field in ACF for this,
 * so we cycle through the 6 original slugs by position; keep cards in the
 * original 6-card order (Transfers/Airtime/Deen/Debit/Bill/Takaful) for the
 * grid to look right, since that's what the CSS spans were designed for.
 */
$slugs = array( 'transfers', 'airtime', 'deen', 'debit', 'bill', 'takaful' );
?>
      <section class="bento-grid-section overflow-hidden">
        <div class="container">
          <div class="section_title text-center">
            <h2 class="section_title_heading pb_60 mx-auto col-lg-9" data-aos="fade-left"><?php echo aik_highlight( $heading ); ?></h2>
          </div>
          <?php if ( ! empty( $cards ) ) : ?>
          <div class="bento-grid<?php echo $custom_grid ? ' custom-grid' : ''; ?>">
            <?php foreach ( $cards as $i => $card ) :
				$slug         = $slugs[ $i % count( $slugs ) ];
				$card_classes = 'bento-card bento-card--' . $slug;
				if ( $custom_grid && 'deen' === $slug ) {
					$card_classes .= ' retention';
				}
				?>
            <div class="<?php echo esc_attr( $card_classes ); ?>" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $i * 100 ); ?>">
              <div class="bento-card__inner">
                <?php if ( ! empty( $card['icon']['url'] ) ) : ?>
                <div class="bento-card__icon bento-card__icon--top-left">
                  <div class="bento-icon-wrapper"><img src="<?php echo esc_url( $card['icon']['url'] ); ?>" alt="icon"></div>
                </div>
                <?php endif; ?>
                <?php if ( ! empty( $card['image']['url'] ) ) : ?>
                <div class="bento-card__media"><img src="<?php echo esc_url( $card['image']['url'] ); ?>" alt="<?php echo esc_attr( str_replace( '**', '', $card['title'] ) ); ?>" class="bento-card__img">
                  <div class="bento-card__bg-placeholder bento-card__bg-placeholder--<?php echo esc_attr( $slug ); ?>"></div>
                </div>
                <?php endif; ?>
                <div class="bento-card__content">
                  <h3 class="bento-card__title"><?php echo aik_highlight( $card['title'] ); ?></h3>
                  <p class="bento-card__desc"><?php echo aik_nl2br( $card['description'] ); ?></p>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
      </section>
