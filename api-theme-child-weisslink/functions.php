<?php 
  /*-----------------------------------------------------------------------------------*/
  /* ADD POST TYPES
  /*-----------------------------------------------------------------------------------*/
  
  add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
  function my_theme_enqueue_styles() {
      wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  }
  //-------------------------------------------------------------------
  // CUSTOM POST TYPES: REMOVE
  //-------------------------------------------------------------------

  function remove_instagram_post() {
    remove_action('init', 'instagram_post');
  }

  add_action( 'after_setup_theme','remove_instagram_post', 1000 );
  
?>