<?php
/**
 * Function which creates new Meta Box
 *
 */
function mp_people_links_create_meta_box(){	
	/**
	 * Array which stores all info about the new metabox
	 *
	 */
	$mp_people_links_add_meta_box = array(
		'metabox_id' => 'mp_people_links', 
		'metabox_title' => __( 'Links', 'mp_people'), 
		'metabox_posttype' => 'mp_people', 
		'metabox_context' => 'advanced', 
		'metabox_priority' => 'low' 
	);
	
	/**
	 * Custom filter to allow for custom link types
	 * This filter is shared with the mp_links plugin
	 */
		
	$default_links_array = array(
		'mp-people-links-facebook' => 'Facebook', 
		'mp-people-links-twitter' => 'Twitter', 
		'mp-people-links-tumblr' => 'Tumblr', 
		'mp-people-links-youtube' => 'YouTube', 
		'mp-people-links-vimeo' => 'Vimeo', 
		'mp-people-links-myspace' => 'MySpace', 
		'mp-people-links-linkedin' => 'Linked-In', 
		'mp-people-links-dribbble' => 'Dribbble', 
		'mp-people-links-pinterest' => 'Pinterest', 
		'mp-people-links-email' => 'Email', 
		'mp-people-links-rss' => 'RSS'
	);
	 	 
	$mp_links_array = has_filter('mp_people_links_array') ? apply_filters( 'mp_people_links_array', $default_links_array) : $default_links_array;
	
	/**
	 * Array which stores all info about the options within the metabox
	 *
	 */
	$mp_people_links_items_array = array(
		array(
			'field_id'			=> 'link_type',
			'field_title' 	=> __( 'Link Icon', 'mp_people'),
			'field_description' 	=> 'Select an icon for this link (Optional)',
			'field_type' 	=> 'select',
			'field_value' => '',
			'field_select_values' => $mp_links_array,
			'field_repeater' => 'mp_people_links_repeater',
		),
		array(
			'field_id'			=> 'link_name',
			'field_title' 	=> __( 'Link Name', 'mp_people'),
			'field_description' 	=> 'Type the name of this link. (Optional)',
			'field_type' 	=> 'textbox',
			'field_value' => '',
			'field_repeater' => 'mp_people_links_repeater',
		),
		array(
			'field_id'			=> 'link_url',
			'field_title' 	=> __( 'Link URL', 'mp_people'),
			'field_description' 	=> 'Enter link to this person\'s profile. (EG: http://facebook.com/thisperson/)',
			'field_type' 	=> 'url',
			'field_value' => '',
			'field_repeater' => 'mp_people_links_repeater',
		),
		array(
			'field_id'			=> 'link_target',
			'field_title' 	=> __( 'Link Open Type', 'mp_people'),
			'field_description' 	=> 'Select the way this link will open:',
			'field_type' 	=> 'select',
			'field_value' => '',
			'field_select_values' => array( '_self' => 'In the current window', '_blank' => 'In a new window/tab' ),
			'field_repeater' => 'mp_people_links_repeater',
		),
	);
	
	
	/**
	 * Custom filter to allow for add-on plugins to hook in their own data for add_meta_box array
	 */
	$mp_people_links_add_meta_box = has_filter('mp_people_links_meta_box_array') ? apply_filters( 'mp_people_links_meta_box_array', $mp_people_links_add_meta_box) : $mp_people_links_add_meta_box;
	
	/**
	 * Custom filter to allow for add on plugins to hook in their own extra fields 
	 */
	$mp_people_links_items_array = has_filter('mp_people_links_items_array') ? apply_filters( 'mp_people_links_items_array', $mp_people_links_items_array) : $mp_people_links_items_array;
	
	
	/**
	 * Create Metabox class
	 */
	global $mp_people_links_meta_box;
	$mp_people_links_meta_box = new MP_CORE_Metabox($mp_people_links_add_meta_box, $mp_people_links_items_array);
}
add_action('plugins_loaded', 'mp_people_links_create_meta_box');