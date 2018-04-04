<article id="post-none" class="post">

	<header class="post-header">
		<h1 class="post-title"><?php _e('Nothing found', FCO_THEME_TEXTDOMAIN); ?></h1>
	</header>

	<div class="post-content">
		<?php if ( is_search() ) : ?>

		<p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords or take a look at the available categories and tags.', FCO_THEME_TEXTDOMAIN); ?></p>
		<?php get_search_form(); ?>

		<?php else : ?>

		<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', FCO_THEME_TEXTDOMAIN); ?></p>
		<?php get_search_form(); ?>
	
		<?php endif; ?>
	</div>

</article>