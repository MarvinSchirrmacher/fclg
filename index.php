<?php get_header(); ?>

<section id="content" class="boxes flex group inside">
	<div class="box">
	<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'post', get_post_format() );
		endwhile;
	?>
	</div>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
