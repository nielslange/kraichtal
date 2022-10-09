<?php
/**
 * Header file for the Kraichtal WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Kraichtal
 * @since 1.0.0
 */

?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" >
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php //wp_body_open(); ?>

<header id="site-header">

	<div id="site-header-logo">
		<?php

		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}

		?>
	</div><!-- #site-header-logo -->

	<div id="site-header-menu">

		<button id="menu-primary-toggle"></button><!-- .nav-toggle -->

		<?php
		if ( has_nav_menu( 'primary' ) ) {
			$args = array(
				'theme_location' => 'primary',
				'container'      => 'nav',
				'depth'          => 2,
			);
			wp_nav_menu( $args );
		}
		?>
	</div><!-- #site-header-menu -->

</header><!-- #site-header -->
