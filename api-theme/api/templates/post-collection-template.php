<?php
  function post_collection_template($p){
    $post_collection = get_field('post_collection', $p->ID);
    return array(
      'id' => $p->ID,
      'posts' => $post_collection
    );
  }
?>
