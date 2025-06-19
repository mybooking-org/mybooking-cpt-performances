<?php
/**
 *		Used cars LOOP PART
 *  	---------------
 *
 * 	@version 0.0.1
 *   @package WordPress
 *   @subpackage Mybooking CPT Performance
 *   @since 1.0.3
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<!-- Gets custom fields data -->
<?php
$gallery = get_post_meta( get_the_ID(), 'mybooking-cpt-performance-gallery-data', true );
if ( isset( $gallery ) && !empty( $gallery ) ) {
    $gallery_array = $gallery['image_url'];
}
else {
    $gallery_array = [];
}
$gallery_photos_count = sizeof($gallery_array);
$duration_hours = get_post_meta( get_the_ID(), 'mybooking-cpt-performance-duration-hours', true );
$duration_minutes = get_post_meta( get_the_ID(), 'mybooking-cpt-performance-duration-minutes', true );
$price_from = get_post_meta( get_the_ID(), 'mybooking-cpt-performance-price-from', true );
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <?php $mybooking_permalink = get_permalink(); ?>

    <!-- Card content -->
    <div class="mybooking-cpt_card">
      <!-- Card image -->
      <div class="mybooking-cpt_card-image">
        <div class="mybooking-cpt_card-image-container">
          <?php
              if ( isset($gallery_array)  && !empty($gallery_array) ) {
                  // Obtener la imagen principal (tamaño completo)
                  $main_image = wp_get_attachment_image(
                      $gallery_array[0], // ID de la imagen
                      'full', // Tamaño completo de la imagen
                      false, // No se necesita el link
                      []
                  );
                  echo wp_kses_post($main_image); // Mostrar la imagen principal
              }
          ?>
        </div>
      </div>
      <!-- Card body -->
      <div class="mybooking-cpt_card-body">
        <div class="mybooking-cpt_card-title">
            <?php the_title(); ?>
        </div>
      </div>
      <!-- Card footer -->
      <div class="mybooking-cpt_card-footer">
        <a class="button mybooking-cpt_btn-book w-100" role="button" href="<?php the_permalink(); ?>">
            <?php echo esc_html_x('Book Now!', 'mybooking-cpt-performances') ?>
        </a>
      </div>
    </div>
</article>