<tr id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<td <?php if ( ! ( get_post_type() == 'post' ) ) : ?>colspan="2"<?php endif; ?> class="sitemap-content">
		<h4 class="sitemap-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
		<div class="sitemap-summary">
			<?php the_excerpt(); ?>
		</div><!-- .post-summary -->
	</td>

	<?php if ( get_post_type() == 'post' ) : ?>
	<td class="sitemap-meta">
		<span class="sitemap-date">
			<time datetime="<?php esc_attr( get_the_date( 'c' ) ); ?>"><?php the_time('j. F Y'); ?></time>
		</span>
		<?php if ( ! is_category() ) : ?>
		<span class="sitemap-category"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'fconline' ) ); ?></span>
		<?php endif; ?>
	</td><!-- .post-meta -->
	<?php endif; ?>

</tr><!-- #post-## -->