<?php
/**
 * Flexible Content dispatcher.
 *
 * Loops the "page_sections" Flexible Content field and includes the
 * matching template-parts/blocks/{layout-name}.php for each row. Field
 * access inside those templates uses get_sub_field()/have_rows(), which
 * work correctly across the include() because ACF tracks the current row
 * via its own internal state, not PHP variable scope.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function aik_render_page_sections( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();

	if ( ! have_rows( 'page_sections', $post_id ) ) {
		return;
	}

	while ( have_rows( 'page_sections', $post_id ) ) {
		the_row();

		$layout = get_row_layout();
		$template = AIK_THEME_DIR . '/template-parts/blocks/' . sanitize_file_name( $layout ) . '.php';

		if ( file_exists( $template ) ) {
			include $template;
		}
	}
}

/**
 * Turns "Spend **Smarter,** the **Halal** Way" into
 * 'Spend <span>Smarter,</span> the <span>Halal</span> Way' so editors can
 * mark up highlighted words from a plain text/textarea field without a raw
 * HTML/WYSIWYG field (which would let them break the section markup).
 * __word__ works the same way but for plain bold (<strong>) — no color
 * change, so it reads as bold black or bold white depending on whatever
 * color the surrounding text already is.
 *
 * Also converts a plain Enter/newline (typed in a textarea field) into
 * <br> — matches how "Your Key to<br>Everyday Savings" is written in the
 * original static markup, without editors needing to type raw HTML tags.
 */
function aik_highlight( $text ) {
	$text = esc_html( (string) $text );
	$text = preg_replace( '/\*\*(.+?)\*\*/', '<span>$1</span>', $text );
	$text = preg_replace( '/__(.+?)__/', '<strong>$1</strong>', $text );
	return nl2br( $text, false );
}

/**
 * Same newline-to-<br> handling as aik_highlight(), for plain paragraph
 * fields (Description, Subtext, etc.) that don't use the **highlight**
 * markup — e.g. so a manual Enter in a Description textarea creates a line
 * break instead of being silently collapsed by HTML whitespace rules.
 */
function aik_nl2br( $text ) {
	return nl2br( esc_html( (string) $text ), false );
}

/**
 * URL of the "Media News" listing (Settings → Reading → Posts page).
 *
 * get_post_type_archive_link( 'post' ) looks like the obvious function for
 * this but only works for custom post types registered with has_archive —
 * the built-in 'post' type never has one, so it silently returns false,
 * esc_url() turns that into "", and the link ends up pointing at whatever
 * page it's rendered on (harmless while the front page itself was showing
 * latest posts, but breaks — links back to itself — once a static front
 * page is set with a separate Posts page).
 */
function aik_news_index_url() {
	$posts_page_id = (int) get_option( 'page_for_posts' );
	if ( $posts_page_id ) {
		return get_permalink( $posts_page_id );
	}
	return home_url( '/' );
}

/**
 * Small helper: echo an ACF image field (array format) as an <img>, with a
 * graceful no-op if the field is empty — every block template uses this
 * instead of repeating the same isset()/esc checks.
 */
function aik_the_acf_image( $image, $class = '', $extra_attrs = '' ) {
	if ( empty( $image ) || empty( $image['url'] ) ) {
		return;
	}
	printf(
		'<img src="%1$s" alt="%2$s" class="%3$s" %4$s>',
		esc_url( $image['url'] ),
		esc_attr( $image['alt'] ),
		esc_attr( $class ),
		$extra_attrs // phpcs:ignore -- trusted, theme-controlled attribute strings only.
	);
}
