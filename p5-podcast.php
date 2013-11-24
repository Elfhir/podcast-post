<?php
/**
 * @package platform5-podcast
 * @version 0.1.0
 *
 *
 * Plugin Name: Platform5 Podcast
 * Plugin URI: http://www.jeremy-ta.fr/app/wp-plugins/platform5-podcast/
 * Description: WP plugin which import data from given values (array) into new WP posts - back-end test for Platform5
 * It requires the activation of Advanced Custom Fields plugin before.
 * Author: Jérémy Ta - Elfhir
 * Version: 0.1.0
 * Author URI: http://www.jeremy-ta.fr/
 * Licence: The MIT License (MIT)
 * Licence URI: http://opensource.org/licenses/MIT
 * 
 * Copyright (c) <2013> <Jérémy Ta - Elfhir>
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
**/

add_action( 'init', 'init_custom_post' );
/**
 * Create Custom Post Type as Post, Page ... When the Plugin is activating
 * @todo  DOC
 */
function init_custom_post() {

	register_post_type( 'p5-podcast-post',
		array(
			'labels' => array(
				'name' => __( 'p5-podcast-posts' ),
				'singular_name' => __( 'p5-podcast-post' )
			),
			'public' => true,
			'has_archive' => true,
			'show_ui' => true,
			'rewrite' => array('slug' => 'p5-podcast-post'),
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array('title',
					'editor',
					'author',
					'thumbnail',
					'excerpt',
					'custom-fields'
					)
		)
	);
}


add_action( 'template_redirect', 'init_custom_post_template' );
/**
 * Redirect for custom template in template subdirectory
 * @todo  DOC
 */
function init_custom_post_template() {
	
	// Checks for single p5 podcast template
	$template_path = dirname( __FILE__ ).'/template/single-p5-podcast-post.php';

	if (file_exists($template_path)) {

		// Page not Found ?
		include( $template_path );
        exit;
	}
}



// EOF Never write after php closing tag
?>