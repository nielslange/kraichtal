<?php

//* Register Custom Post Type
add_action( 'init', 'nl_register_cpt', 0 );
function nl_register_cpt() {
	$labels = array(
		'name'          => 'Kochkurse',
		'singular_name' => 'Kochkurs',
	);
	$args   = array(
		'label'               => 'Kochkurs',
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail' ),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 3,
		'menu_icon'           => 'dashicons-food',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'kochkurs', $args );
}

add_theme_support( 'post-thumbnails', array( 'kochkurs' ) );

add_filter( 'body_class', 'custom_class' );
function custom_class( $classes ) {
	if ( is_page_template( 'page-courses.php' ) ) {
		$classes[] = 'courses';

		if ( in_array( 'page', $classes, true ) ) {
			unset( $classes[ array_search( 'page', $classes, true ) ] );
		}
	}
	if ( is_page_template( 'page-gallery.php' ) ) {
		$classes[] = 'gallery';
	}
	return $classes;
}

/**
 * Add custom colum headers to CPT Veranstaltungen
 *
 *  @package WordPress
 *  @subpackage BeTheme Child
 *  @since BeTheme Child 1.0
 */
add_filter( 'manage_kochkurs_posts_columns', 'nl_manage_kochkurs_posts_columns' );
function nl_manage_kochkurs_posts_columns( $columns ) {
	unset( $columns['date'] );
	$new_columns = array(
		'event_available' => __( 'Status', 'kraichtal' ),
		'event_date'      => __( 'Date', 'kraichtal' ),
		'event_time'      => __( 'Time', 'kraichtal' ),
		'event_price'     => __( 'Costs', 'kraichtal' ),
		'date'            => __( 'Date', 'kraichtal' ),
	);
	return array_merge( $columns, $new_columns );
}

/**
 * Add custom colum entries to CPT Veranstaltungen
 *
 *  @package WordPress
 *  @subpackage BeTheme Child
 *  @since BeTheme Child 1.0
 */
add_action( 'manage_kochkurs_posts_custom_column', 'nl_manage_kochkurs_posts_custom_column', 10, 2 );
function nl_manage_kochkurs_posts_custom_column( $column, $post_id ) {
	switch ( $column ) {
		case 'event_available':
			echo get_post_meta( $post_id, 'event_available', true ) ? '<span class="alert alert-success">Buchbar</span>' : '<span class="alert alert-danger">Ausgebucht</span>';
			break;
		case 'event_date':
			echo datefmt_format(
				datefmt_create(
					'de-DE',
					IntlDateFormatter::FULL,
					IntlDateFormatter::NONE,
					'Europe/Berlin',
					IntlDateFormatter::GREGORIAN
				),
				strtotime( get_post_meta( $post_id, 'event_date', true ) )
			);
			break;
		case 'event_time':
			echo wp_date( 'H:i', strtotime( get_post_meta( $post_id, 'event_time', true ) ) ) . ' Uhr';
			break;
		case 'event_price':
			echo 'EUR ' . number_format( get_post_meta( $post_id, 'event_price', true ), 2, ',', '.' );
			break;
	}
}

add_action( 'admin_head', 'my_custom_fonts' );
function my_custom_fonts() {
	echo '<style>
		.alert {
			border: 1px solid;
			padding: 5px 10px;
			border-radius: 5px;
			margin: 2px auto;
			display: inline-block;
		}
		.alert-success {
			color: #155724;
			background-color: #d4edda;
			border-color: 1px solid #c3e6cb;
		}

		.alert-danger {
			color: #721c24;
			background-color: #f8d7da;
			border-color: 1px solid #f5c6cb;
		}
  </style>';
}

add_filter( 'manage_edit-kochkurs_sortable_columns', 'nl_manage_edit_kochkurs_sortable_columns' );
function nl_manage_edit_kochkurs_sortable_columns( $columns ) {
	$columns['event_date'] = 'event_date';
	return $columns;
}

/**
 * Handle custom order of custom colums of CPT Veranstaltungen
 *
 * @package WordPress
 * @subpackage BeTheme Child
 * @since BeTheme Child 1.0
 */
add_action( 'pre_get_posts', 'nl_kochkurs_orderby' );
function nl_kochkurs_orderby( $query ) {
	if ( ! is_admin() ) {
		return;
	}

	$orderby = $query->get( 'orderby' );
	switch ( $orderby ) {
		case 'event_date':
			$query->set( 'meta_key', 'event_date' );
			$query->set( 'orderby', 'meta_value' );
			break;
		default:
			break;
	}
}

/**
 * Handle default order of custom colums of CPT Veranstaltungen
 *
 * @package WordPress
 * @subpackage BeTheme Child
 * @since BeTheme Child 1.0
 */
add_action( 'pre_get_posts', 'nl_kochkurs_default_order', 9 );
function nl_kochkurs_default_order( $query ) {
	if ( 'kochkurs' === $query->get( 'post_type' ) ) {
		if ( '' === $query->get( 'orderby' ) ) {
			$query->set( 'orderby', 'event_date' );
		}
		if ( '' === $query->get( 'order' ) ) {
			$query->set( 'order', 'desc' );
		}
	}
}

