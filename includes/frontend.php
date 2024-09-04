<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Add frontend functionality here
function orangefox_frontend_init() {
    // Add your frontend code here
}
add_action('wp', 'orangefox_frontend_init');
