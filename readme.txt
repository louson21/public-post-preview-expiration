=== PPP Extension ===

Contributors: wing.louie
Donate link: https://louiesonugan.com/donate/
Tags: public post preview, expiration
Requires at least: 5.0
Tested up to: 7.1
Requires PHP: 8.0
Stable tag: 1.0.5
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Extends the Public Post Preview plugin by allowing users to customize the expiration time dynamically through the WordPress admin panel.

== Features ==

* Set the expiration time for Public Post Preview links.
* Customize the expiration time in **minutes** (from 1 minute to 30 days).
* Secure input validation to prevent invalid values.
* Fully integrated into the **WordPress Settings panel**.
* Safe and lightweight implementation.

== Installation ==

1. Download the plugin.
2. Upload the extracted `ppp-extension` folder to `/wp-content/plugins/`.
3. Activate the plugin in WordPress Admin > Plugins.


== How to Use ==

1. Navigate to **Settings > PPP Extension** in your WordPress admin panel.
2. Enter the expiration time in **minutes** (minimum: 1, maximum: 43200 minutes / 30 days).
3. Click Save Changes.
4. Public Post Preview links will now expire based on your selected time.


== Security ==

– User input is **sanitized** and validated to prevent unauthorized values.
– The input is limited between **1 minute and 30 days** to avoid extreme values.
– Escaped output prevents XSS attacks.


== Frequently Asked Questions ==

= What is the allowed expiration time range? =
You can set the expiration time between **1 minute (minimum) and 43200 minutes (30 days maximum)**.

= Does this work without Public Post Preview installed? =
No, this plugin extends the [Public Post Preview](https://wordpress.org/plugins/public-post-preview/) plugin, so it must be installed and activated first.

= Does this work on Multisite? =
The expiration setting applies network-wide to every site's Public Post Preview links, since it filters a shared nonce lifetime. It has not been extensively tested in multisite environments; use with that in mind.


== Changelog ==

= 1.0.5 =
* Tested with WordPress 7.1.
* Added `Requires Plugins` header so WordPress can natively flag when Public Post Preview is missing.
* Added direct file access protection.
* Added proper text domain loading for translations.
* Added uninstall cleanup to remove stored settings when the plugin is deleted.
* Removed unnecessary closing PHP tag.

= 1.0.4 =
* Tested with WordPress 6.9.
* Enhanced code structure and improved escaping for better security.
* Added proper internationalization support throughout the plugin.
* Added capability checks for enhanced security.
* Improved function documentation and code organization.

= 1.0.3 =
* Tested with WordPress 6.8.
* Added a Settings link next to Deactivate on the Plugins page.

= 1.0.2 =
* Security enhancements for user input.
* Set expiration time in minutes instead of seconds.
* Capped expiration limit to **30 days (43200 minutes)**.

= 1.0.1 =
* Security enhancements for user input.
* Set expiration time in minutes instead of seconds.
* Capped expiration limit to **3 days (4320 minutes)**.

= 1.0.0 =
* Initial implementation of dynamic expiration settings.

== Upgrade Notice ==

= 1.0.5 =
Tested for WordPress v7.1. Adds native plugin dependency check, direct access protection, translation loading, and uninstall cleanup.

= 1.0.4 =
Tested for WordPress v6.9. Enhanced security with improved code structure and better internationalization support.

= 1.0.3 =
* Tested for WordPress v6.8.
* Added Settings link before Deactivate in the Plugins page.

= 1.0.2 =
Improved security and extended expiration limit to 30 days.

= 1.0.1 =
Added input sanitization and minute-based expiration setting.

== Screenshots ==

1. Admin settings page for setting expiration time in minutes.

== License ==

This plugin is released under the GPLv2 or later license.