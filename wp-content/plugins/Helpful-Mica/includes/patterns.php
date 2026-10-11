<?php



function reaal_block_patterns() {

	register_block_pattern(
		'header/home-pattern',
		array(
		   'title'       => __( 'Header', 'helpful-mica' ),
		   'description' => _x( 'A custom block pattern with a heading and paragraph.', 'Block pattern description', 'helpful-mica' ),
		   'content'     => '
		   <!-- wp:group {"lock":{"move":false,"remove":true},"className":"group-1","layout":{"type":"constrained"}} -->
			  <div id="group-1" class="wp-block-group group-1"><!-- wp:heading {"lock":{"move":true,"remove":true}} -->
			  <h2 class="wp-block-heading"></h2>
			  <!-- /wp:heading -->
  
			  <!-- wp:paragraph {"lock":{"move":true,"remove":true}} -->
			  <p></p>
			  <!-- /wp:paragraph --></div>
			  <!-- /wp:group -->
		   ',
		   'categories'  => array( 'text' ),
		   'keywords'    => array( 'custom', 'pattern' ),
		)
	 );

	 


}    

add_action( 'init', 'reaal_block_patterns' );