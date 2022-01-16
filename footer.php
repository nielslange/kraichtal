<?php
/**
 * Footer file for the Kraichtal WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Kraichtal
 * @since 1.0.0
 */

?>

<footer id="site-footer">
    <div class="wrap">
		© <?php echo( wp_date( 'Y' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		Stephanie Haller •
		Alle Rechte vorbehalten •

		<?php
		if ( has_nav_menu( 'footer' ) ) {
			$args = array(
				'theme_location' => 'footer',
				'container'      => false,
				'depth'          => 1,
			);
			wp_nav_menu( $args );
		}
		?>

		Entwickelt mit <abbr title="December 5, 2021 • Jakarta, Indonesia">♥</abbr> by <a href="https://nielslange.com/" target="_blank" title="Niels Lange | WordPress Developer"><strong>Niels Lange</strong></a>
	</div>
</footer><!-- #site-footer -->

<?php wp_footer(); ?>

</body>
</html>
