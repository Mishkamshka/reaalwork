<?php
/**
 * reaal for reaal functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package reaal_for_reaal
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.1' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function reaaltwennysix_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on reaal for reaal, use a find and replace
		* to change 'reaaltwennysix' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'reaaltwennysix', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'reaaltwennysix' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'reaaltwennysix_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'reaaltwennysix_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function reaaltwennysix_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'reaaltwennysix_content_width', 640 );
}
add_action( 'after_setup_theme', 'reaaltwennysix_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function reaaltwennysix_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'reaaltwennysix' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'reaaltwennysix' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'reaaltwennysix_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function reaaltwennysix_scripts() {
	wp_enqueue_style( 'reaaltwennysix-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'reaaltwennysix-style', 'rtl', 'replace' );
	// wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap-grid.min.css');


	wp_enqueue_script( 'reaaltwennysix-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.15/dist/gsap.min.js', array(), false, true );
	
	wp_enqueue_script( 'gsap-trigger', 'https://cdn.jsdelivr.net/npm/gsap@3.15/dist/ScrollTrigger.min.js', array(), false, true );
	wp_enqueue_script( 'gsap-smooth', 'https://cdn.jsdelivr.net/npm/gsap@3.15/dist/ScrollSmoother.min.js', array(), false, true );
	wp_enqueue_script( 'gsap-scroll-to', 'https://cdn.jsdelivr.net/npm/gsap@3.15/dist/ScrollToPlugin.min.js', array(), false, true );
	
	if ( is_front_page() ) {
		wp_enqueue_script( 'orbit', get_stylesheet_directory_uri() . '/js/orbit.js', array('reaal-studio'), _S_VERSION, true );
	}
	wp_enqueue_script( 'reaal-studio', get_stylesheet_directory_uri() . '/js/reaal-app.js', array(), _S_VERSION, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'reaaltwennysix_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

//Page Slug Body Class
function add_slug_body_class( $classes ) {
global $post;
if ( isset( $post ) ) {
$classes[] = $post->post_type . '-' . $post->post_name;
}
return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );






// Register Custom Post Type Work
function create_Work_cpt() {

	$labels = array(
		'name' => _x( 'work', 'Post Type General Name', 'Reaal' ),
		'singular_name' => _x( 'Work', 'Post Type Singular Name', 'Reaal' ),
		'menu_name' => _x( 'Work', 'Admin Menu text', 'Reaal' ),
		'name_admin_bar' => _x( 'Work', 'Add New on Toolbar', 'Reaal' ),
		'archives' => __( 'Work Archives', 'Reaal' ),
		'attributes' => __( 'Work Attributes', 'Reaal' ),
		'parent_item_colon' => __( 'Parent Work:', 'Reaal' ),
		'all_items' => __( 'All Work', 'Reaal' ),
		'add_new_item' => __( 'Add New Work', 'Reaal' ),
		'add_new' => __( 'Add New', 'Reaal' ),
		'new_item' => __( 'New Work', 'Reaal' ),
		'edit_item' => __( 'Edit Work', 'Reaal' ),
		'update_item' => __( 'Update Work', 'Reaal' ),
		'view_item' => __( 'View Work', 'Reaal' ),
		'view_items' => __( 'View Work', 'Reaal' ),
		'search_items' => __( 'Search Work', 'Reaal' ),
		'not_found' => __( 'Not found', 'Reaal' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'Reaal' ),
		'featured_image' => __( 'Featured Image', 'Reaal' ),
		'set_featured_image' => __( 'Set featured image', 'Reaal' ),
		'remove_featured_image' => __( 'Remove featured image', 'Reaal' ),
		'use_featured_image' => __( 'Use as featured image', 'Reaal' ),
		'insert_into_item' => __( 'Insert into Work', 'Reaal' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Work', 'Reaal' ),
		'items_list' => __( 'Work list', 'Reaal' ),
		'items_list_navigation' => __( 'Work list navigation', 'Reaal' ),
		'filter_items_list' => __( 'Filter Work list', 'Reaal' ),
	);
	$args = array(
        'label' => __( 'Work', 'Reaal' ),
        'description' => __( 'Our Work', 'Reaal' ),
        'labels' => $labels,
        'menu_icon' => 'dashicons-admin-media',
        'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'tags'),
        'taxonomies' => array('category', 'sector'), 
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => false,
        'hierarchical' => false,
        'exclude_from_search' => false,
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'work'), // Setting the slug to 'work'
    );
    register_post_type( 'work', $args );


	register_taxonomy('category', 'work', array(
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_rest' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'work/category', 'with_front' => false),
	));	

}
add_action('init', 'create_Work_cpt');


add_action( 'init', 'register_custom_taxonomies', 0 );
function register_custom_taxonomies() {
	register_taxonomy('sector', 'work', array(
		'label' => __( 'Sectors', 'Reaal' ),
        'description' => __( 'The sectors', 'Reaal' ),
		'public' => true,
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_rest' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'work/sector', 'with_front' => false),
	));
}

add_action( 'pre_get_posts', function( $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_category() ) {
		$query->set( 'post_type', 'work' );
	}
} );

// //Remove Gutenberg Block Library CSS from loading on the frontend
function foolhat_remove_gutenberg_css(){
    wp_dequeue_style( 'wp-block-library' ); // Gutenberg CSS
    wp_dequeue_style( 'wp-block-library-theme' ); // Gutenberg CSS
    wp_dequeue_style( 'wc-block-style' ); // WooCommerce block CSS
	wp_dequeue_style( 'global-styles' ); // Gutenberg Style Tag
	wp_dequeue_style( 'classic-theme-styles' ); // Remove global styles inline CSS
	wp_dequeue_style( 'global-styles-inline-css' ); // Remove global styles inline CSS
	wp_dequeue_style( 'core-block-supports-inline-css' ); // Remove global styles inline CSS

} 
add_action( 'wp_enqueue_scripts', 'foolhat_remove_gutenberg_css', 100 );



add_filter( 'the_password_form', function( $form ) {
    $form = str_replace(
        'This content is password-protected. To view it, please enter the password below.',
        '<h2>This project is password-protected</h2>',
        $form
    );
    $form = str_replace( 'Password:', '', $form ); // button text
    $form = str_replace( 'Enter', 'Unlock', $form ); // button text
    return $form;
} );

// /**
//  * Video embeds in post content come from Skiv (formerly muse.ai) as
//  * <div class="muse-video-player" data-…> plus an inline <script> each.
//  * Rename the class so Skiv doesn't auto-build them (reaal-app.js builds them
//  * instead, so it can listen for when each video starts showing frames), and
//  * swap the per-embed scripts for a single skiv.com one per page.
//  */
// function reaaltwennysix_video_embeds( $content ) {
// 	static $script_printed = false;

