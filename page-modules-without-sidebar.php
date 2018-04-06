<?php /* Template Name: Modules template without sidebar */ ?>
<?php get_header(); ?>

<section id="content" class="grid-1-1" role="main">

	<?php
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
	?>

</section>

<?php get_footer(); ?>