<?php
define( 'THEME_VERSION', '2.11.17' );
define( 'THEME_REQUIRED_WP_VERSION', '5.0' );
define( 'THEME', __FILE__ );
define( 'THEME_DIR', untrailingslashit( dirname( THEME ) ) );
define( 'THEME_TEXTDOMAIN', 'fconline' );

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
    require_once THEME_DIR . $path;
}

if (is_admin()) {
	require_once THEME_DIR . '/admin/admin.php';
}
?>
