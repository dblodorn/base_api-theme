<?php
/*-----------------------------------------------------------------------------------*/
/*	Add Custom Portfolio Post Type
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'create_portfolio_post_types' );

function create_portfolio_post_types() {
	register_post_type( 'portfolio',
		array(
			  'labels' => array(
			  'name' => __( 'Portfolio', 'framework'),
			  'singular_name' => __( 'Portfolio Item', 'framework'),
			  'add_new' => __( 'Add New', 'framework' ),
		   	  'add_new_item' => __( 'Add New Portfolio Item', 'framework'),
			  'edit' => __( 'Edit', 'framework' ),
	  		  'edit_item' => __( 'Edit Portfolio Item', 'framework'),
	          'new_item' => __( 'New Portfolio Item', 'framework'),
			  'view' => __( 'View Portfolio', 'framework'),
			  'view_item' => __( 'View Portfolio Item', 'framework'),
			  'search_items' => __( 'Search Portfolio Items', 'framework'),
	  		  'not_found' => __( 'No Portfolios found', 'framework'),
	  		  'not_found_in_trash' => __( 'No Portfolio Items found in Trash', 'framework'),
			  'parent' => __( 'Parent Portfolio', 'framework'),
			),
			'menu_icon' => get_stylesheet_directory_uri() . '/admin/images/icons/photos.png',
			'public' => true,
			'rewrite' => array( 'slug' => 'portfolio'), //  Change this to change the url of your "portfolio".
			'supports' => array( 
			'title', 
			'editor',  
			'thumbnail',
			'comments'),
		)
	);
}


//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'ag_create_taxonomies', 0 );

//create two taxonomies, genres and writers for the post type "book"
function ag_create_taxonomies() 
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Sort', 'taxonomy general name', 'framework'),
    'singular_name' => _x( 'Skill', 'taxonomy singular name', 'framework'),
    'search_items' =>  __( 'Search Skills', 'framework'),
    'all_items' => __( 'All Skills', 'framework'),
    'parent_item' => __( 'Parent Skill', 'framework'),
    'parent_item_colon' => __( 'Parent Skill:', 'framework'),
    'edit_item' => __( 'Edit Skill', 'framework'), 
    'update_item' => __( 'Update Skill', 'framework'),
    'add_new_item' => __( 'Add New Skill', 'framework'),
    'new_item_name' => __( 'New Skill Name', 'framework'),
    'menu_name' => __( 'Skills', 'framework'),
  ); 	

  register_taxonomy('sort',array('portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true, 
    'rewrite' => array( 'slug' => 'sort'), //  Change this to change the url of "sort".
  ));

}

function get_portfolio_info ($image_size, $id, $crop, $thumbnum) {
	
		global $thumb, $full, $alt;
		
		$i = 2;
		
		while ($i < ($thumbnum)) {
		
		global ${"thumb" . $i};
		global ${"full" . $i};
		global ${"alt" . $i};
		
		$i++;
		
		}
		
			  $counter = 2; //start counter at 2

			  $full = get_post_meta($id,'_thumbnail_id',false); // Get Image ID 
			  $alt = get_post_meta($full, '_wp_attachment_image_alt', true); // Alt text of image
			  $full = wp_get_attachment_image_src($full[0], 'portfoliolarge', false);  // URL of Featured Full Image
			  
			   if ( $crop ) {  if ($crop == 'No Crop') {
				 
			  $thumb = get_post_meta($id,'_thumbnail_id',false); 
			  $thumb = wp_get_attachment_image_src($thumb[0], false);  // URL of Featured first slide
			  
			   } else {
				   
			  $thumb = get_post_meta($id,'_thumbnail_id',false); 
			  $thumb = wp_get_attachment_image_src($thumb[0], $image_size, false);  // URL of Featured first slide
				   
			   } } else {
				   
			  $thumb = get_post_meta($id,'_thumbnail_id',false); 
			  $thumb = wp_get_attachment_image_src($thumb[0], $image_size, false);  // URL of Featured first slide
			  
			   }
			
			while ($counter < ($thumbnum)) {
				
					if ($counter == 2) { $countername = 'second';
					} else
					if ($counter == 3) { $countername = 'third'; 
					} else
					if ($counter == 4) { $countername = 'fourth';
					} else
					if ($counter == 5) { $countername = 'fifth';
					} else
					if ($counter == 6) { $countername = 'sixth';
					} else {
					$countername = $counter;	
					}
				
				 ${"full" . $counter} = MultiPostThumbnails::get_post_thumbnail_id('portfolio', $countername . '-slide', $id); // Get Image ID
				 ${"alt" . $counter} = get_post_meta(${"full" . $counter} , '_wp_attachment_image_alt', true); // Alt text of image			 
				 ${"full" . $counter} = wp_get_attachment_image_src(${"full" . $counter}, false); // URL of Second Slide Full Image
			 
			 if ( $crop ) {  if ($crop == 'No Crop') {
			  
    		  ${"thumb" . $counter} = MultiPostThumbnails::get_post_thumbnail_id('portfolio',  $countername . '-slide', $id); 
			  ${"thumb" . $counter} = wp_get_attachment_image_src(${"thumb" . $counter}, false); // URL of next Slide 
		
				 
			 } else {
			  
    		  ${"thumb" . $counter} = MultiPostThumbnails::get_post_thumbnail_id('portfolio', $countername . '-slide', $id); 
			  ${"thumb" . $counter} = wp_get_attachment_image_src(${"thumb" . $counter}, $image_size, false); // URL of next Slide 
	 
			 } } else {
			  
    		  ${"thumb" . $counter} = MultiPostThumbnails::get_post_thumbnail_id('portfolio', $countername . '-slide', $id); 
			  ${"thumb" . $counter} = wp_get_attachment_image_src(${"thumb" . $counter}, $image_size, false); // URL of next Slide 
			 
			 }
			 
			 $counter++;

		}
			
				

	 
  }
?>