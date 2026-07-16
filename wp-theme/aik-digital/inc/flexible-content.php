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
 *
 * Also converts a plain Enter/newline (typed in a textarea field) into
 * <br> — matches how "Your Key to<br>Everyday Savings" is written in the
 * original static markup, without editors needing to type raw HTML tags.
 */
function aik_highlight( $text ) {
	$text = esc_html( (string) $text );
	$text = preg_replace( '/\*\*(.+?)\*\*/', '<span>$1</span>', $text );
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
