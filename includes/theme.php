<?php
class FcOnline {
	public static function getLoginUrl() {
		if (is_user_logged_in()) {
			return wp_logout_url(home_url());
		}
		
		$redirectUrl = get_option('fco_login_redirect_url');
		$redirectUrl = filter_var($redirectUrl, FILTER_SANITIZE_URL);
		$redirectUrl = filter_var($redirectUrl, FILTER_VALIDATE_URL);
		return wp_login_url($redirectUrl ? $redirectUrl : home_url());
	}
	
	public static function assembleNavMenu($menu_slug) {
		if (!has_nav_menu($menu_slug)) {
			return '';
		}

		$search_toggle = '<div id="search-toggle" class="toggle search-form-toggle round-button"></div>';
		$login_button = sprintf('<a href="%s" id="login-button" class="button round-button"></a>', FcOnline::getLoginUrl());
		$search_form = get_search_form(false);
		$search_form = preg_replace('/<\/?p>/m', '', $search_form);
		$search_form = preg_replace('/id="search-form"/m',
			'id="search-wrapper" class="wrapper hidden"', $search_form);
		$pre_nav_menu = $search_toggle.$search_form.$login_button;

		$nav_menu = wp_nav_menu(array(
			'theme_location'  => $menu_slug,
			'container'       => 'div',
			'container_class' => 'wrapper strip hidden',
			'container_id'    => 'navigation-wrapper',
			'menu_class'      => 'menu',
			'menu_id'         => 'navigation-menu',
			'echo'            => false,
			'fallback_cb'     => 'wp_page_menu',
			'items_wrap'      => '<div class="inside"><nav id="%1$s" class="%2$s">%3$s</nav></div>',
			'depth'           => 0
		));

		$sub_menu_pattern = '/<ul\s+class=".*?sub-menu.*?">/';
		$sub_menu =
			'<div id="sub-menu-toggle" class="toggle sub-menu-toggle"></div>'.
			'<ul id="sub-menu-wrapper" class="wrapper menu sub-menu flexbox hidden">';
		$nav_menu = preg_replace($sub_menu_pattern, $sub_menu, $nav_menu);
		
		$nav_menu_pattern = '/<nav /';
		$nav_menu = preg_replace($nav_menu_pattern, $pre_nav_menu.'<nav ', $nav_menu);
		$nav_menu_toggle = '<div id="navigation-toggle" class="toggle round-button"></div>';
		$body_overlay = '<div id="overlay"></div>';

		return $nav_menu_toggle.$nav_menu.$body_overlay;
	}
}
?>