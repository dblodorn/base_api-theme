<?php
  function get_video_list($field, $p) {
    $posts = get_field($field, $p->ID);
    if($posts):
      $data = array();
      foreach( $posts as $p ):
        $p_data = get_post($p->ID);
        $photo = get_field('video_cover', $p->ID);
        $data[] = array(
          'post_id' => $p_data->ID,
          'slug' => $p_data->post_name,
          'title' => get_the_title($p_data),
          'post_type' => $p_data->post_type,
          'thumbnail' => get_the_post_thumbnail_url($p->ID),
          'video_url' => get_field('video_url', $p->ID, false, false),
          'video_cover' => return_image($photo),
        );
      endforeach;
    endif;
    return $data;
  }

  function video_grid_template($p){
    return array(
      'id' => $p->ID,
      'columns' => get_field('columns', $p->ID),
      'permalink' => get_field('permalink', $p->ID),
      'proportion' => get_field('proportion', $p->ID),
      'video_collection' => get_video_list('video_collection', $p)
    );
  }
?>