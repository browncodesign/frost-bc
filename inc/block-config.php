<?php
/**
 * Block config file
 */

/**
 * Only allow specific native blocks
 *
 * @link https://developer.wordpress.org/news/2024/01/how-to-disable-specific-blocks-in-wordpress/
 */
function bc_native_block_allow( $allowed_block_types, $block_editor_context ) {
  $allowed_block_types = array(
    'core/audio',
    'core/buttons',
    'core/code',
    'core/embed',
    'core/gallery',
    'core/heading',
    'core/image',
    'core/list',
    'core/paragraph',
    'core/pullquote',
    'core/quote',
    'core/search',
    'core/separator',
    'core/spacer',
    'core/subhead',
    'core/table',
  );
  return $allowed_block_types;
}
add_filter( 'allowed_block_types_all', 'bc_native_block_allow', 10, 2 );


/**
 * Register ACF blocks
 */
function bc_register_acf_blocks() {
  /*
  Testimonial Block
   */
  register_block_type( get_template_directory() . '/blocks/testimonial' );
}
add_action( 'init', 'bc_register_acf_blocks' );
