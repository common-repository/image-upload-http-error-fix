=== Image Upload HTTP Error Fix ===
Contributors: johnbillion
Donate link: http://lud.icro.us/donations/
Tags: upload, http, error, fix
Requires at least: 2.5
Tested up to: 2.5
Stable tag: trunk

Fixes the media uploader HTTP Error that some WordPress configurations suffer from.

== Description ==

This plugin is no longer being maintained. Use it at your own risk.

If your WordPress 2.5 installation shows an <strong>HTTP Error</strong> when uploading files using the media uploader, then this plugin should fix that problem. Simply upload and activate the plugin, then you'll be able to upload files with no problem.

Technical details:

The plugin adds a few lines to WordPress' .htaccess file which deactivates mod_security on the file which handles file uploads.

== Installation ==

This plugin is for WordPress version 2.5 or later.

1. Unzip the ZIP file and drop the folder straight into your `wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. That's it! Try uploading a file and the HTTP error should be gone.

== Changelog ==

= 1.1 =
* Addition of security2_module thanks to xtoto @ xto.ru.
* Addition of security_module to try and cover all scenarios.
* Addition of file permission checks.

= 1.0 =
Initial release.
