<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Add admin menu
function orangefox_add_admin_menu() {
    add_menu_page(
        'OrangeFox Settings',
        'OrangeFox',
        'manage_options',
        'orangefox-settings',
        'orangefox_settings_page',
        'dashicons-admin-generic',
        99
    );
}
add_action('admin_menu', 'orangefox_add_admin_menu');

// Settings page content
function orangefox_settings_page() {
    ?>
    <div class="wrap">
        <h1>OrangeFox Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('orangefox_options');
            do_settings_sections('orangefox-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings
function orangefox_register_settings() {
    register_setting('orangefox_options', 'orangefox_options');
    add_settings_section('orangefox_main_section', 'Main Settings', 'orangefox_main_section_callback', 'orangefox-settings');
    add_settings_field('orangefox_field_1', 'Field 1', 'orangefox_field_1_callback', 'orangefox-settings', 'orangefox_main_section');
}
add_action('admin_init', 'orangefox_register_settings');

// Section callback
function orangefox_main_section_callback() {
    echo '<p>Main settings for OrangeFox plugin.</p>';
}

// Field callback
function orangefox_field_1_callback() {
    $options = get_option('orangefox_options');
    $value = isset($options['field_1']) ? $options['field_1'] : '';
    echo "<input type='text' name='orangefox_options[field_1]' value='$value' />";
}
