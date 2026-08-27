<?php
/**
 * Layout: faq
 * Collapsible question/answer accordion. The first item starts open;
 * clicking a question opens it and closes whichever one was open —
 * only one item is ever expanded at a time.
 */

$heading      = get_sub_field( 'heading' );
$items        = get_sub_field( 'items' );
$show_button  = get_sub_field( 'show_button' );
$button_label = get_sub_field( 'button_label' );
$button_link  = get_sub_field( 'button_link' );

if ( empty( $items ) ) {
	return;
}
?>
      <section class="aik-faq">
        <div class="container">
          <h2 class="aik-faq__heading" data-aos="fade-up"><?php echo aik_highlight( $heading ); ?></h2>
          <div class="aik-faq__list">
            <?php foreach ( $items as $i => $item ) : ?>
            <div class="aik-faq__item<?php echo 0 === $i ? ' is-open' : ''; ?>">
              <button type="button" class="aik-faq__toggle">
                <span class="aik-faq__question"><?php echo esc_html( $item['question'] ); ?></span>
                <span class="aik-faq__arrow"><i class="bi bi-arrow-right"></i></span>
              </button>
              <div class="aik-faq__answer">
                <p><?php echo aik_nl2br( $item['answer'] ); ?></p>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <?php if ( $show_button && $button_label ) : ?>
          <div class="aik-faq__btn text-center">
            <a href="<?php echo esc_url( $button_link ? $button_link : '#' ); ?>" class="btn btn_fill"><?php echo esc_html( $button_label ); ?></a>
          </div>
          <?php endif; ?>
        </div>
      </section>

      <?php if ( ! defined( 'AIK_FAQ_JS_PRINTED' ) ) : ?>
      <?php define( 'AIK_FAQ_JS_PRINTED', true ); ?>
      <script>
        (function () {
          document.querySelectorAll('.aik-faq').forEach(function (faq) {
            var items = faq.querySelectorAll('.aik-faq__item');
            items.forEach(function (item) {
              var toggle = item.querySelector('.aik-faq__toggle');
              if (!toggle) return;
              toggle.addEventListener('click', function () {
                var isOpen = item.classList.contains('is-open');
                items.forEach(function (el) { el.classList.remove('is-open'); });
                if (!isOpen) { item.classList.add('is-open'); }
              });
            });
          });
        })();
      </script>
      <?php endif; ?>
