<?php /* Template Name: Single page with secondary sidebar */ ?>
<?php get_header(); ?>

<section id="content" class="grid-3-4" role="main">

	<div class="module unpadded">
	<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'post' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				//comments_template();
			}
		endwhile;
	?>
	</div>

</section>

<?php get_sidebar('secondary'); ?>
<?php get_footer(); ?>