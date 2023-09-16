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

function render_cover_image() {
	$image    = get_the_post_thumbnail_url();
	$title    = get_the_title();
	$subtitle = get_the_content();
	print( get_cover_image( $image, $title, $subtitle ) );
}

function get_course_query_args() {
	return array(
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
}

function render_single_course() {
	$post_id   = get_the_ID();
	$status    = get_post_meta( $post_id, 'event_available', true );
	$img_class = $status ? null : 'course-sold-out';
	$badge     = $status ? null : '<span class="sold-out">Ausgebucht</span>';
	$permalink = get_the_permalink( $post_id );
	$title     = sprintf( '<a href="%1$s"><span class="title"><h2>%2$s</h2></span></a>', $permalink, get_the_title( $post_id ) );
	$date      = get_formated_date( get_post_meta( $post_id, 'event_date', true ) );
	$time      = substr( get_post_meta( $post_id, 'event_time', true ), 0, 5 );
	$price     = 'EUR ' . number_format( get_post_meta( $post_id, 'event_price', true ), 2, ',', '.' );
	$image     = has_post_thumbnail( $post_id ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'large', false ) : array( 0 => get_stylesheet_directory_uri() . '/images/logo-stephanie-haller-augenschmaus-und-gaumenfreuden-quer.png' );

	printf(
		'<div class="course">
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
		$img_class
	);
}

get_header();
?>

<main id="site-content">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
			<div id="page">
				<?php render_cover_image(); ?>
				<div id="content">
					<?php
					$query = new WP_Query( get_course_query_args() );
					if ( $query->have_posts() ) {
						setlocale( LC_TIME, 'de_DE' );
						print( '<div id="inner-content">' );
						while ( $query->have_posts() ) {
							$query->the_post();
							render_single_course();
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
