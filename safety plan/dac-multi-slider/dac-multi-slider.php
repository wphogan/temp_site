<?php
/*
Plugin Name: Design Action - Multi-Slider
Description: Lays the groundwork for the slider functionality. Basic fields included in theme, and can be customized to suit a particular site's needs.
Version:     0.0.1
Author:      Design Action
Author URI:  http://designaction.org
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function enqueue_flexslider() {
	wp_enqueue_script( 'flexslider', get_stylesheet_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), null, true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_flexslider' ); 

//Custom Thumbnails
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'slideshow', 1168, 400, true ); //set slideshow size here
}

// Register ACF Slideshow Post Type
function acf_slideshow_posttype() {

	$labels = array(
		'name'                => 'Slideshows',
		'singular_name'       => 'Slideshow',
		'menu_name'           => 'Slideshows',
		'name_admin_bar'      => 'Slideshows',
		'parent_item_colon'   => 'Parent Slideshow:',
		'all_items'           => 'All Slideshows',
		'add_new_item'        => 'Add New Slideshow',
		'add_new'             => 'Add New',
		'new_item'            => 'New Slideshow',
		'edit_item'           => 'Edit Slideshow',
		'update_item'         => 'Update Slideshow',
		'view_item'           => 'View Slideshow',
		'search_items'        => 'Search Slideshow',
		'not_found'           => 'Not found',
		'not_found_in_trash'  => 'Not found in Trash',
	);
	$args = array(
		'label'               => 'acf_slideshow',
		'description'         => 'Slideshows',
		'labels'              => $labels,
		'supports'            => array( 'title', 'revisions', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 6,
		'register_meta_box_cb'=> 'add_shortcode_metabox',
		'menu_icon'           => 'dashicons-format-gallery',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'acf_slideshow', $args );

}

// Hook into the 'init' action
add_action( 'init', 'acf_slideshow_posttype', 0 );

// Add shortcode columns
add_filter('manage_edit-acf_slideshow_columns', 'my_columns');
function my_columns($columns) {
	$columns['shortcode'] = 'Shortcode';
	return $columns;
}

add_action('manage_posts_custom_column', 'my_show_columns');
function my_show_columns($name) {
	global $post;
	switch ($name) {
		case 'shortcode':
		$shortcode = '<input type="text" value="[slideshow id=&quot;'.$post->ID.'&quot;]">';
		echo $shortcode;
	}
}

// Add slideshow shortcode
// Add Shortcode
function acf_slideshow_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'id' => '',
		), $atts )
	);

	// check if the repeater field has rows of data
	if( have_rows('slideshow', $id) ):
		$return = '<div class="flexslider"><ul class="slides">';
		// loop through the rows of data
		while ( have_rows('slideshow', $id) ) : the_row();
			// get all the subfields for each slide
			$return .= '<li>';
			// Link
			if (get_sub_field('link_type') == 'Internal' && get_sub_field('link') != '') {
				$link = get_sub_field('link');
			} elseif (get_sub_field('link_type') == 'External' && get_sub_field('external_link') != '') {
				$link = get_sub_field('external_link');
			}
			if ($link != '') $return .= '<a href="'.$link.'">';
			$image = get_sub_field('image');
			if( !empty($image) ): 

				// vars
				$alt = $image['alt'];

				// thumbnail
				$size = 'slideshow';
				$thumb = $image['sizes'][ $size ];
				$width = $image['sizes'][ $size . '-width' ];;
				$height = $image['sizes'][ $size . '-height' ];
				
				$return .= '<img src="'.$thumb.'" alt="'.$alt.'" width="'.$width.'" height="'.$height.'" />';
				
			endif;
			$return .= '<div class="slide-caption"><div class="slide-caption__inner-wrapper">';
			if (get_sub_field('caption')) $return .= '<h3>'.get_sub_field('caption').'</h3>';
			if (get_sub_field('description')) $return .= '<h4>'.get_sub_field('description').'</h4>';
			$return .= '</div></div>';
			if ($link != '') $return .= '</a>';
			$return .= '</li>';
		endwhile;
		$return .= '</ul></div></div>';
	else :
		// no rows found
		$return .= 'No slides found.';
	endif;
	return $return;
}
add_shortcode( 'slideshow', 'acf_slideshow_shortcode' );

// Add metabox with shortcode to slideshow posts
function add_shortcode_metabox() {
    add_meta_box('acf_slideshow_shortcode', 'Shortcode', 'acfcallback', 'acf_slideshow', 'side', 'default');
}
function acfcallback() {
	global $post;
	echo '<p>Copy and paste the following shortcode into the post or page where you would like this slideshow to appear:</p><input type="text" value="[slideshow id=&quot;'.$post->ID.'&quot;]">';
}