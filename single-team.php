<?php get_header(); ?>

<section id="content" class="grid-3-4 group" role="main">
	
<?php while ( have_posts() ) : the_post(); ?>

	<div class="module unpadded">
		<?php get_template_part( 'post' ); ?>
	</div>

<?php $has_widget = sportsclubmanager_has_fussballde_widget(); ?>

	<section class="<?php echo ($has_widget ? 'grid-1-3' : 'grid-2-3'); ?> ">
		<div class="module unpadded" data-heading="<?php _e( 'Coaching Team', 'fconline' ); ?>">
			<?php sportsclubmanager_coaching_team(); ?>
		</div>
	<?php if ($has_widget) : ?>
		<div class="module unpadded" data-heading="<?php _e( 'Meta', 'fconline' ); ?>">
			<?php sportsclubmanager_meta(); ?>
		</div>
	<?php endif; ?>
	</section>

<?php if ($has_widget) : ?>
	<section class="grid-2-3">
		<div class="module menu-module" data-heading="<?php _e( 'Competition', 'fconline' ); ?>">
			<?php sportsclubmanager_echo_fussballde_widget(); ?>
		</div>
	</section>
<?php else : ?>
	<section class="grid-1-3">
		<div class="module unpadded" data-heading="<?php _e( 'Meta', 'fconline' ); ?>">
			<?php sportsclubmanager_meta(); ?>
		</div>
	</section>
<?php endif; ?>

<?php endwhile;	?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>