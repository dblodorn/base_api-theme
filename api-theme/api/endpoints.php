<?php
  function main_data(){
    $data = array();
    $data['site_basics'] = site_basics_data();
    $data['menus'] = menu_data();
    $data['posts'] = array(
      'pages' => page_data(),
      'project' => all_posts('project'),
      'video' => all_posts('video'),
      'instagram' => all_posts('instagram_post'),
    );
    $data['options'] = options_data();
    return $data;
  }
  function api_setup_endpoints() {
    $namespace = 'api/v1';
    register_rest_route( $namespace, '/data/', array(
      'methods' => 'GET',
      'callback' => 'main_data'
    ));
  }
add_action( 'rest_api_init', 'api_setup_endpoints' );
