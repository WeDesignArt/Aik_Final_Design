<?php
/**
 * Google reCAPTCHA v3 — protects the Partner Inquiry and Feedback forms
 * from bot/spam submissions. The Site Key is public (loaded in the page's
 * JS); the Secret Key must stay server-side only, never output to the
 * browser.
 *
 * Get both from https://www.google.com/recaptcha/admin — register the
 * site there for "reCAPTCHA v3" and add this site's domain(s) — then
 * paste them in below. Leaving AIK_RECAPTCHA_SECRET_KEY blank disables
 * verification entirely (forms keep working exactly as before,
 * unprotected) so nothing breaks while waiting on the keys.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AIK_RECAPTCHA_SITE_KEY', '6Lf5Ca4tAAAAACv0wrpIshd_WWFuieX_TID_k4wy' );
define( 'AIK_RECAPTCHA_SECRET_KEY', '6Lf5Ca4tAAAAADPbNLjcESZP_3VLMWUyT3TUZBCR' );

/**
 * Verifies a reCAPTCHA v3 token against Google's siteverify endpoint.
 * Returns true (i.e. doesn't block the submission) if verification isn't
 * configured yet, or if the request to Google itself fails — a network
 * hiccup on Google's end shouldn't stop real leads from going through.
 */
function aik_verify_recaptcha( $token ) {
	if ( ! AIK_RECAPTCHA_SECRET_KEY ) {
		return true;
	}

	if ( ! $token ) {
		return false;
	}

	$response = wp_remote_post(
		'https://www.google.com/recaptcha/api/siteverify',
		array(
			'body' => array(
				'secret'   => AIK_RECAPTCHA_SECRET_KEY,
				'response' => $token,
				'remoteip' => isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '',
			),
		)
	);

	if ( is_wp_error( $response ) ) {
		return true;
	}

	$body = json_decode( wp_remote_retrieve_body( $response ), true );

	return ! empty( $body['success'] ) && ( ! isset( $body['score'] ) || $body['score'] >= 0.5 );
}

/**
 * Prints the reCAPTCHA v3 API script (once per form using it) and tags the
 * given <form> with data-recaptcha-site-key / data-recaptcha-field
 * attributes. The actual submit handling — fetching a fresh token and
 * setting it on the hidden field right before each submission — lives in
 * js/custom.js's aikBindAjaxForm(), which reads those attributes; this
 * function just makes them available. No-op (prints nothing) until
 * AIK_RECAPTCHA_SITE_KEY is set.
 *
 * @param string $form_id  The <form> element's id.
 * @param string $field_id The hidden <input id="..."> that receives the token.
 */
function aik_recaptcha_script( $form_id, $field_id ) {
	if ( ! AIK_RECAPTCHA_SITE_KEY ) {
		return;
	}
	?>
	<script src="https://www.google.com/recaptcha/api.js?render=<?php echo esc_attr( AIK_RECAPTCHA_SITE_KEY ); ?>"></script>
	<script>
	(function () {
		var form = document.getElementById(<?php echo wp_json_encode( $form_id ); ?>);
		if (!form) return;
		form.dataset.recaptchaSiteKey = <?php echo wp_json_encode( AIK_RECAPTCHA_SITE_KEY ); ?>;
		form.dataset.recaptchaField = <?php echo wp_json_encode( $field_id ); ?>;
	})();
	</script>
	<?php
}
