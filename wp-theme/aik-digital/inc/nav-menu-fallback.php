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
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span data-en="Home" data-ur="ہوم">Home</span></a></li>
		<li><a href="javascript:void(0);"><span data-en="About Us" data-ur="ہمارے بارے میں">About Us</span></a></li>
		<li><a href="javascript:void(0);"><span data-en="Promotion Card" data-ur="پروموشن کارڈ">Promotion Card</span></a></li>
		<li><a href="javascript:void(0);"><span data-en="Features" data-ur="خصوصیات">Features</span> <i class="bi bi-chevron-down aik-menu-arrow"></i></a>
			<ul>
				<li><a href="javascript:void(0);"><span data-en="Digital Account Opening" data-ur="ڈیجیٹل اکاؤنٹ کھولنا">Digital Account Opening</span></a></li>
				<li><a href="javascript:void(0);"><span data-en="Money Transfer" data-ur="رقم کی منتقلی">Money Transfer</span></a></li>
				<li><a href="javascript:void(0);"><span data-en="Mobile Load" data-ur="موبائل لوڈ">Mobile Load</span></a></li>
				<li><a href="javascript:void(0);"><span data-en="Utility Bill Payments" data-ur="یوٹیلیٹی بل کی ادائیگی">Utility Bill Payments</span></a></li>
				<li><a href="<?php echo esc_url( home_url( '/debit-card' ) ); ?>"><span data-en="Debit Card" data-ur="ڈیبٹ کارڈ">Debit Card</span></a></li>
			</ul>
		</li>
		<li><a href="javascript:void(0);"><span data-en="News Media" data-ur="خبریں اور میڈیا">News Media</span></a></li>
		<li><a href="javascript:void(0);"><span data-en="Help" data-ur="مدد">Help</span></a></li>
		<li><a href="javascript:void(0);"><span data-en="Careers" data-ur="کیریئرز">Careers</span></a></li>
		<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><span data-en="Contact Us" data-ur="رابطہ کریں">Contact Us</span></a></li>
	</ul>
	<?php
}

/**
 * Wraps each dynamic WordPress nav menu item's title in a data-en/data-ur
 * span so js/lang.js can translate it.
 *
 * Deliberately NOT done via the nav_menu_link_attributes filter (adding
 * data-en/data-ur straight onto the <a> tag): js/app.js appends a
 * ".aik-menu-arrow" <i> icon INTO that same <a> for every parent menu
 * item (see js/app.js, the .has-children/.in-dropdown arrow-injection
 * block). lang.js translates by setting el.innerHTML on whatever element
 * carries data-en/data-ur — if that were the <a> itself, every language
 * toggle would wipe out the arrow icon along with the old text, leaving
 * parent items with no visible way to expand their submenu. Wrapping
 * only the title text in its own <span> keeps the <a> — and the arrow
 * appended to it — untouched.
 */
function aik_nav_menu_item_title( $title, $item, $args, $depth ) {
	$title = trim( $title );
	$translations = array(
		'Home'                    => 'ہوم',
		'About Us'                => 'ہمارے بارے میں',
		'Promotion Card'          => 'پروموشن کارڈ',
		'Features'                => 'خصوصیات',
		'Digital Account Opening' => 'ڈیجیٹل اکاؤنٹ کھولنا',
		'Money Transfer'          => 'رقم کی منتقلی',
		'Mobile Load'             => 'موبائل لوڈ',
		'Utility Bill Payments'   => 'یوٹیلیٹی بل کی ادائیگی',
		'Debit Card'              => 'ڈیبٹ کارڈ',
		'News Media'              => 'خبریں اور میڈیا',
		'Help'                    => 'مدد',
		'Careers'                 => 'کیریئرز',
		'Contact Us'              => 'رابطہ کریں',
		'Personal'                => 'پرسنل',
		'Business'                => 'بزنس',
	);

	$data_ur = isset( $translations[ $title ] ) ? ' data-ur="' . esc_attr( $translations[ $title ] ) . '"' : '';

	return '<span data-en="' . esc_attr( $title ) . '"' . $data_ur . '>' . esc_html( $title ) . '</span>';
}
add_filter( 'nav_menu_item_title', 'aik_nav_menu_item_title', 10, 4 );
