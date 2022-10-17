<?php

/**
 * Courses template for the Kraichtal WordPress theme.
 *
 * Template Name: Courses template
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#common-wordpress-template-files
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
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
				printf(
					'<div id="title" style="background-image: url(%s)">
						<h1>%s</h1>
						<div>%s</div>
					</div>',
					get_the_post_thumbnail_url(),
					get_the_title(),
					get_the_content()
				);
				?>

				<div id="content">

					<div id="inner-content">

						<?php
						$meta_query = array(
							array(
								'key'     => 'event_date',
								'value'   => wp_date( 'Ymd' ),
								'type'    => 'DATE',
								'compare' => '>=',
							),
						);
						$args       = array(
							'post_type'      => 'kochkurs',
							'posts_per_page' => -1,
							'orderby'        => 'meta_value_num',
							'order'          => 'ASC',
							'meta_query'     => $meta_query,
						);
						$query      = new WP_Query( $args );
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								// setlocale( LC_TIME, 'de_DE.utf8' );
								setlocale( LC_TIME, 'de_DE' );
								$id        = get_the_ID();
								$status    = get_post_meta( $id, 'event_available', true );
								$img_class = $status ? null : 'course-sold-out';
								$badge     = $status ? null : '<span class="sold-out">Ausgebucht</span>';
								$permalink = get_the_permalink( $id );
								$title     = get_the_title( $id );
								$teaser    = get_field( 'event_teaser' );
								$date      = strftime( '%A, %d.%m.%Y', strtotime( get_post_meta( $id, 'event_date', true ) ) );
								$time      = substr( get_post_meta( $id, 'event_time', true ), 0, 5 );
								$price     = 'EUR ' . number_format( get_post_meta( $id, 'event_price', true ), 2, ',', '.' );
								$image     = has_post_thumbnail( $id ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large', false ) : array( 0 => get_stylesheet_directory_uri() . '/images/logo-stephanie-haller-augenschmaus-und-gaumenfreuden-quer.png' );

								printf(
									'<div class="course">
                                    <a href="%1$s" class="image %9$s" style="display:block; min-height: 300px; background:url(%2$s); background-size:cover; background-position:center;"></a>
                                    %3$s
                                    <h3>%4$s &bull; %5$s Uhr &bull; %6$s</h3>
                                    <h2>%7$s</h2>
                                    <p class="teaser">%8$s</p>
                                    <p class="read-more"><a href="%1$s"><strong>Weiterlesen</strong></a></p>
                                </div>',
									$permalink,
									$image[0],
									$badge,
									$date,
									$time,
									$price,
									$title,
									$teaser,
									$img_class
								);
							}
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
