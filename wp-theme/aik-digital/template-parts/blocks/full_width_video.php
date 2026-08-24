<?php
/**
 * Layout: full_width_video
 * Standalone edge-to-edge video section — deliberately has no .container
 * wrapper, so the video always spans the full page width, unlike Smarter
 * Section's Video option which sits inside the boxed layout next to text.
 */

$video = get_sub_field( 'video' );

if ( empty( $video['url'] ) ) {
	return;
}
?>
      <section class="full-width-video-sec">
        <video src="<?php echo esc_url( $video['url'] ); ?>" autoplay muted loop playsinline data-aos="fade-up"></video>
      </section>
