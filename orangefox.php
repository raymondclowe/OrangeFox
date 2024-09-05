<?php
/*
Plugin Name: OrangeFox
Description: Enhances user experience tracking for site optimization.
Version: 1.0
Author: Your Name
*/

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
        if (!get_option($this->data_key)) {
            add_option($this->data_key, array('a' => 0, 'b' => 0));
        }
        if (!get_option($this->config_key)) {
            add_option($this->config_key, array('text' => 'Special Offer', 'link' => 'https://example.com'));
        }
    }

    public function setup_admin() {
        add_options_page('OrangeFox Config', 'OrangeFox', 'manage_options', 'orangefox', array($this, 'config_page'));
    }

    public function config_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        if (isset($_POST['submit'])) {
            $config = array(
                'text' => sanitize_text_field($_POST['text']),
                'link' => esc_url_raw($_POST['link'])
            );
            update_option($this->config_key, $config);
            echo '<div class="updated"><p>Configuration updated.</p></div>';
        }

        $config = get_option($this->config_key);
        ?>
        <div class="wrap">
            <h1>OrangeFox Configuration</h1>
            <form method="post">
                <table class="form-table">
                    <tr>
                        <th><label for="text">Tracker Text</label></th>
                        <td><input type="text" id="text" name="text" value="<?php echo esc_attr($config['text']); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label for="link">Tracker Link</label></th>
                        <td><input type="url" id="link" name="link" value="<?php echo esc_url($config['link']); ?>" class="regular-text"></td>
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
        $data = get_option($this->data_key);
        $total = $data['a'] + $data['b'];
        $a_percent = $total > 0 ? round(($data['a'] / $total) * 100, 2) : 0;

        echo '<p>Total: ' . $total . '</p>';
        echo '<p>A: ' . $data['a'] . ' (' . $a_percent . '%)</p>';
        echo '<p>B: ' . $data['b'] . ' (' . (100 - $a_percent) . '%)</p>';
    }

    public function inject_tracker() {
        $config = get_option($this->config_key);
        echo '<ins class="adsbygoogle" id="advertising-div-ads-go-here" style="display:block;"><i>Advertisement</i><br><a href="' . esc_url($config['link']) . '">' . esc_html($config['text']) . '</a></ins>';
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