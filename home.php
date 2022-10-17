<?php
/**
 * Home template for the Kraichtal WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#common-wordpress-template-files
 *
 * @package WordPress
 * @subpackage Kraichtal
 * @since 1.0.0
 */

// Bail out if ACF is not active.
class_exists( 'ACF' ) || die( 'ACF not found!' );

get_header();

// Get the posts page ID.
$posts_page = get_option( 'page_for_posts' );

?>

<main id="site-content">

	<div id="page">

		<?php
		printf(
			'<div id="title" style="background-image: url(%s)">
				<h1>%s</h1>
			</div>',
			get_the_post_thumbnail_url( $posts_page ),
			get_the_title( $posts_page )
		);
		?>

		<div id="content">

			<div id="inner-content">

			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					$id    = get_the_ID();
					$date  = get_the_date( '', $id );
					$title = get_the_title( $id );
					$link  = get_the_permalink( $id );

					printf(
						'<article class="%s" id="post-%i">
							<p>%s</p>
							<h2>%s</h2>
							%s
							<p><a href="%s">Weiterlesen</a></p>
						</article>',
						implode( ' ', get_post_class() ),
						$id,
						$date,
						$title,
						get_the_excerpt(),
						$link
					);

				} // end while

				printf(
					'<div id="posts_link">
						<div id="previous_posts_link">%s</div>
						<div id="next_posts_link">%s</div>
					</div>',
					get_previous_posts_link( '&laquo; Vorherige Seite' ),
					get_next_posts_link( 'Nächste Seite &raquo;', '' )
				);

			} // end if
			?>

			</div><!-- #inner-content -->

		</div><!-- #content -->

	</div><!-- #page -->

</main><!-- #site-content -->

<?php
get_footer();
