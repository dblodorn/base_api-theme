<?php
  function portfolio_item_template($p){
    return array(
      'id' => $p->ID,
      'short_description' => get_field('short_description', $p->ID),
      'description' => get_field('description', $p->ID),
    );
  }
?>