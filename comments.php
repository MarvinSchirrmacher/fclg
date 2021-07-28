<div id="comments" class="comments-area box" data-heading="<?php _e( 'Comments', 'fconline'); ?>">

	<?php if ( have_comments() ) : ?>
	<ol class="comment-list">
		<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 64,
			) );
		?>
	</ol><!-- .comment-list -->
	<?php endif; ?>

	<?php comment_form( array(
		'fields' => array(
			'author' => '<p class="comment-form-author"><input placeholder="' . __( 'Name', 'domainreference' ) . ( $req ? '*' : '' ) . '" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
			'email' => '<p class="comment-form-email"><input placeholder="' . __( 'Email', 'domainreference' ) . ( $req ? '*' : '' ) . '" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
			'url' => '' // '<p class="comment-form-url"><input placeholder="' . __( 'Website', 'domainreference' ) . '" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'
		),
		'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'comment_notes_before' => false,
		'comment_notes_after' => false
	) ); ?>

</div>