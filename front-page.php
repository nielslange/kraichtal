<?php
/**
 * Front-page template for the Kraichtal WordPress theme.
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
?>

<main id='site-content'>

<?php

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<div class="section full">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="Logo" class="logo">
			<div class="overlay"></div>
		</div>
		<?php
		if ( have_rows( 'sections' ) ) {
			while ( have_rows( 'sections' ) ) {
				the_row();
				$text  = get_sub_field( 'text' );
				$image = get_sub_field( 'image' );
				?>
				<div class="section">
					<div class="text"><?php echo $text; ?></div>
					<div class="image" style="background-image:url('<?php echo esc_url( $image ); ?>');"></div>
				</div>
				<?php
			}
		}
	}
}
?>

</main><!-- #site-content -->

<?php
get_footer();
