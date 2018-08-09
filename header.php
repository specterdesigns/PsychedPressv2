<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!--><html><!--<![endif]-->
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?php
      if ( ! function_exists( '_wp_render_title_tag' ) ) :
      function theme_slug_render_title() {
    ?>
      <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php
        }
        add_action( 'wp_head', 'theme_slug_render_title' );
        endif;
    ?>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type');?>; charset=<?php bloginfo('charset');?>">
    <link rel="" href="" type="image/vnd.microsoft.icon">
    <?php wp_head();?>
  </head>
  <header>
    <nav>
      <?php
				wp_nav_menu(array(
					'theme_location' => 'Primary Menu',
					'menu_id' => 'primary-menu',
				));
			?>
    </nav>
  </header>
  <body <?php body_class();?>>
