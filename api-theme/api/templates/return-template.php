<?php
  require_once( 'home-template.php');
  require_once( 'post-collection-template.php');
  require_once( 'portfolio-item-template.php');
  require_once( 'flexible-image-gallery-template.php');

  function return_template($template) {
    $template_name = null;
    if ($template == 'page-templates/template-home.php') {
      $template_name = 'home';
    } else if ($template == 'page-templates/template-post-collection.php') {
      $template_name = 'post-collection';
    } else if ($template == 'page-templates/template-portfolio-item.php') {
      $template_name = 'portfolio-item';
    } else if ($template == 'page-templates/template-flexible-image-gallery.php') {
      $template_name = 'flexible-image-gallery';
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
    } else if ($template_name == 'portfolio-item') {
      $content = portfolio_item_template($p);
    } else if ($template_name == 'flexible-image-gallery') {
      $content = flexible_image_gallery_template($p);
    }
    return $content;
  }

?>