<?php
/**
 * Layout: send_money
 * Centered heading + a grid of solid green cards, 3 per row, each just a
 * title + description (no image). Not connected to News posts in any way.
 *
 * ────────────────────────────────────────────────────────────────────────
 * PREVIOUS VERSION (photo cards, reusing the .news-single glass-panel
 * shell) — kept here in case this is wanted again later. To restore:
 * 1) Swap the render loop below back to the PHP block quoted below.
 * 2) Re-add this sub_field to the "cards" repeater in
 *    acf-json/group_aik_page_sections.json (JSON has no comment syntax,
 *    so it can't be left in place there — paste it back in when needed),
 *    right before field_aik_sm_card_title:
 *
 *    {
 *        "key": "field_aik_sm_card_image",
 *        "label": "Image",
 *        "name": "image",
 *        "type": "image",
 *        "return_format": "array",
 *        "preview_size": "medium",
 *        "wrapper": { "width": "100" }
 *    },
 *
 * 3) Old render loop (each $card had an 'image' sub-field):
 *
 *    <?php foreach ( $cards as $i => $card ) :
 *              $image = $card['image'];
 *              if ( empty( $image['url'] ) ) {
 *                  continue;
 *              }
 *              ?>
 *    <article class="news-single send-money-card mb-3" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( ( $i % 3 ) * 100 ); ?>">
 *      <div class="news-single-media"><img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>"></div>
 *      <div class="news-single-content">
 *        <h2 class="news-single-content-title"><?php echo esc_html( $card['title'] ); ?></h2>
 *        <p><?php echo esc_html( $card['description'] ); ?></p>
 *      </div>
 *    </article>
 *    <?php endforeach; ?>
 *
 * 4) Old CSS (.send-money-card .news-single-content / -title / p) is in
 *    this project's chat history — ask to have it re-applied, or restore
 *    from git history on css/style.css and the wp-theme copy.
 * ────────────────────────────────────────────────────────────────────────
 */

$heading = get_sub_field( 'heading' );
$cards   = get_sub_field( 'cards' );
?>
      <section class="send-money-sec">
        <div class="container">
          <div class="send-money-header" data-aos="fade-up">
            <h2 class="send-money-title"><?php echo aik_highlight( $heading ); ?></h2>
          </div>

          <?php if ( ! empty( $cards ) ) : ?>
          <div class="send-money-grid">
            <?php foreach ( $cards as $i => $card ) : ?>
            <div class="send-money-card" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( ( $i % 3 ) * 100 ); ?>">
              <h3 class="send-money-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
              <p class="send-money-card__desc"><?php echo esc_html( $card['description'] ); ?></p>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
        <div class="grid-left"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/left-grid-gray.png" alt="gride-img"></div>
        <div class="grid-right"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/right-grid-gray.png" alt="gride-img"></div>
      </section>
