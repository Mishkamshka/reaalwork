<?php 
//Add tag to images

function add_custom_image_data_attributes($atts, $attachment) {
    global $post;
    if ( isset( $post ) ) {
	$idtax = get_field('tag_cat_acf', $attachment->ID);
	$metag = get_term_by('id', $idtax, 'tag_cat', 'ARRAY_A'); 		
  if( is_array($metag) ) {
  $atts['id'] = $metag['slug'];
  }

  }
	return $atts; 
}
add_filter( 'wp_get_attachment_image_attributes', 'add_custom_image_data_attributes', 10, 2 );
