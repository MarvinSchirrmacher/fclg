<?php
// ----------------------------------------------------------------------------------------------------
// Set up theme defaults and registers support for various WordPress features.
// ----------------------------------------------------------------------------------------------------
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
		'default-color' => 'ffffff',
	)));
}
endif;
add_action('after_setup_theme', 'fconline_setup');



// ----------------------------------------------------------------------------------------------------
// Enqueue scripts and styles for front and back end.
// ----------------------------------------------------------------------------------------------------
function fconline_scripts() {
	// Dequeue default plugin stylesheets
	wp_dequeue_style('bbp-default');
	wp_dequeue_style('connections-user');
	wp_dequeue_style('cn-public');
	wp_dequeue_style('cn-chosen');
	wp_dequeue_style('dlm-frontend');
	wp_dequeue_style('ob_page_numbers');
	wp_dequeue_style('validate-engine-css');
	wp_dequeue_style('yarppWidgetCss');

	$theme_font_url = add_query_arg('family', 'Lato:400,700,300italic,400italic', "//fonts.googleapis.com/css");
	$template_directory_uri = get_template_directory_uri();
	wp_enqueue_style('theme-font', $theme_font_url, array(), null);
	wp_enqueue_style('fconline-style', get_stylesheet_uri(), array('theme-font'), '2.7.1');
	wp_enqueue_script('smooth-scroll', $template_directory_uri . '/scripts/min/jquery.smooth-scroll.min.js', array('jquery'), '20140508', true);

	wp_enqueue_script('photoswipe', $template_directory_uri . '/bower_components/photoswipe/dist/photoswipe.min.js', array('jquery'), '4.1.2', true);
	wp_enqueue_script('photoswipe-ui', $template_directory_uri . '/bower_components/photoswipe/dist/photoswipe-ui-default.min.js', array('jquery'), '4.1.2', true);

	wp_enqueue_script('fconline-script', $template_directory_uri . '/scripts/min/functions-min.js', array('jquery', 'photoswipe'), '20170426', true);
	wp_enqueue_script('fussballde-script', $template_directory_uri . '/scripts/min/fussballde-widget-min.js', array(), null, false);
	wp_enqueue_script('analytics', $template_directory_uri . '/scripts/min/analytics-min.js', array(), '20140228', true);
}
add_action('wp_enqueue_scripts', 'fconline_scripts');



function fconline_login_style() {
	// Load the login page stylesheet
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



//==================================================================
// Widgets and sidebars
//==================================================================
function fconline_widgets_init() {
	register_sidebar(array(
		'name'          => __('Primary Sidebar', 'fconline'),
		'id'            => 'sidebar-1',
		'description'   => __('Primary sidebar that appears on the right on every page.', 'fconline'),
		'before_widget' => '<div class="grid-1-1"><div id="%1$s" class="module widget %2$s"',
		'after_widget'  => '</div></div>',
		'before_title'  => ' data-heading="',
		'after_title'   => '">',
	));
	register_sidebar(array(
		'name'          => __('Secondary Sidebar', 'fconline'),
		'id'            => 'sidebar-2',
		'description'   => __('Alternative sidebar, which will be displayed instead of the primary one when the corresponding template is selected.', 'fconline'),
		'before_widget' => '<div class="grid-1-1"><div id="%1$s" class="module widget %2$s"',
		'after_widget'  => '</div></div>',
		'before_title'  => ' data-heading="',
		'after_title'   => '">',
	));
	register_sidebar(array(
		'name'          => __('Tertiary Sidebar', 'fconline'),
		'id'            => 'sidebar-3',
		'description'   => __('Alternative sidebar, which will be displayed instead of the primary one when the corresponding template is selected.', 'fconline'),
		'before_widget' => '<div class="grid-1-1"><div id="%1$s" class="module widget %2$s"',
		'after_widget'  => '</div></div>',
		'before_title'  => ' data-heading="',
		'after_title'   => '">',
	));
	register_sidebar(array(
		'name'          => __('Footer Sidebar', 'fconline'),
		'id'            => 'footer',
		'description'   => __('Appears in the footer section of the website.', 'fconline'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	));
}
add_action('widgets_init', 'fconline_widgets_init');
add_filter('widget_em_widget', 'do_shortcode');


/* Shortcodes */

/* Grid Shortcode */

function fconline_grid_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'id'    => '',
		'width' => '1-2',
		'group' => false
	), $atts));
	return '<section' . ($id != '' ? ' id="' . $id . '"' : '') . ' class="grid-' . $width . ($group ? ' group' : '') . '">' . do_shortcode($content) . '</section>';
}
add_shortcode('grid', 'fconline_grid_shortcode');
add_filter('grid', 'do_shortcode');

/* Module Shortcode */

