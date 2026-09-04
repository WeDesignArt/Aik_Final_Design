<?php
/**
 * Site search.
 *
 * WordPress's native search only matches post_title, post_excerpt and
 * post_content — but every Page on this site is built almost entirely
 * from the "page_sections" ACF Flexible Content field, whose text (Hero
 * heading, Smarter Section copy, list items, etc.) never touches
 * post_content, so a plain search would only ever match a page's title.
 *
 * The fix: whenever a page is saved, flatten every string value out of
 * its page_sections into plain text and store it in post_excerpt — not
 * post_content, since page.php renders post_content directly on the page
 * (see its "classic/block editor content" block) and dumping a wall of
 * unstyled flattened text there would be visibly broken. Nothing in the
 * theme renders post_excerpt directly, so this stays invisible on the
 * live page while WordPress's own search query (which checks post_excerpt
 * too) can now actually find it. search.php also reuses this same
 * post_excerpt (trimmed) as each result's preview snippet, so it isn't
 * wasted work.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Recursively collects every string value out of a Flexible Content /
 * repeater array (as returned by get_field()) into one plain-text blob.
 * Strips the **highlight__/__bold__ markup so raw asterisks/underscores
 * don't clutter the excerpt. ACF image/file field arrays are skipped
 * entirely (detected by their distinctive 'url' + 'mime_type' keys) since
 * their filename/URL/mime-type values aren't meaningful search text.
 */
function aik_flatten_field_text( $value ) {
	if ( is_array( $value ) ) {
		if ( isset( $value['url'] ) && isset( $value['mime_type'] ) ) {
			return '';
		}
		$parts = array();
		foreach ( $value as $item ) {
			$parts[] = aik_flatten_field_text( $item );
		}
		return implode( ' ', array_filter( $parts ) );
	}

	if ( ! is_string( $value ) ) {
		return '';
	}

	$value = preg_replace( '/\*\*(.+?)\*\*/', '$1', $value );
	$value = preg_replace( '/__(.+?)__/', '$1', $value );
	return wp_strip_all_tags( $value );
}

/**
 * Runs after ACF has finished saving a Page's fields (acf/save_post at
 * priority 20, so get_field() below reads the freshly-saved values).
 */
add_action( 'acf/save_post', 'aik_sync_search_excerpt', 20 );
function aik_sync_search_excerpt( $post_id ) {
	if ( ! is_numeric( $post_id ) || 'page' !== get_post_type( $post_id ) ) {
		return;
	}

	$text = aik_flatten_field_text( get_field( 'page_sections', $post_id ) );

	wp_update_post(
		array(
			'ID'           => $post_id,
			'post_excerpt' => $text,
		)
	);
}

/**
 * Search only Posts (News) and Pages — the site's other post types
 * (Testimonials, Partner Inquiries, Feedback) have no public single view
 * of their own and shouldn't be surfaced as search results.
 */
add_action( 'pre_get_posts', 'aik_restrict_search_post_types' );
function aik_restrict_search_post_types( $query ) {
	if ( ! is_admin() && $query->is_search() && $query->is_main_query() ) {
		$query->set( 'post_type', array( 'post', 'page' ) );
	}
}
