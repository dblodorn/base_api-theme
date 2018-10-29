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

  function delete_post_type(){
    unregister_post_type( 'instagram_post' );
    unregister_post_type( 'project' );
  }
  
  add_action('init','delete_post_type', 100);
  
?>