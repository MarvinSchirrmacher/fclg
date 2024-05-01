<?php /* Template Name: Modules template without sidebar */ ?>
<?php get_header(); ?>

<section id="content" class="boxes flex group inside">

	<?php
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
	?>

</section>

<?php get_footer(); ?>
