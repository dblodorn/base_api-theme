<?php
  function site_basics_data(){
    return array(
      'site_title' => get_bloginfo($show = 'name', 'display'),
    );
  }
?>