<?php
/**
 * Layout: schedule_of_charges
 * Document library grid, 3 per row — cards deliberately REUSE the
 * existing .news-single card classes (main.css), same card design as
 * "Our Media News" (template-parts/blocks/news.php), with a PDF icon
 * standing in for a post thumbnail. The outer section/heading/grid get
 * their own .soc-* namespace, same reasoning as .help-sec/.feature-
 * suite-sec/.explore-sec.
 */

$heading   = get_sub_field( 'heading' );
$subtitle  = get_sub_field( 'subtitle' );
$documents = get_sub_field( 'documents' );
?>
      <section class="soc-section">
        <div class="container">
          <div class="soc-header" data-aos="fade-up">
            <h2 class="soc-title"><?php echo aik_highlight( $heading ); ?></h2>
            <?php if ( $subtitle ) : ?>
            <p class="soc-subtitle"><?php echo aik_nl2br( $subtitle ); ?></p>
            <?php endif; ?>
          </div>

          <?php if ( ! empty( $documents ) ) : ?>
          <div class="soc-grid">
            <?php foreach ( $documents as $i => $doc ) :
					$file = $doc['file'];
					if ( empty( $file['url'] ) ) {
						continue;
					}
					$doc_date = ! empty( $file['date'] ) ? date_i18n( get_option( 'date_format' ), strtotime( $file['date'] ) ) : '';
					?>
            <article class="news-single mb-3" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $i * 100 ); ?>">
              <a href="<?php echo esc_url( $file['url'] ); ?>" target="_blank" rel="noopener" class="news-single-media soc-thumb<?php echo empty( $doc['thumbnail']['url'] ) ? ' soc-thumb--icon' : ''; ?>">
                <?php if ( ! empty( $doc['thumbnail']['url'] ) ) : ?>
                <img src="<?php echo esc_url( $doc['thumbnail']['url'] ); ?>" alt="<?php echo esc_attr( $doc['title'] ); ?>">
                <?php else : ?>
                <i class="bi bi-file-earmark-pdf"></i>
                <?php endif; ?>
              </a>
              <div class="news-single-content">
                <?php if ( $doc_date ) : ?>
                <div class="news-single-meta d-flex align-items-center py-3 gap-2"><i class="bi bi-calendar"></i>
                  <span class="data text-white"><?php echo esc_html( $doc_date ); ?></span>
                </div>
                <?php endif; ?>
                <h2 class="news-single-content-title"><?php echo esc_html( $doc['title'] ); ?></h2>
                <a href="<?php echo esc_url( $file['url'] ); ?>" target="_blank" rel="noopener" download class="btn read-btn">Download PDF <i class="ri-arrow-right-line"></i></a>
              </div>
            </article>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
        <div class="grid-left"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/left-grid-gray.png" alt="gride-img"></div>
        <div class="grid-right"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/right-grid-gray.png" alt="gride-img"></div>
      </section>
