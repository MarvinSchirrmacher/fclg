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
		'id' => null,
		'class' => null,
		'heading' => null,
		'use_post_meta' => null,
		'width' => '1-1'
	), $atts));

	$use_post_meta = isset($use_post_meta);

	$output = '<div';
	if (isset($id))
		$output .= ' id="'.$id.'"';

	$output .= ' class="module';
	if (isset($class))
		$output .= ' '.$class;
	$output .= '"';

	if (isset($heading))
		$output .= ' data-heading="'.$heading.'"';
	$output .= '>';

	if ($use_post_meta) {
		$output .= '<article class="hentry"><div class="post-thumbnail">'.get_the_post_thumbnail().'</div>';
		$output .= '<header class="post-header"><h1 class="post-title">'.get_the_post_title().'</h1></header>';
		$output .= '<div class="post-content">';
	}

	$output .= do_shortcode($content);

	if ($use_post_meta)
		$output .= '</div></article>';
	$output .= '</div>';

	return fconline_grid_shortcode(array('width' => $width), $output);
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
	if (empty($atts)) {
		$atts = array();
	}

	$values = explode(',', $values);
	$values_to_include = array();
	$values_to_exclude = array();

	foreach ($values as $value) {
		if (starts_with($value, '-')) {
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
		'class' => '',
		'link' => '',
		'thumbnail' => '',
		'title' => '',
		'date' => '',
		'location' => ''
	), $atts));

	$classes = 'post post-preview '.$class; 
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

/**
 * Parses and shows the inner content only if the current user's role is allowed to see it.
 * 
 * Available rules are:
 *  - only-these (default)
 *  - all-but-these
 * 
 * For the last two options the first entry in roles will be used as orientation
 * 
 * @param atts Inlcudes the access rule and the linked roles.
 * @param content The content to display if the current user's role matches the rule.  
 */
function fconline_limit_visibility($atts, $content = null) {
	extract(shortcode_atts(array(
		'rule' => 'only-these',
		'roles' => ''
	), $atts));

	$roles = explode(',', preg_replace('/\s+/', '', $roles));
	$roles = array_map(function($item) { return strtolower($item); }, $roles);
	$available_roles = fconline_determine_available_roles();

	foreach ($roles as $role) {
		if (array_key_exists($role, $available_roles)) { continue; }
		echo('The content of [visible] will not be parsed because the role "' . $role . '" is unknown');
		return;
	}

	$current_role = fconline_get_user_role();
	$allowed_roles = array();

	switch ($rule) {
		case 'only-these':
			$allowed_roles = $roles;
			break;
		case 'all-but-these':
			$allowed_roles = $available_roles;
			foreach ($roles as $role) {
				unset($allowed_roles[$role]);
			}
			break;
		default:
			echo '[visible] The rule "' . $rule . '" is unknown\n';
			break;
	}

	if (!in_array($current_role, $allowed_roles)) {
		return;
	}

	return do_shortcode($content);
}
add_shortcode('visible', 'fconline_limit_visibility');

/**
 * Links the content to a heading which has to be clicked to make the content visible.
 * 
 * @param atts Inlcudes the heading text and optionals styles.
 * @param content The content to display if the heading is clicked.  
 */
function fconline_block($atts, $content = null) {
	extract(shortcode_atts(array(
		'heading' => '',
		'type' => 'h5',
		'visible' => ''
	), $atts));

	$heading_start = '<' . $type . ' class="toggle" id="block-toggle">';
	$heading_end = '</' . $type . '>';
	$hidden = empty($visible) ? ' hidden' : '';

	$output .= $heading_start . $heading . $heading_end;
	$output .= '<div class="wrapper' . $hidden . '" id="block-wrapper">' . $content . '</div>';

	return do_shortcode($output);
}
add_shortcode('block', 'fconline_block');

/**
 * Assembles shop product entry.
 * 
 * @param atts Inlcudes title, image id, price and box width (default 1-3).
 * @param content The content to include.  
 */
function fconline_shop_product($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => null,
		'image' => null,
		'image_size' => 'medium',
		'price' => null,
		'width' => '1-3'
	), $atts));

	$output = '<div class="grid-'.$width.'"><table><tbody>';
	if (isset($image))
		$output .= '<tr><td>'.wp_get_attachment_image($image, $image_size).'</td></tr>';

	$output .= '<tr><td>';
	if (isset($title))
		$output = '<h6><strong>'.$title.'</strong></h6>';

	$output .= $content.'</td></tr>';

	if (isset($price))
		$output .= '<tr><td style="background-color:#e1e1e1;"><p style="text-align: right;"><span style="color: #333333;"><strong>'.$price.'</strong></span></p></td></tr>';
	$output .= '</tbody></table></div>';

	return do_shortcode($output);
}
add_shortcode('shop_product', 'fconline_shop_product');
?>