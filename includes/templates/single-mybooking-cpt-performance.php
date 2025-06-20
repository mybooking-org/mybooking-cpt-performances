<?php
/**
 *		Performance CPT SINGLE
 *  	------------
 *
 * 	@version 0.0.4
 *   @package WordPress
 *   @subpackage Mybooking Performance CPT Plugin
 *   @since 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

    <!-- Gets custom fields data -->
<?php
$gallery = get_post_meta( $post->ID, 'mybooking-cpt-performance-gallery-data', true );
if ( isset( $gallery ) && !empty( $gallery ) ) {
    $gallery_array = $gallery['image_url'];
}
else {
    $gallery_array = [];
}
$gallery_photos_count = sizeof($gallery_array);
$duration_hours = get_post_meta( $post->ID, 'mybooking-cpt-performance-duration-hours', true );
$duration_minutes = get_post_meta( $post->ID, 'mybooking-cpt-performance-duration-minutes', true );
$price_from = get_post_meta( $post->ID, 'mybooking-cpt-performance-price-from', true );
$category_code = get_post_meta( $post->ID, 'mybooking-cpt-performance-category-code', true );
$performace_id = get_post_meta( $post->ID, 'mybooking-cpt-performance-performance-id', true );

?>

    <div class="container">
      <!--div class="mb-container mb-row">
        <div class="mb-col-md-12"-->
          <?php while ( have_posts() ) : the_post(); ?>

              <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <div class="post_content mybooking-cpt mybooking-cpt_post">
                  <div class="mb-container" tabindex="-1">
                    <div class="mb-row">
                      <!-- The product name -->
                      <div class="mb-col-md-12">
                        <h1 class="mybooking-cpt_post-header">
                          <?php echo esc_html( the_title() ) ?>  
                          <div class="mybooking-cpt_price">
                              <?php /* translators: %s: privacy policy URL */ ?>
                               <?php echo wp_kses_post ( sprintf( __( 'From %s €', 'mybooking-cpt-performances' ), $price_from ) )?>
                          </span>
                        </h1>
                      </div>
                    </div>
                    
                    <div class="mb-row">
                      <!-- The images -->            
                      <div class="mb-col-md-7">                               
                          <?php if( $gallery_photos_count !='' ) { ?>
                            <div class="mybooking-cpt-gallery-carousel-container">
                              <!-- Imagen principal -->
                              <div class="mybooking-cpt-gallery-main-image">
                                  <?php
                                  // Obtener la imagen principal (tamaño completo)
                                  $performance_main_image = wp_get_attachment_image(
                                      $gallery_array[0], // ID de la imagen
                                      'full', // Tamaño completo de la imagen
                                      false, // No se necesita el link
                                      ['class' => 'mybooking-cpt-performance_carousel-img', 'alt' => 'Imagen principal del coche']
                                  );
                                  echo wp_kses_post($performance_main_image); // Mostrar la imagen principal
                                  ?>
                              </div>

                              <!-- Carrusel de miniaturas (thumbnails) -->
                              <div class="mybooking-cpt-gallery_carousel">
                                  <?php for( $i=0; $i<$gallery_photos_count; $i++ ) { ?>
                                      <div class="mybooking-cpt-gallery_carousel-item">
                                          <?php
                                          // Obtener la miniatura de la imagen (tamaño 'thumbnail')
                                          $gallery_thumbnail = wp_get_attachment_image(
                                              $gallery_array[$i], // ID de la imagen
                                              'thumbnail', // Tamaño de la miniatura
                                              false, // No se necesita el link
                                              [
                                                  'class' => 'mybooking-cpt-gallery_carousel-thumbnail',
                                                  'alt' => 'Miniatura del tour',
                                                  'data-full-size' => wp_get_attachment_url($gallery_array[$i]) // URL de la imagen completa
                                              ]
                                          );
                                          echo wp_kses_post($gallery_thumbnail); // Mostrar miniatura
                                          ?>
                                      </div>
                                  <?php } ?>
                              </div>
                            </div>
                          <?php } ?>
                          <div class="mybooking-cpt-gallery_entry-content">
                              <?php the_content(); ?>
                          </div>
                      </div>

                      <!-- The sidebar -->
                      <div class="mb-col-md-5">
                            <h2 class="mybooking-cpt_section-title">
                                <?php esc_html_e( 'Book', 'mybooking-cpt-performances' ); ?>
                            </h2>
                            <?php
                            // Shortcode to display the selector form
                            if ( !empty( $category_code ) && !empty( $performace_id ) ) {
                                echo do_shortcode( '[mybooking_rent_engine_product code="' . esc_attr($category_code) .
                                                    '" performance_id="' . esc_attr($performace_id) . '"]' );
                            }
                            ?>

                          <div class="mybooking-cpt-gallery_sidebar">
                              <!-- Widgets -->
                              <?php if ( is_active_sidebar( 'mybooking-cpt-performance-sidebar' ) ) { ?>
                                  <div class="mybooking-cpt_single-widget-area">
                                          <?php dynamic_sidebar( 'mybooking-cpt-performance-sidebar' ); ?>
                                  </div>
                              <?php } ?>
                              <br>
                          </div>
                      </div>
                    </div>

                    <!-- Widgets before the selector form -->
                    <?php if ( is_active_sidebar( 'mybooking-cpt-performance-bottom' ) ) { ?>
                      <div class="mb-row">
                        <div class="mb-col-md-12">
                            <div class="mybooking-cpt_single-widget-area">
                                <?php dynamic_sidebar( 'mybooking-cpt-performance-bottom' ); ?>
                            </div>
                        </div>
                      </div>
                      <br>
                    <?php } ?>
                    

                    <div class="mb-row">
                      <div class="mb-col-md-12">
                          <!-- Link pages -->
                          <?php
                          wp_link_pages(
                              array(
                                  'before' => '<div class="mybooking-entry-links">' . esc_html_e( 'Pages', 'mybooking-cpt-performances' ),
                                  'after'  => '</div>',
                              )
                          );
                          ?>

                          <!-- Footer -->
                          <footer class="entry-footer">
                              <?php
                              if (function_exists('mybooking_entry_footer') ):
                                  mybooking_entry_footer();
                              endif;
                              ?>
                          </footer>
                      </div>
                    </div>

                      <!-- Posts navigation -->
                      <?php
                      if (function_exists('mybooking_post_nav') ):
                          mybooking_post_nav();
                      endif; ?>
                  </div>
                </div>
              </article>

              <?php
              // If comments are open or we have at least one comment, load up the comment template.
              if ( comments_open() || get_comments_number() ) :
                  comments_template();
              endif;
              ?>

          <?php endwhile; ?>
        <!--/div>
      </div-->
    </div>

<?php get_footer();