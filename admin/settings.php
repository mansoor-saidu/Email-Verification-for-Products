<?php
add_action('admin_menu', function() {
    add_options_page(
        'Email Verification for Products Settings',
        'Email Verification for Products',
        'manage_options',
        'email-verification-gate',
        'email_verification_gate_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('email_verification_gate_settings', 'evg_product_ids', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    register_setting('email_verification_gate_settings', 'evg_days_limit', [
        'sanitize_callback' => 'absint',
    ]);

    register_setting('email_verification_gate_settings', 'evg_email_prompt', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    register_setting('email_verification_gate_settings', 'evg_protected_content', [
        'sanitize_callback' => 'wp_kses_post',
    ]);
});

function email_verification_gate_settings_page() { ?>
    <div class="wrap">
        <h2>Email Verification for Products Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('email_verification_gate_settings'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Product IDs</th>
                    <td>
                        <input type="text" name="evg_product_ids" value="<?php echo esc_attr(get_option('evg_product_ids', '')); ?>" />
                        <p class="description">Enter product IDs separated by commas (e.g., 123,456)</p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Order Recency Limit (days)</th>
                    <td>
                        <input type="number" name="evg_days_limit" value="<?php echo esc_attr(get_option('evg_days_limit', '0')); ?>" />
                        <p class="description">Only accept purchases made within this number of days. Leave 0 for no limit.</p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Email Prompt Text</th>
                    <td>
                        <input type="text" name="evg_email_prompt" value="<?php echo esc_attr(get_option('evg_email_prompt', 'Enter your email to verify your purchase:')); ?>" style="width: 100%;" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Protected Content (Shortcode)</th>
                    <td>
                        <textarea name="evg_protected_content" rows="3" style="width: 100%;"><?php echo esc_textarea(get_option('evg_protected_content', '[wof_wheel id="959"]')); ?></textarea>
                        <p class="description">You can enter any shortcode or HTML content here.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
        <h3>Embed Shortcode</h3>
        <p>Use this shortcode to protect content on a page or post:</p>
        <input type="text" id="evg-shortcode" value="[email_verification_gate]" readonly style="width:300px;" />
        <button class="button" onclick="copyEVGShortcode()">Copy Shortcode</button>
        <script>
            function copyEVGShortcode() {
                const input = document.getElementById('evg-shortcode');
                input.select();
                input.setSelectionRange(0, 99999);
                document.execCommand('copy');
                alert('Shortcode copied to clipboard!');
            }
        </script>
    </div>
<?php }
