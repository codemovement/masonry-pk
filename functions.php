<?php
/**
 * Masonry Pk functions and definitions
 *
 * @package Masonry_Pk
 */

if ( ! function_exists( 'masonry_pk_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function masonry_pk_setup() {

	/**
	* Set the content width based on the theme's design and stylesheet.
	*/
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 640; /* pixels */
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on masonry-pk, use a find and replace
	 * to change 'masonry-pk' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'masonry-pk', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	//Suport for WordPress 4.1+ to display titles
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'masonry-pk' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	// add_theme_support( 'post-formats', array(
	// 	'aside', 'image', 'video', 'quote', 'link',
	// ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'masonry_pk_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Suport for WordPress 4.5+ to display logo
	add_theme_support( 'custom-logo' );
}
endif; // masonry_pk_setup
add_action( 'after_setup_theme', 'masonry_pk_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function masonry_pk_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'masonry-pk' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="panel panel-warning">',
		'after_widget'  => '</div></aside>',
		'before_title'  => ' <div class="panel-heading"><h3 class="panel-title">',
		'after_title'   => '</h3></div>',
	) );
}
add_action( 'widgets_init', 'masonry_pk_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function masonry_pk_scripts() {
	wp_enqueue_style( 'mwp-bootstrap-styles', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6', 'all' );

	wp_enqueue_style( 'mwp-roboto-styles', get_template_directory_uri() . '/css/roboto.min.css', array(), '', 'all' );

	wp_enqueue_style( 'mwp-material-styles', get_template_directory_uri() . '/css/material-fullpalette.min.css', array(), '', 'all' );

	wp_enqueue_style( 'mwp-ripples-styles', get_template_directory_uri() . '/css/ripples.min.css', array(), '', 'all' );

	wp_enqueue_style( 'masonry-pk-style', get_stylesheet_uri(), array() );

	wp_enqueue_script( 'mwp-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.6', true );

	wp_enqueue_script( 'mwp-ripples-js', get_template_directory_uri() . '/js/ripples.min.js', array('jquery'), '', true );

	wp_enqueue_script( 'mwp-material-js', get_template_directory_uri() . '/js/material.min.js', array('jquery'), '', true );

	wp_enqueue_script( 'jquery-masonry', array('jquery'), '', true );
	
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if( is_rtl() ){
		wp_enqueue_style( 'mwp-bootstrap-rtl-styles', get_template_directory_uri() . '/css/bootstrap-rtl.min.css', array('mwp-bootstrap-styles'), '3.3.4', 'all' );
	}
}
add_action( 'wp_enqueue_scripts', 'masonry_pk_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Adds a Walker class for the Bootstrap Navbar.
 */
require get_template_directory() . '/inc/bootstrap-walker.php';

/**
 * Comments Callback.
 */
require get_template_directory() . '/inc/comments-callback.php';

/**
 * Registers an editor stylesheet for the theme.
 */
function masonry_pk_theme_add_editor_styles() {
    add_editor_style( 'css/editor-style.css' );
}
add_action( 'admin_init', 'masonry_pk_theme_add_editor_styles' );