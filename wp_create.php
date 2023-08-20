<?php
function add_slack_notification_menu() {
    add_menu_page(
        'Slack Notification Settings',
        'Slack Notification',
        'manage_options',
        'slack-notification-settings',
        'slack_notification_settings_page'
    );
}
add_action('admin_menu', 'add_slack_notification_menu');


function slack_notification_settings_page() {


    // Display the settings form
    ?>
    <div class="wrap">
        <h2>Slack Notification Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('slack-notification-group'); ?>
            <?php do_settings_sections('slack-notification-group'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">URL</th>
                    <td><input type="text" name="slack_webhook_url" value="<?php echo esc_attr(get_option('slack_webhook_url')); ?>" class="regular-text" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}


function init_slack_notification_settings() {
    register_setting('slack-notification-group', 'slack_webhook_url');
}
add_action('admin_init', 'init_slack_notification_settings');


function send_slack_notification_on_new_order($order_id) {
  
    $webhook_url = get_option('slack_webhook_url');

    if (empty($webhook_url)) {
        return;
    }

    $order = wc_get_order($order_id);

    $message = "New order created:\n";
    $message .= "Order ID: " . $order->get_id() . "\n";
    $message .= "Total: " . wc_price($order->get_total());

    
    $response = wp_safe_remote_post($webhook_url, [
        'body' => json_encode(['text' => $message]),
        'headers' => array('Content-Type' => 'application/json'),
    ]);
}
add_action('woocommerce_new_order', 'send_slack_notification_on_new_order');


