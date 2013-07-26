<?php

/**
 * Enqueue font face for links
 * Usage: add_action( 'wp_enqueue_scripts', 'mp_people_enqueue_scripts' );
 *
 * Filter: mp_people_icon_font_location
 */
function mp_people_enqueue_scripts(){
 	
	//Default location for icon font css
	$default_font_location = plugins_url('/css/mp-people-icon-font.css', dirname(__FILE__) );
	
	//Filter or set default skin for links 
	$filtered_font_location = has_filter('mp_people_icon_font_location') ? apply_filters( 'mp_people_icon_font_location', $default_font_location) : $default_font_location;
	
	//Icon font for links
	if ( !empty( $filtered_font_location ) ) {
		wp_enqueue_style('mp_people_icon_font', $filtered_font_location);
	}

}
 
/**
 * Enqueue font face for links
 */
add_action( 'wp_enqueue_scripts', 'mp_people_enqueue_scripts' );