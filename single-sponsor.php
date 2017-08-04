<?php get_header(); ?>

<section id="content" class="grid-3-4 group" role="main">
	
	<?php while ( have_posts() ) : the_post(); ?>

	<div class="module unpadded">
		<?php get_template_part( 'post' ); ?>
	</div>

	<section class="grid-1-3">
		<div class="module" data-heading="<?php _e( 'Contact', 'fconline' ); ?>">
			<?php sportsclubmanager_sponsors_meta(); ?>
		</div>
	</section>

	<section class="grid-2-3">
		<div class="module unpadded" data-heading="<?php _e( 'Map', 'fconline' ); ?>">
			<?php sportsclubmanager_sponsors_map(); ?>
		</div>
	</section>

	<?php endwhile;	?>

</section>

<?php get_sidebar('tertiary'); ?>
<?php get_footer(); ?>