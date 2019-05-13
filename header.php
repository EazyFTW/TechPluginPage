<?php

function localFile($path){
  return get_bloginfo('template_directory')."/".$path;
}

?>

<html <?php language_attributes(); ?> class="no-js">

  <head>
    <title><?php echo (is_front_page() ? "Overview" : wp_title(''))." - ".get_bloginfo( 'name' ); ?></title>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta property="og:site_name" value="<?php echo get_bloginfo( 'name' ); ?>">
    <meta property="og:title" content="<?php echo (is_front_page() ? "Overview" : wp_title('')); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo get_site_url(); ?>" />
    <meta property="og:image" content="<?php echo esc_url(get_theme_mod( 'icon', 'https://via.placeholder.com/500x500.png?text=Plugin+Icon')); ?>" />
    <meta property="og:description" content="<?php echo get_bloginfo('description');?>" />
    <meta name="theme-color" content="<?php echo get_theme_mod('theme_color', '#000000');?>">

    <link rel="shortcut icon" href="<?php echo esc_url(get_theme_mod( 'icon', 'https://via.placeholder.com/500x500.png?text=Plugin+Icon')); ?>" />

    <?php
    wp_head();

    require("techscodeapi.php");
    ?>

    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
  </head>

  <body>
    <div class="wrapper">
      <div class="topbar">
        <img href="http://techsco.de" class="logo" src="<?php echo localFile('logo.png'); ?>">
        <div class="purchaseWrapper">
          <p class="purchaseCount"><?php echo $apiRunning ? count($purchases)." Buyers" : "API Offline"; ?></p>
          <a href="https://www.spigotmc.org/resources/<?php echo $resourceId; ?>/purchase" class="purchase">Click to purchase</a>
        </div>
      </div>

      <img class="header" src="<?php echo esc_url(get_theme_mod( 'header', 'https://via.placeholder.com/700x257.png?text=Insert+Header+Image+Here')); ?>">

      <ul class="navigation">
        <?php
        $copyMode = isset($_GET['copyMode']);

        if(!$copyMode){
          wp_list_pages( '&title_li=' );
        }
        ?>
      </ul>
