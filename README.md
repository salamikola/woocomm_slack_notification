# woocomm_slack_notification

- # Define a function named add_slack_notification_menu that adds a new admin menu item:

The menu item is labeled "Slack Notification" and is accessible to users with the "manage_options" capability.
When clicked, the menu item will display a page for configuring Slack notification settings.
Add an action hook admin_menu that attaches the add_slack_notification_menu function to it. This ensures that the admin menu item is added to the WordPress admin menu.

- # Define a callback function named slack_notification_settings_page that displays the content of the Slack notification settings page:

It checks if the current user has the capability to manage options. If not, it displays an error message.
It displays a settings form with a title, a text input field for the Slack webhook URL, and a submit button.
The value of the text input field is populated with the previously set Slack webhook URL (if any).

-  # Define another function named init_slack_notification_settings that initializes the settings for the Slack notification page:

It registers the setting group named "slack-notification-group" and the setting named "slack_webhook_url".
This prepares the settings for saving in the WordPress database.
Add an action hook admin_init that attaches the init_slack_notification_settings function to it. This ensures that the settings are initialized when the admin panel is loaded.

- # Define a function named send_slack_notification_on_new_order that sends a Slack notification when a new WooCommerce order is created:

It retrieves the Slack webhook URL from the saved settings.
If the webhook URL is not set, the function returns without taking any action.
It retrieves the details of the newly created order, including the order ID and total amount.
It prepares a message containing information about the new order.
It sends a POST request to the Slack webhook URL with the message in JSON format as the request body.
The Slack notification includes the order information.

- # Add an action hook woocommerce_new_order that attaches the send_slack_notification_on_new_order function to it. This ensures that the Slack notification function is triggered when a new WooCommerce order is created.





