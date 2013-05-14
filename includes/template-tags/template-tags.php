<?php
/**
 * Template tag to display links for a person
 */
function mp_people_links_list( $post_id ){
	
	//Get array of links using the repeater
	$links_array = get_post_meta( $post_id, 'mp_people_links_repeater', true );
	
	if (!empty( $links_array ) ){
		//Loop through each link
		foreach ( $links_array as $link ){
			echo '<ul class="mp-people-links">';
			
			//Display this link
			echo '<li class="' . $link['link_type']  . '-li"><a target="' . $link['link_target'] . '" class="' . $link['link_type'] . '" href="' . $link['link_url'] . '">' . $link['link_name'] . '</a></li>';	
			echo '</ul>';
		}
	}
	
}