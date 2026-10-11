<?php
/**
 * Block Name: hero sub
 *
 * This is the template that displays the testimonial block.
 */
 // Load values and assign defaults
// $heroSub = get_field( 'hero_subtitle' ); echo $heroSub

 $introduction_handle = get_field( 'text' );

 // Support custom id values.
$block_id = '';
if ( ! empty( $block['anchor'] ) ) {
	$block_id = esc_attr( $block['anchor'] );
}

// Create class attribute allowing for custom "className".
$class_name = 'intro-block-acf ';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

 









if ($is_preview && empty($introduction_handle)) :?>
    <p>Please enter a summary of the event.</p>
	<?php elseif (!$is_preview) : ?>
		<?php echo esc_html( $introduction_handle ); ?>
	<?php else : ?>
	

		<h2>
        <div
            <?php
            echo wp_kses_data(
                get_block_wrapper_attributes(
                    array(
                        'id'    => $block_id,
                        'class' => esc_attr($class_name),
                    )
                )
            );
            ?>
        ><?php echo esc_html( $introduction_handle ); ?>
		</div>
    </h2>
    

<?php endif;

