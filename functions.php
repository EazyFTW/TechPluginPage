<?php


function getCSSOverwrites() {
  ob_start();

  $text_color = get_theme_mod( 'theme_color', '' );
  if ( ! empty( $text_color ) ) {
    ?>

    * {
      --theme-color: <?php echo $text_color; ?>;
    }

    <?php
  }

  $css = ob_get_clean();
  return $css;
}

function registerUpdateType() {
  $labels = array(
    'name'               => __( 'Updates' ),
    'singular_name'      => __( 'Update' ),
    'add_new'            => __( 'Add New Update' ),
    'add_new_item'       => __( 'Add New Update' ),
    'edit_item'          => __( 'Edit Update' ),
    'new_item'           => __( 'New Update' ),
    'all_items'          => __( 'All Updates' ),
    'view_item'          => __( 'View Update' ),
    'search_items'       => __( 'Search Updates' ),
    'featured_image'     => 'Cover',
    'set_featured_image' => 'Add Cover'
  );

  $args = array(
    'labels'            => $labels,
    'description'       => 'Holds all informations regarding an update',
    'public'            => true,
    'menu_position'     => 5,
    'supports'          => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields' ),
    'has_archive'       => true,
    'menu_icon'       => 'dashicons-update',
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'has_archive'       => false,
    'show_in_rest' => false,
    'query_var'         => 'update'
  );

  register_post_type( 'update', $args);

  register_taxonomy(
      'tags',
      'update',
      array(
          'hierarchical' => false,
          'label' => 'Tags',
          'query_var' => true,
          'rewrite' => true
      )
  );
}

function registerWikiPageType(){
  $labels = array(
    'name'               => __( 'Wiki Pages' ),
    'singular_name'      => __( 'Wiki Page' ),
    'add_new'            => __( 'Add New Wiki Page' ),
    'add_new_item'       => __( 'Add New Wiki Page' ),
    'edit_item'          => __( 'Edit Wiki Page' ),
    'new_item'           => __( 'New Wiki Page' ),
    'all_items'          => __( 'All Wiki Pages' ),
    'view_item'          => __( 'View Wiki Page' ),
    'search_items'       => __( 'Search Wiki Pages' ),
    'featured_image'     => 'Cover',
    'set_featured_image' => 'Add Cover'
  );

  $args = array(
    'labels'            => $labels,
    'description'       => 'Holds informations about a certain topic',
    'public'            => true,
    'menu_position'     => 5,
    'supports'          => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields' ),
    'has_archive'       => true,
    'menu_icon'       => 'dashicons-book-alt',
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'has_archive'       => false,
    'show_in_rest' => true,
    'query_var'         => 'wiki'
  );

  register_post_type( 'wiki', $args);
}

function registerOverwrites() {
  wp_enqueue_style( 'theme-styles', get_stylesheet_uri());
  wp_add_inline_style( 'theme-styles', getCSSOverwrites());
}

function registerCustomizer( $wp_customize ) {
  require("customizer.php");
}

add_action( 'init', 'registerUpdateType', 0);
add_action( 'init', 'registerWikiPageType', 0);
add_action( 'wp_enqueue_scripts', 'registerOverwrites' );
add_action( 'customize_register', 'registerCustomizer' );
