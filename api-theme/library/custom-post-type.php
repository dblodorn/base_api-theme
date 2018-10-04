<?php

add_action( 'after_switch_theme', 'fs_flush_rewrite_rules' );

function fs_flush_rewrite_rules() {
	flush_rewrite_rules();
}

//-------------------------------------------------------------------
// CUSTOM POST TYPE
//-------------------------------------------------------------------

add_action( 'init', 'custom_cpt' );

function custom_cpt() {
  $labels = array(
    'name'               => _x( 'Custom Post Type', 'post type general name', 'your-plugin-textdomain' ),
    'singular_name'      => _x( 'Custom Post Type', 'post type singular name', 'your-plugin-textdomain' ),
    'menu_name'          => _x( 'Custom Post Type', 'admin menu', 'your-plugin-textdomain' ),
    'name_admin_bar'     => _x( 'Custom Post Type', 'add new on admin bar', 'your-plugin-textdomain' ),
    'add_new'            => _x( 'Add New', 'Custom Post Type', 'your-plugin-textdomain' ),
    'add_new_item'       => __( 'Add New Custom Post Type', 'your-plugin-textdomain' ),
    'new_item'           => __( 'New Custom Post Types', 'your-plugin-textdomain' ),
    'edit_item'          => __( 'Edit Custom Post Types', 'your-plugin-textdomain' ),
    'view_item'          => __( 'View Custom Post Types', 'your-plugin-textdomain' ),
    'all_items'          => __( 'All Custom Post Types', 'your-plugin-textdomain' ),
    'search_items'       => __( 'Search Custom Post Types', 'your-plugin-textdomain' ),
    'parent_item_colon'  => __( 'Parent Custom Post Type:', 'your-plugin-textdomain' ),
    'not_found'          => __( 'No Custom Post Type found.', 'your-plugin-textdomain' ),
    'not_found_in_trash' => __( 'No Custom Post Type found in Trash.', 'your-plugin-textdomain' )
  );
  $args = array(
    'labels'             => $labels,
    'description'        => __( 'Description.', 'your-plugin-textdomain' ),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'custom' ),
    'capability_type'    => 'post',
    'taxonomies'         => array('type'),
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'          => 'dashicons-layout',
    'show_in_rest'       => true,
    'rest_base'          => 'custom-post-type-api',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'supports'           => array( 'title', 'editor', 'author' )
  );
  register_post_type( 'custom', $args );
}

?>
