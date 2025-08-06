<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Register settings
add_action('admin_init', function() {
    register_setting('evfp_settings', 'evfp_product_ids', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    register_setting('evfp_settings', 'evfp_days_limit', [
        'sanitize_callback' => 'absint',
    ]);
    register_setting('evfp_settings', 'evfp_email_prompt', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    register_setting('evfp_settings', 'evfp_fallback_message', [
        'sanitize_callback' => 'wp_kses_post',
    ]);
    register_setting('evfp_settings', 'evfp_protected_content', [
        'sanitize_callback' => 'wp_kses_post',
    ]);
});

add_action('admin_enqueue_scripts', function($hook) {
    if ($hook === 'settings_page_email-verification-gate') {
        wp_enqueue_script(
            'evfp-admin-js',
            plugin_dir_url(__FILE__) . 'js/admin.js',
            [],
            '1.0',
            true
        );
    }
});

add_action('admin_menu', function() {
    add_options_page(
        'Email Verification for Products Settings',
        'Email Verification for Products',
        'manage_options',
        'email-verification-gate',
        'evfp_settings_page'
    );
});

function evfp_settings_page() { ?>
    <div class="wrap">
        <h2>Email Verification for Products Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('evfp_settings'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Product IDs</th>
                    <td>
                        <input type="text" name="evfp_product_ids" value="<?php echo esc_attr(get_option('evfp_product_ids', '')); ?>" />
                        <p class="description">Enter product IDs separated by commas (e.g., 123,456)</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Order Recency Limit (days)</th>
                    <td>
                        <input type="number" name="evfp_days_limit" value="<?php echo esc_attr(get_option('evfp_days_limit', '0')); ?>" />
                        <p class="description">Only accept purchases made within this number of days. Leave 0 for no limit.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Email Prompt Text</th>
                    <td>
                        <input type="text" name="evfp_email_prompt" value="<?php echo esc_attr(get_option('evfp_email_prompt', 'Enter your email to verify your purchase:')); ?>" style="width: 100%;" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Fallback Message (Unverified Users)</th>
                    <td>
                        <textarea name="evfp_fallback_message" rows="3" style="width: 100%;"><?php echo esc_textarea(get_option('evfp_fallback_message', 'To access this content, please verify your purchase using the email you used at checkout.')); ?></textarea>
                        <p class="description">Shown to users who are not verified yet. You can use plain text or HTML.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Protected Content (Shortcode)</th>
                    <td>
                        <textarea name="evfp_protected_content" rows="3" style="width: 100%;"><?php echo esc_textarea(get_option('evfp_protected_content', '[wof_wheel id="959"]')); ?></textarea>
                        <p class="description">You can enter any shortcode or HTML content here.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
        <h3>Embed Shortcode</h3>
        <p>Use this shortcode to protect content on a page or post:</p>
        <input type="text" id="evfp-shortcode" value="[email_verification_gate]" readonly style="width:300px;" />
        <button class="button" onclick="copyEVFPShortcode()">Copy Shortcode</button>
    </div>
<?php }
