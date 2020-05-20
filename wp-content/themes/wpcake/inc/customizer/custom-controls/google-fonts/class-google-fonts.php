<?php
/**
 * Google Font Select Custom Control
 *
 * @author Anthony Hortin <http://maddisondesigns.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @link https://github.com/maddisondesigns
 */
class WPCake_Google_Font_Select_Custom_Control extends WP_Customize_Control {
  /**
   * The type of control being rendered
   */
  public $type = 'google_fonts';
  /**
   * The list of Google Fonts
   */
  private $fontList = false;
  /**
   * The saved font values decoded from json
   */
  private $fontValues = [];
  /**
   * The index of the saved font within the list of Google fonts
   */
  private $fontListIndex = 0;
  /**
   * The number of fonts to display from the json file. Either positive integer or 'all'. Default = 'all'
   */
  private $fontCount = 'all';
  /**
   * The font list sort order. Either 'alpha' or 'popular'. Default = 'alpha'
   */
  private $fontOrderBy = 'popular';
  /**
   * Get our list of fonts from the json file
   */
  public function __construct( $manager, $id, $args = array(), $options = array() ) {
    parent::__construct( $manager, $id, $args );
    // Get the font sort order
    if ( isset( $this->input_attrs['orderby'] ) && strtolower( $this->input_attrs['orderby'] ) === 'popular' ) {
      $this->fontOrderBy = 'popular';
    }
    // Get the list of Google fonts
    if ( isset( $this->input_attrs['font_count'] ) ) {
      if ( 'all' != strtolower( $this->input_attrs['font_count'] ) ) {
        $this->fontCount = ( abs( (int) $this->input_attrs['font_count'] ) > 0 ? abs( (int) $this->input_attrs['font_count'] ) : 'all' );
      }
    }
    $this->fontList = $this->wpcake_getGoogleFonts( 'all' );
    // Decode the default json font value
    $this->fontValues = json_decode( $this->value() );
    // Find the index of our default font within our list of Google fonts
    $this->fontListIndex = $this->wpcake_getFontIndex( $this->fontList, $this->fontValues->font );

  }
  /**
   * Enqueue our scripts and styles
   */
  public function enqueue() {
    wp_enqueue_script( 'wpcake-select2-js', trailingslashit( get_template_directory_uri() ) . 'assets/js/select2.min.js', array( 'jquery' ), '4.0.6', true );
    wp_enqueue_script( 'wpcake-custom-controls-js', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/custom-controls/google-fonts/google-fonts.js', array( 'wpcake-select2-js' ), WPCAKE_THEME_VERSION, true );
    wp_enqueue_style( 'wpcake-custom-controls-css', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/custom-controls/google-fonts/google-fonts.css', array(), WPCAKE_THEME_VERSION, 'all' );
    wp_enqueue_style( 'wpcake-select2-css', trailingslashit( get_template_directory_uri() ) . 'assets/css/select2.min.css', array(), '4.0.6', 'all' );
  }
  /**
   * Export our List of Google Fonts to JavaScript
   */
  public function to_json() {
    parent::to_json();
    $this->json['wpcakefontslist'] = $this->fontList;
  }
  /**
   * Render the control in the customizer
   */
  public function render_content() {
    $fontCounter = 0;
    $isFontInList = false;
    $fontListStr = '';

    if( !empty($this->fontList) ) {
      ?>
      <div class="google_fonts_select_control">
        <?php if( !empty( $this->label ) ) { ?>
          <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php } ?>
        <?php if( !empty( $this->description ) ) { ?>
          <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
        <?php } ?>
        <input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-google-font-selection" <?php esc_url($this->link()); ?> />
        <div class="google-fonts">
          <select class="google-fonts-list" control-name="<?php echo esc_attr( $this->id ); ?>">
            <?php

              foreach( $this->fontList as $key => $value ) {
                $fontCounter++;
                $fontListStr .= '<option value="' . esc_attr($value->family) . '" ' . selected( $this->fontValues->font, $value->family, false ) . '>' . esc_html($value->family) . '</option>';
                if ( $this->fontValues->font === $value->family ) {
                  $isFontInList = true;
                }
                if ( is_int( $this->fontCount ) && $fontCounter === $this->fontCount ) {
                  break;
                }
              }
              if ( !$isFontInList && $this->fontListIndex ) {
                // If the default or saved font value isn't in the list of displayed fonts, add it to the top of the list as the default font
                $fontListStr = '<option value="' . esc_attr($this->fontList[$this->fontListIndex]->family) . '" ' . selected( $this->fontValues->font, $this->fontList[$this->fontListIndex]->family, false ) . '>' . esc_html($this->fontList[$this->fontListIndex]->family) . ' (default)</option>' . $fontListStr;
              }
              // Display our list of font options
              $allowed_html = array(
                  'option' => array(
                      'value' => array(),
                      'selected' => array()
                  ),
              );
              echo wp_kses($fontListStr, $allowed_html);

            ?>
          </select>
        </div>
        <div class="customize-control-description">Select weight &amp; style for regular text</div>
        <div class="weight-style">
          <select class="google-fonts-regularweight-style">
            <?php
              foreach( $this->fontList[$this->fontListIndex]->variants as $key => $value ) {
                echo '<option value="' . esc_attr($value) . '" ' . selected( $this->fontValues->regularweight, $value, false ) . '>' . esc_html($value) . '</option>';
              }
            ?>
          </select>
        </div>
        <input type="hidden" class="google-fonts-category" value="<?php echo esc_attr( $this->fontValues->category ); ?>">
      </div>
      <?php
    }
  }

  /**
   * Find the index of the saved font in our multidimensional array of Google Fonts
   */
  public function wpcake_getFontIndex( $haystack, $needle ) {
    if(!empty($haystack)) {
      foreach( $haystack as $key => $value ) {
        if( $value->family == $needle ) {
          return $key;
        }
      }
    }
    return false;
  }

  /**
   * Return the list of Google Fonts from our json file. Unless otherwise specfied, list will be limited to 30 fonts.
   */
  public function wpcake_getGoogleFonts( $count = 30 ) {
    // Google Fonts json generated from https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=YOUR-API-KEY
    $fontFile = trailingslashit( get_template_directory_uri() ) . 'assets/fonts/google-fonts-alphabetical.json';
    if ( $this->fontOrderBy === 'popular' ) {
      $fontFile = trailingslashit( get_template_directory_uri() ) . 'assets/fonts/google-fonts-popularity.json';
    }

    $request = wp_remote_get( $fontFile );
    if( is_wp_error( $request ) ) {
      return "";
    }

    $body = wp_remote_retrieve_body( $request );
    $content = json_decode( $body );

    if( $count == 'all' ) {
      return $content->items;
    } else {
      return array_slice( $content->items, 0, $count );
    }
  }
}
