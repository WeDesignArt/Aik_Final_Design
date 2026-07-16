<?php
/**
 * Layout: smarter_section
 * The main reusable feature/benefit block — added multiple times per page,
 * in whatever order the Flexible Content field has them.
 */

$heading         = get_sub_field( 'heading' );
$description     = get_sub_field( 'description' );
$list_items      = get_sub_field( 'list_items' );
$image           = get_sub_field( 'image' );
$image_pos       = get_sub_field( 'image_position' );
$bg_style        = get_sub_field( 'background_style' );
$bg_image        = get_sub_field( 'bg_image' );
$bg_image_mobile = get_sub_field( 'bg_image_mobile' );
$grid_left       = get_sub_field( 'grid_left' );
$grid_right      = get_sub_field( 'grid_right' );
$buttons         = get_sub_field( 'buttons' );
$extra_class     = get_sub_field( 'extra_class' );

$section_class = 'smarter-sec';
if ( $extra_class ) {
	// Multiple space-separated classes (e.g. "why-choose-sec debit_custom_why-choose-sec")
	// must be sanitized one at a time — sanitize_html_class() strips spaces if run on
	// the whole string at once, which glues the classes together.
	$classes = array_filter( preg_split( '/\s+/', trim( $extra_class ) ) );
	$classes = array_map( 'sanitize_html_class', $classes );
	if ( $classes ) {
		$section_class .= ' ' . implode( ' ', $classes );
	}
}

// Image Position "Left" is done the same way the original static pages do it —
// Bootstrap order utility classes swap which column renders first — rather than
// a CSS modifier class, since no such class/rule exists in the stylesheet.
$left_order_class  = ( 'left' === $image_pos ) ? ' order-md-2 order-1' : '';
$right_order_class = ( 'left' === $image_pos ) ? ' order-md-1 order-2' : '';

$grid_left_modifiers = array(
	'bottom_left' => '',
	'top_left'    => ' grid-top-left',
	'center_left' => ' grid-center-left',
);
$grid_right_modifiers = array(
	'top_right'    => '',
	'bottom_right' => ' grid-bottom-right',
);
?>
      <section class="<?php echo esc_attr( $section_class ); ?>">
        <div class="container">
          <div class="smarter-sec__inner">
            <div class="smarter-sec__left<?php echo esc_attr( $left_order_class ); ?>">
              <h2 class="smarter-sec__heading" data-aos="fade-right"><?php echo aik_highlight( $heading ); ?></h2>
              <?php if ( ! empty( $list_items ) ) : ?>
              <ul class="smarter-sec__desc" data-aos="fade-up" data-aos-delay="200">
                <?php foreach ( $list_items as $item ) : ?>
                <li><span><?php echo esc_html( $item['item_heading'] ); ?>:</span> <?php echo aik_nl2br( $item['item_text'] ); ?></li>
                <?php endforeach; ?>
              </ul>
              <?php elseif ( $description ) : ?>
              <p class="smarter-sec__desc" data-aos="fade-up" data-aos-delay="200"><?php echo aik_nl2br( $description ); ?></p>
              <?php endif; ?>
              <?php if ( ! empty( $buttons ) ) : ?>
              <div class="smarter-sec__btns" data-aos="fade-up" data-aos-delay="400">
                <?php foreach ( $buttons as $btn ) : ?>
                  <a href="<?php echo esc_url( $btn['link'] ? $btn['link'] : '#' ); ?>" class="btn btn_fill smarter-sec__btn"><?php echo esc_html( $btn['label'] ); ?></a>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>
            <?php if ( ! empty( $image['url'] ) ) : ?>
            <div class="smarter-sec__right<?php echo esc_attr( $right_order_class ); ?>">
              <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ? $image['alt'] : $heading ); ?>" data-aos="fade-left" data-aos-delay="300">
            </div>
            <?php endif; ?>
          </div>
        </div>
        <?php if ( 'custom' === $bg_style && ! empty( $bg_image['url'] ) ) : ?>
        <?php $mobile_bg_url = ! empty( $bg_image_mobile['url'] ) ? $bg_image_mobile['url'] : $bg_image['url']; ?>
        <div class="smarter-sec__bg d-none d-md-block"><img src="<?php echo esc_url( $bg_image['url'] ); ?>" alt="bg"></div>
        <div class="smarter-sec__bg custom_smarter_bg d-block d-md-none"><img src="<?php echo esc_url( $mobile_bg_url ); ?>" alt="bg"></div>
        <?php elseif ( 'none' !== $bg_style ) : ?>
        <div class="smarter-sec__bg"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/smarter_bg.png" alt=""></div>
        <?php endif; ?>
        <?php if ( isset( $grid_left_modifiers[ $grid_left ] ) ) : ?>
        <div class="grid-left<?php echo esc_attr( $grid_left_modifiers[ $grid_left ] ); ?>"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/left-grid-gray.png" alt="gride-img"></div>
        <?php endif; ?>
        <?php if ( isset( $grid_right_modifiers[ $grid_right ] ) ) : ?>
        <div class="grid-right<?php echo esc_attr( $grid_right_modifiers[ $grid_right ] ); ?>"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/right-grid-gray.png" alt="gride-img"></div>
        <?php endif; ?>
      </section>
