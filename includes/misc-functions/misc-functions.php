<?php
/**
 * Check if the current theme support mp_people
 */
function mp_people_theme_support($content){
	
	if ( !current_theme_supports( 'mp_people' ) ){
		return $content . mp_people_links_list();
	}
	else{
		return $content;	
	}
}
add_filter( 'the_content', 'mp_people_theme_support' );
