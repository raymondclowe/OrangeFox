<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Add frontend functionality for AdBlock detection
function orangefox_frontend_init() {
    // Enqueue AdBlock detection script
    wp_enqueue_script('orangefox-adblock-detect', ORANGEFOX_URL . 'assets/js/adblock-detect.js', array('jquery'), ORANGEFOX_VERSION, true);

    // Add AJAX endpoint for recording AdBlock status
    add_action('wp_ajax_orangefox_record_adblock', 'orangefox_record_adblock');
    add_action('wp_ajax_nopriv_orangefox_record_adblock', 'orangefox_record_adblock');
}
add_action('wp', 'orangefox_frontend_init');

// AJAX callback to record AdBlock status
function orangefox_record_adblock() {
    // Verify the AJAX request nonce for security
    check_ajax_referer('orangefox_adblock_nonce', 'nonce');

    // Get the AdBlock status from the POST data
    $is_blocking = isset($_POST['is_blocking']) ? (bool)$_POST['is_blocking'] : false;

    // Retrieve the current AdBlock statistics from the database
    $stats = get_option('orangefox_adblock_stats');

    // Update the statistics based on the AdBlock status
    if ($is_blocking) {
        // Increment the count for users with AdBlock
        $stats['with_adblock']++;
    } else {
        // Increment the count for users without AdBlock
        $stats['without_adblock']++;
    }

    // Update the last updated timestamp
    $stats['last_updated'] = current_time('timestamp');

    // Save the updated statistics back to the database
    update_option('orangefox_adblock_stats', $stats);

    // Send a success response back to the AJAX request
    wp_send_json_success();
}
