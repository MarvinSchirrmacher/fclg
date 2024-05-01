<?php get_header(); ?>

<section id="content" class="boxes flex group inside">

	<div class="box padded teams" data-heading="<?php _e( 'Teams', 'fconline' ) ?>">
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
