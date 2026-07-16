<?php
/**
 * Custom post types.
 *
 * Testimonials get their own post type (rather than an ACF Repeater) so
 * editors manage them from a normal admin list. News reuses core Posts —
 * editors should create a "News" category and assign news posts to it.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function aik_register_post_types() {
	register_post_type(
		'testimonial',
		array(
			'labels'       => array(
				'name'          => __( 'Testimonials', 'aik-digital' ),
				'singular_name' => __( 'Testimonial', 'aik-digital' ),
				'add_new_item'  => __( 'Add New Testimonial', 'aik-digital' ),
			),
			'public'       => true,
			'show_in_menu' => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-format-quote',
			'supports'     => array( 'title' ),
			'has_archive'  => false,
			'rewrite'      => false,
		)
	);

	register_post_type(
		'partner_inquiry',
		array(
			'labels'       => array(
				'name'          => __( 'Partner Inquiries', 'aik-digital' ),
				'singular_name' => __( 'Partner Inquiry', 'aik-digital' ),
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'menu_icon'    => 'dashicons-email-alt',
			'supports'     => array( 'title' ),
			'capabilities' => array(
				'create_posts' => 'do_not_allow', // Submitted only via the front-end form handler.
			),
			'map_meta_cap' => true,
		)
	);
}
add_action( 'init', 'aik_register_post_types' );

/**
 * Show the Partner Inquiry Form submission details (email/mobile/company/
 * service/message) on the post edit screen, since the CPT only has a title.
 */
function aik_partner_inquiry_meta_box() {
	add_meta_box(
		'aik_partner_inquiry_details',
		__( 'Inquiry Details', 'aik-digital' ),
		function ( $post ) {
			$fields = array(
				'email'   => 'Email',
				'mobile'  => 'Mobile',
				'company' => 'Company',
				'service' => 'Service',
				'message' => 'Message',
			);
			echo '<table class="widefat"><tbody>';
			foreach ( $fields as $key => $label ) {
				printf(
					'<tr><th style="width:120px;text-align:left;">%1$s</th><td>%2$s</td></tr>',
					esc_html( $label ),
					esc_html( get_post_meta( $post->ID, $key, true ) )
				);
			}
			echo '</tbody></table>';
		},
		'partner_inquiry',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'aik_partner_inquiry_meta_box' );
