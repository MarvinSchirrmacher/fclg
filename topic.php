<?php get_header(); ?>

<section id="content" class="boxes group inside">

	<div class="box" data-heading="<?php _e( 'Topic', 'fconline' ); ?>">
		<?php the_content(); ?>
	</div>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
