<?php
/**
 * Default page template — renders the "page_sections" Flexible Content
 * field. Falls back to the classic editor content if a page has no
 * sections yet (e.g. right after creating it).
 */

get_header();
?>
    <main role="main" class="home_content1 clearfix">
      <?php
      if ( have_rows( 'page_sections' ) ) {
		aik_render_page_sections();
	  } else {
		while ( have_posts() ) :
			the_post();
			?>
        <div class="container py-5">
          <?php the_content(); ?>
        </div>
			<?php
		endwhile;
	  }
	  ?>
    </main>
<?php
get_footer();
