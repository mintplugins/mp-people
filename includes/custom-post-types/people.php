<?php
/**
 * Custom Post Types
 *
 * @package mp_people
 * @since mp_people 1.0
 */

/**
 * Person Custom Post Type
 */
function mp_people_post_type() {
	
		$people_labels =  apply_filters( 'mp_people_people_labels', array(
			'name' 				=> 'People',
			'singular_name' 	=> 'Person',
			'add_new' 			=> __('Add New', 'mp_people'),
			'add_new_item' 		=> __('Add New Person', 'mp_people'),
			'edit_item' 		=> __('Edit Person', 'mp_people'),
			'new_item' 			=> __('New Person', 'mp_people'),
			'all_items' 		=> __('All People', 'mp_people'),
			'view_item' 		=> __('View People', 'mp_people'),
			'search_items' 		=> __('Search People', 'mp_people'),
			'not_found' 		=>  __('No People found', 'mp_people'),
			'not_found_in_trash'=> __('No People found in Trash', 'mp_people'), 
			'parent_item_colon' => '',
			'menu_name' 		=> __('People', 'mp_people')
		) );
		
			
		$people_args = array(
			'labels' 			=> $people_labels,
			'public' 			=> true,
			'publicly_queryable'=> true,
			'show_ui' 			=> true, 
			'show_in_nav_menus' => false,
			'show_in_menu' 		=> true, 
			'menu_position'		=> 5,
			'query_var' 		=> true,
			'rewrite' 			=> array( 'slug' => 'people' ),
			'capability_type' 	=> 'post',
			'has_archive' 		=> true, 
			'hierarchical' 		=> false,
			'supports' 			=> apply_filters('mp_people_people_supports', array( 'title', 'editor', 'thumbnail' ) ),
		); 
		register_post_type( 'mp_people', apply_filters( 'mp_people_people_post_type_args', $people_args ) );
}
add_action( 'init', 'mp_people_post_type', 100 );

/**
 * People Groups Taxonomy
 */
 
function mp_people_person_group_taxonomy() {  
		
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'                => __( 'People Groups', 'mp_people' ),
			'singular_name'       => __( 'People Group', 'mp_people' ),
			'search_items'        => __( 'Search People Groups', 'mp_people' ),
			'all_items'           => __( 'All People Groups', 'mp_people' ),
			'parent_item'         => __( 'Parent People Group', 'mp_people' ),
			'parent_item_colon'   => __( 'Parent People Group:', 'mp_people' ),
			'edit_item'           => __( 'Edit People Group', 'mp_people' ), 
			'update_item'         => __( 'Update People Group', 'mp_people' ),
			'add_new_item'        => __( 'Add New People Group', 'mp_people' ),
			'new_item_name'       => __( 'New People Group Name', 'mp_people' ),
			'menu_name'           => __( 'People Groups', 'mp_people' ),
		); 	
  
		register_taxonomy(  
			'mp_people_groups',  
			'mp_people',  
			array(  
				'hierarchical' => true,  
				'label' => 'People Groups',  
				'labels' => $labels,  
				'query_var' => true,  
				'with_front' => false, 
				'rewrite' => array('slug' => 'people')  
			)  
		);  
}  
add_action( 'init', 'mp_people_person_group_taxonomy' );  

/**
 * Change default title
 */
function mp_people_change_default_title( $title ){
     $screen = get_current_screen();
 
     if  ( 'mp_people' == $screen->post_type ) {
          $title = __('Enter the Person\'s Name', 'mp_people');
     }
 
     return $title;
}
add_filter( 'enter_title_here', 'mp_people_change_default_title' );


/**
 * Person Taxonomy
 */
 
function mp_people_person_taxonomy() {  
		
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'                => __( 'Persons', 'mp_people' ),
			'singular_name'       => __( 'Person', 'mp_people' ),
			'search_items'        => __( 'Search Persons', 'mp_people' ),
			'all_items'           => __( 'All Persons', 'mp_people' ),
			'parent_item'         => __( 'Parent Person', 'mp_people' ),
			'parent_item_colon'   => __( 'Parent Person:', 'mp_people' ),
			'edit_item'           => __( 'Edit Person', 'mp_people' ), 
			'update_item'         => __( 'Update Person', 'mp_people' ),
			'add_new_item'        => __( 'Add New Person', 'mp_people' ),
			'new_item_name'       => __( 'New Person Name', 'mp_people' ),
			'menu_name'           => __( 'Persons', 'mp_people' ),
		); 	
  		
		//Filter to change the labels this taxonomy will have
		$mp_persons_labels = has_filter('mp_persons_labels') ? apply_filters( 'mp_persons_labels', $labels) : $labels;
		
		//Filter to change the type of posts this taxonomy will be used for
		$mp_persons_post_types = has_filter('mp_persons_post_types') ? apply_filters( 'mp_persons_post_types', array('post') ) : array('post');
	
	
		register_taxonomy(  
			'mp_person_tax',  
			$mp_persons_post_types,  
			array(  
				'hierarchical' => true,  
				'label' => 'Persons',  
				'labels' => $mp_persons_labels,  
				'query_var' => true,  
				'with_front' => false, 
				'rewrite' => array('slug' => 'person'),
				
			)  
		);  
}  
add_action( 'init', 'mp_people_person_taxonomy');  


/**
 * When this custom post type is saved, create a term in the mp_person_tax
 */
function mp_create_person_tax_term($post_id) {
  
    $slug = 'mp_people';
	$post_type = isset($_POST['post_type']) ? $_POST['post_type'] : NULL;
	
    if ( $slug !== $post_type ) {
        return;
    }
    if ( !current_user_can( 'edit_post', $post_id ) ) {
		return;
    }
	
	//var_dump( $_REQUEST );
	$nonce=$_REQUEST['_wpnonce'];
	if (!wp_verify_nonce( $nonce, 'update-post_' . $post_id) ){
		return;	
	}
   

    /* Request passes all checks; Insert */
    wp_insert_term(
		get_the_title($post_id), // the term 
		'mp_person_tax', // the taxonomy
		array(
			'description'=> get_the_content($post_id),
		)
	);	
}

add_action( 'save_post', 'mp_create_person_tax_term');
