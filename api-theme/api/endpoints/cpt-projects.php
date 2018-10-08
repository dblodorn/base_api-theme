<?php
  // ALL PROJECTS CPT
  function cpt_projects(){
    $args = array(
      'post_type' => 'project',
      'posts_per_page' => -1
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
      $data = array();
      while ($the_query->have_posts()) : $the_query->the_post();
        $post = get_post($post_id);
        $data[] = post_data($post);
      endwhile;
    endif;
    return $data;
  }

  function cpt_videos(){
    $args = array(
      'post_type' => 'video',
      'posts_per_page' => -1
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
      $data = array();
      while ($the_query->have_posts()) : $the_query->the_post();
        $post = get_post($post_id);
        $data[] = post_data($post);
      endwhile;
    endif;
    return $data;
  }

  function cpt_instagram(){
    $args = array(
      'post_type' => 'instagram_post',
      'posts_per_page' => -1
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
      $data = array();
      while ($the_query->have_posts()) : $the_query->the_post();
        $post = get_post($post_id);
        $data[] = post_data($post);
      endwhile;
    endif;
    return $data;
  }

?>