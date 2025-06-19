<?php
/*
Plugin Name: MyBooking CPT Performances
Description: Plugin para gestionar el CPT Performances para representar excusiones o tours.
Text Domain: mybooking-cpt-performances
Domain Path: /languages
*/

defined( 'ABSPATH' ) || exit;

// Cargar archivos necesarios
require_once 'class-mybooking-cpt-performances-cpt.php';
require_once 'class-mybooking-cpt-performances-shortcode.php';

/**
 * Clase MyBooking_CPT_Performances
 *
 * Esta clase se encarga de registrar los Custom Post Types y cualquier funcionalidad adicional del plugin.
 */
class MyBooking_CPT_Performances {

    /**
     * Constructor de la clase.
     */
    public function __construct() {
      // Inicializar CPT y metabox
      add_action( 'init', ['MyBooking_CPT_Performances_CPT', 'init'], 0 );
      add_action( 'add_meta_boxes', ['MyBooking_CPT_Performances_CPT', 'add_metabox'] );
      add_action( 'save_post', ['MyBooking_CPT_Performances_CPT', 'save_metabox'] );

      // Encolar estilos y scripts para el metabox de la galería en el admin
      add_action( 'admin_enqueue_scripts', [$this, 'enqueue_admin_gallery_styles_scripts'] );
      // Encolar estilos y scripts para la galería en el frontend
      add_action( 'wp_enqueue_scripts', [$this, 'enqueue_gallery'] );

      // Inicializar shortcode
      add_action( 'init', ['MyBooking_CPT_Performances_Shortcode', 'register'] );

      // Cargar traducciones
      add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

      // Registrar sidebars
      add_action( 'widgets_init', array( $this, 'register_sidebars' ) );

      // Compatibility with MyBooking Reservation Engine
      add_filter( 'body_class', array( $this, 'add_body_class' ) );
      add_action( 'wp_footer',  array( $this, 'include_micro_templates' ) );
    }

    /**
     * Carga el dominio de texto del plugin para las traducciones.
     */
    public function load_textdomain() {
      load_plugin_textdomain( 'mybooking-cpt-performances', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }

    /**
     * Registra los sidebars del plugin.
     *
     * Estos sidebars se utilizarán para mostrar widgets en las páginas de detalle de las performances.
     */
    public function register_sidebars() {
        register_sidebar( array(
            'name'          => __( 'MyBooking Performance Sidebar', 'mybooking-cpt-performances' ),
            'id'            => 'mybooking-cpt-performance-sidebar',
            'description'   => __( 'Widgets in this area will be shown on the performance detail page.', 'mybooking-cpt-performances' ),
            'before_widget' => '<div class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

        register_sidebar( array(
            'name'          => __( 'MyBooking Performance Bottom', 'mybooking-cpt-performances' ),
            'id'            => 'mybooking-cpt-performance-bottom',
            'description'   => __( 'Widgets in this area will be shown below the performance detail.', 'mybooking-cpt-performances' ),
            'before_widget' => '<div class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

    }

    /**
     * Encola los estilos y scripts necesarios para la galería en el frontend.
     */
    public function enqueue_gallery() {
        if (is_singular('mb_cpt_performance') ||
            has_shortcode(get_post_field('post_content', get_the_ID()), 'mybooking_cpt_performances')) { // Make sure it only loads on the detail page
            // Load CSS
            wp_enqueue_style('mybooking-cpt-performances-gallery-css', 
                             plugins_url('/mybooking-cpt-performances/assets/css/mybooking-cpt-performances-gallery.css'), 
                                         dirname( __FILE__ ));
            // Load JS
            wp_enqueue_script('mybooking-cpt-performances-gallery-js', 
                              plugins_url('/mybooking-cpt-performances/assets/js/mybooking-cpt-performances-gallery.js'), 
                                          dirname( __FILE__ ));
        }
    }

    /**
     * Encola los estilos y scripts necesarios para el metabox de la galería en el admin.
     */
    public function enqueue_admin_gallery_styles_scripts($hook) {

      global $post;

      // Check that we are on the post editing screen
      if (!isset($post) || ($hook !== 'post.php' && $hook !== 'post-new.php')) {
          return;
      }

      // Verify that the post is of type "mb_cpt_performance"
      if ($post->post_type !== 'mb_cpt_performance') {
          return;
      }

      // Encola el CSS
      wp_enqueue_style('mybooking-cpt-performances-gallery-style', 
                       plugins_url('/includes/assets/css/mybooking-cpt-performances-metabox-gallery.css', 
                                   dirname(__FILE__)));

      // Encola el JS
      wp_enqueue_script('mybooking-cpt-performances-script', 
                        plugins_url('/includes/assets/js/mybooking-cpt-performances-metabox-gallery.js', 
                                    dirname(__FILE__)));
    }

    /**
     * Add class 'mybooking-product' to custom post type
     *
     * @since 1.0.1
     */
    public function add_body_class ( $classes ) {
        global $post;
        if ( isset( $post ) && is_object( $post ) && 'mb_cpt_performance' == get_post_type( $post ) ):
          $classes[] = 'mybooking-product';
          $classes[] = 'mybooking-contact-widget';
        endif;

        return $classes;

    }


    /**
     * Load microtemplates
     *
     * @since 1.0.1
     */
    public function include_micro_templates ( $classes ) {

        if ( 'mb_cpt_performance' == get_post_type() ):
          if ( function_exists('mybooking_engine_get_template') ):
            mybooking_engine_get_template('mybooking-plugin-product-widget-tmpl.php');
          endif;
        endif;

    }

}