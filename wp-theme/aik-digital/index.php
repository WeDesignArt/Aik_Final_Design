<?php
/**
 * Fallback template (blog index / archives). The theme's real content is
 * built with Pages + the Flexible Content field via page.php — this file
 * only exists so WordPress has a valid catch-all.
 */

get_header();
?>
    <main role="main" class="home_content1 clearfix">
      <section class="md-news-section position-relative overflow-hidden">
        <div class="container">
          <div class="md-news x_spacing">
            <div class="row g-4">
              <?php
              if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					?>
                <?php $external_link = get_field( 'external_link' ); ?>
                <div class="col-lg-4">
                  <article class="news-single mb-3">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="news-single-media">
                      <?php if ( $external_link ) : ?>
                      <a href="<?php echo esc_url( $external_link ); ?>" target="_blank" rel="noopener noreferrer"><?php the_post_thumbnail( 'medium' ); ?></a>
                      <?php else : ?>
                      <?php the_post_thumbnail( 'medium' ); ?>
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
			  else :
				?>
                <p><?php esc_html_e( 'No posts found.', 'aik-digital' ); ?></p>
				<?php
			  endif;
			  ?>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php
get_footer();
