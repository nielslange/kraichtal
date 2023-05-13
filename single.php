<?php
/**
 * Single post template for the Kraichtal WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#common-wordpress-template-files
 *
 * @package WordPress
 * @subpackage Kraichtal
 * @since 1.0.0
 */

get_header();

?>

<main id="site-content">

	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
			<div id="page">
				<div id="title" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
					<?php the_title( '<h1>', '</h1>' ); ?>
				</div>
				<div id="content">
					<div id="inner-content">
						<?php the_content(); ?>
						<?php
						$comment_send      = __( 'Absenden', 'kraichtal' );
						$comment_reply     = __( 'Schreibe einen Kommentar', 'kraichtal' );
						$comment_reply_to  = __( 'Reply', 'kraichtal' );
						$comment_author    = __( 'Name', 'kraichtal' );
						$comment_email     = __( 'Email', 'kraichtal' );
						$comment_body      = __( 'Nachricht', 'kraichtal' );
						$comment_cookies_1 = __( 'Datenschutz *', 'kraichtal' );
						$comment_cookies_2 = __( 'Privacy Policy', 'kraichtal' );
						$comment_before    = __( 'Deine E-Mail-Adresse wird nicht veröffentlicht. Erforderliche Felder sind mit * markiert', 'kraichtal' );
						$comment_cancel    = __( 'Abbrechen', 'kraichtal' );
						$comment_submit    = __( 'Absenden', 'kraichtal' );

						$comments_args = array(
							'fields'               => array(
								'author'  => '<p class="comment-form-author"><br /><input id="author" name="author" aria-required="true" placeholder="' . $comment_author . '"></input></p>',
								'email'   => '<p class="comment-form-email"><br /><input id="email" name="email" placeholder="' . $comment_email . '"></input></p>',
								'cookies' => '<input type="checkbox" required>' . $comment_cookies_1 . '<a href="' . get_privacy_policy_url() . '">' . $comment_cookies_2 . '</a>',
							),
							'label_submit'         => $comment_send,
							'title_reply'          => $comment_reply,
							'title_reply_to'       => $comment_reply_to,
							'cancel_reply_link'    => $comment_cancel,
							'comment_field'        => '<p class="comment-form-comment"><br /><textarea id="comment" name="comment" aria-required="true" placeholder="' . $comment_body . '"></textarea></p>',
							'comment_notes_before' => $comment_before,
							'logged_in_as'         => comment_before,
							'comment_notes_after'  => '',
							'id_submit'            => $comment_submit,
						);
						comment_form( $comments_args );
						?>
					</div><!-- #inner-content -->
				</div><!-- #content -->
			</div><!-- #page -->
			<?php
		} // end while
	} // end if
	?>

</main><!-- #site-content -->

<?php
get_footer();
