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

$image    = get_the_post_thumbnail_url();
$title    = get_the_title();
$subtitle = get_the_content();
$args     = array(
	'post_type'      => 'kochkurs',
	'posts_per_page' => -1,
	'orderby'        => 'meta_value_num',
	'order'          => 'ASC',
	'meta_query'     => array(
		array(
			'key'     => 'event_date',
			'value'   => wp_date( 'Ymd' ),
			'type'    => 'DATE',
			'compare' => '>=',
		),
	),
);

get_header();
?>

<main id="site-content">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
			<div id="page">
				<?php print_cover_image( $image, $title, $subtitle ); ?>
				<div id="content">
					<?php
					$query = new WP_Query( $args );
					if ( $query->have_posts() ) {
						print( '<div id="inner-content">' );
						while ( $query->have_posts() ) {
							$query->the_post();
							print_single_course( get_the_ID() );
						}
						print( '</div><!-- #inner-content -->' );
					} else {
						print( '<p class="no-course">Es sind derzeit keine Kochkurse geplant.</p>' );
					}
					?>
				</div><!-- #content -->
			</div><!-- #page -->
			<?php
		} // end while
	} // end if
	?>
</main><!-- #site-content -->

<?php
get_footer();
