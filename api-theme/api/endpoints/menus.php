<?php
  function menu_data(){
    // LOOP THROUGH MENUS
    function return_menus() { 
      $menu_array = array();
      $menus = get_registered_nav_menus();
      foreach($menus as $menu_item){
        $menu= array();
        $menu['menu_name'] = $menu_item;
        $items_raw = wp_get_nav_menu_items($menu_item);
        $items = array();
        foreach ($items_raw as $item) {
          $i = new stdClass();
          $i->id = $item->ID;
          $i->title = $item->title;
          $i->slug = basename(parse_url($item->url, PHP_URL_PATH));
          $i->is_home = return_home($item->url);
          $i->external_link = false;
          $items[] = $i;
        }
        $menu['items'] = $items;
        // $menu['raw'] = $items_raw;
        $menu_array[] = $menu;
      }
      return $menu_array;
    }
    return return_menus();
  }
?>