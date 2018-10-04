<?php
  function portfolio_item_template($p){
    return array(
      'id' => $p->ID,
      'wp_content' => $p->post_content
    );
  }
?>