<?php
/**
 * Layout: news
 */

$heading     = get_sub_field( 'heading' );
$description = get_sub_field( 'description' );
$category    = get_sub_field( 'category' );
$count       = (int) get_sub_field( 'count' );

$news_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => $count ? $count : 3,
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
            <div class="row g-4">
              <?php
              $i = 0;
              while ( $news_query->have_posts() ) :
				$news_query->the_post();
				?>
              <div class="col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $i * 100 ); ?>">
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
              </div>
              <?php
              ++$i;
              endwhile;
			  wp_reset_postdata();
			  ?>
            </div>
            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="300"><a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="btn btn_fill">See More</a></div>
          </div>
          <?php endif; ?>
        </div>
        <div class="grid-left"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/left-grid-gray.png" alt="gride-img"></div>
        <div class="grid-right"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/right-grid-gray.png" alt="gride-img"></div>
      </section>
