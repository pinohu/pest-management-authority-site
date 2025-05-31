<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Authority_Blueprint
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if (have_comments()) :
		?>
		<h2 class="comments-title">
			<?php
			$authority_blueprint_comment_count = get_comments_number();
			if ('1' === $authority_blueprint_comment_count) {
				printf(
					/* translators: 1: title. */
					esc_html__('One thought on &ldquo;%1$s&rdquo;', 'authority-blueprint'),
					'<span>' . wp_kses_post(get_the_title()) . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $authority_blueprint_comment_count, 'comments title', 'authority-blueprint')),
					number_format_i18n($authority_blueprint_comment_count),
					'<span>' . wp_kses_post(get_the_title()) . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(array(
				'style'      => 'ol',
				'short_ping' => true,
				'callback'   => 'authority_blueprint_comment',
			));
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if (!comments_open()) :
			?>
			<p class="no-comments"><?php esc_html_e('Comments are closed.', 'authority-blueprint'); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form(array(
		'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
		'title_reply_after'  => '</h3>',
		'class_form'         => 'comment-form card',
		'class_submit'       => 'submit btn-primary',
		'comment_field'      => '<div class="comment-form-comment"><label for="comment">' . _x('Comment', 'noun', 'authority-blueprint') . ' <span class="required">*</span></label> <textarea id="comment" name="comment" cols="45" rows="6" maxlength="65525" required="required" class="form-textarea"></textarea></div>',
		'fields'             => array(
			'author' => '<div class="comment-form-author"><label for="author">' . __('Name', 'authority-blueprint') . ' <span class="required">*</span></label> <input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245" autocomplete="name" required="required" class="form-input" /></div>',
			'email'  => '<div class="comment-form-email"><label for="email">' . __('Email', 'authority-blueprint') . ' <span class="required">*</span></label> <input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes" autocomplete="email" required="required" class="form-input" /></div>',
			'url'    => '<div class="comment-form-url"><label for="url">' . __('Website', 'authority-blueprint') . '</label> <input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" maxlength="200" autocomplete="url" class="form-input" /></div>',
		),
	));
	?>

</div><!-- #comments --> 