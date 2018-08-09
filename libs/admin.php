<?php 
//Removes Admin Bar
  add_filter('show_admin_bar', '__return_false');
// Removes Update Notifaction
  function wp_hide_update()
  {
      remove_action('admin_notices', 'update_nag', 3);
  }
  add_action('admin_menu', 'wp_hide_update');

//Remove the version number of WP
  remove_action('wp_head', 'wp_generator');

//Custom admin footer text
  function custom_admin_footer()
  	{
      echo 'The Site is Designed and Developed by <a href="http://www.specterdesigns.io/" target="_blank">Specter Designs</a>';
  	}
  add_filter('admin_footer_text', 'custom_admin_footer');

//Change admin post/page color by status – draft, pending, published, future, private
  function posts_status_color()
	  {?>
			<style>
				.status-draft{background: #FCE3F2 !important;}
				.status-pending{background: #87C5D6 !important;}
				.status-publish{/* no background keep wp alternating colors */}
				.status-future{background: #C6EBF5 !important;}
				.status-private{background:#F2D46F;}
			</style>
		<?php }
  add_action('admin_footer', 'posts_status_color');
//Remove unwanted dashboard items
	add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
	function my_custom_dashboard_widgets()
	{
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	}
//set the default editor to HTML
  add_filter('wp_default_editor', create_function('', 'return "html";'));

//Replace WP Admin Logo
function my_custom_login_logo()
  {
      echo '<style  type="text/css"> h1 a {  background-image:url("https://cdn.churchm.ag/wp-content/uploads/2011/06/wptuts-logo.png")  !important; } </style>';
  }
  add_action('login_head',  'my_custom_login_logo');

//Remove Activity Feed
function remove_activity_dashboard_widget() {
    remove_meta_box( 'dashboard_activity', 'dashboard', 'side' );
} 
add_action('wp_dashboard_setup', 'remove_activity_dashboard_widget' );
?>