<?php

  function simple_slideshow_gallery($images) {
    if ($images) {
      foreach ($images as $image) {
        $img = array(
          'image' => return_image($image),
          'slide_type' => 'image'
        );
        $imgArray[] = $img;
      }
      return $imgArray;
    } else {
      return false;
    }
  }

  function return_image_grid($images) {
    if ($images) {
      foreach ($images as $image) {
        $img = array(
          'image' => return_image($image),
          'style' => 'cover',
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
      'controls' => get_sub_field( 'controls' ),
      'has_text_overlay' => get_sub_field( 'has_text_overlay'),
      'text_overlay_content' => get_sub_field( 'text_overlay_content'),
      'text_overlay_postion' => get_sub_field( 'text_overlay_position'),
      'pagination' => get_sub_field( 'pagination' ),
      'autoplay' => get_sub_field( 'autoplay' ),
      'captions' => get_sub_field( 'captions' ),
      'transition_time' => get_sub_field( 'transition_time' ),
      'image_style' => get_sub_field('image_style'),
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
          'slide_type' => get_sub_field('slide_type'),
          'image_style' => get_sub_field('image_style'),
          'video' => get_sub_field( 'video_file' ),
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
      'has_text_overlay' => get_sub_field( 'has_text_overlay'),
      'text_overlay_content' => get_sub_field( 'text_overlay_content'),
      'is_hero' => get_sub_field('is_hero'),
      'text_overlay_postion' => get_sub_field( 'text_overlay_position'),
      'controls' => get_sub_field( 'controls' ),
      'pagination' => get_sub_field( 'pagination' ),
      'autoplay' => get_sub_field( 'autoplay' ),
      'captions' => get_sub_field( 'captions' ),
      'transition_time' => get_sub_field( 'transition_time' ),
      'slides' => full_slideshow()
    );
  }

  function return_image_grid_popup() {
    $images = get_sub_field( 'images' );
    return array (
      'module' => 'image_grid_popup',
      'proportion' => get_sub_field('proportion'),
      'popup_type' => get_sub_field('popup_type'),
      'columns' => get_sub_field('columns'),
      'image_style' => get_sub_field('image_style'),
      'images' => return_image_grid($images)
    );
  }

  function return_details_popup() {
    return array (
      'module' => 'details_popup',
      'images' => get_sub_field('proportion'),
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

  function return_wysiwig_content() {
    return array (
      'module' => 'wysiwig_content',
      'wysiwig' => get_sub_field('wysiwig'),
      'wysiwig_width' => get_sub_field('wysiwig_width'),
      'wysiwig_position' => get_sub_field('wysiwig_position'),
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
        elseif(get_row_layout() == 'wysiwig_content'):
          $data = return_wysiwig_content();
        endif;
        $fc_image_gallery[] = $data;
      endwhile;
      return $fc_image_gallery;
    else:
      return false;
    endif;
  }

  function return_text_overlay() {

  }

  function flexible_image_gallery_template($p){
    $flex_layout = get_field('layout_modules', $p->ID);
    return array(
      'layout' => flex_content_image_gallery($p)
    );
  }
?>