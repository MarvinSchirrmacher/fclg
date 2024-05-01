<?php get_header(); ?>

<section id="content" class="boxes group inside">

	<div class="box" data-heading="Section">
	<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'content' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				//comments_template();
			}
		endwhile;
	?>
	</div>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
