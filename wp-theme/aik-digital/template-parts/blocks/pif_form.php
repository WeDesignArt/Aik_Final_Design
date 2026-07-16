<?php
/**
 * Layout: pif_form
 * "Partner Inquiry Form" — heading/subtext are editable, the field list
 * itself is structural (it posts to admin-post.php, handled in
 * inc/forms.php) so it stays hardcoded rather than becoming ACF fields.
 */

$heading = get_sub_field( 'heading' );
$subtext = get_sub_field( 'subtext' );
?>
      <section class="pif-section">
        <div class="container">
          <div class="pif-header text-center" data-aos="fade-up">
            <h2 class="pif-heading"><?php echo aik_highlight( $heading ); ?></h2>
            <?php if ( $subtext ) : ?>
            <p class="pif-subtext"><?php echo aik_nl2br( $subtext ); ?></p>
            <?php endif; ?>
          </div>

          <form class="pif-card" id="partnerInquiryForm" novalidate data-aos="fade-up" data-aos-delay="100" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="action" value="aik_partner_inquiry">
            <?php wp_nonce_field( 'aik_partner_inquiry', 'aik_partner_inquiry_nonce' ); ?>
            <h3 class="pif-card__title">Partner Inquiry Form</h3>

            <div class="pif-grid">
              <div class="pif-field">
                <label for="pifName"><strong>Name</strong> <span class="pif-req">*</span></label>
                <input type="text" id="pifName" name="name" placeholder="Enter Name" required>
                <span class="pif-error"></span>
              </div>

              <div class="pif-field">
                <label for="pifEmail"><strong>Email Address</strong> <span class="pif-req">*</span></label>
                <input type="email" id="pifEmail" name="email" placeholder="Enter Email Address" required>
                <span class="pif-error"></span>
              </div>

              <div class="pif-field">
                <label for="pifMobile"><strong>Mobile Number</strong> <span class="pif-req">*</span></label>
                <div class="pif-phone">
                  <span class="pif-phone__code">PK +92</span>
                  <input type="tel" id="pifMobile" name="mobile" inputmode="numeric" placeholder="" required>
                </div>
                <span class="pif-error"></span>
              </div>

              <div class="pif-field">
                <label for="pifCompany"><strong>Company Name</strong> <span class="pif-req">*</span></label>
                <input type="text" id="pifCompany" name="company" placeholder="Enter Company Name" required>
                <span class="pif-error"></span>
              </div>

              <div class="pif-field pif-field--full">
                <label for="pifService"><strong>Select Service</strong> <span class="pif-req">*</span></label>
                <div class="pif-select">
                  <select id="pifService" name="service" required>
                    <option value="" disabled selected hidden>Select Service</option>
                    <option value="account-integration">Account Integration</option>
                    <option value="payment-apis">Payment APIs</option>
                    <option value="data-sharing">Data Sharing</option>
                    <option value="other">Other</option>
                  </select>
                  <i class="bi bi-chevron-down"></i>
                </div>
                <span class="pif-error"></span>
              </div>

              <div class="pif-field pif-field--full">
                <label for="pifMessage"><strong>Message</strong></label>
                <textarea id="pifMessage" name="message" rows="5" placeholder="Enter Message"></textarea>
                <span class="pif-error"></span>
              </div>
            </div>

            <div class="pif-footer">
              <label class="pif-agree">
                <input type="checkbox" id="pifAgree" name="agree" required>
                <span class="pif-agree__box"></span>
                <span class="pif-agree__text">I agree that the above provided information is accurate<span class="pif-req">*</span></span>
              </label>

              <button type="submit" class="pif-submit">
                Submit
                <span class="pif-submit__icon"><i class="bi bi-arrow-up-right"></i></span>
              </button>
            </div>

            <div class="pif-agree-error"></div>

            <?php if ( isset( $_GET['pif_sent'] ) ) : // phpcs:ignore -- read-only status flag, no processing. ?>
              <div class="pif-alert" role="status" aria-live="polite">
                <?php echo '1' === $_GET['pif_sent'] ? 'Thanks — we\'ll be in touch shortly.' : 'Something went wrong, please try again.'; // phpcs:ignore ?>
              </div>
            <?php else : ?>
              <div class="pif-alert" role="status" aria-live="polite"></div>
            <?php endif; ?>
          </form>
        </div>
        <div class="grid-left grid-center-left"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/left-grid-gray.png" alt="gride-img"></div>
        <div class="grid-right grid-top-right"><img src="<?php echo esc_url( AIK_THEME_URI ); ?>/images/right-grid-gray.png" alt="gride-img"></div>
      </section>
