<?php if (is_single()): ?>
<div <?php post_class('post-preview'); ?>>
<?php else : ?>
<a <?php post_class('post-preview'); ?> href="<?php echo esc_url(get_permalink()); ?>">
<?php endif; ?>
	<div class="post-thumbnail">
		<?php the_post_thumbnail( 'medium' ); ?>
	</div>
	<figcaption class="post-meta">
		<span class="post-title"><?php the_title(); ?></span>
		<?php $subtitle = get_the_subtitle(); if (!empty($subtitle)): ?>
		<span class="post-subtitle"><?php echo $subtitle; ?></span>
		<?php endif; ?>
		<?php if ( get_post_type() == 'post' && get_post_format() != 'gallery' ) : ?>
		<span class="post-date">
			<time datetime="<?php esc_attr( get_the_date( 'c' ) ); ?>"><?php the_time('j. F Y'); ?></time>
		</span>
		<?php endif; ?>
	</figcaption>
<?php if (is_single()): ?>
</div>
<?php else : ?>
</a>
<?php endif; ?>