<?php /* Template Name: Modules template with fourth sidebar */ ?>
<?php get_header(); ?>

<section id="content" class="boxes flex group inside">

	<?php
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
	?>

</section>

<?php get_sidebar('fourth'); ?>
<?php get_footer(); ?>
