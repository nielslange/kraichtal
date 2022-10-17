<?php

/**
 * Page template for the Kraichtal WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#common-wordpress-template-files
 *
 * @package WordPress
 * @subpackage Kraichtal
 * @since 1.0.0
 */

// Bail out if ACF is not active.
class_exists( 'ACF' ) || die( 'ACF not found!' );

get_header(); ?>

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
						<?php
						the_post();
						$id              = get_the_ID();
						$event_available = get_field( 'event_available' );
						$event_sub_title = get_field( 'event_sub_title' );
						$event_date      = get_field( 'event_date' );
						$event_time      = get_field( 'event_time' );
						$event_location  = get_field( 'event_location' );
						$event_price     = get_field( 'event_price' );
						$event_teaser    = get_field( 'event_teaser' );
						$event_menu      = get_field( 'event_menu' );

						printf(
							'<article class="%s" id="post-%i">
									<h2>%s</h2>
									<p>%s</p>
									<p>%s</p>
									<p>%s</p>
									<p>%s</p>
									<p>%s</p>
									<p>%s</p>
									<p>%s</p>
								</article>',
							implode( ' ', get_post_class() ),
							$id,
							$event_sub_title,
							$event_date,
							$event_time,
							$event_location,
							$event_price,
							$event_teaser,
							$event_menu,
							get_the_content()
						);
						?>

						Buchungsformular

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
