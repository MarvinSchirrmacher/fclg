<?php

function fconline_grid_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'id'    => '',
		'width' => '1-2',
		'group' => false
	), $atts));
	return '<section' . ($id != '' ? ' id="' . $id . '"' : '') . ' class="grid-' . $width . ($group ? ' grid' : '') . '">' . do_shortcode($content) . '</section>';
}
add_shortcode('grid', 'fconline_grid_shortcode');
add_filter('grid', 'do_shortcode');

/* Module Shortcode */

function fconline_module_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'id' => '',
		'class' => '',
		'heading' => '',
		'width' => '1-1'
	), $atts));

	$module = '<div' . ($id != '' ? ' id="' . $id . '"' : '') . ' class="module' . ($class != '' ? ' ' . $class  : '') . '"' . ($heading != '' ? ' data-heading="' . $heading . '"' : '') . '>' . do_shortcode($content) . '</div>';
	return fconline_grid_shortcode(array('width' => $width), $module);
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

function fconline_construct_post_preview($atts) {
	extract(shortcode_atts(array(
		'link' => '',
		'thumbnail' => '',
		'title' => '',
		'date' => '',
		'location' => ''
	), $atts));

	$classes = 'post post-preview'; 
	$output = empty($link)
		? '<div class="' . $classes . '">'
		: '<a class="' . $classes . '" href="' . $link . '" title="' . $title . '">';
	$output .= empty($thumbnail)
		? ''
		: '<div class="post-thumbnail">' . $thumbnail . '</div>';

	if (!empty($title) || !empty($date) || !empty($location)) {
		$output .= '<figcaption class="post-meta">';
		$output .= ! empty($title) ? '<span class="post-title">' . $title . '</span>' : '';
		$output .= ! empty($date) ? '<span class="post-meta-date">' . $date . '</span>' : '';
		$output .= ! empty($location) ? '<span class="post-meta-location">' . $location . '</span>' : '';
		$output .= '</figcaption>';
	}
	$output .= empty($link) ? '</div>' : '</a>';

	return $output;
}

function fconline_construct_post_preview_with_post($atts) {
	if (!empty($atts['post_formats'])) {
		fconline_set_taxonomy($atts, 'post_format', $atts['post_formats'], 'post-format');
		unset($atts['post_formats']);
	}

	if (!empty($atts['section'])) {
		fconline_set_taxonomy($atts, 'section', $atts['section']);
		unset($atts['section']);
	}

	if (!empty($atts['advertising_medium'])) {
		fconline_set_taxonomy($atts, 'advertising_medium', $atts['advertising_medium']);
		unset($atts['advertising_medium']);
	}

	global $post;
	$posts = get_posts($atts);

	ob_start();

	foreach ($posts as $post) : setup_postdata($post);
		get_template_part('post', 'preview');
	endforeach; wp_reset_postdata();

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

function fconline_post_preview_shortcode($atts) {
	return empty($atts['link'])
		? fconline_construct_post_preview_with_post($atts)
		: fconline_construct_post_preview($atts);
}
add_shortcode('post_preview', 'fconline_post_preview_shortcode');

function fconline_text_link_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => '',
		'link' => '#',
		'target' => '_self'
	), $atts));
	return '<h6><a class="link" href="' . esc_url($link) . '" target="' . esc_attr($target) . '">' . $title . '</a></h6><p>' . $content . '</p>';
}
add_shortcode('text_link', 'fconline_text_link_shortcode');
add_filter('widget_text', 'do_shortcode');

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}

function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
}
?>