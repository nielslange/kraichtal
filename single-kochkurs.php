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

				<?php

				$image = get_the_post_thumbnail_url();
				$title = get_the_title();
				print( get_cover_image( $image, $title ) );

				?>

				<div id="content">
					<div id="inner-content">
						<?php
						$id              = get_the_ID();
						$event_available = get_field( 'event_available' );
						$event_sub_title = get_field( 'event_sub_title' );
						$event_date      = get_formated_date( get_post_meta( $id, 'event_date', true ) );
						$event_time      = get_field( 'event_time' );
						$event_location  = get_field( 'event_location' );
						$event_price     = 'EUR ' . number_format( get_post_meta( $id, 'event_price', true ), 2, ',', '.' );

						$event_teaser = get_field( 'event_teaser' );
						$event_menu   = get_field( 'event_menu' );

						printf(
							'<article class="%1$s" id="post-%2$d">
								<h2>%3$s</h2>
								<p><strong>📍 Wo:</strong> %4$s</p>
								<p><strong>🗓️ Wann:</strong> %5$s um %6$s Uhr</p>
								<p><strong>💰 Kosten:</strong> %7$s</p>
								<hr class="wp-block-separator has-alpha-channel-opacity"/>
								<p>%8$s</p>
								<hr class="wp-block-separator has-alpha-channel-opacity"/>
								<h3>Menü / Programm</h3>
								%9$s %10$s
							</article>',
							implode( ' ', get_post_class() ),
							$id,
							$event_sub_title,
							$event_location,
							$event_date,
							$event_time,
							$event_price,
							$event_teaser,
							$event_menu,
							get_the_content()
						);

						if ( $event_available ) {
							print( do_shortcode( '[ninja_form id=3]' ) );
						} else {
							print( '<p class="unavailable">Leider ist dieser Kochkurs bereits ausgebucht. Aber schau doch mal unter <a href="/kochkurse">Kochkurse</a>, vielleicht findest du ja noch einen anderen tollen Kurs!</p>' );
						}

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
