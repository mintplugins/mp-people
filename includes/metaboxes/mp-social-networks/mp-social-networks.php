<?php
/**
 * Function which creates new Meta Box
 *
 */
function mp_people_s_n_create_meta_box(){	
	/**
	 * Array which stores all info about the new metabox
	 *
	 */
	$mp_people_s_n_add_meta_box = array(
		'metabox_id' => 'mp_people_s_n_social_networks', 
		'metabox_title' => __( 'Social Networks', 'mp_people'), 
		'metabox_posttype' => 'mp_people', 
		'metabox_context' => 'advanced', 
		'metabox_priority' => 'low' 
	);
	
	/**
	 * Array which stores all info about the options within the metabox
	 *
	 */
	$mp_people_s_n_items_array = array(
		array(
			'field_id'			=> 'social_network_icon',
			'field_title' 	=> __( 'Social Network Icon', 'mp_people'),
			'field_description' 	=> 'Upload an icon for this social network (Optional)',
			'field_type' 	=> 'mediaupload',
			'field_value' => '',
			'field_repeater' => 'mp_people_social_networks',
		),
		array(
			'field_id'			=> 'social_network_name',
			'field_title' 	=> __( 'Social Network Name', 'mp_people'),
			'field_description' 	=> 'Type the name of this social network. (Optional)',
			'field_type' 	=> 'textbox',
			'field_value' => '',
			'field_repeater' => 'mp_people_social_networks',
		),
		array(
			'field_id'			=> 'social_network_link',
			'field_title' 	=> __( 'Network Link', 'mp_people'),
			'field_description' 	=> 'Enter link to this person\'s profile. (EG: http://facebook.com/thisperson/)',
			'field_type' 	=> 'url',
			'field_value' => '',
			'field_repeater' => 'mp_people_social_networks',
		),
	);
	
	
	/**
	 * Custom filter to allow for add-on plugins to hook in their own data for add_meta_box array
	 */
	$mp_people_s_n_add_meta_box = has_filter('mp_people_s_n_meta_box_array') ? apply_filters( 'mp_people_s_n_meta_box_array', $mp_people_s_n_add_meta_box) : $mp_people_s_n_add_meta_box;
	
	/**
	 * Custom filter to allow for add on plugins to hook in their own extra fields 
	 */
	$mp_people_s_n_items_array = has_filter('mp_people_s_n_items_array') ? apply_filters( 'mp_people_s_n_items_array', $mp_people_s_n_items_array) : $mp_people_s_n_items_array;
	
	
	/**
	 * Create Metabox class
	 */
	global $mp_people_s_n_meta_box;
	$mp_people_s_n_meta_box = new MP_CORE_Metabox($mp_people_s_n_add_meta_box, $mp_people_s_n_items_array);
}
add_action('plugins_loaded', 'mp_people_s_n_create_meta_box');