// 	$content = preg_replace( '#<script[^>]+(?:muse\.ai|skiv\.com)/static/js/embed-player\.min\.js[^>]*>\s*</script>#i', '', $content );

// 	if ( ! str_contains( $content, 'class="muse-video-player"' ) ) {
// 		return $content;
// 	}

// 	$content = str_replace( 'class="muse-video-player"', 'class="reaal-video"', $content );

// 	if ( ! $script_printed ) {
// 		$script_printed = true;
// 		$content       .= '<script src="https://skiv.com/static/js/embed-player.min.js"></script>';
// 	}

// 	return $content;
// }
// add_filter( 'the_content', 'reaaltwennysix_video_embeds', 20 );

/**
 * Display size [width, height] of a video attachment, for the <video> tag's
 * width/height so its box has the right shape before the file loads.
 *
 * WordPress stores the encoded frame size, which is wrong for videos with
 * non-square pixels or a crop (e.g. light-trees.mp4 is stored as 1536×1080
 * but plays at 810×1080). The real size is read from the MP4 instead and
 * cached on the attachment until the file changes.
 */
function reaaltwennysix_video_size( $attachment_id ) {
	$file  = get_attached_file( $attachment_id );
	$mtime = ( $file && file_exists( $file ) ) ? filemtime( $file ) : 0;

	$cached = get_post_meta( $attachment_id, '_reaaltwennysix_video_size', true );
	if ( is_array( $cached ) && isset( $cached['mtime'], $cached['size'] ) && $cached['mtime'] === $mtime ) {
		return $cached['size'];
	}

	$size = $mtime ? reaaltwennysix_mp4_display_size( $file ) : null;
	if ( ! $size ) {
		$meta = wp_get_attachment_metadata( $attachment_id );
		$size = array( (int) ( $meta['width'] ?? 0 ) ?: 640, (int) ( $meta['height'] ?? 0 ) ?: 360 );
	}

	update_post_meta( $attachment_id, '_reaaltwennysix_video_size', array( 'mtime' => $mtime, 'size' => $size ) );
	return $size;
}

/**
 * Reads the display size from the video track's tkhd box of an MP4/MOV file
 * (what browsers use), swapping width/height for 90°/270° rotated videos.
 */
function reaaltwennysix_mp4_display_size( $file ) {
	$fh = @fopen( $file, 'rb' );
	if ( ! $fh ) {
		return null;
	}

	$size = null;
	$walk = function ( $pos, $end ) use ( &$walk, &$size, $fh ) {
		while ( ! $size && $pos + 8 <= $end ) {
			fseek( $fh, $pos );
			$head = fread( $fh, 8 );
			if ( strlen( $head ) < 8 ) {
				return;
			}
			$len  = unpack( 'N', $head )[1];
			$type = substr( $head, 4, 4 );
			$hdr  = 8;
			if ( 1 === $len ) {
				$len = unpack( 'J', fread( $fh, 8 ) )[1];
				$hdr = 16;
			} elseif ( 0 === $len ) {
				$len = $end - $pos;
			}
			if ( $len < $hdr ) {
				return;
			}

			if ( 'moov' === $type || 'trak' === $type ) {
				$walk( $pos + $hdr, $pos + $len );
			} elseif ( 'tkhd' === $type ) {
				$data = fread( $fh, min( $len - $hdr, 96 ) );
				$v1   = 1 === ord( $data[0] );
				$m    = $v1 ? 52 : 40; // transform matrix
				$wh   = $v1 ? 88 : 76; // width, height (16.16 fixed point)
				if ( strlen( $data ) >= $wh + 8 ) {
					$w = (int) round( unpack( 'N', substr( $data, $wh, 4 ) )[1] / 65536 );
					$h = (int) round( unpack( 'N', substr( $data, $wh + 4, 4 ) )[1] / 65536 );
					if ( $w && $h ) { // audio tracks are 0×0
						$rotated = 0 === unpack( 'N', substr( $data, $m, 4 ) )[1];
						$size    = $rotated ? array( $h, $w ) : array( $w, $h );
					}
				}
			}
			$pos += $len;
		}
	};

	fseek( $fh, 0, SEEK_END );
	$walk( 0, ftell( $fh ) );
	fclose( $fh );

	return $size;
}
