<?php
function fconline_register_sidebar($name, $id, $description = null) {
	if (empty($description)) {
		$description = __('Sidebar that appears on the right of a page.', 'fconline');
	}

	register_sidebar(array(
		'name'          => $name,
		'id'            => $id,
		'description'   => $description,
		'before_widget' => '<div class="flex-1-4"><div id="%1$s" class="box widget %2$s"',
		'after_widget'  => '</div></div>',
		'before_title'  => ' data-heading="',
		'after_title'   => '">',
	));
}

function fconline_widgets_init() {
	fconline_register_sidebar(__('Primary Sidebar', 'fconline'), 'sidebar-1');
	fconline_register_sidebar(__('Secondary Sidebar', 'fconline'), 'sidebar-2');
	fconline_register_sidebar(__('Tertiary Sidebar', 'fconline'), 'sidebar-3');
	fconline_register_sidebar(__('Fourth Sidebar', 'fconline'), 'sidebar-4');
	
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
?>
