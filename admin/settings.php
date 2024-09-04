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

// Function to display the stats page content
function orangefox_stats_page() {
    // Get the AdBlock stats from the WordPress options
    $stats = get_option('orangefox_adblock_stats');

    // Calculate total visitors
    $total_visitors = $stats['with_adblock'] + $stats['without_adblock'];

    // Calculate the percentage of visitors using AdBlock
    $adblock_percentage = $total_visitors > 0 ? round(($stats['with_adblock'] / $total_visitors) * 100, 2) : 0;

    // Start the HTML output
    ?>
    <div class="wrap">
        <h1>OrangeFox AdBlock Statistics</h1>
        <div id="orangefox-stats-container">
            <p>Total visitors: <?php echo $total_visitors; ?></p>
            <p>Visitors with AdBlock: <?php echo $stats['with_adblock']; ?> (<?php echo $adblock_percentage; ?>%)</p>
            <p>Visitors without AdBlock: <?php echo $stats['without_adblock']; ?> (<?php echo 100 - $adblock_percentage; ?>%)</p>
            <p>Last updated: <?php echo date('Y-m-d H:i:s', $stats['last_updated']); ?></p>
        </div>
    </div>
    <?php
}

// Function to add the dashboard widget
function orangefox_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'orangefox_dashboard_widget',
        'AdBlock Usage Statistics',
        'orangefox_dashboard_widget_content'
    );
}
add_action('wp_dashboard_setup', 'orangefox_add_dashboard_widget');

// Function to display the dashboard widget content
function orangefox_dashboard_widget_content() {
    // Get the AdBlock stats from the WordPress options
    $stats = get_option('orangefox_adblock_stats');

    // Calculate total visitors
    $total_visitors = $stats['with_adblock'] + $stats['without_adblock'];

    // Calculate the percentage of visitors using AdBlock
    $adblock_percentage = $total_visitors > 0 ? round(($stats['with_adblock'] / $total_visitors) * 100, 2) : 0;

    // Display the statistics
    echo '<p>Total visitors: ' . $total_visitors . '</p>';
    echo '<p>Visitors with AdBlock: ' . $stats['with_adblock'] . ' (' . $adblock_percentage . '%)</p>';
    echo '<p>Visitors without AdBlock: ' . $stats['without_adblock'] . ' (' . (100 - $adblock_percentage) . '%)</p>';
}
