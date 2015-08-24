<?php

function _s_template_path() {
  return _S_Wrapper::$main_template;
}

function _s_sidebar_path() {
  return new _S_Wrapper( 'template-parts/sidebar.php' );
}

class _S_Wrapper {

  // stores the full page to the main template file
  public static $main_template;

  // basename of template file
  public $slug;

  // array of templates
  public $templates;

  // stores the base name of the template file; eg: 'page' for page.php etc.
  public static $base;

  public function __construct( $template = 'base.php' ) {
    $this->slug = basename( $template, '.php' );
    $this->templates = array( $template );

    if ( self::$base ) {
      $str = substr( $template, 0, -4 );
      array_unshift( $this->templates, sprintf( $str . '-%s.php', self::$base ) );
    }
  }

  public function __toString() {
    $this->templates = apply_filters( '_s_wrap' . $this->slug, $this->templates );
    return locate_template( $this->templates );
  }

  public static function wrap( $main ) {
    // check for other filters returning null
    if ( !is_string( $main ) ) {
      return $main;
    }

    self::$main_template = $main;
    self::$base = basename( self::$main_template, '.php' );

    if ( self::$base === 'index.php' ) {
      self::$base = false;
    }

    return new _S_Wrapper();
  }

}

add_filter( 'template_include', array( '_S_Wrapper', 'wrap'), 99 );
