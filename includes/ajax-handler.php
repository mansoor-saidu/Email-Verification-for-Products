<?php
add_action('wp_ajax_nopriv_check_email_purchase', 'ajax_check_email_purchase');
function ajax_check_email_purchase() {
    check_ajax_referer('evfp_nonce', 'nonce');

    if (!isset($_POST['email'])) {
        wp_send_json_error();
    }

    $email = sanitize_email(wp_unslash($_POST['email']));
    $product_ids = array_map('trim', explode(',', get_option('evfp_product_ids', '')));
    $days_limit = intval(get_option('evfp_days_limit', 0));

    $args = [
        'limit' => -1,
        'status' => 'completed',
        'billing_email' => $email,
    ];

    if ($days_limit > 0) {
        $args['date_created'] = '>' . (new DateTime("-{$days_limit} days"))->format('Y-m-d H:i:s');
    }

    $orders = wc_get_orders($args);

    foreach ($orders as $order) {
        foreach ($order->get_items() as $item) {
            if (in_array($item->get_product_id(), $product_ids)) {
                wp_send_json_success();
            }
        }
    }

    wp_send_json_error();
}
