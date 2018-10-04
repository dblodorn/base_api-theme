<?php
  function flexible_image_gallery_template($p){
    return array(
      'id' => $p->ID,
      'wp_content' => $p->post_content
    );
  }
?>