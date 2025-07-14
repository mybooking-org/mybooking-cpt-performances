<?php
defined( 'ABSPATH' ) || exit;

class MyBooking_CPT_Performances_Shortcode {
  public static function register() {
    add_shortcode( 'mybooking_cpt_performances', [self::class, 'render'] );
  }

  public static function render( $atts ) {

    // Extract attributes from the shortcode, with a new 'ids' parameter that allows passing specific IDs
    $atts = shortcode_atts( array(
        'ids' => '', // Optional 'ids' attribute to filter by specific vehicle IDs
    ), $atts, 'mybooking_cpt_performances' );

    // Constructing the query arguments
    $args = array(
        'post_type'      => 'mb_cpt_performance',
        'posts_per_page' => 12, // Number of performances to show
        'tax_query'      => array(),
    );

    // If ids are provided, filter by specific vehicle IDs
    if ( ! empty( $atts['ids'] ) ) {
        $args['post__in'] = array_map( 'intval', explode( ',', $atts['ids'] ) ); // Convert to array of integers
    }

    // Setup the order of the results
    $args['orderby'] = 'menu_order';
    $args['order']   = 'ASC';

    // Execute the query
    $query = new WP_Query( $args );

    // Check for results
    if ( $query->have_posts() ) {
        $output = '<div class="mybooking-cpt"><div class="mybooking-cpt_grid">';
        while ( $query->have_posts() ) {
            $query->the_post();
            ob_start();
            include plugin_dir_path(__FILE__) . 'templates/loop-part.php';
            $output .= ob_get_clean();
        }
        wp_reset_postdata();
        $output .= '</div></div>';
    } else {
        $output = __('There are no performances available', 'mybooking-cpt-performances' );
    }

    return $output;
  }
}