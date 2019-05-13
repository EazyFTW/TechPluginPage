<?php

function onPageInitialization(){
  createUpdatePostType();
  createWikiPostType();
  createDefaultPages();
  setCustomPermalink();
}

function getCSSOverwrites() {
  ob_start();

  $text_color = get_theme_mod('theme_color', '#000000');
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

function getAdminPanelCSS(){
  $cssFile = get_bloginfo('template_directory')."/style_acp.css";
  echo '<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">';
  echo '<link rel="stylesheet" type="text/css" href="'.$cssFile.'">';
}

function setCustomPermalink(){
  global $wp_rewrite;
  $wp_rewrite->set_permalink_structure('/%postname%/');
  $wp_rewrite->flush_rules();
  flush_rewrite_rules();
}

function createDefaultPages(){
  $overview = get_page_by_title('Overview');

  if($overview == NULL){
    $overview = createPage('Overview', 1);
  }

  if(get_page_by_title('Updates') == NULL){
    createPage('Updates', 2);
  }

  if(get_page_by_title('Wiki') == NULL){
    createPage("Wiki", 3);
  }

  if(get_page_by_title('Discord') == NULL){
    createPage("Discord", 4);
  }

  if(get_page_by_title('Sample Page') != NULL){
    removePage('sample-page');
  }

  if(get_page_by_title("Privacy Policy") != NULL){
    removePage('privacy-policy');
  }

  // Overwrite Frontpage Setting
  update_option( 'page_on_front', $overview->ID );
  update_option( 'show_on_front', 'page' );
}

function createPage($pageName, $order){
  $createPage = array(
    'post_title'    => $pageName,
    'post_content'  => '',
    'post_status'   => 'publish',
    'post_author'   => 1,
    'post_type'     => 'page',
    'post_name'     => $pageName,
    'menu_order'    => $order
  );

  wp_insert_post($createPage);
}

function removePage($pageName){
  $page = get_page_by_path($pageName);
  $pageId = $page->ID;
  wp_delete_post($pageId, true);
}

function createUpdatePostType() {
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
    'has_archive'       => false,
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

function createWikiPostType(){
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
    'has_archive'       => false,
    'menu_icon'       => 'dashicons-book-alt',
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'has_archive'       => false,
    'show_in_rest' => false,
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

add_action('init', 'onPageInitialization', 0);
add_action('wp_enqueue_scripts', 'registerOverwrites' );
add_action('customize_register', 'registerCustomizer' );
add_action('admin_head', 'getAdminPanelCSS');
add_filter('use_block_editor_for_post', '__return_false');

remove_action('rest_api_init', 'wp_oembed_register_route');

 // Disabling oEmbeds
add_filter( 'embed_oembed_discover', '__return_false' );
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
