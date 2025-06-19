<?php
defined( 'ABSPATH' ) || exit;

class MyBooking_CPT_Performances_CPT {

  public static function init() {
    // Register the custom post type
    add_action( 'init', [self::class, 'register'] );

    // Add the single template for performances
    add_filter( 'single_template', [self::class, 'single_template'] );
  }

  /**
   * Register the custom post type "Performances".
   */
  public static function register() {
    $labels = [
      'name'               => __( 'Performances', 'mybooking-cpt-performances' ),
      'singular_name'      => __( 'Performance', 'mybooking-cpt-performances' ),
      'add_new'            => __( 'Add New', 'mybooking-cpt-performances' ),
      'add_new_item'       => __( 'Add New Performance', 'mybooking-cpt-performances' ),
      'edit_item'          => __( 'Edit Performance', 'mybooking-cpt-performances' ),
      'new_item'           => __( 'New Performance', 'mybooking-cpt-performances' ),
      'view_item'          => __( 'View Performance', 'mybooking-cpt-performances' ),
      'view_items'         => __( 'View Performances', 'mybooking-cpt-performances' ),
      'search_items'       => __( 'Search Performances', 'mybooking-cpt-performances' ),
      'not_found'          => __( 'No performances found', 'mybooking-cpt-performances' ),
      'not_found_in_trash' => __( 'No performances found in Trash', 'mybooking-cpt-performances' ),
      'menu_name'          => __( 'Performances', 'mybooking-cpt-performances' ),
    ];

    $rewrite = array(
        'slug'                  => 'tours', 
        'with_front'            => false,
        'pages'                 => true,
        'feeds'                 => true,
      );

    $args = array(
      'label'                 => __( 'Performances', 'mybooking-cpt-performances' ),
      'description'           => __( 'Performances', 'mybooking-cpt-performances' ),
      'labels'                => $labels,
      'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes' ),
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'menu_icon'             => 'dashicons-clipboard',
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => 'mb_cpt_performance',
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
      'rewrite'               => $rewrite,
      'capability_type'       => 'post',
      'show_in_rest'          => true,
    );


