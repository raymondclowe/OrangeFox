<?php
/*
Plugin Name: OrangeFox
Plugin URI: https://github.com/raymondclowe/OrangeFox
Description: A custom WordPress plugin called OrangeFox.
Version: 1.0
Author: Your Name
Author URI: https://github.com/raymondclowe/
License: GPL2
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('ORANGEFOX_PATH', plugin_dir_path(__FILE__));
define('ORANGEFOX_URL', plugin_dir_url(__FILE__));
define('ORANGEFOX_VERSION', '1.0');

// Include necessary files
require_once ORANGEFOX_PATH . 'admin/settings.php';
require_once ORANGEFOX_PATH . 'includes/frontend.php';

// Enqueue scripts and styles
function orangefox_enqueue_scripts() {
    wp_enqueue_style('orangefox-style', ORANGEFOX_URL . 'assets/css/style.css', array(), ORANGEFOX_VERSION);
    wp_enqueue_script('orangefox-script', ORANGEFOX_URL . 'assets/js/script.js', array('jquery'), ORANGEFOX_VERSION, true);
}
add_action('wp_enqueue_scripts', 'orangefox_enqueue_scripts');

// Activation hook
function orangefox_activate() {
    // Activation code here
}
register_activation_hook(__FILE__, 'orangefox_activate');

// Deactivation hook
function orangefox_deactivate() {
    // Deactivation code here
}
register_deactivation_hook(__FILE__, 'orangefox_deactivate');
