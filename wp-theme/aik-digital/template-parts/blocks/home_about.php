<?php
/**
 * Layout: home_about
 */

$heading         = get_sub_field( 'heading' );
$heading_ur      = get_sub_field( 'heading_ur' );
$description     = get_sub_field( 'description' );
$description_ur  = get_sub_field( 'description_ur' );
$button_text     = get_sub_field( 'button_text' );
$button_text_ur  = get_sub_field( 'button_text_ur' );
$button_link     = get_sub_field( 'button_link' );
?>
      <section class="home_about_section clearfix overflow-hidden">
        <div class="x_spacing position-relative">
          <div class="container position-relative">
            <div class="row justify-content-center g-0">
              <div class="col-lg-10">
                <div class="row justify-content-center align-items-center g-0">
                  <div class="col-lg-10 text-center">
                    <div class="home_about_section_content text-center">
                      <h2 class="home_about_section_content_title display-3" data-aos="fade-left" data-en="<?php echo esc_attr( aik_highlight( $heading ) ); ?>" data-ur="<?php echo esc_attr( aik_highlight( $heading_ur ? $heading_ur : $heading ) ); ?>"><?php echo aik_highlight( $heading ); ?></h2>
                      <?php if ( $description ) : ?>
                      <p data-aos="fade-up" data-en="<?php echo esc_attr( aik_nl2br( $description ) ); ?>" data-ur="<?php echo esc_attr( aik_nl2br( $description_ur ? $description_ur : $description ) ); ?>"><?php echo aik_nl2br( $description ); ?></p>
                      <?php endif; ?>
                      <?php if ( $button_text ) : ?>
                      <a href="<?php echo esc_url( $button_link ? $button_link : '#' ); ?>" class="btn btn_fill" data-aos="fade-right" data-en="<?php echo esc_attr( $button_text ); ?>" data-ur="<?php echo esc_attr( $button_text_ur ? $button_text_ur : $button_text ); ?>"><?php echo esc_html( $button_text ); ?></a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="grid-left"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/left-grid-gray.png" alt="gride-img"></div>
            <div class="grid-right"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/right-grid-gray.png" alt="gride-img"></div>
          </div>
        </div>
      </section>
