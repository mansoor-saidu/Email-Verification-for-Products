<?php
/**
 * Plugin Name: Email Verification for Products
 * Description: Restricts page content unless the user verifies their email has purchased specific WooCommerce product(s). Requires WooCommerce and supports guest checkout.
 * Version: 1.0.1
 * Author: Mansoor Saidu
 * Author URI: https://profiles.wordpress.org/mansoor8080
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: email-verification-for-products
 * Domain Path: /languages
 * Requires PHP: 7.2
 * Requires at least: 5.4
 * Requires Plugins: WooCommerce
 */

if (!defined('ABSPATH')) exit;

// Check for WooCommerce
add_action('admin_init', function() {
    if (!class_exists('WooCommerce')) {
        add_action('admin_notices', function() {
            echo '<div class="notice notice-error"><p><strong>Email Verification for Products</strong> requires WooCommerce to be installed and activated.</p></div>';
        });
    }
});

// Include components
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';
require_once plugin_dir_path(__FILE__) . 'includes/ajax-handler.php';
require_once plugin_dir_path(__FILE__) . 'admin/settings.php';

// Enqueue assets
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('evg-style', plugin_dir_url(__FILE__) . 'css/style.css', [], '1.0.0');
    wp_enqueue_script('evg-script', plugin_dir_url(__FILE__) . 'js/script.js', [], '1.0.0', true);
    wp_localize_script('evg-script', 'evgData', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('evg_nonce'),
    ]);
});

add_filter('plugin_action_links_email-verification-for-products/email-verification-for-products.php', 'evg_plugin_action_links');
function evg_plugin_action_links($links) {
    $settings_link = '<a href="' . admin_url('options-general.php?page=email-verification-gate') . '">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}

add_filter('plugin_row_meta', 'evg_plugin_row_meta', 10, 2);
function evg_plugin_row_meta($links, $file) {
    if ($file == 'email-verification-for-products/email-verification-for-products.php') {
        $hire_me_link = '<a href="mailto:mansaidus@gmail.com">Hire Me</a>';
        $links[] = $hire_me_link;
    }
    return $links;
}
