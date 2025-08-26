<?php
/**
 * Plugin Name:       Quiz Block
 * Description:		  Custom Gutenberg block for creating quizzes.
 * Requires at least: 6.6
 * Requires PHP:      7.2
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       quiz-block
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_quiz_block_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'create_block_quiz_block_block_init' );

function quiz_block_enqueue_scripts() {
    wp_enqueue_script(
		'quiz-checker',
		plugins_url('quiz-checker.js', __FILE__),
		array(),
		'1.0.0',
		true
	);
}
add_action('wp_enqueue_scripts', 'quiz_block_enqueue_scripts');

