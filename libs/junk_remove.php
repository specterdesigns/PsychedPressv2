<?php 
/**
 * remove really simple discovery link
 */
    remove_action('wp_head', 'rsd_link');

/**
 * remove link to index page
 */
    remove_action('wp_head', 'index_rel_link');

/**
 * remove random post link
 */
    remove_action('wp_head', 'start_post_rel_link', 10, 0);

/**
 * remove parent post link
 */
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);

/**
 * Remove inline style for font size from tag cloud
 */
		add_filter('wp_generate_tag_cloud', 'xf_tag_cloud', 10, 3);
			function xf_tag_cloud($tag_string)
				{
				    return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
				}
//unregister default wp_widgets
  function unregister_default_wp_widgets()
  {
      unregister_widget('WP_Widget_Pages');
      unregister_widget('WP_Widget_Calendar');
      unregister_widget('WP_Widget_Archives');
      unregister_widget('WP_Widget_Links');
      unregister_widget('WP_Widget_Meta');
      unregister_widget('WP_Widget_Search');
      unregister_widget('WP_Widget_Text');
      unregister_widget('WP_Widget_Categories');
      unregister_widget('WP_Widget_Recent_Posts');
      unregister_widget('WP_Widget_Recent_Comments');
      unregister_widget('WP_Widget_RSS');
      unregister_widget('WP_Widget_Tag_Cloud');
  }
  add_action('widgets_init', 'unregister_default_wp_widgets', 1);		

//REMOVE META BOXES FROM DEFAULT POSTS SCREEN
  function remove_default_post_screen_metaboxes()
  	{
      remove_meta_box('postcustom', 'post', 'normal'); // Custom Fields Metabox
      remove_meta_box('postexcerpt', 'post', 'normal'); // Excerpt Metabox
      remove_meta_box('commentstatusdiv', 'post', 'normal'); // Comments Metabox
      remove_meta_box('trackbacksdiv', 'post', 'normal'); // Talkback Metabox
      remove_meta_box('slugdiv', 'post', 'normal'); // Slug Metabox
      remove_meta_box('authordiv', 'post', 'normal'); // Author Metabox
  	}
  add_action('admin_menu', 'remove_default_post_screen_metaboxes');

//REMOVE META BOXES FROM DEFAULT PAGES SCREEN
  function remove_default_page_screen_metaboxes()
  	{
      global $post_type;
      remove_meta_box('postcustom', 'page', 'normal'); // Custom Fields Metabox
      remove_meta_box('postexcerpt', 'page', 'normal'); // Excerpt Metabox
      remove_meta_box('commentstatusdiv', 'page', 'normal'); // Comments Metabox
      remove_meta_box('commentsdiv', 'page', 'normal'); // Comments
      remove_meta_box('trackbacksdiv', 'page', 'normal'); // Talkback Metabox
      remove_meta_box('slugdiv', 'page', 'normal'); // Slug Metabox
      remove_meta_box('authordiv', 'page', 'normal'); // Author Metabox
  	}
  add_action('admin_menu', 'remove_default_page_screen_metaboxes');	

//junk
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'index_rel_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'start_post_rel_link', 10, 0);
  remove_action('wp_head', 'parent_post_rel_link', 10, 0);
  remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
?>