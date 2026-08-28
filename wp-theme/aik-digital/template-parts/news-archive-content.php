<?php
/**
 * Shared "Media News" listing content — hero banner + 3-column grid +
 * pagination. Included by both archive.php (category/tag/date archives)
 * and home.php (the Settings → Reading "Posts page", which is what
 * actually governs the general blog index — archive.php is never used
 * for that, only for real taxonomy/date archives) so the two templates
 * can't drift out of sync with each other.
 *
 * Cards reuse the homepage's .news-single dark glass-overlay style (same
 * markup as the swiper slides in news.php) rather than a separate design,
 * so a post looks identical whether it's in the homepage preview or here.
 */

$news_archive_title = is_category() ? single_cat_title( '', false ) : 'Media News';
?>
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
              <h1><?php echo esc_html( $news_archive_title ); ?></h1>
            </div>
          </article>
        </section>
      </section>

      <section class="news-archive-section">
        <div class="container">
          <?php if ( have_posts() ) : ?>
          <div class="news-archive-grid">
            <?php
			while ( have_posts() ) :
				the_post();
				?>
            <article class="news-single mb-3">
              <?php if ( has_post_thumbnail() ) : ?>
              <div class="news-single-media"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large' ); ?></a></div>
              <?php endif; ?>
              <div class="news-single-content">
                <div class="news-single-meta d-flex align-items-center py-3 gap-2"><i class="bi bi-calendar"></i>
                  <span class="data text-white"><?php the_date(); ?></span>
                </div>
                <h2 class="news-single-content-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <a href="<?php the_permalink(); ?>" class="btn read-btn">Read More <i class="ri-arrow-right-line"></i></a>
              </div>
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
          <p class="news-archive-empty text-center">No news posts yet.</p>
          <?php endif; ?>
        </div>
      </section>
