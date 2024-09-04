<?php
/*
Plugin Name: OrangeFox AdBlock Detector
Plugin URI: https://example.com/orangefox-adblock-detector
Description: Counts and displays the number and ratio of visitors with or without adblocking extensions on the WordPress dashboard.
Version: 1.0
Author: Your Name
Author URI: https://example.com
License: GPL2
*/

// This code prevents direct access to the plugin file
if (!defined('ABSPATH')) {
    exit;
}

// Define constants for the plugin
define('ORANGEFOX_PATH', plugin_dir_path(__FILE__));
define('ORANGEFOX_URL', plugin_dir_url(__FILE__));
define('ORANGEFOX_VERSION', '1.0');

// Include other PHP files needed for the plugin
require_once ORANGEFOX_PATH . 'admin/settings.php';
require_once ORANGEFOX_PATH . 'includes/frontend.php';

// Function to add CSS and JavaScript files to the website
function orangefox_enqueue_scripts() {
    // Add the CSS file
    wp_enqueue_style('orangefox-style', ORANGEFOX_URL . 'assets/css/style.css', array(), ORANGEFOX_VERSION);
    // Add the JavaScript file
    wp_enqueue_script('orangefox-script', ORANGEFOX_URL . 'assets/js/script.js', array('jquery'), ORANGEFOX_VERSION, true);
}
// Hook the function to WordPress so it runs at the right time
add_action('wp_enqueue_scripts', 'orangefox_enqueue_scripts');

// Function to initialize options for OrangeFox plugin
function orangefox_init_options() {
    // Check if the 'orangefox_adblock_stats' option doesn't exist
    if (get_option('orangefox_adblock_stats') === false) {
        // If it doesn't exist, add the option with initial values
        add_option('orangefox_adblock_stats', array(
            'with_adblock' => 0,          // Counter for visitors with adblock
            'without_adblock' => 0,       // Counter for visitors without adblock
            'last_updated' => current_time('timestamp')  // Timestamp of last update
        ));
    }
}

// Hook the initialization function to WordPress admin_init action
add_action('admin_init', 'orangefox_init_options');
