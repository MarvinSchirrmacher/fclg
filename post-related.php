<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<h6 class="post-title sitemap-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h6>

	<div class="post-summary">
		<?php the_excerpt(); ?>
	</div><!-- .post-summary -->

</article>