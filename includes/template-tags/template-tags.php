<?php
/**
 * Template tag to display links for a person
 */
function mp_people_links_list( $post_id = NULL ){
	
	//Get the global post
	global $post;
	
	//If no post ID has been passed in, use the global post id		
	$post_id = $post_id == NULL ? $post->ID : $post_id;
			
	//Get array of links using the repeater
	$links_array = get_post_meta( $post_id, 'mp_people_links_repeater', true );
		
	//Set HTML Ouput var	
	$html_output = NULL;
	
	if (!empty( $links_array ) ){
		//Loop through each link
		foreach ( $links_array as $link ){
			$html_output .= '<ul class="mp-people-links">';
			
			//Display this link
			$html_output .= '<li class="' . $link['link_type']  . '-li"><a target="' . $link['link_target'] . '" class="' . $link['link_type'] . '" href="' . $link['link_url'] . '">' . $link['link_name'] . '</a></li>';	
			$html_output .= '</ul>';
		}
		
		return $html_output;
	}
	
}
