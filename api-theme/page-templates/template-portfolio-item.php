<?php /*
  Template Name: Portfolio Item
  Template Post Type: post, page, project
*/ ?>

<?php /* ACF CODE */?>

<?php the_field( 'short_description' ); ?>

<?php /* ACF CODE */?>

<?php $project_photo = get_field( 'project_photo' ); ?>
<?php if ( $project_photo ) { ?>
	<img src="<?php echo $project_photo['url']; ?>" alt="<?php echo $project_photo['alt']; ?>" />
<?php } ?>

<?php /* ACF CODE */?>

<?php the_field( 'project_description' ); ?>

<?php /* ACF CODE */?>

<?php if ( get_field( 'more_information' ) == 1 ) { 
 // echo 'true'; 
} else { 
 // echo 'false'; 
} ?>

<?php /* ACF CODE */?>

<?php if ( have_rows( 'project_links' ) ) : ?>
	<?php while ( have_rows( 'project_links' ) ) : the_row(); ?>
		<?php the_sub_field( 'project_link' ); ?>
		<?php the_sub_field( 'project_link_copy' ); ?>
	<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>

<?php /* additional_details - TEXT AREA - ACF CODE */?>

<?php the_field( 'additional_details' ); ?>

<?php if ( get_field( 'show_capabilities' ) == 1 ) { 
 // echo 'true'; 
} else { 
 // echo 'false'; 
} ?>

<?php if ( get_field( 'show_industry' ) == 1 ) { 
 // echo 'true'; 
} else { 
 // echo 'false'; 
} ?>

<?php /* additional_details - Gallery */?>

<?php $gallery_images = get_field( 'gallery' ); ?>
<?php if ( $gallery_images ) :  ?>
	<?php foreach ( $gallery_images as $gallery_image ): ?>
		<a href="<?php echo $gallery_image['url']; ?>">
			<img src="<?php echo $gallery_image['sizes']['thumbnail']; ?>" alt="<?php echo $gallery_image['alt']; ?>" />
		</a>
	<p><?php echo $gallery_image['caption']; ?></p>
	<?php endforeach; ?>
<?php endif; ?>