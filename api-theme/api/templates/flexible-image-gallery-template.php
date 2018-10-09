<?php

  function simple_slideshow_gallery($images, $style) {
    if ($images) {
      foreach ($images as $image) {
        $img = array(
          'image' => return_image($image),
          'slide_type' => 'image',
          'image_style' => $style
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
          'image' => return_image($image)
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
    $style = get_sub_field('image_style');
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
      'image_style' => $style,
      'slides' => simple_slideshow_gallery($images, $style),
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

  function details_popup() {
    $images = array();
    if ( have_rows( 'details_images' ) ) :
      while ( have_rows( 'details_images' ) ) : the_row();
        $main_img = get_sub_field( 'main_image' );
        $details = get_sub_field( 'details' );
        $images[] = array(
          'image' => return_image($main_img),
          'deatails' => return_image_grid($details)
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
      'thumbnail_proportion' => get_sub_field('image_grid_proportion'),
      'popup_type' => get_sub_field('popup_type'),
      'ig_columns' => get_sub_field('ig_columns'),
      'ig_width' => get_sub_field('ig_width'),
      'image_style' => get_sub_field('image_style'),
      'images' => return_image_grid($images)
    );
  }

  function return_details_popup() {
    return array (
      'module' => 'details_popup',
      'thumbnail_proportion' => get_sub_field('popup_grid_proportion'),
      'columns' => get_sub_field('popup_grid_columns'),
      'width' => get_sub_field('popup_grid_width'),
      'image_style' => get_sub_field('image_style'),
      'images' => details_popup()
    );
  }

  function return_single_video_photo() {
    $video_file = get_sub_field( 'video_file' );
    $image = get_sub_field( 'cover_image' );
    return array (
      'module' => 'single_video_photo',
      'has_text_overlay' => get_sub_field( 'svp_has_text_overlay'),
      'text_overlay_content' => get_sub_field( 'svp_text_overlay_content'),
      'text_overlay_postion' => get_sub_field( 'svp_text_overlay_position'),
      'is_hero' => get_sub_field('is_hero'),
      'media_type' => get_sub_field('media_type'),
      'video_embed' => get_sub_field('video_embed', false, false),
      'video_file' => $video_file['url'],
      'video_cover_image' => return_image($image),
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
  
  function flex_content_layout_modules($p){
    $fc_layout_modules = array();
    if( get_field('layout_modules', $p->ID) ):
      while( has_sub_field('layout_modules', $p->ID) ):
        if(get_row_layout() == 'simple_slideshow'):
          $data = return_simple_slideshow();
        elseif(get_row_layout() == 'slideshow'):
          $data = return_slideshow();
        elseif(get_row_layout() == 'image_grid_popup'):
          $data = return_image_grid_popup();
        elseif(get_row_layout() == 'details_popup'):
          $data = return_details_popup();
        elseif(get_row_layout() == 'single_video_photo'):
          $data = return_single_video_photo();
        elseif(get_row_layout() == 'wysiwig_content'):
          $data = return_wysiwig_content();
        endif;
        $fc_layout_modules[] = $data;
      endwhile;
      return $fc_layout_modules;
    else:
      return false;
    endif;
  }

  function flexible_image_gallery_template($p){
    $flex_layout = get_field('layout_modules', $p->ID);
    return array(
      'layout' => flex_content_layout_modules($p)
    );
  }
?>