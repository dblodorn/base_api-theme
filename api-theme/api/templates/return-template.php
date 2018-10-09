<?php
  require_once( 'post-collection-template.php');
  require_once( 'flexible-image-gallery-template.php');
  require_once( 'video-grid-template.php');

  function return_template($template) {
    $template_name = null;
    if ($template == 'page-templates/template-post-collection.php') {
      $template_name = 'post-collection';
    } else if ($template == 'page-templates/template-flexible-image-gallery.php') {
      $template_name = 'flexible-image-gallery';
    } else if ($template == 'page-templates/template-video-grid.php') {
      $template_name = 'video-grid';
    } else {
      return false;
    }
    return $template_name;
  }

  function template_data($template_name, $p) {
    $content = false;
    if ($template_name == 'post-collection') {
      $content = post_collection_template($p);
    } else if ($template_name == 'flexible-image-gallery') {
      $content = flexible_image_gallery_template($p);
    } else if ($template_name == 'video-grid') {
      $content = video_grid_template($p);
    }
    return $content;
  }

?>