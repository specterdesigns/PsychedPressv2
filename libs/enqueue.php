<?php  

/**
 * Enqueue styles.
 */
function theme_name_style(){
	wp_enqueue_style('main', get_template_directory_uri() . '/css/style.css');
}
add_action('wp_enqueue_scripts', 'theme_name_style');

/**
 * Enqueue styles.
 */
function theme_name_js(){
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', '', '' , true );
}
add_action('wp_enqueue_scripts', 'theme_name_js');

?>