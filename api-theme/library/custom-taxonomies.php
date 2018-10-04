<?php

//-------------------------------------------------------------------
// CUSTOM TAXONOMIES
//-------------------------------------------------------------------

// Type taxonomy
add_action( 'init', 'type_taxonomy', 30 );
  function type_taxonomy() {
  $labels = array(
    'name'                  => _x( 'Page Type', 'taxonomy general name' ),
    'singular_name'         => _x( 'Page Type', 'taxonomy singular name' ),
    'search_items'          => __( 'Search Page Types' ),
    'all_items'             => __( 'All Page Types' ),
    'parent_item'           => __( 'Parent Page Type' ),
    'parent_item_colon'     => __( 'Parent Page Type:' ),
    'edit_item'             => __( 'Edit Page Types' ),
    'update_item'           => __( 'Update Page Type' ),
    'add_new_item'          => __( 'Add New Page Type' ),
    'new_item_name'         => __( 'New Page Types Name' ),
    'menu_name'             => __( 'Page Type' ),
  );
  $args = array(
    'hierarchical'          => true,
    'labels'                => $labels,
    'show_ui'               => true,
    'show_admin_column'     => true,
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'type' ),
    'show_in_rest'          => true,
    'rest_base'             => 'type-taxonomy-api',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
  );
  register_taxonomy( 'type', array( 'custom' ), $args );
}

//-------------------------------------------------------------------
// CUSTOM TAXONOMY FILTER DROPDOWNS IN ADMIN
//-------------------------------------------------------------------

function tsm_filter_post_type_by_taxonomy($post_type, $taxonomy) {
	global $typenow;
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => __("All {$info_taxonomy->label}"),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}

function filter_type() {
  tsm_filter_post_type_by_taxonomy('custom', 'type');
}

add_action('restrict_manage_posts', 'filter_custom_type');

// NEXT
function tsm_convert_id_to_term_in_query_type($query) {
	global $pagenow;
	$post_type = 'custom';
	$taxonomy  = 'type';
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}

add_filter('parse_query', 'tsm_convert_id_to_term_in_query_type');

?>