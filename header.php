<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<!-- <link rel="shortcut icon" href="<?php //get_template_directory_uri(); ?>/images/favicon.ico"> -->
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<a name="top"></a>

<body <?php body_class(); ?>>

	<a href="#top" id="back-to-top" class="hidden"></a>

	<section id="page">
	<?php $nav_menu_id = 'primary'; ?>
	<?php $has_nav_menu = has_nav_menu($nav_menu_id); ?>
	<?php if($has_nav_menu): ?>
		<div id="navigation-toggle" class="toggle"></div>
	<?php endif;?>

		<header id="page-header" role="banner">

			<div id="top-strip" class="strip">
				<div id="page-title-wrapper" class="inside">
					<?php include get_template_directory() . "/images/title.svg"; ?>
					<?php include get_template_directory() . "/images/claim.svg"; ?>
				</div>
			</div>
			<div id="middle-strip" class="strip"></div>
			<div id="bottom-strip" class="strip"></div>
			<a id="site-logo" href="<?php bloginfo('url'); ?>"><span></span></a>

		</header>

		<?php
		if ($has_nav_menu) {
			$nav_menu_parameters = array(
				'theme_location'  => $nav_menu_id,
				'container'       => 'div',
				'container_class' => 'wrapper strip hidden',
				'container_id'    => 'navigation-wrapper',
				'menu_class'      => 'menu inside grid',
				'menu_id'         => 'navigation-menu',
				'echo'            => false,
				'fallback_cb'     => 'wp_page_menu',
				'items_wrap'      => '<nav id="%1$s" class="%2$s">%3$s</nav>',
				'depth'           => 0
			);
			echo preg_replace('<ul class="sub-menu">', 'div id="sub-menu-toggle" class="toggle sub-menu-toggle"></div><ul id="sub-menu-wrapper" class="wrapper sub-menu hidden"', wp_nav_menu( $nav_menu_parameters ) );
		}
		?>

		<section id="page-main" class="inside grid">