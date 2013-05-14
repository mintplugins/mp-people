<?php
/**
 * Function which creates new Meta Box
 *
 */
function mp_people_create_meta_box(){	
	/**
	 * Array which stores all info about the new metabox
	 *
	 */
	$mp_people_add_meta_box = array(
		'metabox_id' => 'mp_people_metabox', 
		'metabox_title' => __( 'Person Settings', 'mp_people'), 
		'metabox_posttype' => 'mp_people', 
		'metabox_context' => 'advanced', 
		'metabox_priority' => 'low' 
	);
	
	/**
	 * Array which stores all info about the options within the metabox
	 *
	 */
	$mp_people_items_array = array(
		array(
			'field_id'			=> 'person_nickname',
			'field_title' 	=> __( 'Person\'s Nickname (Optional)', 'mp_people'),
			'field_description' 	=> 'This is the name used by various themes when just 1 short name is used.',
			'field_type' 	=> 'textbox',
			'field_value' => ''
		),
		
	);
	
	
	/**
	 * Custom filter to allow for add-on plugins to hook in their own data for add_meta_box array
	 */
	$mp_people_add_meta_box = has_filter('mp_people_meta_box_array') ? apply_filters( 'mp_people_meta_box_array', $mp_people_add_meta_box) : $mp_people_add_meta_box;
	
	/**
	 * Custom filter to allow for add on plugins to hook in their own extra fields 
	 */
	$mp_people_items_array = has_filter('mp_people_items_array') ? apply_filters( 'mp_people_items_array', $mp_people_items_array) : $mp_people_items_array;
	
	
	/**
	 * Create Metabox class
	 */
	global $mp_people_meta_box;
	$mp_people_meta_box = new MP_CORE_Metabox($mp_people_add_meta_box, $mp_people_items_array);
}
add_action('plugins_loaded', 'mp_people_create_meta_box');