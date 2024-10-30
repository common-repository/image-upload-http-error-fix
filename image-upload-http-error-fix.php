<?php
/*
Plugin Name: Image Upload HTTP Error Fix
Description: Fixes the media uploader HTTP Error that some WordPress configurations suffer from.
Plugin URI:  http://lud.icro.us/wordpress-plugin-image-upload-http-error-fix/
Version:     1.1
License:     GNU General Public License
Author:      John Blackbourn
Author URI:  http://johnblackbourn.com/

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

*/

function iuehf_activate() {
	global $wp_rewrite;
	$hp = get_home_path();

	if ( ( !file_exists( $hp . '.htaccess' ) and !is_writable( $hp ) )
	   or ( file_exists( $hp . '.htaccess' ) and !is_writable( $hp . '.htaccess' ) ) )
		add_option( 'iuehf_notice', true );

	$wp_rewrite->flush_rules();
}

function iuehf_notice() {
	if ( get_option( 'iuehf_notice' ) ) {
		?>
		<div class="updated fade" id="iuhef_message"><p><?php _e( '<strong>Your blog&#8217;s .htaccess file needs to be updated, but it is not writable.</strong> Please visit your <a href="options-permalink.php">Permalink Settings</a> page and follow the instructions on there for updating your .htaccess file.', 'iuehf' ); ?></p></div>
		<?php
	}
}

add_filter( 'mod_rewrite_rules', create_function(
	'$rules', 'return $rules . "
#BEGIN Image Upload HTTP Error Fix
<IfModule mod_security.c>
<Files async-upload.php>
SecFilterEngine Off
SecFilterScanPOST Off
</Files>
</IfModule>
<IfModule security_module>
<Files async-upload.php>
SecFilterEngine Off
SecFilterScanPOST Off
</Files>
</IfModule>
<IfModule security2_module>
<Files async-upload.php>
SecFilterEngine Off
SecFilterScanPOST Off
</Files>
</IfModule>
#END Image Upload HTTP Error Fix
";'
	) );

add_action( 'admin_notices', 'iuehf_notice' );
add_action( 'load-options-permalink.php', create_function( '$a', 'return delete_option( "iuehf_notice" );' ) );

load_plugin_textdomain( 'iuhef', PLUGINDIR );
register_activation_hook( __FILE__, 'iuehf_activate' );

?>