function fconline_module_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'id' => '',
		'class' => '',
		'heading' => '',
		'width' => ''
	), $atts));

	if (! empty($width)) {
		$grid_content = '';
		$grid_content .= '[module id="' . $id . '" class="' . $class . '" heading="' . $heading . '"]';
		$grid_content .= ($content != null ? $content : '');
		$grid_content .= '[/module]';
		return fconline_grid_shortcode(array('width' => $width), $grid_content);
	} else {
		return '<div' . ($id != '' ? ' id="' . $id . '"' : '') . ' class="module' . ($class != '' ? ' ' . $class  : '') . '"' . ($heading != '' ? ' data-heading="' . $heading . '"' : '') . '>' . do_shortcode($content) . '</div>';
	}
}
add_shortcode('module', 'fconline_module_shortcode');
add_filter('module', 'do_shortcode');

function fconline_post_excerpt_shortcode($atts, $template = '') {
	global $post;
	if (!empty($atts['post_formats'])) {
		fconline_set_taxonomy($atts, 'post_format', $atts['post_formats'], 'post-format');
		unset($atts['post_formats']);
	}
	$posts = get_posts($atts);

	ob_start();

	foreach ($posts as $post) : setup_postdata($post);
		get_template_part('post', $template);
	endforeach; wp_reset_postdata();

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_shortcode('post_excerpt', 'fconline_post_excerpt_shortcode');

function fconline_set_taxonomy(&$atts, $name, $values, $value_prefix = '') {
	$values = explode(',', $values);
	$values_to_include = array();
	$values_to_exclude = array();

	foreach ($values as $value) {
		if (startsWith($value, '-')) {
			$value = ltrim($value, '-');
			$values_to_exclude[] = $value_prefix . '-' . $value;
		} else {
			$values_to_include[] = $value_prefix . '-' . $value;
		}
	}

	if (!empty($values_to_include)) {
		$atts['tax_query'][] = array(
			'taxonomy' => $name,
			'field' => 'slug',
			'terms' => $values_to_include,
        	'operator' => 'IN'
       );
	}
	if (!empty($values_to_exclude)) {
		foreach ($values_to_include as $value) {
			echo $value;
		}
		$atts['tax_query'][] = array(
			'taxonomy' => $name,
			'field' => 'slug',
			'terms' => $values_to_exclude,
        	'operator' => 'NOT IN'
       );
	}
}

function fconline_status_shortcode($atts) {
	fconline_set_taxonomy($atts, 'post_format', 'status', 'post-format');
	return fconline_post_excerpt_shortcode($atts, 'status');
}
add_shortcode('status', 'fconline_status_shortcode');

function fconline_post_preview_shortcode($atts) {
	$output = '';

	if (!empty($atts['link'])) {
		extract(shortcode_atts(array(
			'link' => '',
			'thumbnail' => '',
			'title' => '',
			'date' => '',
			'location' => ''
		), $atts));

		$output .= ! empty($link) ? '<a class="post post-preview" href="' . $link . '" title="' . $title . '">' : '<div class="post post-preview">';
		$output .= ! empty($thumbnail) ? '<div class="post-thumbnail">' . $thumbnail . '</div>' : '';
		if (!empty($title) || !empty($date) || !empty($location)) {
			$output .= '<figcaption class="post-meta">';
			$output .= ! empty($title) ? '<span class="post-title">' . $title . '</span>' : '';
			$output .= ! empty($date) ? '<span class="post-meta-date">' . $date . '</span>' : '';
			$output .= ! empty($location) ? '<span class="post-meta-location">' . $location . '</span>' : '';
			$output .= '</figcaption>';
		}
		$output .= ! empty($link) ? '</a>' : '</div>';
	} else {
		$posts = array();
		if (!empty($atts['post_formats'])) {
			fconline_set_taxonomy($atts, 'post_format', $atts['post_formats'], 'post-format');
			unset($atts['post_formats']);
		}

		if (!empty($atts['section'])) {
			fconline_set_taxonomy($atts, 'section', $atts['section']);
			unset($atts['section']);
		}

		global $post;
		$posts = get_posts($atts);

		ob_start();

		foreach ($posts as $post) : setup_postdata($post);
			get_template_part('post', 'preview');
		endforeach; wp_reset_postdata();

		$output = ob_get_contents();
		ob_end_clean();
	}

	return $output;
}
add_shortcode('post_preview', 'fconline_post_preview_shortcode');

function fconline_text_link_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => '',
		'link' => '#',
		'target' => '_self'
	), $atts));
	return '<h5><a class="link" href="' . esc_url($link) . '" target="' . esc_attr($target) . '">' . $title . '</a></h5><p>' . $content . '</p>';
}
add_shortcode('text_link', 'fconline_text_link_shortcode');
add_filter('widget_text', 'do_shortcode');

function remove_width_attribute($html) {
   return preg_replace('/(width|height)="\d*"\s/', "", $html);
}
add_filter('post_thumbnail_html', 'remove_width_attribute', 10);
add_filter('image_send_to_editor', 'remove_width_attribute', 10);

function fconline_query_format_standard() {
	$args = array(
		'tax_query' => array(
			array(
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => array(
					'post-format-aside',
					'post-format-gallery',
					'post-format-link',
					'post-format-image',
					'post-format-quote',
					'post-format-status',
					'post-format-video',
					'post-format-audio',
					'post-format-chat'
				),
				'operator' => 'NOT IN'
			)
		)
	);
	query_posts($args);
}

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}

function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
}

?>