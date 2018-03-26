<?php
if (! function_exists('fconline_setup')) :
function fconline_setup() {
	// Make theme available for translation.
	load_theme_textdomain('fconline', get_template_directory() . '/languages');

	// Register menus.
	register_nav_menus(array(
		'primary'   => __('Header menu', 'fconline')
	));

	// Enable post thumbnail support.
	add_theme_support('post-thumbnails');
	
	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support('html5', array(
		'search-form', 'comment-form', 'comment-list',
	));
	
	// Enable support for post formats.
	add_theme_support('post-formats', array(
		'gallery', 'status'
	));

	// Enable support for custom background.
	add_theme_support('custom-background', apply_filters('fconline_custom_background_args', array(
		'default-color' => '4d4d4d',
	)));

	add_theme_support('events-manager');
}
endif;
add_action('after_setup_theme', 'fconline_setup');



// ----------------------------------------------------------------------------------------------------
// Enqueue scripts and styles for front and back end.
// ----------------------------------------------------------------------------------------------------
function fconline_dequeue_plugin_styles() {
	$plugin_slugs = array(
		'bbp-default', 'connections-user', 'cn-public', 'cn-chosen',
		'contact-form-7', 'dlm-frontend', 'ob_page_numbers',
		'validate-engine-css', 'yarppWidgetCss'
	);
	foreach ($plugin_slugs as $slug) {
		wp_dequeue_style($slug);
	}

	$plugin_slugs = array('cn-public', 'cn-chosen');
	foreach ($plugin_slugs as $slug) {
		wp_deregister_style($slug);
	}
}

function fconline_enqueue_styles($template_directory_uri) {
<<<<<<< Updated upstream
	// $theme_font_url = add_query_arg('family', 'Lato:400,700,300italic,400italic', "//fonts.googleapis.com/css");
=======
>>>>>>> Stashed changes
	$theme_font_url = add_query_arg('family', 'Corbert', "//db.onlinewebfonts.com/c/5ce66afbbd1516da0d69cffddf4f8cf3");

	wp_enqueue_style('theme-font',
		$theme_font_url, array(), null);
	wp_enqueue_style('fconline',
<<<<<<< Updated upstream
		get_stylesheet_uri(), array('theme-font'), '2.8');
	wp_enqueue_script('smooth-scroll',
		$template_directory_uri . '/scripts/min/jquery.smooth-scroll.min.js', array('jquery'), '20140508', true);
=======
		get_stylesheet_uri(), array('theme-font'), '2.8.1');
	wp_enqueue_script('smooth-scroll',
		$template_directory_uri . '/scripts/min/jquery.smooth-scroll-min.js', array('jquery'), '20140508', true);
>>>>>>> Stashed changes
	wp_enqueue_style('photoswipe',
		$template_directory_uri . '/bower_components/photoswipe/dist/photoswipe.css', array(), '4.1.2');
	wp_enqueue_style('photoswipe-skin',
		$template_directory_uri . '/bower_components/photoswipe/dist/default-skin/default-skin.css', array(), '4.1.2');
}

function fconline_enqueue_scripts($template_directory_uri) {
	wp_enqueue_script('underscore',
		$template_directory_uri . '/bower_components/underscore-amd/underscore-min.js', array(), '1.5.2', true);
	wp_enqueue_script('photoswipe',
		$template_directory_uri . '/bower_components/photoswipe/dist/photoswipe.min.js', array(), '4.1.2', true);
	wp_enqueue_script('photoswipe-ui',
		$template_directory_uri . '/bower_components/photoswipe/dist/photoswipe-ui-default.min.js', array(), '4.1.2', true);
	wp_enqueue_script('fconline-script',
		$template_directory_uri . '/scripts/min/functions-min.js', array('jquery', 'underscore', 'photoswipe'), '20170903', true);
	wp_enqueue_script('fussballde-script',
		$template_directory_uri . '/scripts/min/fussballde-widget-min.js', array(), null, false);
	wp_enqueue_script('analytics',
		$template_directory_uri . '/scripts/min/analytics-min.js', array(), '20140228', true);
}

/**
* Enqueues all neccessary styles and scripts for the theme.
* Dequeues some default plugin styles which collidate with theme style entries. 
*/
function fconline_scripts() {
	$template_directory_uri = get_template_directory_uri();

	fconline_dequeue_plugin_styles();
	fconline_enqueue_styles($template_directory_uri);
	fconline_enqueue_scripts($template_directory_uri);
}
// add script with low priority (100) to ensure the default plugin styles are enqueued earlier.
add_action('wp_enqueue_scripts', 'fconline_scripts', 100);



function fconline_login_style() {
	wp_enqueue_style('fc-online-login-style', get_template_directory_uri() . '/css/login.css', array(), '0.1');
}
add_action('login_enqueue_scripts', 'fconline_login_style');

function fconline_admin_style() {
	?><style>
	#adminmenu .menu-icon-team div.wp-menu-image:before {
	  content: "\f307";
	}
	#adminmenu #toplevel_page_jigoshop div.wp-menu-image:before,
	#adminmenu #menu-posts-products div.wp-menu-image:before,
	#adminmenu #menu-posts-shop_order div.wp-menu-image:before {
	  content: "\f174";
	}
	</style><?php
}
add_action('admin_head', 'fconline_admin_style');
?>