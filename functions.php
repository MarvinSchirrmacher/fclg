<?php

define( 'FCO_VERSION', '2.8.2' );
define( 'FCO_REQUIRED_WP_VERSION', '5.0' );
define( 'FCO_THEME', __FILE__ );
define( 'FCO_THEME_DIR', untrailingslashit( dirname( FCO_THEME ) ) );
define( 'FCO_THEME_TEXTDOMAIN', 'fconline' );

require_once FCO_THEME_DIR . '/includes/setup.php';
require_once FCO_THEME_DIR . '/includes/modules.php';
require_once FCO_THEME_DIR . '/includes/widgets.php';
require_once FCO_THEME_DIR . '/includes/gallery.php';
require_once FCO_THEME_DIR . '/includes/shortcodes.php';

?>