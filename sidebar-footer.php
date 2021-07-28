<?php
$sidebar_id = 'footer';
if ( ! is_active_sidebar( $sidebar_id ) ) {
	return;
}
?>

<div id="footer-sidebar" class="widget-area grey shaded">
	<aside class="inside">
		<?php dynamic_sidebar( $sidebar_id ); ?>
	</aside>
</div>