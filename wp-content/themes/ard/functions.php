<?php
/**
 * Alex Robinson Design functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ard
 */

if ( ! function_exists( 'ard_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ard_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Alex Robinson Design, use a find and replace
		 * to change 'ard' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ard', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'ard' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ard_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'ard_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ard_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ard_content_width', 640 );
}
add_action( 'after_setup_theme', 'ard_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ard_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ard' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ard' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ard_widgets_init' );


/**
 * Display Featured Image & Excerpt for Password Protected Content
 */
function my_excerpt_protected( $excerpt ) {
    if ( post_password_required() )
        $excerpt = 'Projects with protected IP; Projects that are protected by a nondisclosure agreement (NDA); Projects that are active.';
    return $excerpt;
}
add_filter( 'the_excerpt', 'my_excerpt_protected' );

// function my_excerpt_protected( $excerpt ) {
//     if ( post_password_required() && function_exists('ppw_core_render_login_form') ) {
//         $excerpt = ppw_core_render_login_form();
// }
//     return $excerpt;
// }
// add_filter( 'the_excerpt', 'my_excerpt_protected' );

add_filter('ard_can_show_post_thumbnail', function() {
	return ! is_attachment() && has_post_thumbnail();
});


/**
 * Enqueue scripts and styles.
 */
function ard_scripts() {

	wp_enqueue_style( 'ard-style', get_stylesheet_uri() );
	wp_enqueue_style( 'enqueue-that-css', get_template_directory_uri() . '/css/main.css', array(), '1.0', 'all');
	wp_enqueue_script( 'fotorama', get_template_directory_uri() . '/js/fotorama.js', array(), false);
	wp_enqueue_script( 'enqueue-that-js', get_template_directory_uri() . '/js/min/main.min.js', array ( 'jquery' ), 1.0, true);
	wp_enqueue_script( 'ard-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'ard-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ard_scripts' );



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

// Register Custom Post Type Portfolio Piece
function create_portfoliopiece_cpt() {

	$labels = array(
		'name' => _x( 'Portfolio Pieces', 'Post Type General Name', 'portfolio' ),
		'singular_name' => _x( 'Portfolio Piece', 'Post Type Singular Name', 'portfolio' ),
		'menu_name' => _x( 'Portfolio Pieces', 'Admin Menu text', 'portfolio' ),
		'name_admin_bar' => _x( 'Portfolio Piece', 'Add New on Toolbar', 'portfolio' ),
		'archives' => __( 'Portfolio Piece Archives', 'portfolio' ),
		'attributes' => __( 'Portfolio Piece Attributes', 'portfolio' ),
		'parent_item_colon' => __( 'Parent Portfolio Piece:', 'portfolio' ),
		'all_items' => __( 'All Portfolio Pieces', 'portfolio' ),
		'add_new_item' => __( 'Add New Portfolio Piece', 'portfolio' ),
		'add_new' => __( 'Add New', 'portfolio' ),
		'new_item' => __( 'New Portfolio Piece', 'portfolio' ),
		'edit_item' => __( 'Edit Portfolio Piece', 'portfolio' ),
		'update_item' => __( 'Update Portfolio Piece', 'portfolio' ),
		'view_item' => __( 'View Portfolio Piece', 'portfolio' ),
		'view_items' => __( 'View Portfolio Pieces', 'portfolio' ),
		'search_items' => __( 'Search Portfolio Piece', 'portfolio' ),
		'not_found' => __( 'Not found', 'portfolio' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'portfolio' ),
		'featured_image' => __( 'Featured Image', 'portfolio' ),
		'set_featured_image' => __( 'Set featured image', 'portfolio' ),
		'remove_featured_image' => __( 'Remove featured image', 'portfolio' ),
		'use_featured_image' => __( 'Use as featured image', 'portfolio' ),
		'insert_into_item' => __( 'Insert into Portfolio Piece', 'portfolio' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Portfolio Piece', 'portfolio' ),
		'items_list' => __( 'Portfolio Pieces list', 'portfolio' ),
		'items_list_navigation' => __( 'Portfolio Pieces list navigation', 'portfolio' ),
		'filter_items_list' => __( 'Filter Portfolio Pieces list', 'portfolio' ),
	);
	$args = array(
		'label' => __( 'Portfolio Piece', 'portfolio' ),
		'description' => __( '', 'portfolio' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-lightbulb',
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'portfolio', $args );

}
add_action( 'init', 'create_portfoliopiece_cpt', 0 );

// Blah
