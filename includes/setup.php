<?php
if (! function_exists('fconline_setup')) :
function fconline_setup() {
	load_theme_textdomain('fconline', get_template_directory() . '/languages');

	register_nav_menus(array(
		'primary'   => __('Header menu', 'fconline')
	));

	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', array(
		'search-form', 'comment-form', 'comment-list',
	));
	add_theme_support('post-formats', array(
		'gallery', 'status'
	));
	add_theme_support('custom-background', apply_filters('fconline_custom_background_args', array(
		'default-color' => '4d4d4d',
	)));
	add_theme_support('wp-block-styles');

	add_theme_support('connections');
	add_theme_support('events-manager');
	add_theme_support('flexmap');
	add_theme_support('post-preview');
	add_theme_support('sports-club-manager');
}
endif;
add_action('after_setup_theme', 'fconline_setup');

function fconline_dequeue_plugin_styles() {
	$plugin_slugs = array(
		'bbp-default', 'connections-user', 'cn-public', 'cn-chosen',
		'contact-form-7', 'dlm-frontend',
		'basecss', // eu-cookie-law
		'events-manager',
		'validate-engine-css',
		'woocommerce-general', 'woocommerce-layout', 'woocommerce-gzd-layout', 'woocommerce-smallscreen',
		'yarppWidgetCss'
	);

	foreach ($plugin_slugs as $slug) {
		wp_dequeue_style($slug);
		wp_deregister_style($slug);
	}
}

function fconline_enqueue_styles($template_directory_uri) {
	$theme_font_url = add_query_arg(array(
		'family' => 'Source+Sans+Pro',
		'display' => 'swap',
	), "https://fonts.googleapis.com/css");

	wp_enqueue_style('theme-font',
		$theme_font_url, array(), null);
	wp_enqueue_style('fconline',
		get_stylesheet_uri(), array('theme-font'), THEME_VERSION);
	wp_enqueue_style('photoswipe',
		$template_directory_uri . '/bower_components/photoswipe/dist/photoswipe.css', array(), '4.1.2');
	wp_enqueue_style('photoswipe-skin',
		$template_directory_uri . '/bower_components/photoswipe/dist/default-skin/default-skin.css', array(), '4.1.2');
}

// function fconline_add_type_attribute($tag, $handle, $src) {
//     if ( 'quform-addon-script' !== $handle ) {
//         return $tag;
//     }
//     $tag = '<script type="systemjs-module" src="' . esc_url( $src ) . '"></script>';
//     return $tag;
// }
// add_filter('script_loader_tag', 'fconline_add_type_attribute' , 10, 3);

function fconline_enqueue_scripts($template_directory_uri) {
	wp_enqueue_script('underscore',
		$template_directory_uri . '/bower_components/underscore-amd/underscore-min.js', array(), '1.5.2', true);
	wp_enqueue_script('smooth-scroll',
		$template_directory_uri . '/scripts/jquery.smooth-scroll-min.js', array('jquery'), '1.4.13', true);
	wp_enqueue_script('photoswipe',
		$template_directory_uri . '/bower_components/photoswipe/dist/photoswipe.min.js', array(), '4.1.2', true);
	wp_enqueue_script('photoswipe-ui',
		$template_directory_uri . '/bower_components/photoswipe/dist/photoswipe-ui-default.min.js', array(), '4.1.2', true);
	wp_enqueue_script('fconline-script',
		$template_directory_uri . '/scripts/functions-min.js', array('jquery', 'underscore', 'photoswipe'), THEME_VERSION, true);
	wp_enqueue_script('fussballde-script',
		$template_directory_uri . '/scripts/fussballde-min.js', array(), null, false);
	// wp_enqueue_script('systemjs',
	// 	$template_directory_uri . '/scripts/min/s.min.js', array(), null, true);
	// wp_enqueue_script('systemjs-named-register',
	// '//cdn.jsdelivr.net/npm/systemjs/dist/extras/named-register.js', array(), null, true);
	// wp_enqueue_script('systemjs',
	// 	'//cdn.jsdelivr.net/npm/systemjs/dist/system.js', array('systemjs-named-register'), null, true);
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
