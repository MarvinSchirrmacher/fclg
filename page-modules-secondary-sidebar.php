<?php /* Template Name: Modules template with secondary sidebar */ ?>
<?php get_header(); ?>

<section id="content" class="grid-3-4 grid" role="main">

	<?php
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
	?>

</section>

<?php get_sidebar('secondary'); ?>
<?php get_footer(); ?>