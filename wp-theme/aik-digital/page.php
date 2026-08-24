<?php
/**
 * Default page template — renders the "page_sections" Flexible Content
 * field, then the classic/block editor content below it (if any was
 * typed). The two aren't mutually exclusive: a page can have just a Hero
 * section (e.g. for the banner + Personal/Business toggle) with the actual
 * body text written normally in the editor — e.g. Privacy Policy, Terms —
 * instead of needing a dedicated Flexible Content layout for plain text.
 */

get_header();
?>
    <main role="main" class="home_content1 clearfix">
      <?php
      if ( have_rows( 'page_sections' ) ) {
		aik_render_page_sections();
	  }

	  while ( have_posts() ) :
		the_post();
		if ( trim( get_the_content() ) ) :
			?>
        <div class="container py-5">
          <?php the_content(); ?>
        </div>
			<?php
		endif;
	  endwhile;
	  ?>
    </main>
<?php
get_footer();
