<?php
/**
 * The actual blog index template — this is what WordPress uses for
 * Settings → Reading's "Posts page" (or for the homepage when "Your
 * homepage displays" is left on "Your latest posts"), NOT archive.php.
 * Shares its markup with archive.php via template-parts/news-archive-content.php
 * so the "Media News" design stays identical in both places.
 */

get_header();
?>
    <main role="main" class="home_content1 clearfix">
      <?php get_template_part( 'template-parts/news-archive-content' ); ?>
    </main>
<?php
get_footer();
