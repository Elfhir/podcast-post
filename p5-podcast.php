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
 * Parse data/datas.php
 * @todo  DOC
 */
function include_custom_podcast_post($single_template) {
	global $post;

	$file = include(plugin_dir_path( __FILE__ ) .'/data/datas.php');
	
	// import data
	$ep = unserialize( $data ) ;
	var_dump($ep);

	if ($post->post_type == 'p5-podcast-post') {
		$single_template = plugin_dir_path( __FILE__ ) . 'template/single-p5-podcast-post.php';
	}
	return $single_template;
}


add_action('admin_init', create_function('', 'add_meta_box("my_upload_field", "Upload File Data instead", "my_upload_field", "p5-podcast-post");'));
/**
 * @link  http://stackoverflow.com/questions/3249666/wordpress-3-0-custom-post-type-with-upload
 * adding File Upload Field for Podcast Post - instead of Filling the fields
 * We can upload a Datas.php for creating 1 (or more?) Podcast post
 * 
 * The current function add to the p5-podcast-post a field for uploading
 */
function my_upload_field( ) {
    echo '<input type="file" name="my_upload_field" />';
}

add_action('wp_insert_post', 'handle_upload_field', 10, 2);
/**
 * @link  http://stackoverflow.com/questions/3249666/wordpress-3-0-custom-post-type-with-upload
 * adding File Upload Field for Podcast Post - instead of Filling the fields
 * We can upload a Datas.php for creating 1 (or more?) Podcast post
 * 
 * The current function upload the files to
 */
function handle_upload_field( $post_ID, $post) {

    if (!empty($_FILES['my_upload_field']['name'])) {
        $upload = wp_handle_upload($_FILES['my_upload_field']);

        if (!isset( $upload['error'] )) {
            // no errors, do what you like
        	if( $upload ) {
        		echo "File is valid, and was successfully uploaded.\n";
				var_dump( $upload );
			} else {
				echo "Possible file upload attack!\n";
			}
        }
    }
}


// EOF Never write after php closing tag
?>