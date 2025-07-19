=== Email Verification for Products ===
Contributors: mansoor8080  
Tags: woocommerce, guest checkout, content restriction
Requires at least: 5.4  
Tested up to: 6.8  
Requires PHP: 7.2  
Stable tag: 1.0.0  
License: GPLv2 or later  
License URI: https://www.gnu.org/licenses/gpl-2.0.html  

Restrict content unless a user verifies purchase via email. Perfect for guest checkout, digital rewards, and gated content.

== Description ==

It is a lightweight plugin that lets you restrict content on a WordPress page or post unless the visitor verifies they've purchased a specific WooCommerce product — using only their email address
This is ideal for digital rewards, gated resources, or interactive features like spin-to-win wheels.  
No user login required — works perfectly with guest checkout!

**🔑 Key Features**

- Restrict content by WooCommerce product ID
- Supports guest (non-logged-in) customers
- Email-based verification with order lookup
- Set a time limit (e.g., “purchase within last 30 days”)
- Simple [shortcode] embed
- Modern, responsive design
- Session-based caching to avoid repeat verification
- Settings and Donate links directly in plugin list
- Admin panel for easy configuration

**🔧 Requirements**
- WooCommerce must be installed and active

== Installation ==

1. Upload the plugin zip via Plugins > Add New > Upload
2. Activate the plugin through the ‘Plugins’ menu
3. Go to Settings → Email Verification for Products
4. Enter the WooCommerce product ID(s) and optionally, a time limit in days
5. Use the shortcode `[email_verification_gate]` on any page or post

== FAQ ==

= Does this work for guest checkout users? =  
Yes, the plugin is specifically designed for users who checkout without creating an account.

= Can I limit content access to recent purchases only? =  
Yes! Use the "Order Recency Limit" field to require purchases within X days.

= What happens if WooCommerce is not active? =  
The plugin will show a warning and not perform checks.

= Is email verification cached per session? =  
Yes — verified emails are stored in sessionStorage to avoid repeat checks.

== Screenshots ==

1. Email verification form (frontend)
2. Admin settings for product IDs and time limits
3. Shortcode embed copy panel
4. Example: gated content (e.g., Spin the Wheel)

== Changelog ==

= 1.0.0 =
* Initial release: shortcode-based email verification for WooCommerce guest purchases

== Upgrade Notice ==

= 1.0.0 =
First stable version.

== Credits ==

Developed by [Mansoor Saidu](https://profiles.wordpress.org/mansoor8080)  
Inspired by community needs for simple guest-checkout content restriction.

== License ==

This plugin is licensed under the GPLv2 or later. You may use it for free, in personal or commercial projects.
