<?php
  function get_project_list($field, $p) {
    $posts = get_field($field, $p->ID);
    if($posts):
      $data = array();
      foreach( $posts as $p ):
        $p_data = get_post($p->ID);
        $p_type = $p_data->post_type;
        $data[] = array(
          'post_id' => $p_data->ID,
          'slug' => $p_data->post_name,
          'title' => get_the_title($p_data),
          'thumbnail' => get_the_post_thumbnail_url($p->ID),
          'post_type' => $p_data->post_type,
        );
      endforeach;
    endif;
    return $data;
  }
  
  function post_collection_template($p){
    $post_collection = get_field('post_collection', $p->ID);
    return array(
      'id' => $p->ID,
      'short_description' => get_field('short_description', $p->ID),
      'description' => get_field('description', $p->ID),
      'post_collection' => get_project_list('post_collection', $p)
    );
  }
?>
