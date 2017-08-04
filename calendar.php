<?php /* Template Name: Calendar */ ?> 
<?php get_header(); ?>

<section id="content" class="grid-3-4 group" role="main">

	<div class="module widget_em_calendar" data-heading="<?php _e( 'Calendar', 'fconline' ); ?>">
		<?php if (class_exists('EM_Calendar')) {
			echo EM_Calendar::output( array(
				'long_events' => 1,
				'full' => 1
			) );
			echo EM_Calendar::output();
		} ?>
	</div>

	<section class="grid-1-2">
		<div class="module widget_em_widget" data-heading="<?php _e( 'Events', 'fconline' ); ?>">
			<?php if (class_exists('EM_Events')) {
				echo do_shortcode(EM_Events::output(array(
					'limit' => 5
				) ) );
			} ?>
		</div>
	</section>

	<section class="grid-1-2">
		<div class="module widget_em_widget" data-heading="<?php _e( 'Locations', 'fconline' ); ?>">
			<?php if (class_exists('EM_Locations')) {
				echo do_shortcode(EM_Locations::output( array(
					'scope' => future,
					'eventful' => 1,
					'limit'=>5,
					'orderby' => 'event_start_date'
				) ) );
			} ?>
		</div>
	</section>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
 
<!-- 			<a class="location-map-image" href="http://maps.google.com/maps?daddr=#_LOCATIONADDRESS,+#_LOCATIONPOSTCODE+#_LOCATIONTOWN" target="_blank">
				<img src="http://maps.googleapis.com/maps/api/staticmap?markers=#_LOCATIONLATITUDE,#_LOCATIONLONGITUDE&zoom=15&size=640x640&scale=2&visual_refresh=false&sensor=false">
			</a> -->