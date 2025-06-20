<?php
/**
 * Plugin Name: MyBooking CPT Performances
 * Plugin URI: https://example.com/mybooking-cpt-performances
 * Description: A plugin to manage custom post types for performances in MyBooking.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://example.com
 * License: GPL2
 * Text Domain: mybooking-cpt-performances
 * Domain Path: /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Include the main class file.
//include_once dirname( __FILE__ ) . 'includes/class-mybooking-cpt-performances.php';
require_once 'includes/class-mybooking-cpt-performances.php';

$url = plugin_dir_url(__FILE__);
define('MYBOOKING_CPT_PERFORMANCES_PLUGIN_URL', $url );

// Initialize the plugin.
$mybooking_cpt_performances = new MyBooking_CPT_Performances();
