<?php
/**
 * Layout: bento_grid
 */

$heading      = get_sub_field( 'heading' );
$cards        = get_sub_field( 'cards' );
$custom_grid  = get_sub_field( 'custom_grid' );
$card_pattern = get_sub_field( 'card_pattern' ) ?: 'big_first';
$show_button  = get_sub_field( 'show_button' );
$button_label = get_sub_field( 'button_label' );
$button_link  = get_sub_field( 'button_link' );

/**
 * main.css lays this grid out with fixed grid-column spans keyed to these
 * exact modifier classes (.bento-card--transfers{grid-column:span 6} etc.)
 * — a plain .bento-card with no modifier gets no span and collapses to a
 * single narrow column. There's no per-card "layout" field in ACF for this,
 * so we cycle through 4 slugs by position: transfers/airtime are the "big"
 * pair (span 6, 580px tall) and deen/debit are the "small" pair (span 7+5,
 * 380px tall) — cycling 2 big, 2 small, 2 big, 2 small (or the reverse, per
 * Card Size Pattern) for however many cards there are. (bill/takaful exist
 * as identical-looking alternates but aren't needed for the pattern itself.)
 */
$slugs = ( 'small_first' === $card_pattern )
	? array( 'deen', 'debit', 'transfers', 'airtime' )
	: array( 'transfers', 'airtime', 'deen', 'debit' );
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
				$card_tag  = ! empty( $card['link'] ) ? 'a' : 'div';
				$card_href = ! empty( $card['link'] ) ? ' href="' . esc_url( $card['link'] ) . '"' : '';
				?>
            <<?php echo $card_tag; ?> class="<?php echo esc_attr( $card_classes ); ?>"<?php echo $card_href; // phpcs:ignore -- trusted, built entirely from esc_url() above. ?> data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $i * 100 ); ?>">
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
            </<?php echo $card_tag; ?>>
            <?php endforeach; ?>
          </div>
          <?php if ( $show_button && $button_label ) : ?>
          <div class="bento-grid-btn text-center">
            <a href="<?php echo esc_url( $button_link ? $button_link : '#' ); ?>" class="btn btn_fill"><?php echo esc_html( $button_label ); ?></a>
          </div>
          <?php endif; ?>
          <?php endif; ?>
        </div>
      </section>
