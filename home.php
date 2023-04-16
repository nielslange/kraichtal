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
						setlocale( LC_TIME, 'de_DE' );
						$id      = get_the_ID();
						$class   = implode( ' ', get_post_class() );
						$date    = datefmt_format(
							datefmt_create(
								'de-DE',
								IntlDateFormatter::LONG,
								IntlDateFormatter::NONE,
								'Europe/Berlin',
								IntlDateFormatter::GREGORIAN
							),
							strtotime( get_the_date( '', $id ) )
						);
						$title   = get_the_title( $id );
						$link    = get_the_permalink( $id );
						$excerpt = get_the_excerpt( $id );

						printf(
							'<article class="%1$s" id="post-%2$s">
								<p class="entry-meta">%3$s</p>
								<h2 class="entry-title"><a href="%4$s">%5$s</a></h2>
								%6$s
								<p><a href="%4$s">Weiterlesen</a></p>
							</article>',
							$class,
							$id,
							$date,
							$link,
							$title,
							$excerpt
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
