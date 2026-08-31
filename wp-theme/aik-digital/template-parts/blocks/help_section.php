<?php
/**
 * Layout: help_section
 * Standalone "We're Here to Help" contact block — deliberately its own
 * layout rather than another variant on smarter_section, which already
 * carries heading/description/list/icon-grid/media/button options.
 */

$heading     = get_sub_field( 'heading' );
$intro       = get_sub_field( 'intro' );
$items       = get_sub_field( 'items' );
$image       = get_sub_field( 'image' );
$extra_class = get_sub_field( 'extra_class' );

$section_class = 'help-sec';
if ( $extra_class ) {
	// Multiple space-separated classes must be sanitized one at a time —
	// sanitize_html_class() strips spaces if run on the whole string at
	// once, which glues the classes together.
	$classes = array_filter( preg_split( '/\s+/', trim( $extra_class ) ) );
	$classes = array_map( 'sanitize_html_class', $classes );
	if ( $classes ) {
		$section_class .= ' ' . implode( ' ', $classes );
	}
}
?>
      <section class="<?php echo esc_attr( $section_class ); ?>">
        <div class="container">
          <div class="help-sec__inner">
            <div class="help-sec__left">
              <h2 class="help-sec__heading" data-aos="fade-right" data-aos-offset="0"><?php echo aik_highlight( $heading ); ?></h2>
              <?php if ( $intro ) : ?>
              <p class="help-sec__intro" data-aos="fade-up" data-aos-delay="100" data-aos-offset="0"><?php echo aik_nl2br( $intro ); ?></p>
              <?php endif; ?>
              <?php if ( ! empty( $items ) ) : ?>
              <div class="help-sec__items">
                <?php foreach ( $items as $i => $item ) : ?>
                <div class="help-sec__item" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( 150 + ( $i * 50 ) ); ?>" data-aos-offset="0">
                  <?php if ( ! empty( $item['item_title'] ) ) : ?>
                  <h3 class="help-sec__item-title"><?php echo esc_html( $item['item_title'] ); ?></h3>
                  <?php endif; ?>
                  <?php if ( ! empty( $item['item_bold'] ) ) : ?>
                  <p class="help-sec__item-bold">
                    <?php if ( ! empty( $item['item_bold_link'] ) ) : ?>
                    <a href="<?php echo esc_url( $item['item_bold_link'] ); ?>"><?php echo esc_html( $item['item_bold'] ); ?></a>
                    <?php else : ?>
                    <?php echo esc_html( $item['item_bold'] ); ?>
                    <?php endif; ?>
                  </p>
                  <?php endif; ?>
                  <?php if ( ! empty( $item['item_desc'] ) ) : ?>
                  <p class="help-sec__item-desc"><?php echo aik_nl2br( $item['item_desc'] ); ?></p>
                  <?php endif; ?>
                </div>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>
            <?php if ( ! empty( $image['url'] ) ) : ?>
            <div class="help-sec__right"><img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ? $image['alt'] : '' ); ?>" data-aos="fade-left" data-aos-delay="300" data-aos-offset="0"></div>
            <?php endif; ?>
          </div>
        </div>
        <div class="grid-left"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/left-grid-gray.png" alt="gride-img"></div>
      </section>
