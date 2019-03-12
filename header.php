<?php

function localFile($path){
  return get_bloginfo('template_directory')."/".$path;
}

?>

<html <?php language_attributes(); ?> class="no-js">

  <head>
    <title><?php echo (is_front_page() ? "Overview" : wp_title(''))." - ".get_bloginfo( 'name' ); ?></title>
    <meta charset="<?php bloginfo( 'charset' ); ?>">

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

      <img class="header" src="<?php echo esc_url( get_theme_mod( 'header' ) ); ?>">

      <ul class="navigation">
        <?php wp_list_pages( '&title_li=' ); ?>
      </ul>
