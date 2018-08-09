<?php
//theme support
function psyched_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails', array('post', 'page'));
    add_theme_support('html5');
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'psyched_setup');

//theme support
if (!class_exists('ReduxFramework') && file_exists(dirname(__FILE__) . '/libs/framework/ReduxCore/framework.php')) {
    require_once dirname(__FILE__) . '/libs/framework/ReduxCore/framework.php';
}
if (!isset($redux_owd) && file_exists(dirname(__FILE__) . '/libs/framework/admin/thm_opts.php')) {
    require_once dirname(__FILE__) . '/libs/framework/admin/thm_opts.php';
}

//upload size
@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '300');

//import of tweaks, enqueue script & styles
require_once 'libs/asset-loader.php';
require_once 'libs/admin.php';
require_once 'libs/junk_remove.php';
require_once 'libs/register-plugins.php';
require_once 'libs/bfi_thumb.php';
require_once 'libs/cmb/metabox_functions.php';
require_once 'libs/post-type.php';
require_once 'libs/custom-admin-welcome.php';
require_once 'libs/tinymce/tinymce-advanced.php';

//End to Automatic JPEG Compression
  add_filter('jpeg_quality', 'smashing_jpeg_quality');
  function smashing_jpeg_quality()
    {
      return 100;
    }

//Remove width/height HTML attributes from images
function remove_image_size_atts($html)
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}
add_filter('post_thumbnail_html', 'remove_image_size_atts', 10);
add_filter('image_send_to_editor', 'remove_image_size_atts', 10);

//Sharpen JPG/JPEG images when auto-resized in Wordpress
function sharpen_resized_jpeg_images($resized_file)
{
    $image = wp_load_image($resized_file);
    if (!is_resource($image)) {
        return new WP_Error('error_loading_image', $image, $file);
    }
    $size = @getimagesize($resized_file);
    if (!$size) {
        return new WP_Error('invalid_image', __('Could not read image size'), $file);
    }
    list($orig_w, $orig_h, $orig_type) = $size;
    switch ($orig_type) {
        case IMAGETYPE_JPEG:
            $matrix = array(
                array(-1, -1, -1),
                array(-1, 16, -1),
                array(-1, -1, -1),
            );
            $divisor = array_sum(array_map('array_sum', $matrix));
            $offset = 0;
            imageconvolution($image, $matrix, $divisor, $offset);
            imagejpeg($image, $resized_file, apply_filters('jpeg_quality', 90, 'edit_image'));
            break;
        case IMAGETYPE_PNG:
            return $resized_file;
        case IMAGETYPE_GIF:
            return $resized_file;
    }
    return $resized_file;
}
add_filter('image_make_intermediate_size', 'sharpen_resized_jpeg_images', 900);

//Add support for uploading SVG inside Wordpress Media Uploader
function svg_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'svg_mime_types');

//Remove p tag from around images in the_content
function filter_ptags_on_images($content)
{
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

//Menu
function register_my_menu()
{
    register_nav_menu('primary-menu', __('Primary Menu'));
    register_nav_menu('secondary-menu', __('Secondary Menu'));
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('init', 'register_my_menu');

//slice crazy long div outputs
function category_id_class($classes)
{
    global $post;
    foreach ((get_the_category($post->ID)) as $category) {
        $classes[] = $category->category_nicename;
    }

    return array_slice($classes, 0, 5);
}
add_filter('post_class', 'category_id_class');

//Security Fixes
add_filter('login_errors', create_function('$a', "return null;"));
