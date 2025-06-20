<?php if ( $quadisrentacar_details_seats !='' ) {  ?>
    <span class="badge badge-light">
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() .
        '/assets/images/icon-asientos.svg'); ?>"
             alt="seats"
             style="width: 25px; margin-left: 5px">
        <?php
        switch ($quadisrentacar_details_seats) {
            case '2':
                echo esc_html_e('2', 'mybooking-cpt-performances');
                break;
            case '3':
                echo esc_html_e('3', 'mybooking-cpt-performances');
                break;
            case '4':
                echo esc_html_e('4', 'mybooking-cpt-performances');
                break;
            case '5':
                echo esc_html_e('5', 'mybooking-cpt-performances');
                break;
            case '6':
                echo esc_html_e('6', 'mybooking-cpt-performances');
                break;
            case '7':
                echo esc_html_e('7', 'mybooking-cpt-performances');
                break;
            case '8':
                echo esc_html_e('8', 'mybooking-cpt-performances');
                break;
            case '9':
                echo esc_html_e('9', 'mybooking-cpt-performances');
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
                echo esc_html_e('2', 'mybooking-cpt-performances');
                break;
            case '3':
                echo esc_html_e('3', 'mybooking-cpt-performances');
                break;
            case '4':
                echo esc_html_e('4', 'mybooking-cpt-performances');
                break;
            case '5':
                echo esc_html_e('5', 'mybooking-cpt-performances');
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
                echo esc_html_e('1', 'mybooking-cpt-performances');
                break;
            case '2':
                echo esc_html_e('2', 'mybooking-cpt-performances');
                break;
            case '3':
                echo esc_html_e('3', 'mybooking-cpt-performances');
                break;
            case '4':
                echo esc_html_e('4', 'mybooking-cpt-performances');
                break;
            case '5':
                echo esc_html_e('5', 'mybooking-cpt-performances');
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
                echo esc_html_e('Petrol', 'mybooking-cpt-performances');
                break;
            case 'diesel':
                echo esc_html_e('Diesel', 'mybooking-cpt-performances');
                break;
            case 'electric':
                echo esc_html_e('Electric', 'mybooking-cpt-performances');
                break;
            case 'hybrid':
                echo esc_html_e('Hybrid', 'mybooking-cpt-performances');
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
                <?php echo esc_html_e('Manual', 'mybooking-cpt-performances') ?>
            <?php } else { ?>
                <?php echo esc_html_e('Auto', 'mybooking-cpt-performances') ?>
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


