<?php
/**
 *  Open-sourced suite of components that empower interactive storytelling.
 *
 *
 * @package   Aesop_Core
 * @author    Nick Haskins <nick@aesopinteractive.com>, Hyun Supul <hyunsupul@gmail.com>
 * @license   GPL-2.0+
 * @link      http://aesopinteractive.com
 * @copyright 2016-2021 Hyun Supul <hyun@aesopinteractive.com>
 *
 * @wordpress-plugin
 *  Plugin Name:       Aesop Story Engine
 *  Plugin URI:        https://aesopstoryengine.com
 *  Description:       Open-sourced suite of components that empower interactive storytelling.
 *  Version:           2.3.0
 *  Author:            Aesopinteractive 
 *  Author URI:        https://aesopstoryengine.com
 *  Text Domain:       aesop-core
 *  License:           GPL-2.0+
 *  License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 *  Domain Path:       /languages
 *  GitHub Plugin URI: https://github.com/hyunsupul/aesop-core
 *   Github Branch:     dev
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Set some constants
define( 'AI_CORE_VERSION', '2.3.0' );
define( 'AI_CORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'AI_CORE_URL', plugins_url( '', __FILE__ ) );

/*
 ----------------------------------------------------------------------------*
* 	Public-Facing Functionality
*----------------------------------------------------------------------------*/

require_once AI_CORE_DIR.'public/class-aesop-core.php';

/*
* 	Register hooks that are fired when the plugin is activated or deactivated.
* 	When the plugin is deleted, the uninstall.php file is loaded.
*/
register_activation_hook( __FILE__, array( 'Aesop_Core', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Aesop_Core', 'deactivate' ) );


add_action( 'plugins_loaded', array( 'Aesop_Core', 'get_instance' ) );


/*
 ----------------------------------------------------------------------------*
* 	Dashboard and Administrative Functionality
*----------------------------------------------------------------------------*/

/*
* 	The code below is intended to to give the lightest footprint possible.
*/
if ( is_admin() ) {

	require_once AI_CORE_DIR.'admin/class-aesop-core-admin.php';

	add_action( 'plugins_loaded', array( 'Aesop_Core_Admin', 'get_instance' ) );

}






/**
 * Aesop Gutenberg Support.
 */
require_once( AI_CORE_DIR . 'blocks/index.php' );

add_filter( 'block_categories_all', function( $categories, $post ) {
	/*if ( $post->post_type !== 'post' ) {
		return $categories;
	}*/
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'aesop-story-engine',
				'title' => __( 'Aesop Story Engine', 'ASE' ),
			),
		)
	);
}, 10, 2 );
