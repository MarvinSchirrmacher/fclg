<?php
/*
 * Get user's role
 *
 * If $user parameter is not provided, returns the current user's role.
 * Only returns the user's first role, even if they have more than one.
 * Returns false on failure.
 *
 * @param  mixed       $user User ID or object.
 * @return string|bool       The User's role, or false on failure.
 */
function fconline_get_user_role( $user = null ) {
	$user = $user ? new WP_User( $user ) : wp_get_current_user();
	return $user->roles ? $user->roles[0] : false;
}

function fconline_determine_available_roles() {
	global $wp_roles;
	return array_map(
		function($item) { return strtolower($item); },
		$wp_roles->get_names()
	);
}

function download_is_accessed_directly() {
	return !defined('ABSPATH');
}

function download_has_image($html) {
	return strpos($html, 'alt="Placeholder"') == false;
}

function starts_with($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}

function ends_with($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
}

?>