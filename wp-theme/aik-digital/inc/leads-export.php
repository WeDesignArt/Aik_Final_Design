<?php
/**
 * Leads CSV Export — adds "Download Selected (CSV)" / "Download All (CSV)"
 * buttons and an "Export Selected to CSV" Bulk Action to the wp-admin list
 * tables for Partner Inquiries and Feedback (both submission-only CPTs,
 * see inc/post-types.php). One generic implementation for both post types
 * — aik_leads_export_config() below is the only per-post-type-specific
 * part (which CSV columns map to which postmeta key).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CSV column map for each exportable post type: key is either 'ID',
 * 'post_title', 'post_date' (read straight off the post) or a postmeta
 * key; value is the CSV column header. Add a post type here to make its
 * list table exportable — everything else in this file is generic.
 */
function aik_leads_export_config( $post_type ) {
	$config = array(
		'partner_inquiry' => array(
			'ID'         => 'Lead ID',
			'post_date'  => 'Date Submitted',
			'post_title' => 'Name — Company',
			'email'      => 'Email',
			'mobile'     => 'Mobile',
			'company'    => 'Company',
			'service'    => 'Service',
			'message'    => 'Message',
		),
		'feedback_entry'  => array(
			'ID'         => 'Lead ID',
			'post_date'  => 'Date Submitted',
			'post_title' => 'Name — Product',
			'email'      => 'Email',
			'mobile'     => 'Mobile',
			'product'    => 'Product',
			'query_type' => 'Query Type',
			'message'    => 'Message',
		),
	);

	return isset( $config[ $post_type ] ) ? $config[ $post_type ] : null;
}

/**
 * "Download Selected" (button — ties into the list table's own checkbox
 * form) + "Download All" (plain link) above the list table. Only shown on
 * post types aik_leads_export_config() knows about.
 */
function aik_add_leads_export_buttons( $which ) {
	global $typenow;

	$columns = aik_leads_export_config( $typenow );
	if ( ! $columns || 'top' !== $which ) {
		return;
	}

	$nonce_action   = 'aik_export_leads_' . $typenow;
	$nonce          = wp_create_nonce( $nonce_action );
	$export_all_url = wp_nonce_url(
		add_query_arg(
			array(
				'action'    => 'aik_export_leads',
				'post_type' => $typenow,
			),
			admin_url( 'admin-post.php' )
		),
		$nonce_action,
		'export_nonce'
	);
	?>
	<div class="alignleft actions aik-leads-export-actions">
		<input type="hidden" name="aik_export_nonce" value="<?php echo esc_attr( $nonce ); ?>">

		<button type="submit" name="aik_leads_export_action" value="selected" id="aik-export-selected-btn" class="button aik-export-btn aik-export-btn--selected">
			<span class="dashicons dashicons-yes-alt"></span>
			<span id="aik-selected-btn-text"><?php esc_html_e( 'Download Selected (CSV)', 'aik-digital' ); ?></span>
		</button>

		<a href="<?php echo esc_url( $export_all_url ); ?>" class="button aik-export-btn aik-export-btn--all">
			<span class="dashicons dashicons-download"></span>
			<?php esc_html_e( 'Download All (CSV)', 'aik-digital' ); ?>
		</a>
	</div>

	<style>
		/* Kept deliberately understated (AIK green, solid vs. outline) —
		   the bright saturated blue/green button colors this was ported
		   from looked out of place sitting in wp-admin's own UI. */
		.aik-leads-export-actions {
			display: inline-flex;
			align-items: center;
			gap: 6px;
			margin-left: 4px;
		}
		.aik-export-btn {
			display: inline-flex !important;
			align-items: center;
			gap: 4px;
			font-weight: 600;
		}
		.aik-export-btn .dashicons {
			font-size: 16px;
			width: 16px;
			height: 16px;
			line-height: 1.4;
		}
		.aik-export-btn--selected {
			background-color: #065258 !important;
			border-color: #065258 !important;
			color: #fff !important;
		}
		.aik-export-btn--selected:hover {
			background-color: #053f44 !important;
			border-color: #053f44 !important;
		}
		.aik-export-btn--all {
			background-color: #fff !important;
			border-color: #065258 !important;
			color: #065258 !important;
		}
		.aik-export-btn--all:hover {
			background-color: #f2f7f7 !important;
		}
	</style>
	<script>
	( function ( $ ) {
		$( function () {
			function aikUpdateExportCount() {
				var checked = $( 'input[name="post[]"]:checked' ).length;
				$( '#aik-selected-btn-text' ).text(
					checked > 0
						? '<?php echo esc_js( __( 'Download Selected', 'aik-digital' ) ); ?> (' + checked + ')'
						: '<?php echo esc_js( __( 'Download Selected (CSV)', 'aik-digital' ) ); ?>'
				);
			}
			$( document ).on( 'change', 'input[name="post[]"], #cb-select-all-1, #cb-select-all-2', aikUpdateExportCount );
			$( '#aik-export-selected-btn' ).on( 'click', function ( e ) {
				if ( $( 'input[name="post[]"]:checked' ).length === 0 ) {
					e.preventDefault();
					alert( '<?php echo esc_js( __( 'Please select at least one lead first.', 'aik-digital' ) ); ?>' );
				}
			} );
		} );
	} )( jQuery );
	</script>
	<?php
}
add_action( 'manage_posts_extra_tablenav', 'aik_add_leads_export_buttons' );

/**
 * Catches the "Download Selected" button's submission — it posts to the
 * list table's own form (same one Bulk Actions uses), so it's picked up
 * here rather than via admin-post.php like the "Download All" link.
 */
