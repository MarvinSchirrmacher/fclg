<?php get_header(); ?>

<section id="content" class="boxes flex group inside">

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="flex-2-3 box posts">
			<?php get_template_part( 'post', get_post_format() ); ?>
		</div>

	<?php endwhile; ?>

	<?php
	
	if( get_post_type() == 'post' && function_exists('related_posts') ) :
		related_posts();
	endif;
			
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

	?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
