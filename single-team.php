<?php get_header(); ?>
<?php $has_widget = Team::hasFussballdeWidget(); ?>
<?php $has_sponsor = Team::hasSponsor(); ?>

<section id="content" class="boxes flex group inside">
	
<?php while ( have_posts() ) : the_post(); ?>

	<div class="box flex-2-3">
		<?php get_template_part( 'post' ); ?>
	</div>

	<section class="flex-1-3 boxes flex">
		<div class="box" data-heading="<?php _e( 'Coaching Team', 'fconline' ); ?>">
			<?php Team::echoCoachingTeam(); ?>
		</div>
	<?php if ($has_widget) : ?>
		<div class="box" data-heading="<?php _e( 'Meta', 'fconline' ); ?>">
			<?php Team::echoTeamMeta(); ?>
		</div>
		<?php if ($has_sponsor) : ?>
		<div class="box" data-heading="<?php _e( 'Sponsor', 'fconline' ); ?>">
			<?php Team::echoSponsor(); ?>
		</div>
		<?php endif; ?>
	<?php endif; ?>
	</section>

<?php if ($has_widget) : ?>
	<section class="flex-2-3">
		<div class="box menu" data-heading="<?php _e( 'Competition', 'fconline' ); ?>">
			<?php Team::echoFussballdeWidget(); ?>
		</div>
	</section>
<?php else : ?>
	<section class="flex-1-3">
		<div class="box" data-heading="<?php _e( 'Meta', 'fconline' ); ?>">
			<?php Team::echoTeamMeta(); ?>
		</div>
		<?php if ($has_sponsor) : ?>
		<div class="box" data-heading="<?php _e( 'Sponsor', 'fconline' ); ?>">
			<?php Team::echoSponsor(); ?>
		</div>
		<?php endif; ?>
	</section>
<?php endif; ?>

<?php endwhile;	?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
