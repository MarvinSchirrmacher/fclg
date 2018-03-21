<?php get_header(); ?>

<section id="content" class="grid-3-4" role="main">
	
	<?php while ( have_posts() ) : the_post(); ?>

	<div class="module unpadded">
		<?php get_template_part( 'post' ); ?>
	</div>

	<?php endwhile;	?>

</section>

<?php get_sidebar('tertiary'); ?>
<?php get_footer(); ?>