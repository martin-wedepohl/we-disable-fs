<?php
/**
 * Disable WordPress Block Editor Fullscreen Mode
 *
 * @package   WEDisableFS
 * @author    Martin Wedepohl <martin@wedepohlengineering.com>
 * @copyright 2020 Wedepohl Engineering
 * @license   http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Disable Block Editor Fullscreen
 * Plugin URI:        https://github.com/martin-wedepohl/we-disable-fs
 * Description:       Disable the WordPress Block Editor Fullscreen Mode which is enabled by default.
 * Version:           1.0.8
 * Requires at least: 5.3
 * Requires PHP:      5.6
 * Author:            Martin Wedepohl
 * Author URI:        https://wedepohlengineering.com/
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       we-disable-fs
 *
 * The plugin we_disable_fs is free software: you can redistribute it
 * and/or modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3 of
 * the License, or any later version.
 *
 * we_disable_fs is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with we_disable_fs. If not, see https://www.gnu.org/licenses/gpl-3.0.html.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( 'WEDisableFS' ) ) {

	/**
	 * Class WEDisableFS
	 *
	 * Provides all the functionality to disable the WordPress block editor
	 * fullscreen mode which by default is eanbled in WordPress 5.4.
	 *
	 * @package WEDisableFS
	 */
	class WEDisableFS {

		/**
		 * Initialize the class.
		 *
		 * @since 1.0.0
		 */
		public static function init() {

			add_action( 'enqueue_block_editor_assets', array( 'WEDisableFS', 'disable_editor_fullscreen' ) );

		}

		/**
		 * Disable the WordPress editor fullscreen if enabled.
		 *
		 * Full credit to Jean-Baptiste Audras for his blog on how to do this.
		 * https://jeanbaptisteaudras.com/en/2020/03/disable-block-editor-default-fullscreen-mode-in-wordpress-5-4/
		 *
		 * @since 1.0.0
		 */
		public static function disable_editor_fullscreen() {

			$script = "window.onload = function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } }";
			wp_add_inline_script( 'wp-blocks', $script );

		}
	}

	WEDisableFS::init();

}
