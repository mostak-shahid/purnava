<?php
// hook into the init action and call mosacademy_taxonomies when it fires
add_action( 'init', 'purnava_taxonomies_init', 0 );

// create two taxonomies, categories and tags for the post type "book"
function purnava_taxonomies_init() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Event Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Event Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Event Categories', 'textdomain' ),
		'all_items'         => __( 'All Event Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Event Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Event Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Event Category', 'textdomain' ),
		'update_item'       => __( 'Update Event Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Event Category', 'textdomain' ),
		'new_item_name'     => __( 'New Event Category Name', 'textdomain' ),
		'menu_name'         => __( 'Event Categories', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'event-category' ),
	);

	register_taxonomy( 'event-category', array( 'event' ), $args );

	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Event Tags', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Event Tag', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Event Tags', 'textdomain' ),
		'popular_items'              => __( 'Popular Event Tags', 'textdomain' ),
		'all_items'                  => __( 'All Event Tags', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Event Tag', 'textdomain' ),
		'update_item'                => __( 'Update Event Tag', 'textdomain' ),
		'add_new_item'               => __( 'Add New Event Tag', 'textdomain' ),
		'new_item_name'              => __( 'New Event Tag Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate tags with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove tags', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used tags', 'textdomain' ),
		'not_found'                  => __( 'No tags found.', 'textdomain' ),
		'menu_name'                  => __( 'Event Tags', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'event-tag' ),
	);

	register_taxonomy( 'event-tag', 'event', $args );
}