<?php
function render_email_verification_gate() {
    $prompt = get_option('evg_email_prompt', 'Enter your email to verify your purchase:');
    $content = get_option('evg_protected_content', '[wof_wheel id="959"]');
    ob_start(); ?>
<?php
$verified = isset($_COOKIE['evg_verified']) && $_COOKIE['evg_verified'] === 'true';

if ($verified) {
    echo '<div id="protected-content">';
    echo do_shortcode(get_option('evg_protected_content', '[wof_wheel id="959"]'));
    echo '</div>';
} else {
?>
<div id="verify-section">
    <p><?php echo esc_html(get_option('evg_email_prompt', 'Enter your email to verify your purchase:')); ?></p>
    <input type="email" id="verify-email" placeholder="Enter your email" required />
    <button onclick="verifyEmail()">Verify</button>
    <p id="verify-message"></p>
</div>
<?php } ?>
    <?php return ob_get_clean();
}
add_shortcode('email_verification_gate', 'render_email_verification_gate');
