<?php
  // MODULE FOR WORDPRESS MENUS
  function menu_data(){
    // LOOP THROUGH MENUS
    function return_menus() { 
      $menu_array = array();
      $menus = get_registered_nav_menus();
      foreach($menus as $menu_item){
        $menu_array[] = array( 
          'menu' => $menu_item,
        );
      }
      return $menu_array;
    }

    return array(
      'menu_list' => return_menus(),
    );
  }
?>