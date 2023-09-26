<?php
/**
 * Gallery template for the Kraichtal WordPress theme.
 *
 * Template Name: Gallery template
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

	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			$images = get_field( 'gallery' );
			if ( $images ) :
				?>
				<div class="grid">
					<?php foreach ( $images as $image ) : ?>
						<div class="grid-item">
							<a href="<?php echo esc_url( $image['url'] ); ?>" data-lightbox="roadtrip">
								<img src="<?php echo esc_url( $image['sizes']['medium'] ); ?>" alt="foo-bar-<?php echo esc_attr( $image['name'] ); ?>" />
							</a>
						</div>
					<?php endforeach; ?>
				</div>
				<?php
			endif;
		endwhile;
	endif;
	?>

</main><!-- #site-content -->

<?php
get_footer();
