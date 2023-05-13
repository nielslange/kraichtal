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
function get_cover_image( $image, $title, $subtitle = '' ) {
	$subtitle_html = '';

	if ( ! empty( $subtitle ) ) {
		$subtitle_html = sprintf( '<div>%s</div>', $subtitle );
	}

	return sprintf(
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
function get_copyright() {

	$data  = sprintf( '© %s Stephanie Haller • ', wp_date( 'Y' ) );
	$data .= sprintf( ' ' );
	$data .= sprintf( 'Alle Rechte vorbehalten • ' );

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

	return $data;
}
