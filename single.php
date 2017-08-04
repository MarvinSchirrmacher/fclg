<?php get_header(); ?>

<section id="content" class="grid-3-4 group" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="module posts">
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