<?php
/**
 * Category/tag/date/author archive fallback. NOT used for the general blog
 * index (Settings → Reading "Posts page" or "latest posts" as homepage) —
 * that goes through home.php instead, per WP's template hierarchy. Both
 * share the same markup via template-parts/news-archive-content.php.
 */

get_header();
?>
    <main role="main" class="home_content1 clearfix">
      <?php get_template_part( 'template-parts/news-archive-content' ); ?>
    </main>
<?php
get_footer();
