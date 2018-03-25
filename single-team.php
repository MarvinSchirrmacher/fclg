<?php get_header(); ?>
<?php $has_widget = TeamManagement::hasFussballdeWidget(); ?>

<section id="content" class="grid-3-4 grid" role="main">
	
<?php while ( have_posts() ) : the_post(); ?>

	<section class="grid-1-1">
		<div class="module unpadded">
			<?php get_template_part( 'post' ); ?>
		</div>
	</section>

	<section class="<?php echo ($has_widget ? 'grid-1-3' : 'grid-2-3'); ?> ">
		<div class="module unpadded" data-heading="<?php _e( 'Coaching Team', 'fconline' ); ?>">
			<?php TeamManagement::echoCoachingTeam(); ?>
		</div>
	<?php if ($has_widget) : ?>
		<div class="module unpadded" data-heading="<?php _e( 'Meta', 'fconline' ); ?>">
			<?php TeamManagement::echoTeamMeta(); ?>
		</div>
	<?php endif; ?>
	</section>

<?php if ($has_widget) : ?>
	<section class="grid-2-3">
		<div class="module menu-module" data-heading="<?php _e( 'Competition', 'fconline' ); ?>">
			<?php TeamManagement::echoFussballdeWidget(); ?>
		</div>
	</section>
<?php else : ?>
	<section class="grid-1-3">
		<div class="module unpadded" data-heading="<?php _e( 'Meta', 'fconline' ); ?>">
			<?php TeamManagement::echoTeamMeta(); ?>
		</div>
	</section>
<?php endif; ?>

<?php endwhile;	?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>