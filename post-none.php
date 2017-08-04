<article id="post-none" class="post">

	<header class="post-header">
		<h1 class="post-title"><?php _e('Nothing found', 'fconline'); ?></h1>
	</header><!-- .post-header -->

	<div class="post-summary">
		<?php if ( is_search() ) : ?>

		<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords or take a look at the available categories and tags.', 'fconline' ); ?></p>
		<?php get_search_form(); ?>

		<?php else : ?>

		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'fconline' ); ?></p>
		<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .post-summary -->

	<?php // the_tags( '<footer class="post-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->