function aik_check_leads_table_export_submission() {
	global $typenow, $pagenow;

	$columns = aik_leads_export_config( $typenow );
	if ( 'edit.php' !== $pagenow || ! $columns ) {
		return;
	}

	if ( ! isset( $_REQUEST['aik_leads_export_action'] ) || 'selected' !== $_REQUEST['aik_leads_export_action'] ) {
		return;
	}

	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( esc_html__( 'You do not have permission to export leads.', 'aik-digital' ) );
	}

	$nonce = isset( $_REQUEST['aik_export_nonce'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['aik_export_nonce'] ) ) : '';
	if ( ! $nonce || ! wp_verify_nonce( $nonce, 'aik_export_leads_' . $typenow ) ) {
		wp_die( esc_html__( 'Invalid security token. Please refresh and try again.', 'aik-digital' ) );
	}

	$post_ids = isset( $_REQUEST['post'] ) ? array_map( 'intval', (array) $_REQUEST['post'] ) : array();
	if ( empty( $post_ids ) ) {
		wp_die( esc_html__( 'No leads selected. Please check at least one lead checkbox.', 'aik-digital' ) );
	}

	aik_generate_leads_csv( $typenow, $post_ids ); // Exits internally.
}
add_action( 'load-edit.php', 'aik_check_leads_table_export_submission' );

/**
 * "Export Selected to CSV" in the standard Bulk Actions dropdown, for
 * every post type aik_leads_export_config() knows about.
 */
function aik_register_bulk_export_action( $bulk_actions ) {
	$bulk_actions['aik_bulk_export_leads'] = __( 'Export Selected to CSV', 'aik-digital' );
	return $bulk_actions;
}
add_filter( 'bulk_actions-edit-partner_inquiry', 'aik_register_bulk_export_action' );
add_filter( 'bulk_actions-edit-feedback_entry', 'aik_register_bulk_export_action' );

function aik_handle_bulk_export_leads( $redirect_to, $doaction, $post_ids ) {
	if ( 'aik_bulk_export_leads' !== $doaction || empty( $post_ids ) ) {
		return $redirect_to;
	}

	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( esc_html__( 'You do not have permission to export leads.', 'aik-digital' ) );
	}

	aik_generate_leads_csv( get_post_type( $post_ids[0] ), $post_ids ); // Exits internally.

	return $redirect_to;
}
add_filter( 'handle_bulk_actions-edit-partner_inquiry', 'aik_handle_bulk_export_leads', 10, 3 );
add_filter( 'handle_bulk_actions-edit-feedback_entry', 'aik_handle_bulk_export_leads', 10, 3 );

/**
 * "Download All" direct link handler.
 */
function aik_handle_export_all_leads() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( esc_html__( 'You do not have permission to export leads.', 'aik-digital' ) );
	}

	$post_type = isset( $_GET['post_type'] ) ? sanitize_key( wp_unslash( $_GET['post_type'] ) ) : '';
	if ( ! aik_leads_export_config( $post_type ) ) {
		wp_die( esc_html__( 'Invalid export request.', 'aik-digital' ) );
	}

	$nonce = isset( $_GET['export_nonce'] ) ? sanitize_text_field( wp_unslash( $_GET['export_nonce'] ) ) : '';
	if ( ! $nonce || ! wp_verify_nonce( $nonce, 'aik_export_leads_' . $post_type ) ) {
		wp_die( esc_html__( 'Invalid or expired export request.', 'aik-digital' ) );
	}

	aik_generate_leads_csv( $post_type, null ); // Exits internally.
}
add_action( 'admin_post_aik_export_leads', 'aik_handle_export_all_leads' );

/**
 * Streams the CSV to the browser. $post_ids null exports every post of
 * $post_type; an array exports just those IDs. Always exits — never
 * returns, whether it dies early on bad input or finishes the download.
 */
function aik_generate_leads_csv( $post_type, $post_ids = null ) {
	$columns = aik_leads_export_config( $post_type );
	if ( ! $columns ) {
		wp_die( esc_html__( 'Invalid export request.', 'aik-digital' ) );
	}

	if ( ob_get_level() ) {
		ob_end_clean();
	}

	$is_selected = ! empty( $post_ids ) && is_array( $post_ids );
	$suffix      = $is_selected ? '-selected-' . count( $post_ids ) : '-all';
	$filename    = 'aik-' . $post_type . $suffix . '-' . gmdate( 'Y-m-d_H-i-s' ) . '.csv';

	header( 'Content-Type: text/csv; charset=UTF-8' );
	header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
	header( 'Pragma: no-cache' );
	header( 'Expires: 0' );

	$output = fopen( 'php://output', 'w' );

	// UTF-8 BOM so Microsoft Excel renders non-ASCII characters correctly.
	fputs( $output, "\xEF\xBB\xBF" );

	fputcsv( $output, array_values( $columns ) );

	$query_args = array(
		'post_type'      => $post_type,
		'post_status'    => array( 'publish', 'private', 'draft' ),
		'posts_per_page' => -1,
		'orderby'        => 'date',
		'order'          => 'DESC',
	);

	if ( $is_selected ) {
		$query_args['post__in'] = array_map( 'intval', $post_ids );
	}

	$query = new WP_Query( $query_args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$lead_id = get_the_ID();

			$row = array();
			foreach ( array_keys( $columns ) as $key ) {
				if ( 'ID' === $key ) {
					$row[] = $lead_id;
				} elseif ( 'post_title' === $key ) {
					$row[] = get_the_title();
				} elseif ( 'post_date' === $key ) {
					$row[] = get_the_date( 'Y-m-d H:i:s' );
				} else {
					$row[] = get_post_meta( $lead_id, $key, true );
				}
			}
			fputcsv( $output, $row );
		}
		wp_reset_postdata();
	}

	fclose( $output );
	exit;
}
