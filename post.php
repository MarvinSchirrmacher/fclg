<?php
$is_singular = (is_singular() and !is_search() and !is_front_page() and !is_page_template('page-modules.php'));
$post_type = get_post_type();
$is_post = $post_type == 'post';
$is_sponsor = $post_type == 'sponsor';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if (!post_password_required() and has_post_thumbnail()): ?>

		<?php if ($is_singular): ?>
		<div class="post-thumbnail">
			<a href="<?php the_post_thumbnail_url(); ?>"><?php the_post_thumbnail(); ?></a>
			<?php if ($is_sponsor) { SponsorManagement::echoCompanyLogo(); } ?>
		</div>
		<?php else: ?>
		<a class="post-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
		<?php endif; ?>

	<?php endif; ?>

	<header class="post-header">

	<?php if (function_exists('the_subtitle')): $subtitle = the_subtitle('', '', false); if (!empty($subtitle)): ?>
		<h6 class="post-subtitle"><?php the_subtitle(); ?></h6>
	<?php endif; endif; ?>

	<?php if ($is_singular) : ?>
		<h1 class="post-title"><?php the_title(); ?></h1>
	<?php else : ?>
		<h1 class="post-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	<?php endif; ?>

	<?php if ($is_post) : ?>
		<div class="post-meta">

			<span class="post-meta-category"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'fconline' ) ); ?></span>
		<?php if ( 'post' == get_post_type() ) : ?>
			<span class="post-meta-date">
				<time datetime="<?php esc_attr( get_the_date( 'c' ) ); ?>"><?php the_time('j. F Y'); ?></time>
			</span>
			<?php if ($is_singular): ?>
				<span class="post-meta-author vcard"><?php the_author(); ?>
					<!-- <a class="url fn n" href="<?php //esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php the_author(); ?></a> -->
				</span>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( is_user_logged_in() ) : ?>
			<?php edit_post_link( __( 'Edit', 'fconline' ), '<span class="post-meta-edit">', '</span>' ); ?>
		<?php endif; ?>
		</div>
	<?php endif; ?>
	</header>

	<?php if ($is_singular): ?>
	<div class="post-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'fconline' ) );
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'fconline' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>'
		) ); ?>
	</div>
	<?php if ($is_sponsor): ?>
	<footer class="post-meta grid">
		<div class="grid-1-1"><hr /></div>
		<div class="grid-1-2">
			<?php SponsorManagement::echoSponsorMeta(); ?>
		</div>
		<div class="grid-1-2">
			<?php SponsorManagement::echoSponsorAdvertisingMedia(); ?>
		</div>
		<div class="grid-1-1">
			<?php SponsorManagement::echoSponsorLocationMap(); ?>
			<?php SponsorManagement::echoSponsorGallery(); ?>
		</div>
	</footer>
	<?php SponsorManagement::echoFooterImage('of-above-average-width'); ?>
	<?php else: ?>
		<?php the_tags('<footer class="post-meta"><div class="tags-list">', '', '</div></footer>'); ?>
	<?php endif; ?>
	<?php else: ?>
	<div class="post-summary">
	<?php
		if (function_exists("the_advanced_excerpt")) {
			the_advanced_excerpt();
		} else {
			the_excerpt();
		}
	?>
	</div>
	<?php endif; ?>
</article>