    register_post_type( 'mb_cpt_performance', $args );
  }

  /**
   * Return the template for single performance.
   *
   * @return string
   */
  public static function single_template() {
    global $post;

    if ( $post->post_type == 'mb_cpt_performance' ) {
          $template = plugin_dir_path(__FILE__).'templates/single-mybooking-cpt-performance.php';
    }
    return $template;

  }

  /**
   * Add a metabox to the custom post type.
   */
  public static function add_metabox() {
    add_meta_box(
      'mybooking_cpt_performance_metabox',
      __( 'Performance Details', 'mybooking-cpt-performances' ),
      [self::class, 'render_metabox'],
      'mb_cpt_performance',
      'normal',
      'default'
    );
  }

  /**
   * Render the metabox content.
   *
   * @param WP_Post $post The post object.
   */
  public static function render_metabox( $post ) {
    wp_nonce_field( 'mybooking_cpt_performance_nonce', 'mybooking_cpt_performance_nonce_field' );
    // Gallery data
    $gallery_data = get_post_meta( $post->ID, 'mybooking-cpt-performance-gallery-data', true );
    ?>
    <table class="form-table">
      <tbody>
          <tr>
          <th scope="row">
              <label><?php echo esc_html_e( 'Image gallery', 'mybooking-cpt-performances' ) ?></label>
          </th>
          <td style="width: 45%;">
              <div class="gallery_wrapper">
              <div id="img_box_container">
                  <?php
                  if ( isset( $gallery_data['image_url'] ) ){
                      for( $i = 0; $i < count( $gallery_data['image_url'] ); $i++ ){
                      $gallery_data_item_src =  wp_get_attachment_image_src($gallery_data['image_url'][$i],
                                                                              'medium'
                                                                              );
                      if (!empty($gallery_data_item_src)) {
                      ?>
                      <div class="gallery_single_row dolu">
                          <div class="gallery_area image_container ">
                          <img class="gallery_img_img" src="<?php esc_html_e( $gallery_data_item_src[0] ); ?>" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>
                          <input type="hidden"
                              class="meta_image_url"
                              name="mybooking-cpt-performance-gallery[image_url][]"
                              value="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>"
                              />
                          </div>
                          <div class="gallery_area">
                          <span class="button remove" onclick="remove_img(this)" title="Remove"/><i class="dashicons dashicons-trash"></i></span>
                          </div>
                          <div class="clear">
                          </div>
                      </div>
                      <?php
                      }
                      }
                  }
                  ?>
              </div>
              <!-- Prepare new image -->
              <div style="display:none" id="master_box">
                  <div class="gallery_single_row">
                  <div class="gallery_area image_container" onclick="open_media_uploader_image(this)">
                      <input class="meta_image_url" value="" type="hidden" name="mybooking-cpt-performance-gallery[image_url][]" />
                  </div>
                  <div class="gallery_area">
                      <span class="button remove" onclick="remove_img(this)" title="Remove"/><i class="dashicons dashicons-trash"></i></span>
                  </div>
                  <div class="clear"></div>
                  </div>
              </div>
              <div id="add_gallery_single_row">
                  <button class="button add" type="button" onclick="open_media_uploader_image_plus();" title="Add image"/>
                  +
                  </button>
              </div>
              </div>
          </td>
          <td style="width: 45%;">
              <p class="description"><?php echo esc_html_e( 'Add multiple images from your media library to create a carousel. Click and drag to change the order.', 'mybooking-cpt-performances' ) ?></p>
          </td>
          </tr>
      </tbody>
    </table>

    <?php
      // Duration hours
      $duration_hours = get_post_meta( $post->ID, 'mybooking-cpt-performance-duration-hours', true );
    ?>
    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row">
                <label for="mybooking-cpt-performance-duration-hours"><?php echo esc_html_e( 'Duration (hours)', 'mybooking-cpt-performances' ) ?></label>
            </th>
            <td style="width: 45%;">
                <input
                        name="mybooking-cpt-performance-duration-hours"
                        id="mybooking-cpt-performance-duration-hours"
                        class="components-text-control__input"
                        style="width: 100%"
                        type="number"
                        min="0"
                        value="<?php echo esc_attr( $duration_hours ); ?>">
            </td>
            <td style="width: 45%;">
                <p class="description"><?php echo esc_html_e( 'Input the duration of the performance in hours', 'mybooking-cpt-performances' ) ?></p>
            </td>
        </tr>
    </table>

    <?php
      // Duration minutes
      $duration_minutes = get_post_meta( $post->ID, 'mybooking-cpt-performance-duration-minutes', true );
    ?>
    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row">  
                <label for="mybooking-cpt-performance-duration-minutes"><?php echo esc_html_e( 'Duration (minutes)', 'mybooking-cpt-performances' ) ?></label>
            </th>
            <td style="width: 45%;">
                <input
                        name="mybooking-cpt-performance-duration-minutes"
                        id="mybooking-cpt-performance-duration-minutes"
                        class="components-text-control__input"
                        style="width: 100%"
                        type="number"
                        min="0"
                        value="<?php echo esc_attr( $duration_minutes ); ?>">
            </td>
            <td style="width: 45%;">
                <p class="description"><?php echo esc_html_e( 'Input the duration of the performance in minutes', 'mybooking-cpt-performances' ) ?></p>
            </td>
        </tr>
    </table>

    <?php
      // Price from
      $price_from = get_post_meta( $post->ID, 'mybooking-cpt-performance-price-from', true );
    ?>
    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row">
                <label for="mybooking-cpt-performance-price-from"><?php echo esc_html_e( 'Price (from)', 'mybooking-cpt-performances' ) ?></label>
            </th>
            <td style="width: 45%;">
                <input
                        name="mybooking-cpt-performance-price-from"
                        id="mybooking-cpt-performance-price-from"
                        class="components-text-control__input"
                        style="width: 100%"
                        type="number"
                        min="0"
                        value="<?php echo esc_attr( $price_from ); ?>">
            </td>
            <td style="width: 45%;">
                <p class="description"><?php echo esc_html_e( 'Input the starting price of the performance', 'mybooking-cpt-performances' ) ?></p>
            </td>
        </tr>
    </table>

    <?php
      // Category code
      $category = get_post_meta( $post->ID, 'mybooking-cpt-performance-category-code', true );
    ?>
    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row">
                <label for="mybooking-cpt-performance-category-code"><?php echo esc_html_e( 'Category', 'mybooking-cpt-performances' ) ?></label>
            </th>
            <td style="width: 45%;">
                <input
                        name="mybooking-cpt-performance-category-code"
                        id="mybooking-cpt-performance-category-code"
                        class="components-text-control__input"
                        style="width: 100%"
                        type="text"
                        value="<?php echo esc_attr( $category ); ?>">
            </td>
            <td style="width: 45%;">
                <p class="description"><?php echo esc_html_e( 'Input the category code of the performance', 'mybooking-cpt-performances' ) ?></p>
            </td>
        </tr>
    </table>
    
    <?php
      // Performance ID
      $performance_id = get_post_meta( $post->ID, 'mybooking-cpt-performance-performance-id', true );
    ?>
    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row">
                <label for="mybooking-cpt-performance-performance-id"><?php echo esc_html_e( 'Performance ID', 'mybooking-cpt-performances' ) ?></label>
            </th>
            <td style="width: 45%;">
                <input
                        name="mybooking-cpt-performance-performance-id"
                        id="mybooking-cpt-performance-performance-id"
                        class="components-text-control__input"
                        style="width: 100%"
                        type="text"
                        value="<?php echo esc_attr( $performance_id ); ?>">
            </td>
            <td style="width: 45%;">
                <p class="description"><?php echo esc_html_e( 'Input the performance ID of the performance', 'mybooking-cpt-performances' ) ?></p>
            </td>
        </tr>
    </table>

    <?php
  }

  /**
   * Save the metabox data.
   *
   * @param int $post_id The post ID.
   */
  public static function save_metabox( $post_id ) {

    if ( ! isset( $_POST['mybooking_cpt_performance_nonce_field'] ) ||
         ! wp_verify_nonce( $_POST['mybooking_cpt_performance_nonce_field'], 'mybooking_cpt_performance_nonce' ) ) {
      return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // Save gallery
    if ( isset($_POST['mybooking-cpt-performance-gallery']) ){
        // Build array for saving post meta
        $gallery_data = array();
        if ( !empty($_POST['mybooking-cpt-performance-gallery']['image_url']) ) {
            foreach ($_POST['mybooking-cpt-performance-gallery']['image_url'] as $img_url) {
                if ( '' != $img_url ) {
                    $gallery_data['image_url'][] = $img_url;
                }
            }
        }
        if ( !empty($gallery_data['image_url']) ) {
            update_post_meta( $post_id, 'mybooking-cpt-performance-gallery-data', $gallery_data );
        } else {
            delete_post_meta( $post_id, 'mybooking-cpt-performance-gallery-data' );
        }
    }

    // Save duration hours
    if ( isset( $_POST['mybooking-cpt-performance-duration-hours'] ) ) {
      $duration_hours = sanitize_text_field( $_POST['mybooking-cpt-performance-duration-hours'] );
      update_post_meta( $post_id, 'mybooking-cpt-performance-duration-hours', $duration_hours );
    }
    // Save duration minutes
    if ( isset( $_POST['mybooking-cpt-performance-duration-minutes'] ) ) {
      $duration_minutes = sanitize_text_field( $_POST['mybooking-cpt-performance-duration-minutes'] );
      update_post_meta( $post_id, 'mybooking-cpt-performance-duration-minutes', $duration_minutes );
    }
    // Save price from
    if ( isset( $_POST['mybooking-cpt-performance-price-from'] ) ) {
      $price_from = sanitize_text_field( $_POST['mybooking-cpt-performance-price-from'] );
      update_post_meta( $post_id, 'mybooking-cpt-performance-price-from', $price_from );  
    }
    // Save category code
    if ( isset( $_POST['mybooking-cpt-performance-category-code'] ) ) {
      $category = sanitize_text_field( $_POST['mybooking-cpt-performance-category-code'] );
      update_post_meta( $post_id, 'mybooking-cpt-performance-category-code', $category );
    }
    // Save performance ID
    if ( isset( $_POST['mybooking-cpt-performance-performance-id'] ) ) {
      $performance_id = sanitize_text_field( $_POST['mybooking-cpt-performance-performance-id'] );
      update_post_meta( $post_id, 'mybooking-cpt-performance-performance-id',
        $performance_id );
    }
  }
}