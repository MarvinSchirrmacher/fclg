<?php get_header(); ?>

<section id="content" class="grid-3-4 group" role="main">

	<div class="box posts">
		<?php get_template_part('post', 'none'); ?>
	</div>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>