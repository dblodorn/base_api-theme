<?php
  
  function return_simple_slideshow() {
    $images = get_sub_field( 'images' );
    return array (
      'module' => 'simple_slideshow',
      'headline' => get_sub_field( 'headline' ),
      'slides' => acf_gallery($images),
    );
  }
  
  function return_slideshow() {
    return array (
      'module' => 'slideshow',
      'headline' => get_sub_field( 'headline' )
    );
  }

  function return_single_image_popup() {
    return array (
      'module' => 'single_image_popup',
      'headline' => get_sub_field( 'headline' )
    );
  }

  function return_slideshow_popup() {
    return array (
      'module' => 'slideshow_popup',
      'headline' => get_sub_field( 'headline' )
    );
  }

  function return_details_popup() {
    return array (
      'module' => 'details_popup',
      'headline' => get_sub_field( 'headline' )
    );
  }

  function return_video_embed() {
    $video_cover_image = get_sub_field( 'video_cover_image' );
    return array (
      'module' => 'video_embed',
      'headline' => get_sub_field( 'headline' ),
      'video_embed' => get_sub_field( 'video' ),
      'video_cover_image' => return_image($video_cover_image),
      'caption' => get_sub_field( 'video_caption' ),
    );
  }

  function return_video_embed_file() {
    $video_file = get_sub_field( 'video_file' );
    $video_cover_image = get_sub_field( 'video_cover_image' );
    return array (
      'module' => 'video_embed_file',
      'headline' => get_sub_field( 'headline' ),
      'video_file' => $video_file['url'],
      'video_cover_image' => return_image($video_cover_image),
      'caption' => get_sub_field( 'video_caption' ),
    );
  }
  
  function flex_content_image_gallery($p){
    $fc_image_gallery = array();
    if( get_field('image_gallery', $p->ID) ):
      while( has_sub_field('image_gallery', $p->ID) ):
        if(get_row_layout() == 'simple_slideshow'):
          $data = return_simple_slideshow();
        elseif(get_row_layout() == 'slideshow'):
          $data = return_slideshow();
        elseif(get_row_layout() == 'single_image_popup'):
          $data = return_single_image_popup();
        elseif(get_row_layout() == 'slideshow_popup'):
          $data = return_slideshow_popup();
        elseif(get_row_layout() == 'details_popup'):
          $data = return_details_popup();
        elseif(get_row_layout() == 'video_embed'):
          $data = return_video_embed();
        elseif(get_row_layout() == 'video_embed_file'):
          $data = return_video_embed_file();
        endif;
        $fc_image_gallery[] = $data;
      endwhile;
      return $fc_image_gallery;
    else:
      return false;
    endif;
  }

  function flexible_image_gallery_template($p){
    $flex_layout = get_field('image_gallery', $p->ID);
    return array(
      'description' => get_field('description', $p->ID),
      'layout' => flex_content_image_gallery($p)
    );
  }
?>