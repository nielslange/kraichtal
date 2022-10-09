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

if ( ! class_exists( 'ACF' ) ) {
	return;
}

get_header();
?>

<main id='site-content'>
<?php
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		if ( have_rows( 'sections' ) ) {
			while ( have_rows( 'sections' ) ) {
				the_row();
				$text  = get_sub_field( 'text' );
				$image = get_sub_field( 'image' );
				?>
				<div class="section">
					<div class="text"><?php echo $text; ?></div>
					<div class="image" style="background-image:url(<?php echo $image; ?>);"></div>
				</div>
				<?php
				print( '' );
			}
		}
	}
}
?>
</main><!-- #site-content -->

<?php
get_footer();
