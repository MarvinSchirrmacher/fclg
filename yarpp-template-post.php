<div class="module columns gallery-columns-3 related-posts" data-heading="<?php _e('Related', 'fconline'); ?>">
<?php
	// Start the Loop.
	while ( have_posts() ) : the_post();

		// Include the page content template.
		get_template_part( 'post', 'related' );
		
	endwhile;
?>
</div>