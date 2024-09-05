<?php
/*
Plugin Name: OrangeFox
Plugin URI: https://example.com/orangefox
Description: Enhances user experience tracking for site optimization.
Version: 1.3
Author: Your Name
Author URI: https://example.com
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: orangefox
Domain Path: /languages
*/

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}



class OrangeFox {
    private $data_key = 'of_metrics';
    private $config_key = 'of_config';

    public function __construct() {
        register_activation_hook(__FILE__, array($this, 'initialize'));
        add_action('admin_menu', array($this, 'setup_admin'));
        add_action('wp_dashboard_setup', array($this, 'setup_widget'));
        add_action('wp_footer', array($this, 'inject_tracker'));
        add_action('wp_enqueue_scripts', array($this, 'load_resources'));
        add_action('wp_ajax_update_metrics', array($this, 'process_data'));
        add_action('wp_ajax_nopriv_update_metrics', array($this, 'process_data'));
    }

    public function initialize() {
        // Check if the data option exists
        if (!get_option($this->data_key)) {
            // If not, add the option with default values
            add_option($this->data_key, array('a' => 0, 'b' => 0));
        }
        // Check if the config option exists
        if (!get_option($this->config_key)) {
            // If not, add the option with default banner and click URLs
            add_option($this->config_key, array('banner_url' => 'https://example.com/banner.jpg', 'click_url' => 'https://example.com'));
        }
    }

    public function setup_admin() {
        add_options_page('OrangeFox Config', 'OrangeFox', 'manage_options', 'orangefox', array($this, 'config_page'));
    }

    public function config_page() {
        // Check if the current user has the 'manage_options' capability
        if (!current_user_can('manage_options')) {
            return;
        }

        // Check if the form has been submitted
        if (isset($_POST['submit'])) {
            // Create an array to store the configuration
            $config = array(
                'banner_url' => esc_url_raw($_POST['banner_url']),
                'click_url' => esc_url_raw($_POST['click_url'])
            );
            // Update the option in the database
            update_option($this->config_key, $config);
            // Display a success message
            echo '<div class="updated"><p>Configuration updated.</p></div>';
        }

        // Get the current configuration from the database
        $config = get_option($this->config_key);
        ?>
        <div class="wrap">
            <h1>OrangeFox Configuration</h1>
            <form method="post">
                <table class="form-table">
                    <tr>
                        <th><label for="banner_url">Banner Image URL</label></th>
                        <td><input type="url" id="banner_url" name="banner_url" value="<?php echo esc_url($config['banner_url']); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label for="click_url">Click Destination URL</label></th>
                        <td><input type="url" id="click_url" name="click_url" value="<?php echo esc_url($config['click_url']); ?>" class="regular-text"></td>
                    </tr>
                </table>
                <p class="submit">
                    <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
                </p>
            </form>
        </div>
        <?php
    }

    public function setup_widget() {
        wp_add_dashboard_widget('orangefox_widget', 'OrangeFox Metrics', array($this, 'display_widget'));
    }

        public function display_widget() {
            // Get the data from the option
            $data = get_option($this->data_key);

            // Calculate the total number of ad impressions
            $total = $data['a'] + $data['b'];

            // Calculate the percentage of hidden ads
            $hidden_percent = $total > 0 ? round(($data['a'] / $total) * 100, 2) : 0;

            // Calculate the percentage of visible ads
            $visible_percent = 100 - $hidden_percent;

            // Display the total ad impressions
            echo '<p>Total Ad Impressions: ' . $total . '</p>';

            // Display the number and percentage of hidden ads
            echo '<p>Hidden Ads: ' . $data['a'] . ' (' . $hidden_percent . '%)</p>';

            // Display the number and percentage of visible ads
            echo '<p>Visible Ads: ' . $data['b'] . ' (' . $visible_percent . '%)</p>';

            // Add a reset button
            echo '<form method="post">';
            echo '<input type="submit" name="reset_counters" value="Reset Counters">';
            echo '</form>';

            // Check if the reset button was clicked
            if (isset($_POST['reset_counters'])) {
                // Reset both counters to 0
                $data['a'] = 0;
                $data['b'] = 0;

                // Save the updated data
                update_option($this->data_key, $data);

                // Refresh the page to show updated counters
                echo '<meta http-equiv="refresh" content="0">';
            }
        }
    // Function to inject the tracker (advertisement) into the page
    public function inject_tracker() {
        // Get the configuration options from the database
        $config = get_option($this->config_key);

        // Create a div with id "ad" to wrap the advertisement
        echo '<div id="ad">';

        // Output the HTML for the advertisement

        // Create a link with an image inside
        echo '<a class="ad" href="' . esc_url($config['click_url']) . '">';

        // Display the banner image
        echo '<img class="banner" src="' . esc_url($config['banner_url']) . '" alt="Advertisement">';

        // Close the link tag
        echo '</a>';

        // Close the div tag
        echo '</div>';
      
    }

    public function load_resources() {
        wp_enqueue_script('orangefox', plugins_url('adserver-orangefox.js', __FILE__), array('jquery'), '1.0', true);
        wp_localize_script('orangefox', 'orangeFox', array(
            'ajaxurl' => admin_url('admin-ajax.php')
        ));
    }

    public function process_data() {
        $data = get_option($this->data_key);
        $is_a = $_POST['is_a'] === 'true';

        if ($is_a) {
            $data['a']++;
        } else {
            $data['b']++;
        }

        update_option($this->data_key, $data);
        wp_die();
    }
}

new OrangeFox();