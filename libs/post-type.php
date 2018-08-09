<?php

/*-----------------------------------------------------------------------------------*/
/*	Ebooks Post Type
/*-----------------------------------------------------------------------------------*/

	add_action( 'init', 'ebook_type' );

	function ebook_type() {

		$labels = array(
			'name' 					=> __('Ebooks'),
			'singular_name' 		=> __('Ebook'),
			'add_new' 				=> __('Add Ebook'), __('ebook'),
			'add_new_item' 		=> __('Ebook'),
			'edit_item' 			=> __('Edit Ebook'),
			'new_item'				=> __('New Ebook'),
			'view_item' 			=> __('View Ebook'),
			'search_items' 		=> __('Search Ebooks'),
			'not_found' 			=> __('No Ebooks found'),
			'not_found_in_trash' => __('No Ebooks found in Trash'),
			'parent_item_colon' 	=> ''
		);

		$supports = array( 'title','editor','thumbnail','categories','page-attributes');

		register_post_type( 'ebook',
			array(
				'labels' => $labels,
				'public' => true,
				'menu_position' => 5,
				'hierarchical' => false,
				'supports' => $supports,
				'taxonomies'=> array('category'),
				'menu_icon' => 'dashicons-book',
				'rewrite' => array( 'slug' => __('ebook') ),
				'menu_position' => 40,
				'exclude_from_search' => true,  
			)
		);

		flush_rewrite_rules();
	}
	function doctor_edit_columns($columns){

		  $columns = array(
				"cb" => "<input type=\"checkbox\" />",
				"thumb" => __( 'Thumbnail', 'FitCookingClub' ),
				"title" => __( 'Book Title', 'FitCookingClub' ),
				"id" => __( 'Book ID', 'FitCookingClub' ),
				"featured" => __( 'Shown On Featured', 'FitCookingClub' ),
				"date" => __( 'Publish Time', 'FitCookingClub' )
		  );

		  return $columns;
	 }
	
	add_filter("manage_edit-doctor_columns", "doctor_edit_columns");
	
	function doctor_custom_columns($column){
		  global $post;
		  switch ($column) {
				case 'thumb':
					 if(has_post_thumbnail($post->ID)){
						  $image_id = get_post_thumbnail_id();
						  $image_url = wp_get_attachment_url($image_id);
						  ?>
						  <a href="<?php the_permalink(); ?>" target="_blank">
							  <img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" width="80">
						  </a>
					 <?php
					}
				break;

				case 'id':
					 echo $post->ID;
					 break;
				case 'featured':
					$terms = get_the_terms( $post->ID , 'doctor_category' );
						foreach ( $terms as $term ) {
							$term_link = get_term_link( $term, 'Taxonomy Name' );
							echo "<a href='".get_site_url().'wp-admin/edit.php?category_name='.$term->name."'>" . $term->name . "</a>, ";
						}
					break;
		  }
	 }

	add_action("manage_posts_custom_column",  "doctor_custom_columns");
/*-----------------------------------------------------------------------------------*/
/*	Taxonomy
/*-----------------------------------------------------------------------------------*/

	add_action( 'init', 'build_taxonomies');

	function build_taxonomies() {

		/* Ebook Taxonomy */

			$doctor_labels = array(
				'name' => __('Location'),
				'singular_name' => __('Location'),
				'search_items' => __('Search Location'),
				'all_items' => __('All Location'),
				'parent_item' => __('Parent Location'),
				'parent_item_colon' =>__('Parent Location:'),
				'edit_item' => __('Edit Location'),
				'update_item' => __('Update Location'),
				'add_new_item' => __('Add New Location'),
				'new_item_name' => __('Location Name'),
				'menu_name' => __('Location')
			);

			register_taxonomy(
				'doctor_category',
				'doctor',				
				array(
					'hierarchical' => true,
					'labels' => $doctor_labels,
					'query_var' => true,
					'rewrite' => array( 'slug' => __('doctors') )
				)
			);

		flush_rewrite_rules();
	}

?>