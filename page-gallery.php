<?php
/**
 * Gallery template for the Kraichtal WordPress theme.
 *
 * Template Name: Gallery Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#common-wordpress-template-files
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package WordPress
 * @subpackage Kraichtal
 * @since 1.0.0
 */

get_header(); ?>

<main id="site-content">

	GALLERIE

	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
		} // end while
	} // end if
	?>

</main><!-- #site-content -->

<?php
get_footer();
