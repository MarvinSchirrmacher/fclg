<div class="box" data-heading="<?php _e('Related', 'fconline'); ?>">
	<div class="columns gallery-columns-3 related-posts">
	<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'post', 'related' );
			
		endwhile;
	?>
	</div>
</div>