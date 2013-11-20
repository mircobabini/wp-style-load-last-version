<?php
/*
Plugin Name: W3 Total Cache Debug
Plugin URI: http://github.com/mirkolofio/wp-w3-total-cache-debug/
Description: Request the last version of the style.css even if W3 Total Cache is active. No side effects on performances.
Author: Mirco Babini <mirkolofio@gmail.com>
Version: 1.0.0
Author URI: http://github.com/mirkolofio

        Copyright (c) 2013 Mirco Babini (http://github.com/mirkolofio)
        W3 Total Cache Debug is released under the GNU General Public License (GPL)
        http://www.gnu.org/licenses/gpl-2.0.txt
*/

add_action( 'wp_enqueue_scripts', 'w3debug_enqueue_scripts', 999 );
function w3debug_enqueue_scripts() {

	if ( ! wp_style_is ( 'style', 'done' ) ) {
		
		wp_deregister_style ( 'style' );
		wp_dequeue_style ( 'style' );

		// if you have a style.css but you don't want to load it
		// you just dont need this plugin, so deactivate it
		$style_filepath = get_stylesheet_directory() . '/style.css';
		if ( file_exists ($style_filepath) ) {
			wp_enqueue_style( 'style', get_stylesheet_uri() . '?' . filemtime( $style_filepath ) );
		}

	}

}
