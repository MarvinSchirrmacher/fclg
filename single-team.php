<?php get_header(); ?>
<?php $has_widget = Team::hasFussballdeWidget(); ?>
<?php $has_sponsor = Team::hasSponsor(); ?>

<section id="content" class="grid-3-4 grid" role="main">
	
<?php while ( have_posts() ) : the_post(); ?>

	<section class="grid-1-1">
		<div class="module unpadded">
			<?php get_template_part( 'post' ); ?>
		</div>
	</section>

	<section class="<?php echo ($has_widget ? 'grid-1-3' : 'grid-2-3'); ?> ">
		<div class="module unpadded" data-heading="<?php _e( 'Coaching Team', 'fconline' ); ?>">
			<?php Team::echoCoachingTeam(); ?>
		</div>
	<?php if ($has_widget) : ?>
		<div class="module unpadded" data-heading="<?php _e( 'Meta', 'fconline' ); ?>">
			<?php Team::echoTeamMeta(); ?>
		</div>
		<?php if ($has_sponsor) : ?>
		<div class="module unpadded" data-heading="<?php _e( 'Sponsor', 'fconline' ); ?>">
			<?php Team::echoSponsor(); ?>
		</div>
		<?php endif; ?>
	<?php endif; ?>
	</section>

<?php if ($has_widget) : ?>
	<section class="grid-2-3">
		<div class="module menu-mod" data-heading="<?php _e( 'Competition', 'fconline' ); ?>">
			<?php Team::echoFussballdeWidget(); ?>
		</div>
	</section>
<?php else : ?>
	<section class="grid-1-3">
		<div class="module unpadded" data-heading="<?php _e( 'Meta', 'fconline' ); ?>">
			<?php Team::echoTeamMeta(); ?>
		</div>
		<?php if ($has_sponsor) : ?>
		<div class="module unpadded" data-heading="<?php _e( 'Sponsor', 'fconline' ); ?>">
			<?php Team::echoSponsor(); ?>
		</div>
		<?php endif; ?>
	</section>
<?php endif; ?>

<?php endwhile;	?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>