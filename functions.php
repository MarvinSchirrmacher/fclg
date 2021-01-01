<?php
define( 'FCO_VERSION', '2.10.1' );
define( 'FCO_REQUIRED_WP_VERSION', '5.0' );
define( 'FCO_THEME', __FILE__ );
define( 'FCO_THEME_DIR', untrailingslashit( dirname( FCO_THEME ) ) );
define( 'FCO_THEME_TEXTDOMAIN', 'fconline' );

// the order matters
$paths = array(
    '/includes/utils.php',
    '/includes/setup.php',
    '/includes/modules.php',
    '/includes/widgets.php',
    '/includes/gallery.php',
    '/includes/shortcodes.php',
    '/includes/theme.php'
);

foreach ($paths as $path) {
    require_once FCO_THEME_DIR . $path;
}

if (is_admin()) {
	require_once FCO_THEME_DIR . '/admin/admin.php';
}
?>