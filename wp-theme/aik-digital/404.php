<?php
/**
 * 404 (page not found).
 *
 * Standalone component (.error-404-*) — no hero banner (same reasoning
 * as search.php). Reuses .search-results-form (the pill search bar,
 * submits to WordPress's own search) and .btn.btn_fill for the way back
 * home — same controls used site-wide, nothing new to maintain here.
 */

get_header();
?>
    <main role="main" class="home_content1 clearfix">
      <section class="error-404-sec">
        <div class="container">
          <p class="error-404__code">4<span>0</span>4</p>
          <h1 class="error-404__title">Page Not Found</h1>
          <p class="error-404__desc">Sorry, the page you're looking for doesn't exist or may have been moved. Try
            searching for what you need, or head back to the homepage.</p>

          <form class="search-results-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
            <input type="text" name="s" placeholder="Search aik digital..." autocomplete="off">
            <button type="submit" aria-label="Search"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/icon/icon_submit.png" alt=""></button>
          </form>

          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn_fill error-404__home-btn">Back to Home</a>
        </div>
        <div class="grid-left"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/left-grid-gray.png" alt="gride-img"></div>
        <div class="grid-right"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/right-grid-gray.png" alt="gride-img"></div>
      </section>
    </main>
<?php
get_footer();
