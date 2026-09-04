<?php
/**
 * Layout: feature_suite
 * Autoplaying content/image slider — standalone component (.feature-suite-*),
 * not a Smarter Section variant. Each slide's Layout field just toggles the
 * "feature-suite-slide--reverse" class; the content/media DOM order stays
 * the same for every slide, only that one class differs.
 */

$heading           = get_sub_field( 'heading' );
$background_style  = get_sub_field( 'background_style' ) ?: 'default';
$background_image  = get_sub_field( 'background_image' );
$slides            = get_sub_field( 'slides' );
$extra_class       = get_sub_field( 'extra_class' );

$section_class = 'feature-suite-sec';
if ( 'white' === $background_style ) {
	$section_class .= ' feature-suite-sec--white';
}
if ( $extra_class ) {
	$classes = array_filter( preg_split( '/\s+/', trim( $extra_class ) ) );
	$classes = array_map( 'sanitize_html_class', $classes );
	if ( $classes ) {
		$section_class .= ' ' . implode( ' ', $classes );
	}
}

// Unique per-instance id — this layout can be added more than once per
// page, and Swiper needs a distinct selector for each instance.
// get_row_index() is this row's 1-based position within the whole
// page_sections field (not just among feature_suite rows), which is all
// that's needed for a unique DOM id — a `static` counter would be
// unreliable here since include() (not include_once) recompiles this
// file fresh on every row, so static state doesn't carry over.
$swiper_id = 'featureSuiteSwiper-' . (int) get_row_index();
?>
      <section class="<?php echo esc_attr( $section_class ); ?>">
        <?php if ( 'default' === $background_style && ! empty( $background_image['url'] ) ) : ?>
        <div class="feature-suite-sec__bg"><img src="<?php echo esc_url( $background_image['url'] ); ?>" alt=""></div>
        <?php endif; ?>
        <div class="grid-left"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/left-grid-<?php echo 'white' === $background_style ? 'gray' : 'white'; ?>.png" alt="gride-img"></div>
        <div class="container">
          <?php if ( $heading ) : ?>
          <h2 class="feature-suite-sec__heading" data-aos="fade-up"><?php echo aik_highlight( $heading ); ?></h2>
          <?php endif; ?>

          <?php if ( ! empty( $slides ) ) : ?>
          <div class="swiper feature-suite-swiper" id="<?php echo esc_attr( $swiper_id ); ?>">
            <div class="swiper-wrapper">
              <?php foreach ( $slides as $slide ) :
					$slide_class = 'feature-suite-slide';
					if ( 'content_right' === $slide['layout_position'] ) {
						$slide_class .= ' feature-suite-slide--reverse';
					}
					?>
              <div class="swiper-slide">
                <div class="<?php echo esc_attr( $slide_class ); ?>">
                  <div class="feature-suite-slide__content">
                    <?php if ( $slide['title'] ) : ?>
                    <h3 class="feature-suite-slide__title"><?php echo aik_highlight( $slide['title'] ); ?></h3>
                    <?php endif; ?>
                    <?php if ( $slide['tagline'] ) : ?>
                    <p class="feature-suite-slide__tagline"><?php echo esc_html( $slide['tagline'] ); ?></p>
                    <?php endif; ?>
                    <?php if ( $slide['description'] ) : ?>
                    <p class="feature-suite-slide__desc"><?php echo aik_nl2br( $slide['description'] ); ?></p>
                    <?php endif; ?>
                    <?php if ( ! empty( $slide['list_items'] ) ) : ?>
                    <ul class="feature-suite-slide__list">
                      <?php foreach ( $slide['list_items'] as $item ) : ?>
                      <li><span><?php echo esc_html( $item['item_heading'] ); ?>:</span> <?php echo aik_nl2br( $item['item_text'] ); ?></li>
                      <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                  </div>
                  <?php if ( ! empty( $slide['image']['url'] ) ) : ?>
                  <div class="feature-suite-slide__media">
                    <img src="<?php echo esc_url( $slide['image']['url'] ); ?>" alt="<?php echo esc_attr( $slide['image']['alt'] ? $slide['image']['alt'] : ( $slide['title'] ? wp_strip_all_tags( $slide['title'] ) : '' ) ); ?>">
                  </div>
                  <?php endif; ?>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
            <div class="swiper-pagination feature-suite-swiper__pagination"></div>
          </div>
          <?php endif; ?>
        </div>
      </section>
