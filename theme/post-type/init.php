<?php
if (!defined( 'ABSPATH' ) ) exit;

/**
 * Add Post Types
 */
add_action( 'init', 'zenith_add_post_type_invoice' );
add_action( 'init', 'zenith_add_post_type_estimate' );
function zenith_add_post_type_invoice() {
	register_post_type(
		'invoice',
		array(
			'labels' => array(
				'name' => '請求書',
				'view_item' => '請求書の表示',
				'edit_item' => '請求書の編集',
				'add_new_item' => '請求書を作成'
			),
			'public' => true,
			'public_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'has_archive' => true,
			'supports' => array( 'title' ),
			'menu_icon' => 'dashicons-list-view',
			'menu_position' => 5
		)
	);
	register_taxonomy(
		'invoice-cat', 
		'invoice',
		array(
			'hierarchical' => true,
			'update_count_callback' => '_update_post_term_count',
			'label' => '請求書カテゴリ',
			'singular_label' => '請求書カテゴリ',
			'public' => true,
			'show_ui' => true
		)
	);
}

function zenith_add_post_type_estimate() {
	register_post_type(
		'estimate',
		array(
			'labels' => array(
				'name' => '見積書',
				'view_item' => '見積書の表示',
				'edit_item' => '見積書の編集',
				'add_new_item' => '見積書を作成'
			),
			'public' => true,
			'public_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'has_archive' => true,
			'supports' => array( 'title' ),
			'menu_icon' => 'dashicons-media-spreadsheet',
			'menu_position' => 5
		)
	);
	register_taxonomy(
		'estimate-cat', 
		'estimate',
		array(
			'hierarchical' => true,
			'update_count_callback' => '_update_post_term_count',
			'label' => '見積書カテゴリ',
			'singular_label' => '見積書カテゴリ',
			'public' => true,
			'show_ui' => true
		)
	);
}

/**
 * エディターを削除
 */
add_action( 'init', 'zenith_remove_post_editor_support' );
function zenith_remove_post_editor_support() {
	remove_post_type_support( 'invoice', 'editor' );
	remove_post_type_support( 'estimate', 'editor' );
}

/**
 * タイトルの置き換え
 */
add_filter( 'wp_title', 'zenith_title_custom', 11 );
add_filter( 'pre_get_document_title', 'zenith_title_custom', 11 );
function zenith_title_custom( $title ) {
	$target_post_types = array( 'invoice', 'estimate' );
	if ( is_single() ) {
		global $post;
		setup_postdata( $post );
		$post_type = zenith_get_post_type();
		if ( in_array( $post_type['slug'], $target_post_types ) ) {
			$title = $post_type['name'] . '--' . get_the_title( $post->bill_client ) . '御中-' . get_the_title() . '__' . get_the_date( 'Ymd' );
		}
	}
	return strip_tags( $title );
}
