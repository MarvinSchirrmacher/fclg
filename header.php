<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="google-site-verification" content="BQFYvthhymuUhKWzKiHIrYuc_ZkibFbN2in51t7TISk" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<meta name="apple-mobile-web-app-title" content="FCLG">
	<?php wp_head(); ?>
</head>

<a name="top"></a>

<body <?php body_class(); ?>>
	<a href="#top" id="top-lnk" aria-label="link to top" class="round grey shaded icn hidden"></a>
	<header id="page-header" role="banner">
		<div id="top-edging" class="edging shaded"></div>
		<div id="bottom-edging" class="edging shaded"></div>
		<a id="logo-wrapper" class="round" href="<?php bloginfo('url'); ?>">
			<?php include get_template_directory() . "/images/logo.svg"; ?>
		</a>
	</header>
	<?php echo FcOnline::assembleNavMenu('primary'); ?>
	<main id="page-main">
