<?php if ( $quadisrentacar_details_seats !='' ) {  ?>
    <span class="badge badge-light">
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() .
        '/assets/images/icon-asientos.svg'); ?>"
             alt="seats"
             style="width: 25px; margin-left: 5px">
        <?php
        switch ($quadisrentacar_details_seats) {
            case '2':
                echo esc_html_x('2', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case '3':
                echo esc_html_x('3', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case '4':
                echo esc_html_x('4', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case '5':
                echo esc_html_x('5', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case '6':
                echo esc_html_x('6', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case '7':
                echo esc_html_x('7', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case '8':
                echo esc_html_x('8', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case '9':
                echo esc_html_x('9', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            default:
                echo esc_html($quadisrentacar_details_seats);
        }
        ?>
    </span>
<?php } ?>
<?php if ( $quadisrentacar_details_doors !='' ) {  ?>
    <span class="badge badge-light">
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() .
            '/assets/images/icon-puertas.svg'); ?>"
             alt="doors"
             style="width: 25px; margin-left: 5px">
        <?php
        switch ($quadisrentacar_details_doors) {
            case '2':
                echo esc_html_x('2', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case '3':
                echo esc_html_x('3', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case '4':
                echo esc_html_x('4', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case '5':
                echo esc_html_x('5', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            default:
                echo esc_html($quadisrentacar_details_doors);
        }
        ?>
    </span>
<?php } ?>

<?php if ( $quadisrentacar_details_trunk !='' ) {  ?>
    <span class="badge badge-light">
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() .
            '/assets/images/icon-maletero.svg'); ?>"
             alt="doors"
             style="width: 25px; margin-left: 5px">
        <?php
        switch ($quadisrentacar_details_trunk) {
            case '1':
                echo esc_html_x('1', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case '2':
                echo esc_html_x('2', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case '3':
                echo esc_html_x('3', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case '4':
                echo esc_html_x('4', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case '5':
                echo esc_html_x('5', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            default:
                echo esc_html($quadisrentacar_details_doors);
        }
        ?>
    </span>
<?php } ?>

<?php if ( $quadisrentacar_details_fuel !='' ) {  ?>
    <span class="badge badge-light">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/icon-combustible.svg' ); ?>"
               alt="fuel"
               style="width: 25px; margin-left: 5px">
        <?php
        switch ($quadisrentacar_details_fuel) {
            case 'petrol':
                echo esc_html_x('Petrol', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case 'diesel':
                echo esc_html_x('Diesel', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case 'electric':
                echo esc_html_x('Electric', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            case 'hybrid':
                echo esc_html_x('Hybrid', 'quadisrentacar-archive', 'quadisrentacar');
                break;
            default:
                echo esc_html($quadisrentacar_details_fuel);
        }
        ?>
    </span>
<?php } ?>
<?php if ( $quadisrentacar_details_gear !='' ) {  ?>
    <span class="badge badge-light">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/icon-transmision.svg' ); ?>"
                 alt="camera"
                 style="width: 25px; margin-left: 5px">
            <?php
            if ( $quadisrentacar_details_gear == 'manual' ) { ?>
                <?php echo esc_html_x('Manual', 'quadisrentacar-archive', 'quadisrentacar') ?>
            <?php } else { ?>
                <?php echo esc_html_x('Auto', 'quadisrentacar-archive', 'quadisrentacar') ?>
            <?php }
            ?>
          </span>
<?php } ?>
<?php if ( $quadisrentacar_details_environmental_label == 'label-0' ) { ?>
    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/etiqueta-medioambiental-0.svg' ); ?>"
         alt="label-0"
         style="width: 30px; margin-left: 5px">
<?php }
if ( $quadisrentacar_details_environmental_label == 'label-c' ){ ?>
    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/etiqueta-medioambiental-c.svg' ); ?>"
         alt="label-c"
         style="width: 30px; margin-left: 5px">
<?php }
if ( $quadisrentacar_details_environmental_label == 'label-eco' ){ ?>
    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/etiqueta-medioambiental-eco.svg' ); ?>"
         alt="label-eco"
         style="width: 30px; margin-left: 5px">
<?php }
?>


