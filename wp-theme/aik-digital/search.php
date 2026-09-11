<?php
/**
 * Search results.
 *
 * Query is WordPress's own main search query (restricted to Posts + Pages
 * by inc/search.php's pre_get_posts filter) — nothing custom to build
 * here. Each result's snippet comes from post_excerpt, which
 * inc/search.php keeps synced with a page's Flexible Content text on
 * every save (see that file for why), trimmed to a short preview here.
 *
 * Cards are the standalone .search-result-card component (not
 * .news-single) since results can be Pages, which generally have no
 * featured image.
 */

get_header();
?>
    <main role="main" class="home_content1 clearfix">
      <section class="home_hero_wrapper index_custom clearfix position-relative bg_primary">
        <section class="home_hero_slider custom_adjustment aik_landing overflow-hidden">
          <div class="app_link_holder">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span>Personal</span> </a>
            <a href="<?php echo esc_url( home_url( '/business' ) ); ?>"><span>Business</span> </a>
          </div>
          <article class="hero_item debit_hero_item">
            <div class="hero_img">
              <picture>
                <source media="(min-width: 575px)" srcset="<?php echo esc_url( AIK_THEME_URI ); ?>/images/bg-1.png">
                <img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/bg-1.png" alt="slide">
              </picture>
            </div>
            <div class="debit-hero-caption">
              <h1> <span>How May We Help You?</span></h1>
            </div>
          </article>
        </section>
      </section>

      <section class="search-results-sec">
        <div class="container">
          <h2 class="search-results-title">Search Results for: <span>"<?php echo esc_html( get_search_query() ); ?>"</span></h2>

          <form class="search-results-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
            <input type="text" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Search again..." autocomplete="off">
            <button type="submit" aria-label="Search"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/icon_submit.png" alt=""></button>
          </form>

          <?php if ( have_posts() ) : ?>
          <div class="search-results-list">
            <?php
			while ( have_posts() ) :
				the_post();
				?>
            <article class="search-result-card">
              <h2 class="search-result-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <?php $excerpt = wp_trim_words( get_the_excerpt(), 30, '…' ); ?>
              <?php if ( $excerpt ) : ?>
              <p class="search-result-card__excerpt"><?php echo esc_html( $excerpt ); ?></p>
              <?php endif; ?>
              <a href="<?php the_permalink(); ?>" class="search-result-card__link">Read More <i class="ri-arrow-right-line"></i></a>
            </article>
            <?php endwhile; ?>
          </div>

          <div class="news-archive-pagination">
            <?php
			the_posts_pagination(
				array(
					'prev_text' => '←',
					'next_text' => '→',
				)
			);
			?>
          </div>
          <?php else : ?>
          <p class="search-results-empty">No results found for "<strong><?php echo esc_html( get_search_query() ); ?></strong>". Try a different search term.</p>
          <?php endif; ?>
        </div>
      </section>
    </main>
<?php
get_footer();
