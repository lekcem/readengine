<?php
/**
 * The comment display template
 *
 * @package Pixel Ebook Store
 */

/*
 * If the current post requires a password to access, and
 * The user is still missing the password, so we will
 * without loading the comments, return early.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$pixel_ebook_store_comment_count = get_comments_number();
			if ( '1' === $pixel_ebook_store_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'pixel-ebook-store' ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $pixel_ebook_store_comment_count, 'comments title', 'pixel-ebook-store' ) ),
					number_format_i18n( $pixel_ebook_store_comment_count ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
			) );
			?>
		</ol>

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'pixel-ebook-store' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form();
	?>

</div>