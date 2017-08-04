<?php get_header(); ?>

<section id="content" class="grid-3-4 group" role="main">

	<div class="module" data-heading="<?php _e('Search results', 'fconline'); ?>">

		<header class="sitemap-header">
			<h1 class="sitemap-header-title"><?php _e('Search results for:', 'fconline'); ?> <em>"<?php the_search_query(); ?>"</em></h1>
		</header>

		<?php if ( have_posts() ) : ?>

		<table class="sitemap-table">
			<tbody>

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'post', 'sitemap' );

			endwhile;
			?>

			</tbody>
		</table>

		<?php else : get_template_part( 'post', 'none' ); endif; ?>

	</div>

	<?php if( function_exists('ob_page_numbers') && have_posts() ) : ?>
	<div class="module menu-module">
		<?php ob_page_numbers(); ?>
	</div>
	<?php endif; ?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>