<?php get_header(); ?>

<section id="content" class="boxes flex group inside">
	
	<?php while ( have_posts() ) : the_post(); ?>

	<div class="box flex-2-3">
		<?php get_template_part( 'post' ); ?>
	</div>

	<?php endwhile;	?>

</section>

<?php get_sidebar('tertiary'); ?>
<?php get_footer(); ?>
