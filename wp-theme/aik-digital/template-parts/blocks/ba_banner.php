<?php
/**
 * Layout: ba_banner
 * Brand Ambassador Bottom Banner
 */

$title      = get_sub_field( 'title' ) ?: 'Become a Brand Ambassador';
$title_ur   = get_sub_field( 'title_ur' ) ?: 'ایک برانڈ ایمبیسیڈر بنیں';
$subtext    = get_sub_field( 'subtext' ) ?: '© 2026 BankIslami aik. All Shariah principles applied.';
$subtext_ur = get_sub_field( 'subtext_ur' ) ?: '© 2026 BankIslami aik. تمام شریعت کے اصول لاگو ہیں۔';
$bg_image   = get_sub_field( 'bg_image' );

$bg_url = ! empty( $bg_image['url'] ) ? $bg_image['url'] : AIK_THEME_URI . '/images/bg_brand_ambassador.png';
?>
<section class="brand-ambassador-bottom-banner" style="background-image: url('<?php echo esc_url( $bg_url ); ?>');">
  <div class="container" data-aos="fade-up">
    <h2 class="brand-ambassador-bottom-banner__title" data-en="<?php echo esc_attr( $title ); ?>" data-ur="<?php echo esc_attr( $title_ur ); ?>"><?php echo esc_html( $title ); ?></h2>
    <p class="brand-ambassador-bottom-banner__sub" data-en="<?php echo esc_attr( $subtext ); ?>" data-ur="<?php echo esc_attr( $subtext_ur ); ?>"><?php echo esc_html( $subtext ); ?></p>
  </div>
</section>
