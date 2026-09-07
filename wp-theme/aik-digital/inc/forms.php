<?php
/**
 * Front-end form handlers: newsletter signup (footer.php), the Partner
 * Inquiry Form (template-parts/blocks/pif_form.php), and the Feedback Form
 * (template-parts/blocks/feedback_form.php). No mailing-list or CRM
 * provider was specified, so all three just email the site admin; Partner
 * Inquiry / Feedback submissions are additionally saved as their own CPT
 * posts so they show up in wp-admin even if the email doesn't land.
 *
 * Partner Inquiry and Feedback are also checked against Google reCAPTCHA
 * v3 (see inc/recaptcha.php) — a no-op until that file's keys are filled
 * in, so this works today and just starts enforcing once configured.
 *
 * Both of those two are submitted via fetch() (see js/custom.js's
 * aikBindAjaxForm) instead of a normal browser POST, so their handlers
 * respond with wp_send_json_success()/wp_send_json_error() instead of
 * redirecting — there's no page reload, the JS swaps the form for the
 * returned message in place. wp_send_json_*() calls die() itself, so
 * nothing after those calls in either function ever runs.
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
	if (
		! isset( $_POST['aik_partner_inquiry_nonce'] ) ||
		! wp_verify_nonce( wp_unslash( $_POST['aik_partner_inquiry_nonce'] ), 'aik_partner_inquiry' )
	) {
		wp_send_json_error( array( 'message' => 'Security check failed — please refresh the page and try again.' ) );
	}

	$recaptcha_token = isset( $_POST['g-recaptcha-response'] ) ? sanitize_text_field( wp_unslash( $_POST['g-recaptcha-response'] ) ) : '';
	if ( ! aik_verify_recaptcha( $recaptcha_token ) ) {
		wp_send_json_error( array( 'message' => 'Verification failed — please try again.' ) );
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$mobile  = isset( $_POST['mobile'] ) ? sanitize_text_field( wp_unslash( $_POST['mobile'] ) ) : '';
	$company = isset( $_POST['company'] ) ? sanitize_text_field( wp_unslash( $_POST['company'] ) ) : '';
	$service = isset( $_POST['service'] ) ? sanitize_text_field( wp_unslash( $_POST['service'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$agree   = ! empty( $_POST['agree'] );

	if ( ! $name || ! is_email( $email ) || ! $mobile || ! $company || ! $service || ! $agree ) {
		wp_send_json_error( array( 'message' => 'Please fill in all required fields.' ) );
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

	wp_send_json_success( array( 'message' => "Thanks — we'll be in touch shortly." ) );
}
add_action( 'admin_post_nopriv_aik_partner_inquiry', 'aik_handle_partner_inquiry' );
add_action( 'admin_post_aik_partner_inquiry', 'aik_handle_partner_inquiry' );

function aik_handle_feedback_form() {
	if (
		! isset( $_POST['aik_feedback_form_nonce'] ) ||
		! wp_verify_nonce( wp_unslash( $_POST['aik_feedback_form_nonce'] ), 'aik_feedback_form' )
	) {
		wp_send_json_error( array( 'message' => 'Security check failed — please refresh the page and try again.' ) );
	}

	$recaptcha_token = isset( $_POST['g-recaptcha-response'] ) ? sanitize_text_field( wp_unslash( $_POST['g-recaptcha-response'] ) ) : '';
	if ( ! aik_verify_recaptcha( $recaptcha_token ) ) {
		wp_send_json_error( array( 'message' => 'Verification failed — please try again.' ) );
	}

	$name       = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email      = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$mobile     = isset( $_POST['mobile'] ) ? sanitize_text_field( wp_unslash( $_POST['mobile'] ) ) : '';
	$product    = isset( $_POST['product'] ) ? sanitize_text_field( wp_unslash( $_POST['product'] ) ) : '';
	$query_type = isset( $_POST['query_type'] ) ? sanitize_text_field( wp_unslash( $_POST['query_type'] ) ) : '';
	$message    = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( ! $name || ! is_email( $email ) || ! $mobile || ! $product ) {
		wp_send_json_error( array( 'message' => 'Please fill in all required fields.' ) );
	}

	$post_id = wp_insert_post(
		array(
			'post_type'   => 'feedback_entry',
			'post_title'  => $name . ' — ' . $product,
			'post_status' => 'publish',
		)
	);

	if ( $post_id && ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, 'email', $email );
		update_post_meta( $post_id, 'mobile', $mobile );
		update_post_meta( $post_id, 'product', $product );
		update_post_meta( $post_id, 'query_type', $query_type );
		update_post_meta( $post_id, 'message', $message );
	}

	wp_mail(
		get_option( 'admin_email' ),
		'New feedback: ' . $name,
		"Name: {$name}\nEmail: {$email}\nMobile: {$mobile}\nProduct: {$product}\nQuery Type: {$query_type}\nMessage: {$message}"
	);

	wp_send_json_success( array( 'message' => 'Thank you for your feedback! Our team will get back to you shortly.' ) );
}
add_action( 'admin_post_nopriv_aik_feedback_form', 'aik_handle_feedback_form' );
add_action( 'admin_post_aik_feedback_form', 'aik_handle_feedback_form' );
