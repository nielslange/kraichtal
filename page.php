<?php
/**
 * Page template for the Kraichtal WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#common-wordpress-template-files
 *
 * @package WordPress
 * @subpackage Kraichtal
 * @since 1.0.0
 */

get_header(); ?>

<main id="site-content">

	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
			<div id="page">
				<div id="title" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
					<?php the_title( '<h1>', '</h1>' ); ?>
				</div>
				<div id="content">
					<div id="inner-content">
						<?php the_content(); ?>
						CONTENT
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
