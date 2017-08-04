<?php get_header(); ?>

<section id="content" class="grid-3-4 group" role="main">

	<div class="module unpadded teams" data-heading="<?php _e( 'Teams', 'fconline' ) ?>">
	<?php
	if ( have_posts() ) :
		// Start the Loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'content', 'preview' );

		endwhile;
	else:
		get_template_part( 'content', 'none' );
	endif;
	?>
	</div>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>