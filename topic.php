<?php get_header(); ?>

<section id="content" class="grid-3-4 group" role="main">

	<div class="module" data-heading="<?php _e( 'Topic', 'fconline' ); ?>">
		<?php the_content(); ?>
	</div>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>