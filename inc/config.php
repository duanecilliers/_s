<?php

/**
 * Configuration values
 */
if ( !defined( 'WP_ENV' ) ) {
  // Fallback if WP_ENV isn't defined in your WordPress config
  // Used in lib/assets.php to check for 'development' or 'production'
  define( 'WP_ENV', 'production' );
}

/**
 * Define which pages shouldn't have the sidebar
 */
function _s_display_sidebar() {
  static $display;
  if ( !isset( $display ) ) {
    $conditionalCheck = new ConditionalTagCheck(
      /**
       * Any of these conditional tags that return true won't show the sidebar.
       * You can also specify your own custom function as long as it returns a boolean.
       *
       * To use a function that accepts arguments, use an array instead of just the function name as a string.
       *
       * Examples:
       *
       * 'is_single'
       * 'is_archive'
       * array( 'is_page', 'about-me' )
       * array( 'is_tax', array( 'flavor', 'mild') )
       * array( 'is_page_template', 'about.php' )
       * array( 'is_post_type_archive', array( 'foo', 'bar', 'baz') )
       *
       */
      array(
        'is_404',
        'is_front_page',
        array( 'is_page_template', 'template-custom.php' )
      )
    );
    $display = apply_filters( '_s/display_sidebar', $conditionalCheck->result );
  }
  return $display;
}
