<?php
/**
 * Front-end form handlers: newsletter signup (footer.php) and the Partner
 * Inquiry Form (template-parts/blocks/pif_form.php). No mailing-list or
 * CRM provider was specified, so both just email the site admin; Partner
 * Inquiry submissions are additionally saved as "Partner Inquiry" posts so
 * they show up in wp-admin even if the email doesn't land.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function aik_handle_newsletter_subscribe() {
	$email    = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$redirect = wp_get_referer() ? wp_get_referer() : home_url( '/' );

	if ( $email && is_email( $email ) ) {
		wp_mail( get_option( 'admin_email' ), 'New newsletter signup', 'Email: ' . $email );
		$redirect = add_query_arg( 'subscribed', '1', $redirect );
	} else {
		$redirect = add_query_arg( 'subscribed', '0', $redirect );
	}

	wp_safe_redirect( $redirect );
	exit;
}
add_action( 'admin_post_nopriv_aik_newsletter_subscribe', 'aik_handle_newsletter_subscribe' );
add_action( 'admin_post_aik_newsletter_subscribe', 'aik_handle_newsletter_subscribe' );

function aik_handle_partner_inquiry() {
	$redirect = wp_get_referer() ? wp_get_referer() : home_url( '/' );

	if (
		! isset( $_POST['aik_partner_inquiry_nonce'] ) ||
		! wp_verify_nonce( wp_unslash( $_POST['aik_partner_inquiry_nonce'] ), 'aik_partner_inquiry' )
	) {
		wp_safe_redirect( add_query_arg( 'pif_sent', '0', $redirect ) );
		exit;
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$mobile  = isset( $_POST['mobile'] ) ? sanitize_text_field( wp_unslash( $_POST['mobile'] ) ) : '';
	$company = isset( $_POST['company'] ) ? sanitize_text_field( wp_unslash( $_POST['company'] ) ) : '';
	$service = isset( $_POST['service'] ) ? sanitize_text_field( wp_unslash( $_POST['service'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$agree   = ! empty( $_POST['agree'] );

	if ( ! $name || ! is_email( $email ) || ! $mobile || ! $company || ! $service || ! $agree ) {
		wp_safe_redirect( add_query_arg( 'pif_sent', '0', $redirect ) );
		exit;
	}

	$post_id = wp_insert_post(
		array(
			'post_type'   => 'partner_inquiry',
			'post_title'  => $name . ' — ' . $company,
			'post_status' => 'publish',
		)
	);

	if ( $post_id && ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, 'email', $email );
		update_post_meta( $post_id, 'mobile', $mobile );
		update_post_meta( $post_id, 'company', $company );
		update_post_meta( $post_id, 'service', $service );
		update_post_meta( $post_id, 'message', $message );
	}

	wp_mail(
		get_option( 'admin_email' ),
		'New partner inquiry: ' . $company,
		"Name: {$name}\nEmail: {$email}\nMobile: {$mobile}\nCompany: {$company}\nService: {$service}\nMessage: {$message}"
	);

	wp_safe_redirect( add_query_arg( 'pif_sent', '1', $redirect ) );
	exit;
}
add_action( 'admin_post_nopriv_aik_partner_inquiry', 'aik_handle_partner_inquiry' );
add_action( 'admin_post_aik_partner_inquiry', 'aik_handle_partner_inquiry' );
