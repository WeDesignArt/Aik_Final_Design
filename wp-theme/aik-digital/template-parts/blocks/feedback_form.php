<?php
/**
 * Layout: feedback_form
 * "Feedback Form" — heading/subtext are editable, the field list itself is
 * structural (it posts to admin-post.php, handled in inc/forms.php) so it
 * stays hardcoded rather than becoming ACF fields. Same visual language as
 * the Partner Inquiry Form (.pif-*) but its own component (.fb-*) — a
 * second, independent form, not a variant of the first.
 *
 * Submits via fetch(), not a normal browser POST (see js/custom.js's
 * aikBindAjaxForm) — .fb-card__fields wraps everything except the final
 * .fb-alert so the JS can hide the fields and show the alert in the same
 * spot on success, with no page reload.
 */

$heading = get_sub_field( 'heading' );
$subtext = get_sub_field( 'subtext' );
?>
      <section class="fb-section">
        <div class="container">
          <div class="fb-header text-center" data-aos="fade-up">
            <h2 class="fb-heading"><?php echo aik_highlight( $heading ); ?></h2>
            <?php if ( $subtext ) : ?>
            <p class="fb-subtext"><?php echo aik_nl2br( $subtext ); ?></p>
            <?php endif; ?>
          </div>

          <form class="fb-card" id="feedbackForm" novalidate data-aos="fade-up" data-aos-delay="100" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="action" value="aik_feedback_form">
            <?php wp_nonce_field( 'aik_feedback_form', 'aik_feedback_form_nonce' ); ?>
            <input type="hidden" name="g-recaptcha-response" id="fbRecaptchaResponse">

            <div class="fb-card__fields">
              <div class="fb-grid">
                <div class="fb-field">
                  <label for="fbName"><strong>Name</strong> <span class="fb-req">*</span></label>
                  <input type="text" id="fbName" name="name" placeholder="Enter Name" required>
                  <span class="fb-error"></span>
                </div>

                <div class="fb-field">
                  <label for="fbEmail"><strong>Email Address</strong> <span class="fb-req">*</span></label>
                  <input type="email" id="fbEmail" name="email" placeholder="Enter Email Address" required>
                  <span class="fb-error"></span>
                </div>

                <div class="fb-field">
                  <label for="fbMobile"><strong>Mobile Number</strong> <span class="fb-req">*</span></label>
                  <div class="fb-phone">
                    <span class="fb-phone__code">PK +92</span>
                    <input type="tel" id="fbMobile" name="mobile" inputmode="numeric" placeholder="" required>
                  </div>
                  <span class="fb-error"></span>
                </div>

                <div class="fb-field">
                  <label for="fbProduct"><strong>Product Name</strong> <span class="fb-req">*</span></label>
                  <div class="fb-select">
                    <select id="fbProduct" name="product" required>
                      <option value="" disabled selected hidden>Select Product</option>
                      <option value="ada">Asaan Digital Account (ADA)</option>
                      <option value="bachat">Bachat Account</option>
                      <option value="debit-card">aik Debit Card</option>
                      <option value="tijarat">aik Tijarat</option>
                      <option value="connect">aik Connect</option>
                      <option value="other">Other</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                  </div>
                  <span class="fb-error"></span>
                </div>

                <div class="fb-field fb-field--full">
                  <label for="fbQueryType"><strong>Query Type</strong></label>
                  <div class="fb-select">
                    <select id="fbQueryType" name="query_type">
                      <option value="" disabled selected hidden>Select Service</option>
                      <option value="general">General Inquiry</option>
                      <option value="account">Account Opening</option>
                      <option value="technical">Technical Support</option>
                      <option value="complaint">Complaint</option>
                      <option value="feedback">Feedback</option>
                      <option value="other">Other</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                  </div>
                  <span class="fb-error"></span>
                </div>

                <div class="fb-field fb-field--full">
                  <label for="fbMessage"><strong>Message</strong></label>
                  <textarea id="fbMessage" name="message" rows="5" placeholder="Enter Message"></textarea>
                  <span class="fb-error"></span>
                </div>
              </div>

              <div class="fb-footer">
                <button type="submit" class="btn btn_fill">Submit</button>
              </div>
            </div>

            <div class="fb-alert" role="status" aria-live="polite"></div>
          </form>
          <?php aik_recaptcha_script( 'feedbackForm', 'fbRecaptchaResponse' ); ?>
        </div>
        <div class="grid-left grid-center-left"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/left-grid-gray.png" alt="gride-img"></div>
        <div class="grid-right grid-top-right"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/right-grid-gray.png" alt="gride-img"></div>
      </section>
