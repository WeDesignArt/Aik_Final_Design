<?php
/**
 * Layout: how_it_works
 * Brand Ambassador "How it Works" section (4 Steps)
 */

$heading    = get_sub_field( 'heading' ) ?: 'How it Works';
$heading_ur = get_sub_field( 'heading_ur' ) ?: 'یہ کیسے کام کرتا ہے';
$steps      = get_sub_field( 'steps_list' );

// Default 4 steps if ACF repeater is not filled in
if ( empty( $steps ) ) {
	$steps = array(
		array(
			'number'         => '01',
			'title'          => 'Click On The Register Button',
			'title_ur'       => 'رجسٹر بٹن پر کلک کریں',
			'description'    => 'Complete the online registration form using your aik Consumer account details.',
			'description_ur' => 'اپنے aik کنزیومر اکاؤنٹ کی تفصیلات استعمال کرتے ہوئے آن لائن رجسٹریشن فارم مکمل کریں۔',
		),
		array(
			'number'         => '02',
			'title'          => 'Provide Your Details',
			'title_ur'       => 'اپنی تفصیلات فراہم کریں',
			'description'    => 'Enter your personal information and aik account details to complete your registration.',
			'description_ur' => 'اپنی رجسٹریشن مکمل کرنے کے لیے اپنی ذاتی معلومات اور aik اکاؤنٹ کی تفصیلات درج کریں۔',
		),
		array(
			'number'         => '03',
			'title'          => 'Accept Terms & Conditions',
			'title_ur'       => 'شرائط و ضوابط قبول کریں',
			'description'    => 'Review and accept the Brand Ambassador Terms & Conditions to complete your registration.',
			'description_ur' => 'رجسٹریشن مکمل کرنے کے لیے برانڈ ایمبیسیڈر کی شرائط و ضوابط کا جائزہ لیں اور قبول کریں۔',
		),
		array(
			'number'         => '04',
			'title'          => 'Congratulations',
			'title_ur'       => 'مبارکباد',
			'description'    => 'Complete registration online in just a few minutes.',
			'description_ur' => 'صرف چند منٹوں میں آن لائن رجسٹریشن مکمل کریں۔',
		),
	);
}
?>
<section class="how-it-works-sec">
  <div class="container">
    <h2 class="how-it-works__heading" data-aos="fade-up" data-en="<?php echo esc_attr( $heading ); ?>" data-ur="<?php echo esc_attr( $heading_ur ); ?>"><?php echo esc_html( $heading ); ?></h2>

    <div class="how-it-works__grid cols-4">
      <?php foreach ( $steps as $i => $step ) :
        $step_num = ! empty( $step['number'] ) ? $step['number'] : str_pad( $i + 1, 2, '0', STR_PAD_LEFT );
        $title    = ! empty( $step['title'] ) ? $step['title'] : '';
        $title_ur = ! empty( $step['title_ur'] ) ? $step['title_ur'] : $title;
        $desc     = ! empty( $step['description'] ) ? $step['description'] : '';
        $desc_ur  = ! empty( $step['description_ur'] ) ? $step['description_ur'] : $desc;
        $delay    = 150 + ( $i * 100 );
      ?>
      <div class="how-it-works__card" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
        <div class="how-it-works__badge"><?php echo esc_html( $step_num ); ?></div>
        <h3 class="how-it-works__card-title" data-en="<?php echo esc_attr( $title ); ?>" data-ur="<?php echo esc_attr( $title_ur ); ?>"><?php echo esc_html( $title ); ?></h3>
        <p class="how-it-works__card-desc" data-en="<?php echo esc_attr( $desc ); ?>" data-ur="<?php echo esc_attr( $desc_ur ); ?>"><?php echo esc_html( $desc ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
