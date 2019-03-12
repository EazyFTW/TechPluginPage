<?php

# Remove Default Settings
$wp_customize -> remove_control( 'blogdescription' );
$wp_customize -> remove_control( 'custom_css' );
$wp_customize -> remove_section( 'static_front_page' );

addSection($wp_customize, "Visual Settings", "general");
addSection($wp_customize, "API Settings", "api_settings");

addImageSetting($wp_customize, "general", "Plugin Header", "header", get_template_directory_uri() . 'default_header.png');
addColorSetting($wp_customize, "general", "Theme Color", "theme_color", "#000000");

addUrlSetting($wp_customize, "api_settings", "API Url", "api_url", "http://api.techsco.de");
addStringSetting($wp_customize, "api_settings", "API Token", "api_token", "api-token");
addStringSetting($wp_customize, "api_settings", "Resource ID", "resource_id", "resource-id");

function addSection($wp_customize, $title, $key){
  $wp_customize->add_section($key, array(
   'title'      => __($title, 'techpluginpage'),
   'priority'   => 30)
  );
}

function addStringSetting($wp_customize, $section, $title, $key, $default){
  $wp_customize->add_setting($key, array(
  	 'default'           =>  $default,
  	 'sanitize_callback' => 'sanitize_text_field')
   );

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, $key, array(
  	        'label'    => __( $title, 'techpluginpage' ),
  	        'section'  => $section,
  	        'settings' => $key,
  	        'type'     => 'text'
  	    )
      )
  );
}

function addUrlSetting($wp_customize, $section, $title, $key, $default){
  $wp_customize->add_setting( $key, array(
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
  ) );

  $wp_customize->add_control( $key, array(
    'type' => 'url',
    'section' => $section,
    'label' => __( $title),
    'description' => __( 'Put in a valid url' ),
    'input_attrs' => array(
      'placeholder' => __( $default ),
    ),
  ) );
}

function addColorSetting($wp_customize, $section, $title, $key, $default){
  $wp_customize->add_setting($key , array(
    'default'   => $default,
    'transport' => 'refresh')
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, $key, array(
      'label'      => __( $title, 'techpluginpage' ),
      'section'    => $section,
      'settings'   => $key)
    )
  );
}

function addImageSetting($wp_customize, $section, $title, $key, $default){
  $wp_customize->add_setting($key, array(
        'default-image' => $default,
        'transport'     => 'refresh',
        'height'        => 257,
        'width'        => 700,
    ));

    $wp_customize->add_control(
         new WP_Customize_Image_Control(
             $wp_customize,
             $key,
             array(
                 'label'      => __($title, 'techpluginpage' ),
                 'section'    => $section,
                 'settings'   => $key
             )
         )
     );
}

 ?>
