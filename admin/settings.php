<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Add admin menu
function orangefox_add_admin_menu() {
    add_menu_page(
        'OrangeFox AdBlock Stats',
        'AdBlock Stats',
        'manage_options',
        'orangefox-stats',
        'orangefox_stats_page',
        'dashicons-chart-bar',
        99
    );
}
add_action('admin_menu', 'orangefox_add_admin_menu');

// Stats page content
function orangefox_stats_page() {
    ?>
    <div class="wrap">
        <h1>OrangeFox AdBlock Statistics</h1>
        <div id="orangefox-stats-container">
            <!-- AdBlock statistics will be displayed here -->
        </div>
    </div>
    <?php
}

// Add dashboard widget
function orangefox_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'orangefox_dashboard_widget',
        'AdBlock Usage Statistics',
        'orangefox_dashboard_widget_content'
    );
}
add_action('wp_dashboard_setup', 'orangefox_add_dashboard_widget');

// Dashboard widget content
function orangefox_dashboard_widget_content() {
    // Display AdBlock usage statistics
    echo '<div id="orangefox-dashboard-stats"></div>';
}
