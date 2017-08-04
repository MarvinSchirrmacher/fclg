<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( ! post_password_required() && has_post_thumbnail() ): ?>

		<?php if ( is_singular() && ! is_page_template( 'page-modules.php' ) ) : ?>
		<div class="post-thumbnail"><?php the_post_thumbnail(); ?></div>
		<?php else : ?>
		<a class="post-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
		<?php endif; ?>

	<?php endif; ?>

	<header class="post-header"></header>

	<div class="post-content">
		<span class="post-meta">
			<span class="post-meta-time">
				<time datetime="<?php esc_attr( get_the_date( 'c' ) ); ?>">
					<?php the_time('j. F G:i'); ?>
				</time>
			</span>
		<?php if ( is_user_logged_in() ) : ?>
			<?php edit_post_link( __( 'Edit', 'fconline' ), '<span class="post-meta-edit">', '</span>' ); ?>
		<?php endif; ?>
		</span>

		<?php
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'fconline' ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'fconline' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div>

</article>