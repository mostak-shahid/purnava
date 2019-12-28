<?php
//Events
add_action( 'init', 'mos_post_type_init' );
function mos_post_type_init() {
	$labels = array(
		'name'               => _x( 'Events', 'post type general name', 'excavator-template' ),
		'singular_name'      => _x( 'Event', 'post type singular name', 'excavator-template' ),
		'menu_name'          => _x( 'Events', 'admin menu', 'excavator-template' ),
		'name_admin_bar'     => _x( 'Event', 'add new on admin bar', 'excavator-template' ),
		'add_new'            => _x( 'Add New', 'event', 'excavator-template' ),
		'add_new_item'       => __( 'Add New Event', 'excavator-template' ),
		'new_item'           => __( 'New Event', 'excavator-template' ),
		'edit_item'          => __( 'Edit Event', 'excavator-template' ),
		'view_item'          => __( 'View Event', 'excavator-template' ),
		'all_items'          => __( 'All Events', 'excavator-template' ),
		'search_items'       => __( 'Search Events', 'excavator-template' ),
		'parent_item_colon'  => __( 'Parent Events:', 'excavator-template' ),
		'not_found'          => __( 'No Events found.', 'excavator-template' ),
		'not_found_in_trash' => __( 'No Events found in Trash.', 'excavator-template' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'excavator-template' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'event' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 7,
		'menu_icon' => 'dashicons-networking',
		'supports'           => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
	);
	register_post_type( 'event', $args );
}
add_action( 'after_switch_theme', 'flush_rewrite_rules' );
