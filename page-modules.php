<?php /* Template Name: Modules template */ ?>
<?php get_header(); ?>

<section id="content" class="grid-3-4 group" role="main">

	<?php
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
	?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>