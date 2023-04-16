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
						//Declare Vars
						$comment_send      = 'Absenden';
						$comment_reply     = 'Schreibe einen Kommentar';
						$comment_reply_to  = 'Reply';
						$comment_author    = 'Name';
						$comment_email     = 'Email';
						$comment_body      = 'Nachricht';
						$comment_cookies_1 = 'Datenschutz *';
						$comment_cookies_2 = 'Privacy Policy';
						$comment_before    = 'Deine E-Mail-Adresse wird nicht veröffentlicht. Erforderliche Felder sind mit * markiert';
						$comment_cancel    = 'Abbrechen';

						//Array
						$comments_args = array(
							//Define Fields
							'fields'               => array(
								//Author field
								'author'  => '<p class="comment-form-author"><br /><input id="author" name="author" aria-required="true" placeholder="' . $comment_author . '"></input></p>',
								//Email Field
								'email'   => '<p class="comment-form-email"><br /><input id="email" name="email" placeholder="' . $comment_email . '"></input></p>',
								//Cookies
								'cookies' => '<input type="checkbox" required>' . $comment_cookies_1 . '<a href="' . get_privacy_policy_url() . '">' . $comment_cookies_2 . '</a>',
							),
							// Change the title of send button
							'label_submit'         => __( $comment_send ),
							// Change the title of the reply section
							'title_reply'          => __( $comment_reply ),
							// Change the title of the reply section
							'title_reply_to'       => __( $comment_reply_to ),
							//Cancel Reply Text
							'cancel_reply_link'    => __( $comment_cancel ),
							// Redefine your own textarea (the comment body).
							'comment_field'        => '<p class="comment-form-comment"><br /><textarea id="comment" name="comment" aria-required="true" placeholder="' . $comment_body . '"></textarea></p>',
							//Message Before Comment
							'comment_notes_before' => __( $comment_before ),
							'logged_in_as'         => __( $comment_before ),
							// Remove "Text or HTML to be displayed after the set of comment fields".
							'comment_notes_after'  => '',
							//Submit Button ID
							'id_submit'            => __( 'comment-submit' ),
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
