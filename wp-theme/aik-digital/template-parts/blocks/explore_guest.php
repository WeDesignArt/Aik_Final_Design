<?php
/**
 * Layout: explore_guest
 * "Explore aik Before You Sign Up" — standalone content/image block
 * (.explore-sec*), deliberately not a Smarter Section variant.
 */

$heading        = get_sub_field( 'heading' );
$description    = get_sub_field( 'description' );
$subheading_1   = get_sub_field( 'subheading_1' );
$list_items     = get_sub_field( 'list_items' );
$closing_blocks = get_sub_field( 'closing_blocks' );
$image          = get_sub_field( 'image' );
$extra_class    = get_sub_field( 'extra_class' );

$section_class = 'explore-sec';
if ( $extra_class ) {
	$classes = array_filter( preg_split( '/\s+/', trim( $extra_class ) ) );
	$classes = array_map( 'sanitize_html_class', $classes );
	if ( $classes ) {
		$section_class .= ' ' . implode( ' ', $classes );
	}
}
?>
      <section class="<?php echo esc_attr( $section_class ); ?>">
        <div class="container">
          <div class="explore-sec__inner">
            <div class="explore-sec__left">
              <?php if ( $heading ) : ?>
              <h2 class="explore-sec__heading" data-aos="fade-right"><?php echo aik_highlight( $heading ); ?></h2>
              <?php endif; ?>
              <?php if ( $description ) : ?>
              <p class="explore-sec__desc" data-aos="fade-up" data-aos-delay="100"><?php echo aik_nl2br( $description ); ?></p>
              <?php endif; ?>
              <?php if ( $subheading_1 ) : ?>
              <h3 class="explore-sec__subheading" data-aos="fade-up" data-aos-delay="150"><?php echo esc_html( $subheading_1 ); ?></h3>
              <?php endif; ?>
              <?php if ( ! empty( $list_items ) ) : ?>
              <ul class="explore-sec__list" data-aos="fade-up" data-aos-delay="200">
                <?php foreach ( $list_items as $item ) : ?>
                <li><?php echo esc_html( $item['item_text'] ); ?></li>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
              <?php if ( ! empty( $closing_blocks ) ) : ?>
              <?php foreach ( $closing_blocks as $block ) : ?>
              <div class="explore-sec__closing" data-aos="fade-up" data-aos-delay="250">
                <?php if ( $block['title'] ) : ?>
                <h3 class="explore-sec__subheading"><?php echo esc_html( $block['title'] ); ?></h3>
                <?php endif; ?>
                <?php if ( $block['description'] ) : ?>
                <p class="explore-sec__desc"><?php echo aik_nl2br( $block['description'] ); ?></p>
                <?php endif; ?>
                <?php if ( $block['button_label'] ) : ?>
                <a href="<?php echo esc_url( $block['button_link'] ? $block['button_link'] : 'javascript:void(0);' ); ?>" class="btn btn_fill explore-sec__btn"><?php echo esc_html( $block['button_label'] ); ?></a>
                <?php endif; ?>
              </div>
              <?php endforeach; ?>
              <?php endif; ?>
            </div>
            <?php if ( ! empty( $image['url'] ) ) : ?>
            <div class="explore-sec__right" data-aos="fade-left" data-aos-delay="200">
              <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ? $image['alt'] : '' ); ?>">
            </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="grid-right"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/right-grid-gray.png" alt="gride-img"></div>
      </section>
