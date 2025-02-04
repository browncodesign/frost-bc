<?php
/**
 * Core setup file
 */

if ( ! function_exists( 'frost_setup' ) ) {

  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   *
   * @since 0.8.0
   *
   * @return void
   */
  function frost_setup() {

    // Make theme available for translation.
    load_theme_textdomain( 'frost', get_template_directory() . '/languages' );

    // Enqueue editor stylesheet.
    add_editor_style( get_template_directory_uri() . '/style.css' );

    // Remove core block patterns.
    remove_theme_support( 'core-block-patterns' );

  }
}
add_action( 'after_setup_theme', 'frost_setup' );

// Enqueue stylesheet.
add_action( 'wp_enqueue_scripts', 'frost_enqueue_stylesheet' );
function frost_enqueue_stylesheet() {

  wp_enqueue_style( 'frost', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );

}

/**
 * Register block styles.
 *
 * @since 0.9.2
 */
function frost_register_block_styles() {

  $block_styles = array(
    'core/columns' => array(
      'columns-reverse' => __( 'Reverse', 'bc' ),
    ),
    'core/group' => array(
      'shadow-light' => __( 'Shadow', 'bc' ),
      'shadow-solid' => __( 'Solid', 'bc' ),
    ),
    'core/list' => array(
      'no-disc' => __( 'No Disc', 'bc' ),
    ),
    'core/quote' => array(
      'shadow-light' => __( 'Shadow', 'bc' ),
      'shadow-solid' => __( 'Solid', 'bc' ),
    ),
    'core/social-links' => array(
      'outline' => __( 'Outline', 'bc' ),
    ),
  );

  foreach ( $block_styles as $block => $styles ) {
    foreach ( $styles as $style_name => $style_label ) {
      register_block_style(
        $block,
        array(
          'name'  => $style_name,
          'label' => $style_label,
        )
      );
    }
  }
}
add_action( 'init', 'frost_register_block_styles' );

/**
 * Register block pattern categories.
 *
 * @since 1.0.4
 */
function frost_register_block_pattern_categories() {

  register_block_pattern_category(
    'frost-page',
    array(
      'label'       => __( 'Page', 'bc' ),
      'description' => __( 'Create a full page with multiple patterns that are grouped together.', 'bc' ),
    )
  );
  register_block_pattern_category(
    'frost-pricing',
    array(
      'label'       => __( 'Pricing', 'bc' ),
      'description' => __( 'Compare features for your digital products or service plans.', 'bc' ),
    )
  );

}

add_action( 'init', 'frost_register_block_pattern_categories' );


/**
 * Enqueue scripts and styles.
 */
function bc_styles_scripts() {
  wp_enqueue_style( 'base-css', get_template_directory_uri() . '/assets/css/base.css', array(), filemtime( get_template_directory() . '/assets/css/base.css' ) );
  wp_enqueue_style( 'client-css', get_template_directory_uri() . '/assets/css/client.css', array(), filemtime( get_template_directory() . '/assets/css/client.css' ) );
}
add_action( 'wp_enqueue_scripts', 'bc_styles_scripts' );


/**
 * Load block restrict script
 */
function bc_restrict_blocks_script() {
  $script_file = '/assets/js/restrict-blocks.js';

  wp_enqueue_script( 'restrict-blocks',
    get_template_directory_uri() . $script_file,
    array( 'wp-edit-post', 'wp-blocks', 'wp-dom-ready' ),
    filemtime( get_template_directory() . $script_file )
  );
}
add_action( 'enqueue_block_editor_assets', 'bc_restrict_blocks_script' );
