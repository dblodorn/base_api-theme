<?php
  require_once( 'home-template.php');
  require_once( 'post-collection-template.php');

  function return_template($template) {
    $template_name = null;
    if ($template == 'page-templates/template-home.php') {
      $template_name = 'home';
    } else if ($template == 'page-templates/template-post-collection.php') {
      $template_name = 'post-collection';
    } else {
      return false;
    }
    return $template_name;
  }

  function template_data($template_name, $p) {
    $content = false;
    if ($template_name == 'home') {
      $content = home_template($p);
    } else if ($template_name == 'post-collection') {
      $content = post_collection_template($p);
    }
    return $content;
  }

?>