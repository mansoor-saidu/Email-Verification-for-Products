<?php
function render_email_verification_gate() {
    $prompt = get_option('evg_email_prompt', 'Enter your email to verify your purchase:');
    $content = get_option('evg_protected_content', '[wof_wheel id="959"]');
    ob_start(); ?>
    <div id="verify-section">
        <p><?php echo esc_html($prompt); ?></p>
        <input type="email" id="verify-email" placeholder="Enter your email" required />
        <button onclick="verifyEmail()">Verify</button>
        <p id="verify-message"></p>
    </div>
    <div id="protected-content" style="display:none;">
        <?php echo do_shortcode($content); ?>
    </div>
    <?php return ob_get_clean();
}
add_shortcode('email_verification_gate', 'render_email_verification_gate');
