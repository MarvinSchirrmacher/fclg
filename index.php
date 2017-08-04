<?php get_header(); ?>

<section id="content" class="grid-3-4" role="main">
	<div class="module">
	<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'post', get_post_format() );
		endwhile;
	?>
	</div>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>