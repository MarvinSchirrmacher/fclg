<?php get_header(); ?>

<section id="content" class="boxes flex group inside">

	<div class="box menu" data-heading="<?php _e('Archive', 'fconline'); ?>">
		<?php FcOnlineModules::pageNavigation(); ?>
	</div>

	<div class="box padded sitemap">
		<table class="sitemap-table">
			<tbody>
			<?php
				if ( have_posts() ) :
					// Start the Loop.
					while ( have_posts() ) : the_post();

						// Include the page content template.
						get_template_part( 'post', 'sitemap' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							//comments_template();
						}
					endwhile;
				else:
					get_template_part( 'content', 'none' );
				endif;
			?>
			</tbody>
		</table>
	</div>

	<div class="box menu">
		<?php FcOnlineModules::pageNavigation(); ?>
	</div>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
