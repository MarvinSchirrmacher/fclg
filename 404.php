<?php get_header(); ?>

<section id="content" class="grid-3-4 group" role="main">

	<div class="module posts">
		<article id="post-none" class="hentry">

			<header class="post-header">
				<h1 class="post-title"><?php _e('Page not found', 'fconline'); ?></h1>
			</header>

			<div class="post-summary">
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'fconline' ); ?></p>
				<?php get_search_form(); ?>
			</div>
			
		</article>
	</div>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>