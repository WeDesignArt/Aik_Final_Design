<?php
/**
 * Layout: news
 */

$heading     = get_sub_field( 'heading' );
$description = get_sub_field( 'description' );
$category    = get_sub_field( 'category' );
$count       = (int) get_sub_field( 'count' );

// "Number of Posts" is an optional cap, not a required count — left blank
// (or 0) it shows every post in the category automatically, so a new post
// appears here without editing this section each time. -1 is WP_Query's
// "no limit" value.
$news_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => $count > 0 ? $count : -1,
		'cat'            => $category ? $category : '',
		'no_found_rows'  => true,
	)
);
?>
      <section class="md-news-section position-relative overflow-hidden">
        <div class="container">
          <div class="md-news-header" data-aos="fade-up">
            <h2 class="md-news-title"><?php echo aik_highlight( $heading ); ?></h2>
            <?php if ( $description ) : ?>
            <p class="md-news-subtitle"><?php echo aik_nl2br( $description ); ?></p>
            <?php endif; ?>
          </div>
          <?php if ( $news_query->have_posts() ) : ?>
          <div class="md-news x_spacing">
            <div class="md-news-swiper-wrap" data-aos="fade-up">
              <button type="button" class="md-news-swiper__nav md-news-swiper__nav--prev" aria-label="Previous news"><i class="bi bi-arrow-left"></i></button>

              <div class="swiper md-news-swiper" id="mdNewsSwiper">
                <div class="swiper-wrapper">
                  <?php
                  while ( $news_query->have_posts() ) :
					$news_query->the_post();
					?>
                  <?php $external_link = get_field( 'external_link' ); ?>
                  <div class="swiper-slide">
                    <article class="news-single mb-3">
                      <?php if ( has_post_thumbnail() ) : ?>
                      <div class="news-single-media">
                        <?php if ( $external_link ) : ?>
                        <a href="<?php echo esc_url( $external_link ); ?>" target="_blank" rel="noopener noreferrer"><?php the_post_thumbnail( 'medium_large' ); ?></a>
                        <?php else : ?>
                        <?php the_post_thumbnail( 'medium_large' ); ?>
                        <?php endif; ?>
                      </div>
                      <?php endif; ?>
                      <div class="news-single-content">
                        <div class="news-single-meta d-flex align-items-center py-3 gap-2"><i class="bi bi-calendar"></i>
                          <span class="data text-white"><?php echo esc_html( get_the_date() ); ?></span>
                        </div>
                        <h2 class="news-single-content-title"><?php if ( $external_link ) : ?><a href="<?php echo esc_url( $external_link ); ?>" target="_blank" rel="noopener noreferrer"><?php the_title(); ?></a><?php else : ?><?php the_title(); ?><?php endif; ?></h2>
                        <?php if ( $external_link ) : ?>
                        <a href="<?php echo esc_url( $external_link ); ?>" target="_blank" rel="noopener noreferrer" class="btn read-btn">Read More <i class="ri-arrow-right-line"></i></a>
                        <?php endif; ?>
                      </div>
                    </article>
                  </div>
                  <?php
                  endwhile;
				  wp_reset_postdata();
				  ?>
                </div>
              </div>

              <button type="button" class="md-news-swiper__nav md-news-swiper__nav--next" aria-label="Next news"><i class="bi bi-arrow-right"></i></button>
            </div>
            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="300"><a href="<?php echo esc_url( aik_news_index_url() ); ?>" class="btn btn_fill">See More</a></div>
          </div>
          <?php endif; ?>
        </div>
        <div class="grid-left"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/left-grid-gray.png" alt="gride-img"></div>
        <div class="grid-right"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/right-grid-gray.png" alt="gride-img"></div>
      </section>
