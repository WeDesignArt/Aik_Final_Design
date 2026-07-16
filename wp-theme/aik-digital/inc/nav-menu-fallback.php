<?php
/**
 * Fallback markup for the off-canvas menu when no "Primary Menu" has been
 * assigned yet under Appearance > Menus, so the theme still looks right
 * immediately after activation.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function aik_nav_menu_fallback() {
	?>
	<ul id="menu" class="menuNav">
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
		<li><a href="javascript:void(0);">About Us</a></li>
		<li><a href="javascript:void(0);">Promotion Card</a></li>
		<li><a href="javascript:void(0);">Features <i class="bi bi-chevron-down aik-menu-arrow"></i></a>
			<ul>
				<li><a href="javascript:void(0);">Digital Account Opening</a></li>
				<li><a href="javascript:void(0);">Money Transfer</a></li>
				<li><a href="javascript:void(0);">Mobile Load</a></li>
				<li><a href="javascript:void(0);">Utility Bill Payments</a></li>
				<li><a href="javascript:void(0);">Debit Card</a></li>
			</ul>
		</li>
		<li><a href="javascript:void(0);">News Media</a></li>
		<li><a href="javascript:void(0);">Help</a></li>
		<li><a href="javascript:void(0);">Careers</a></li>
		<li><a href="javascript:void(0);">Contact Us</a></li>
	</ul>
	<?php
}
