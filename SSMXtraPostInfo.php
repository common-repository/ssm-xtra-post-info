<?php
/*
Plugin Name: SSM Xtra Post Info
Description: Adds a "featured image" checkbox to Screen Options when viewing All Posts. If the box is checked, If a post has a featured image, you will see a small thumbnail.
Version: 1.0
Author: Bernard Meisler
Author URI: http://www.evili.com 
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2017 East Village Interactive, Inc. email: bmeisler@evili.com
*/
defined( 'ABSPATH' ) OR exit;

define('SSMXTRAPOSTINFO_VERSION', '1.0');
define('SSMXTRAPOSTINFO_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('SSMXTRAPOSTINFO_PLUGIN_URL', plugin_dir_url( __FILE__ ));

require_once(SSMXTRAPOSTINFO_PLUGIN_DIR . 'SSMXtraPostInfo.class.php');

//register activation and deactivation hooks
register_activation_hook(   __FILE__, array( '\SSMXtraPostInfo\PostInfo', 'ssm_postinfo_on_activation' ) );
register_deactivation_hook( __FILE__, array( '\SSMXtraPostInfo\PostInfo', 'ssm_postinfo_on_deactivation' ) );

//start me up
add_action( 'plugins_loaded', array( '\SSMXtraPostInfo\PostInfo', 'ssm_postinfo_init' ) );
