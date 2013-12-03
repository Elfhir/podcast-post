<?php
/**
 * @package platform5-podcast
 * @version 0.1.0
 *
 *
 * Plugin Name: platform5-podcast
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
 * Create Custom Post Type as Post, Page ...
 * It will use custom-fields 
 *
 */
function init_custom_post() {

	register_post_type( 'p5-podcast-post',
		array(
			'labels' => array(
				'name' => __( 'p5-podcast-posts' ),
				'singular_name' => __( 'p5-podcast-post' ),
				 'menu_name' => __('Podcast')
			),
			'public' => true,
			'has_archive' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array('slug' => 'p5-podcast-post'),
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


add_filter( 'single_template', 'include_custom_podcast_post' ) ;
/**
 * Redirect for custom template in template subdirectory
 * @todo  DOC
 */
function include_custom_podcast_post($single_template) {
	global $post;
	
	if ($post->post_type == 'p5-podcast-post') {
		$single_template = plugin_dir_path( __FILE__ ) . 'template/single-p5-podcast-post.php';
	}
	return $single_template;
}

register_activation_hook( __FILE__, 'import_data_podcast' );
/**
 * When the plugin is activating, create 6 examples of post in database
 * There is no check if the file is there and it should be safely formated
 *
 */
function import_data_podcast( ) {
	// When the plugin is activating, insert 6 examples of post
	$file = include(plugin_dir_path( __FILE__ ) .'/data/datas.php');

	// import data
	$episodes = unserialize( $data ) ;

	// Insertion with a loop IS BETTER, but it doesn't succeed the way I do.
	// It insert Draft posts ...
	/*
	$post_id = array();
	$post = array();

	$i = 0;
	foreach ($episodes as $ep => $val) {

		$post[$i] = array(
			'post_author' => 'Jérémy Ta',
			'post_status' => $ep[$i]['state'],
			'post_date' => $ep[$i]['pubdate'],
			'post_excerpt' => $ep[$i]['desc'],
			'post_name' => $ep[$i]['alias'],
			'post_title' => $ep[$i]['h1'],
			'post_content' => $ep[$i]['text'],
			'post_type' => 'p5-podcast-post',
			'tags_input' => utf8_encode(explode(",", $ep[$i]['tags']))
		);
		
		$post_id[$i] = wp_create_category($ep[$i]['category']);	

		// Featured image => insert in Media Library from import
		$image = media_sideload_image($ep[$i]['image'], $post_id, $desc);
			
		$i++;
	}

	for ($i = 0, $len = count($episodes); $i < $len; $i++) {
		// Insert the post into the database
		echo $post[$i];
		$post_id[$i] = wp_insert_post( $post[$i] );
	}
	*/

	// WARNING : because the previous loop doesn't work yet, I insert post one by one, because
	// I know the number ... ugly, but it works. I didn't find the

	// post 5
	// utf8_encode can be good for all fields. A special function for cleaning would be better.
	$post = array(
			'post_author' => '1',
			'post_status' => $episodes[5]['state'],
			'post_date' => $episodes[5]['pubdate'],
			'post_excerpt' => $episodes[5]['desc'],
			'post_name' => $episodes[5]['alias'],
			'post_title' => utf8_encode($episodes[5]['h1']),
			'post_content' => $episodes[5]['text'],
			'post_type' => 'p5-podcast-post',
			'tags_input' => utf8_encode(explode(",", $episodes[5]['tags'])),
			'comment_status' => 'closed',
			'ping_status' => 'closed',
		);
		// Insert the post into the database
		$post_id = wp_insert_post( $post );

		// Featured image => insert in Media Library, with a right url. Image is attach to the post.
		$image = media_sideload_image($episodes[5]['image'], $post_id, 'image');

		// Create a category
		wp_create_category(utf8_encode($episodes[5]['category']));

		// Add the custom fields
		add_post_meta($post_id, 'order', $episodes[5]['order'], true) || update_post_meta( $post_id, 'order', $episodes[5]['order'] );
		add_post_meta($post_id, 'subtitle', $episodes[5]['h2'], true) || update_post_meta( $post_id, 'subtitle', $episodes[5]['h2'] );
		add_post_meta($post_id, 'mp3', $episodes[5]['mp3'], true) || update_post_meta( $post_id, 'mp3', $episodes[5]['mp3'] );
		add_post_meta($post_id, 'duree', $episodes[5]['duree'], true) || update_post_meta( $post_id, 'duree', $episodes[5]['duree'] );

	// post 1
	$post = array(
			'post_author' => '1',
			'post_status' => $episodes[1]['state'],
			'post_date' => $episodes[1]['pubdate'],
			'post_excerpt' => $episodes[1]['desc'],
			'post_name' => $episodes[1]['alias'],
			'post_title' => utf8_encode($episodes[1]['h1']),
			'post_content' => $episodes[1]['text'],
			'post_type' => 'p5-podcast-post',
			'tags_input' => utf8_encode(explode(",", $episodes[1]['tags'])),
			'comment_status' => 'closed',
			'ping_status' => 'closed',
		);
		// Insert the post into the database
		$post_id = wp_insert_post( $post );

		wp_create_category(utf8_encode($episodes[1]['category']));

		$image = media_sideload_image($episodes[1]['image'], $post_id, 'image');

		add_post_meta($post_id, 'order', $episodes[1]['order'], true) || update_post_meta( $post_id, 'order', $episodes[1]['order'] );
		add_post_meta($post_id, 'subtitle', $episodes[1]['h2'], true) || update_post_meta( $post_id, 'subtitle', $episodes[1]['h2'] );
		add_post_meta($post_id, 'mp3', $episodes[1]['mp3'], true) || update_post_meta( $post_id, 'mp3', $episodes[1]['mp3'] );
		add_post_meta($post_id, 'duree', $episodes[1]['duree'], true) || update_post_meta( $post_id, 'duree', $episodes[1]['duree'] );

	// post 7
	$post = array(
			'post_author' => '1',
			'post_status' => $episodes[7]['state'],
			'post_date' => $episodes[7]['pubdate'],
			'post_excerpt' => $episodes[7]['desc'],
			'post_name' => $episodes[7]['alias'],
			'post_title' => utf8_encode($episodes[7]['h1']),
			'post_content' => $episodes[7]['text'],
			'post_type' => 'p5-podcast-post',
			'tags_input' => utf8_encode(explode(",", $episodes[7]['tags'])),
			'comment_status' => 'closed',
			'ping_status' => 'closed',
		);
		// Insert the post into the database
		$post_id = wp_insert_post( $post );

		wp_create_category(utf8_encode($episodes[7]['category']));

		$image = media_sideload_image($episodes[7]['image'], $post_id, 'image');

		add_post_meta($post_id, 'order', $episodes[7]['order'], true) || update_post_meta( $post_id, 'order', $episodes[7]['order'] );
		add_post_meta($post_id, 'subtitle', $episodes[7]['h2'], true) || update_post_meta( $post_id, 'subtitle', $episodes[7]['h2'] );
		add_post_meta($post_id, 'mp3', $episodes[7]['mp3'], true) || update_post_meta( $post_id, 'mp3', $episodes[7]['mp3'] );
		add_post_meta($post_id, 'duree', $episodes[7]['duree'], true) || update_post_meta( $post_id, 'duree', $episodes[7]['duree'] );

	// post 12
	$post = array(
			'post_author' => '1',
			'post_status' => $episodes[12]['state'],
			'post_date' => $episodes[12]['pubdate'],
			'post_excerpt' => $episodes[12]['desc'],
			'post_name' => $episodes[12]['alias'],
			'post_title' => utf8_encode($episodes[12]['h1']),
			'post_content' => $episodes[12]['text'],
			'post_type' => 'p5-podcast-post',
			'tags_input' => utf8_encode(explode(",", $episodes[12]['tags'])),
			'comment_status' => 'closed',
			'ping_status' => 'closed',
		);
		// Insert the post into the database
		$post_id = wp_insert_post( $post );

		wp_create_category(utf8_encode($episodes[12]['category']));

		$image = media_sideload_image($episodes[12]['image'], $post_id, 'image');

		add_post_meta($post_id, 'order', $episodes[12]['order'], true) || update_post_meta( $post_id, 'order', $episodes[12]['order'] );
		add_post_meta($post_id, 'subtitle', $episodes[12]['h2'], true) || update_post_meta( $post_id, 'subtitle', $episodes[12]['h2'] );
		add_post_meta($post_id, 'mp3', $episodes[12]['mp3'], true) || update_post_meta( $post_id, 'mp3', $episodes[12]['mp3'] );
		add_post_meta($post_id, 'duree', $episodes[12]['duree'], true) || update_post_meta( $post_id, 'duree', $episodes[12]['duree'] );

	// post 14
	$post = array(
			'post_author' => '1',
			'post_status' => $episodes[14]['state'],
			'post_date' => $episodes[14]['pubdate'],
			'post_excerpt' => $episodes[14]['desc'],
			'post_name' => $episodes[14]['alias'],
			'post_title' => utf8_encode($episodes[14]['h1']),
			'post_content' => $episodes[14]['text'],
			'post_type' => 'p5-podcast-post',
			'tags_input' => utf8_encode(explode(",", $episodes[14]['tags'])),
			'comment_status' => 'closed',
			'ping_status' => 'closed',
		);
		// Insert the post into the database
		$post_id = wp_insert_post( $post );

		wp_create_category(utf8_encode($episodes[14]['category']));

		$image = media_sideload_image($episodes[14]['image'], $post_id, 'image');

		add_post_meta($post_id, 'order', $episodes[14]['order'], true) || update_post_meta( $post_id, 'order', $episodes[14]['order'] );
		add_post_meta($post_id, 'subtitle', $episodes[14]['h2'], true) || update_post_meta( $post_id, 'subtitle', $episodes[14]['h2'] );
		add_post_meta($post_id, 'mp3', $episodes[14]['mp3'], true) || update_post_meta( $post_id, 'mp3', $episodes[14]['mp3'] );
		add_post_meta($post_id, 'duree', $episodes[14]['duree'], true) || update_post_meta( $post_id, 'duree', $episodes[14]['duree'] );

	// post 21
	$post = array(
			'post_author' => '1',
			'post_status' => $episodes[21]['state'],
			'post_date' => $episodes[21]['pubdate'],
			'post_excerpt' => $episodes[21]['desc'],
			'post_name' => $episodes[21]['alias'],
			'post_title' => utf8_encode($episodes[21]['h1']),
			'post_content' => $episodes[21]['text'],
			'post_type' => 'p5-podcast-post',
			'tags_input' => utf8_encode(explode(",", $episodes[21]['tags'])),
			'comment_status' => 'closed',
			'ping_status' => 'closed',
		);
		// Insert the post into the database
		$post_id = wp_insert_post( $post );

		wp_create_category(utf8_encode($episodes[21]['category']));

		$image = media_sideload_image($episodes[21]['image'], $post_id, 'image');

		add_post_meta($post_id, 'order', $episodes[21]['order'], true) || update_post_meta( $post_id, 'order', $episodes[21]['order'] );
		add_post_meta($post_id, 'subtitle', $episodes[21]['h2'], true) || update_post_meta( $post_id, 'subtitle', $episodes[21]['h2'] );
		add_post_meta($post_id, 'mp3', $episodes[21]['mp3'], true) || update_post_meta( $post_id, 'mp3', $episodes[21]['mp3'] );
		add_post_meta($post_id, 'duree', $episodes[21]['duree'], true) || update_post_meta( $post_id, 'duree', $episodes[21]['duree'] );	

}


// EOF Never write after php closing tag
?>