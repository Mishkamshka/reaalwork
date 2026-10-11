<?php

add_action( 'init', 'portfolio_init', 0 );

add_filter( 'manage_edit-portfolio_columns', 'add_thumbnail_column', 10, 1 );
add_action( 'manage_portfolio_posts_custom_column', 'display_thumbnail', 10, 1 );

add_action( 'restrict_manage_posts', 'add_taxonomy_filters' );

add_action( 'right_now_content_table_end', 'add_portfolio_counts' );

/**
 * Add Columns to Portfolio Edit Screen
 * http://wptheming.com/2010/07/column-edit-pages/
 */

function add_thumbnail_column( $columns ) {

	$column_thumbnail = array( 'thumbnail' => __('Thumbnail','calafate' ) );
	$columns = array_slice( $columns, 0, 2, true ) + $column_thumbnail + array_slice( $columns, 1, NULL, true );
	return $columns;
}
function display_thumbnail( $column ) {
	global $post;
	switch ( $column ) {
		case 'thumbnail':
			echo get_the_post_thumbnail( $post->ID, array(50, 50) );
			break;
	}
}



?>