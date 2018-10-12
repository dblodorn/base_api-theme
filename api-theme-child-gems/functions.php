<?php 
  /*-----------------------------------------------------------------------------------*/
  /* ADD POST TYPES
  /*-----------------------------------------------------------------------------------*/
  
  add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
  function my_theme_enqueue_styles() {
      wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  }

  //-------------------------------------------------------------------
  // CUSTOM POST TYPE: REGISTER
  //-------------------------------------------------------------------

  function portfolio() {
    register_post_type( 'portfolio',
    array(
      'labels' => array (
        'name' => 'portfolio',
        'singular_name' => 'portfolio',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New portfolio',
        'edit' => 'Edit',
        'edit_item' => 'Edit portfolio',
        'new_item' => 'New portfolio',
        'view' => 'View',
        'view_item' => 'View portfolio',
        'search_items' => 'Search portfolio',
        'not_found' => 'No portfolio found',
        'not_found_in_trash' => 'No portfolio found in Trash',
        'parent' => 'Parent portfolio'
      ),
      'public' => true,
      'menu_position' => 15,
      'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
      'taxonomies' => array( '' ),
      'menu_icon' => 'P',
      'has_archive' => true
      )
    );
  }
  add_action( 'init', 'portfolio' );

  //-------------------------------------------------------------------
  // CUSTOM POST TYPES: REMOVE
  //-------------------------------------------------------------------

  function remove_project() {
    remove_action('init', 'project');
  }

  function remove_instagram_post() {
    remove_action('init', 'instagram_post');
  }

  add_action( 'after_setup_theme','remove_project', 100 );
  add_action( 'after_setup_theme','remove_instagram_post', 100 );
  
?>