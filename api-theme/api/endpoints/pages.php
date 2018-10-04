<?php
  // MODULE FOR WORDPRESS PAGES
  function page_data(){
    $pages = get_pages();
    $post_array = array();
    foreach ($pages as $post) {
      $template = get_post_meta( $post->ID, '_wp_page_template', true );
      $template_name = return_template($template);
      $permalink = get_permalink($post->ID);
      $post_array[] = array ( 
        'id' => $post->ID,
        'title' => $post->post_title,
        'slug' => $post->post_name,
        'is_home' => return_home($permalink),
        'template' => $template_name,
        'content' => template_data($template_name, $post),
      );
    }
    return $post_array;
  }
?>