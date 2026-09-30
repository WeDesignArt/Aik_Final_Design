<?php
/**
 * Layout: smarter_section
 * The main reusable feature/benefit block — added multiple times per page,
 * in whatever order the Flexible Content field has them.
 */

$top_image       = get_sub_field( 'top_image' );
$heading         = get_sub_field( 'heading' );
$heading_ur      = get_sub_field( 'heading_ur' );
$description     = get_sub_field( 'description' );
$description_ur  = get_sub_field( 'description_ur' );
$list_items      = get_sub_field( 'list_items' );
$icon_items      = get_sub_field( 'icon_items' );
$media_type      = get_sub_field( 'media_type' ) ?: 'image';
$image           = get_sub_field( 'image' );
$video           = get_sub_field( 'video' );
$image_pos       = get_sub_field( 'image_position' );
$bg_style        = get_sub_field( 'background_style' );
$bg_image        = get_sub_field( 'bg_image' );
$bg_image_mobile = get_sub_field( 'bg_image_mobile' );
$grid_left       = get_sub_field( 'grid_left' );
$grid_right      = get_sub_field( 'grid_right' );
$buttons         = get_sub_field( 'buttons' );
$show_notes      = get_sub_field( 'show_notes' );
$notes           = get_sub_field( 'notes' );
$extra_class     = get_sub_field( 'extra_class' );

$section_class = 'smarter-sec';
if ( 'none' === $bg_style ) {
	// Heading/Description/List text defaults to white for the dark textured
	// background used everywhere else — on a plain white section that's
	// invisible, so switch it to dark text automatically here instead of
	// relying on every white-background section remembering a manual class.
	$section_class .= ' smarter-sec--on-white';
}
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
              <?php if ( ! empty( $top_image['url'] ) ) : ?>
              <div class="smarter-sec__top-logo" data-aos="fade-right"><img src="<?php echo esc_url( $top_image['url'] ); ?>" alt="<?php echo esc_attr( $top_image['alt'] ? $top_image['alt'] : '' ); ?>"></div>
              <?php endif; ?>
              <h2 class="smarter-sec__heading" data-aos="fade-right" data-en="<?php echo esc_attr( aik_highlight( $heading ) ); ?>" data-ur="<?php echo esc_attr( aik_highlight( $heading_ur ? $heading_ur : $heading ) ); ?>"><?php echo aik_highlight( $heading ); ?></h2>
              <?php if ( $description ) : ?>
              <p class="smarter-sec__desc" data-aos="fade-up" data-aos-delay="200" data-en="<?php echo esc_attr( aik_highlight( $description ) ); ?>" data-ur="<?php echo esc_attr( aik_highlight( $description_ur ? $description_ur : $description ) ); ?>"><?php echo aik_highlight( $description ); ?></p>
              <?php endif; ?>
              <?php if ( ! empty( $list_items ) ) : ?>
              <ul class="smarter-sec__desc" data-aos="fade-up" data-aos-delay="250">
                <?php foreach ( $list_items as $item ) :
					$item_h    = ! empty( $item['item_heading'] ) ? $item['item_heading'] : '';
					$item_h_ur = ! empty( $item['item_heading_ur'] ) ? $item['item_heading_ur'] : $item_h;
					$item_t    = ! empty( $item['item_text'] ) ? $item['item_text'] : '';
					$item_t_ur = ! empty( $item['item_text_ur'] ) ? $item['item_text_ur'] : $item_t;
					$en_html   = ( $item_h ? '<span>' . esc_html( $item_h ) . ':</span> ' : '' ) . aik_nl2br( $item_t );
					$ur_html   = ( $item_h_ur ? '<span>' . esc_html( $item_h_ur ) . ':</span> ' : '' ) . aik_nl2br( $item_t_ur );
				?>
                <li data-en="<?php echo esc_attr( $en_html ); ?>" data-ur="<?php echo esc_attr( $ur_html ); ?>"><?php echo $en_html; // phpcs:ignore ?></li>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
              <?php if ( ! empty( $icon_items ) ) : ?>
              <div class="smarter-sec__icons" data-aos="fade-up" data-aos-delay="300">
                <?php foreach ( $icon_items as $icon_item ) :
					$lbl    = ! empty( $icon_item['icon_label'] ) ? $icon_item['icon_label'] : '';
					$lbl_ur = ! empty( $icon_item['icon_label_ur'] ) ? $icon_item['icon_label_ur'] : $lbl;
				?>
                <div class="smarter-sec__icon-item">
                  <span class="smarter-sec__icon-box"><?php aik_the_acf_image( $icon_item['icon_image'], 'smarter-sec__icon-img' ); ?></span>
                  <span class="smarter-sec__icon-label" data-en="<?php echo esc_attr( $lbl ); ?>" data-ur="<?php echo esc_attr( $lbl_ur ); ?>"><?php echo esc_html( $lbl ); ?></span>
                </div>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
              <?php if ( ! empty( $buttons ) ) : ?>
              <div class="smarter-sec__btns" data-aos="fade-up" data-aos-delay="400">
                <?php foreach ( $buttons as $btn ) :
					$b_lbl    = ! empty( $btn['label'] ) ? $btn['label'] : '';
					$b_lbl_ur = ! empty( $btn['label_ur'] ) ? $btn['label_ur'] : $b_lbl;
				?>
                  <a href="<?php echo esc_url( $btn['link'] ? $btn['link'] : '#' ); ?>" class="btn btn_fill smarter-sec__btn" data-en="<?php echo esc_attr( $b_lbl ); ?>" data-ur="<?php echo esc_attr( $b_lbl_ur ); ?>"><?php echo esc_html( $b_lbl ); ?></a>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
              <?php if ( $show_notes && ! empty( $notes ) ) : ?>
              <div class="note" data-aos="fade-up" data-aos-delay="450">
                <?php foreach ( $notes as $note ) :
					$n_h    = ! empty( $note['note_heading'] ) ? $note['note_heading'] : '';
					$n_h_ur = ! empty( $note['note_heading_ur'] ) ? $note['note_heading_ur'] : $n_h;
					$n_t    = ! empty( $note['note_text'] ) ? $note['note_text'] : '';
					$n_t_ur = ! empty( $note['note_text_ur'] ) ? $note['note_text_ur'] : $n_t;
					$en_note = ( $n_h ? '<strong>' . esc_html( $n_h ) . ':</strong> ' : '' ) . aik_nl2br( $n_t );
					$ur_note = ( $n_h_ur ? '<strong>' . esc_html( $n_h_ur ) . ':</strong> ' : '' ) . aik_nl2br( $n_t_ur );
				?>
                <p class="smarter-sec__desc_note" data-en="<?php echo esc_attr( $en_note ); ?>" data-ur="<?php echo esc_attr( $ur_note ); ?>"><?php echo $en_note; // phpcs:ignore ?></p>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>
            <?php if ( 'video' === $media_type && ! empty( $video['url'] ) ) : ?>
            <div class="smarter-sec__right<?php echo esc_attr( $right_order_class ); ?>">
              <video src="<?php echo esc_url( $video['url'] ); ?>" autoplay muted loop playsinline data-aos="fade-left" data-aos-delay="300"></video>
            </div>
            <?php elseif ( 'image' === $media_type && ! empty( $image['url'] ) ) : ?>
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
