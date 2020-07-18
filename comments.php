<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Travel_Blog
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return; 
?>

<div id="comments" class="comments-area">
	<div class="post-full__comments comments">
		<?php
		comment_form([
			'fields' => [
				'author' => "<p class='comment-form-author'>
											<label for='author'>" . __('Name') . '</label> ' . ($req ? '<span class="required">*</span>' : '') .
											"<input id='author' name='author' type='text' value='" . esc_attr($commenter['comment_author']) . "' size='30' />
										</p>",

				'email'  => '<p class="comment-form-email">
											<label for="email">' . __('Email') . '</label> ' . ($req ? '<span class="required">*</span>' : '') .
											"<input id='email' name='email' type='text' value='".esc_attr($commenter['comment_author_email'])."' size='30' />
										</p>",

				'url'    => '<p class="comment-form-url">
											<label for="url">' . __( 'Website' ) . '</label>' .
											"<input id='url' name='url' type='text' value='" . esc_attr( $commenter['comment_author_url'] ) . "' size='30'/>
										</p>"
			],

			'comment_field' => '
				<label for="reply">Comment</label>
				<textarea id="comment" name="comment" cols="30" rows="8" aria-required="true"></textarea>
			',

			'submit_button' => '
				<button type="submit" class="action-button">Post the comment</button>
			',

			'class_form'    => 'comments reply-form'
		]);
		?>
	</div>

	<?php if ( have_comments() ): ?>
		<h2 class="comments-title">
			<?php
			$travel_blog_comment_count = get_comments_number();
			if ( '1' === $travel_blog_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'travel-blog' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $travel_blog_comment_count, 'comments title', 'travel-blog' ) ),
					number_format_i18n( $travel_blog_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>
		
		<ul class="comments__list" data-depth="0">
			<?php 
			$postComments = get_comments([
				'post_id'      => $post->ID,
				'status'       => 'approve',
				'hierarchical' => false
			]);

			foreach ($postComments as $comment) {
				if ($comment->comment_parent == 0)
					echo apply_filters('travel_blog_nested_comments', $comment, $post);
			}
			?>
		</ul>

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'travel-blog' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().
	?>
</div><!-- #comments -->

<!-- 
	<button class="comment-item__reply">Reply</button>

	<div class="reply-container">
		<form action="" method="post" class="comments reply-form">
			<label for="name">Full name</label>
			<input type="text" id="name" name="name">
			<label for="email">Email <small>(it won't be displayed)</small></label>
			<input type="text" id="email" name="email">
			<label for="reply">Comment</label>
			<textarea name="reply" id="reply" cols="30" rows="7"></textarea>
			<button type="submit" class="action-button">Post the comment</button>
		</form>
	</div>
 -->