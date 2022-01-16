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

	$data .= sprintf( 'Entwickelt mit <abbr title="December 5, 2021 • Jakarta, Indonesia">♥</abbr> by <a href="https://nielslange.com/" target="_blank" title="Niels Lange | WordPress Developer"><strong>Niels Lange</strong></a>' );

	return $data;
}
