<?php
/**
 * Custom template tags for the Kraichtal WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-tags/
 *
 * @package WordPress
 * @subpackage Kraichtal
 * @since 1.0.0
 */

/**
 * Returns the formated date.
 *
 * @param string $date The date to format.
 * @return string The formated date.
 */
function get_formated_date( $date ) {
	$formatter = new IntlDateFormatter(
		'de_DE',
		IntlDateFormatter::NONE,
		IntlDateFormatter::NONE,
		'Europe/Berlin',
		IntlDateFormatter::GREGORIAN,
		'EEEE, d. MMM y'
	);

	return $formatter->format( new DateTime( $date ) );
}

/**
 * Returns the cover image including title, and subtitle, if provided.
 *
 * @param string $image The image URL.
 * @param string $title The title.
 * @param string $subtitle The subtitle.
 * @return string The cover image.
 */
function print_cover_image( $image, $title, $subtitle = '' ) {
	$subtitle_html = '';

	if ( ! empty( $subtitle ) ) {
		$subtitle_html = sprintf( '<div>%s</div>', $subtitle );
	}

	printf(
		'<div id="title" style="background-image: url(%s)">
			<h1>%s</h1>
			%s
		</div>',
		$image,
		$title,
		$subtitle_html
	);
}

/**
 * Returns the copyright.
 *
 * @return string The copyright.
*/
function print_copyright() {

	$data = sprintf( '© %s Stephanie Haller • Alle Rechte vorbehalten • ', wp_date( 'Y' ) );

	if ( has_nav_menu( 'footer' ) ) {
		$args  = array(
			'theme_location' => 'footer',
			'container'      => false,
			'depth'          => 1,
			'echo'           => false,
		);
		$data .= wp_nav_menu( $args );
	}

	$data .= sprintf( 'Entwickelt mit <abbr title="December 5, 2021 • Jakarta, Indonesia">♥</abbr> von <a href="https://nielslange.de/" target="_blank" title="Niels Lange | WordPress Developer"><strong>Niels Lange</strong></a>' );

	print( $data );
}

/**
 * Returns the single course.
 *
 * @param int $id The post ID of the course.
 * @return string The single course.
 */
function print_single_course( $post_id ) {
	setlocale( LC_TIME, 'de_DE' );
	$status        = get_post_meta( $post_id, 'event_available', true );
	$img_class     = $status ? null : 'course-sold-out';
	$badge         = $status ? null : '<span class="sold-out">Ausgebucht</span>';
	$course_status = $status ? 'course-available' : 'course-sold-out';
	$permalink     = get_the_permalink( $post_id );
	$title         = sprintf( '<a href="%1$s"><span class="title"><h2>%2$s</h2></span></a>', $permalink, get_the_title( $post_id ) );
	$date          = get_formated_date( get_post_meta( $post_id, 'event_date', true ) );
	$time          = substr( get_post_meta( $post_id, 'event_time', true ), 0, 5 );
	$price         = 'EUR ' . number_format( get_post_meta( $post_id, 'event_price', true ), 2, ',', '.' );
	$image         = has_post_thumbnail( $post_id ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'large', false ) : array( 0 => get_stylesheet_directory_uri() . '/images/logo-stephanie-haller-augenschmaus-und-gaumenfreuden-quer.png' );

	printf(
		'<div class="course %9$s">
			<a href="%1$s" class="image %8$s" style="display:block; min-height: 300px; background:url(%2$s); background-size:cover; background-position:center;"></a>
			%7$s
			%3$s
			<h3>%4$s <br> %5$s Uhr &bull; %6$s</h3>
		</div>',
		$permalink,
		$image[0],
		$badge,
		$date,
		$time,
		$price,
		$title,
		$img_class,
		$course_status
	);
}
