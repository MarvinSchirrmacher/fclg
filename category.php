<?php get_header(); ?>

<section id="content" class="grid-3-4 group" role="main">

	<?php if(function_exists('ob_page_numbers')) : ?>
	<div class="module menu-module">
		<?php ob_page_numbers(); ?>
	</div>
	<?php endif; ?>

	<div class="module sitemap">
		<header class="sitemap-header">
			<h1 class="sitemap-header-title"><?php //_e('Category', 'fconline'); ?><?php single_cat_title(); ?></h1>
		</header>
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

	<?php if(function_exists('ob_page_numbers')) : ?>
	<div class="module menu-module">
		<?php ob_page_numbers(); ?>
	</div>
	<?php endif; ?>

	<div class="module menu-module widget widget_categories">
		<ul>
			<?php wp_list_categories( array(
				'hierarchical' => false,
				'title_li' => null
			) ) ; ?>
		</ul>
	</div>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>