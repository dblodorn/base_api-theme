<?php

  function simple_slideshow_gallery($images) {
    if ($images) {
      foreach ($images as $image) {
        $img = array(
          'image' => return_image($image),
          'style' => 'cover',
          'slide_type' => 'image'
        );
        $imgArray[] = $img;
      }
      return $imgArray;
    } else {
      return false;
    }
  }

  function return_simple_slideshow() {
    $images = get_sub_field( 'images' );
    return array (
      'module' => 'simple_slideshow',
      'is_hero' => get_sub_field( 'is_hero' ),
      'slides' => simple_slideshow_gallery($images),
    );
  }

  function full_slideshow() {
    $images = array();
    if ( have_rows( 'slides' ) ) :
      while ( have_rows( 'slides' ) ) : the_row();
        $video = get_sub_field( 'video_file' );
        $photo = get_sub_field( 'photo' );
        $images[] = array(
          'image' => return_image($photo),
          'style' => 'cover',
          'video' => get_sub_field( 'video_file' ),
          'video_embed' => get_sub_field( 'video_embed' ),
          'slide_type' => get_sub_field('slide_type'),
          'text' => get_sub_field( 'text' ),
          'has_bg_color' => get_sub_field( 'add_background_color' ),
          'bg_color' => get_sub_field( 'background_color' ),
          'text_color' => get_sub_field( 'text_color' ),
          'theme' => get_sub_field( 'theme' ),
        );
      endwhile;
    endif;
    return $images;
  }

  function return_slideshow() {
    return array (
      'module' => 'slideshow',
      'is_hero' => get_sub_field('is_hero'),
      'slides' => full_slideshow()
    );
  }

  function return_image_grid_popup() {
    return array (
      'module' => 'image_grid_popup',
    );
  }

  function return_details_popup() {
    return array (
      'module' => 'details_popup',
    );
  }

  function return_video_embed() {
    $video_cover_image = get_sub_field( 'video_cover_image' );
    return array (
      'module' => 'video_embed',
      'is_hero' => get_sub_field('is_hero'),
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
      'is_hero' => get_sub_field('is_hero'),
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
        elseif(get_row_layout() == 'image_grid_popup'):
          $data = return_image_grid_popup();
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
      'layout' => flex_content_image_gallery($p)
    );
  }
?>