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

		$search_toggle = '<div id="srch-tog" class="tog search-form-tog round"></div>';
		$login_button = sprintf('<a href="%s" id="login" class="button round"></a>', FcOnline::getLoginUrl());
		$search_form = get_search_form(false);
		$search_form = preg_replace('/<\/?p>/m', '', $search_form);
		$search_form = preg_replace('/id="search-form"/m',
			'id="srch-wrp" class="wrp hidden"', $search_form);
		$pre_nav_menu = $search_toggle.$search_form.$login_button;

		$nav_menu = wp_nav_menu(array(
			'theme_location'  => $menu_slug,
			'container'       => 'div',
			'container_class' => 'wrp grey shaded hidden',
			'container_id'    => 'nav-wrp',
			'menu_class'      => 'menu grey uc flex',
			'menu_id'         => 'nav-menu',
			'echo'            => false,
			'fallback_cb'     => 'wp_page_menu',
			'items_wrap'      => '<div class="inside flex rel"><nav id="%1$s" class="%2$s">%3$s</nav></div>',
			'add_li_class'    => 'shaded-hover',
			'depth'           => 0
		));

		$sub_menu_pattern = '/<ul\s+class=".*?sub-menu.*?">/';
		$sub_menu =
			'<div id="sub-tog" class="tog sub-tog icn round"></div>'.
			'<ul id="sub-wrp" class="wrp menu sub-menu flex hidden">';
		$nav_menu = preg_replace($sub_menu_pattern, $sub_menu, $nav_menu);
		
		$nav_menu_pattern = '/<nav /';
		$nav_menu = preg_replace($nav_menu_pattern, $pre_nav_menu.'<nav ', $nav_menu);
		$nav_menu_toggle = '<div id="nav-tog" class="tog icn round grey shaded"></div>';
		$body_overlay = '<div id="overlay"></div>';

		return $nav_menu_toggle.$nav_menu.$body_overlay;
	}
}
?>