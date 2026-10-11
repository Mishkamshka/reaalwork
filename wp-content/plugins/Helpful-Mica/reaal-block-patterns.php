<?php
/**
 * Plugin Name:       Helpful Mica
 * Plugin URI:        https://reaal.studio
 * Description:       A plugin for custom block patterns. 
 * Version:           2.0.0
 * Author:            Mica Whitcliffe
 * Author URI:        https://MicaWhitcliffe.xyz
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
 
 // If this file is called directly, abort.
 if ( ! defined( 'WPINC' ) ) {
	 die;
 }
 
 /**
  * Currently plugin version.
  */
 define( 'REAAL_BLOCK_PATTERNS_VERSION', '1.0.0' );
 


if( !defined('ABSPATH'))
{
   exit; 
}

// require_once 'register-block-pattern.php';

require_once 'includes/acf-portfolio.php';
require_once 'includes/pretty.php';
require_once 'includes/auto-resize.php';
require_once( 'includes/patterns.php' );


// function reaal_register_acf_blocks() {
//   // register_block_type( __DIR__ . '/blocks/hero-new' );
//   register_block_type( __DIR__ . '/blocks/hero' );
//   register_block_type( __DIR__ . '/blocks/download' );
//   register_block_type( __DIR__ . '/blocks/meet' );
//   register_block_type( __DIR__ . '/blocks/hero-section' );
//   // register_block_type( __DIR__ . '/blocks/testing' );
// }
// add_action( 'init', 'reaal_register_acf_blocks' );



 // Adding a new (custom) block category and show that category at the top
 add_filter( 'block_categories_all', 'example_block_category', 10, 2);
 function example_block_category( $categories, $post ) {
   
   array_unshift( $categories, array(
     'title' => 'Control Shift Blocks',
     'slug'	=> 'cntrl-shft-category'
   ) );
 
   return $categories;
 }






/**
 * Registers a custom page template THAT LOADS AUTO
 * GO TO INC > PATTERNS TO ADD NEW
 */
// function myplugin_register_page_template() {
//   // Register the page template for the 'post' post type
//   $post_type_object = get_post_type_object( 'post' );
//   if ($post_type_object) {
//       $post_type_object->template = array(
//           array( 'reaal-block-patterns/hero-sub', array() ),
//       );
//   }

//   // Register the page template for the 'events' post type
//   $events_post_type_object = get_post_type_object( 'events' );
//   if ($events_post_type_object) {
//       $events_post_type_object->template = array(
//           array( 'reaal-block-patterns/hero-sub', array() ),
//       );
//   }
// }
// add_action( 'init', 'myplugin_register_page_template' );







// REMOVING ACF BLOCKS FROM THE CONTENT TO INSERT THEM WHERE NEEDED
add_filter( 'the_content', 'my_remove_reaal_block_patterns_hero_sub_from_content', 7 );
function my_remove_reaal_block_patterns_hero_sub_from_content( $content ) {
    global $post;

    // Get the post content
    $post_content = get_post_field('post_content', $post);

    // Parse the content to extract blocks
    $blocks = parse_blocks($post_content);

    // Variable to store the new content
    $new_content = '';

    // Loop over the blocks and exclude specific blocks
    foreach ( $blocks as $block ) {

        // Exclude 'reaal-block-patterns/hero-sub' block
        if ('reaal-block-patterns/hero-sub' === $block['blockName']) {
            continue; // Skip this block
        }

        // Exclude custom pattern block
        if (isset($block['attrs']['metadata']['patternName']) && 
            'header/home-pattern' === $block['attrs']['metadata']['patternName']) {
            continue;
        }
        

        // If the block is not excluded, render it
        $new_content .= render_block($block);
    }

    // Return the filtered content
    return $new_content;
}



