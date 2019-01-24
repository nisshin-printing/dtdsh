<?php
	if (!defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Sliders Post type
$labels = array(
	'name'                  => _x( 'LP','dtdsh' ),
	'singular_name'         => _x( 'LP','dtdsh' ),
	'add_new'               => _x( '新規追加','dtdsh' ),
	'add_new_item'          => _x( '新しいLPを追加','dtdsh' ),
	'edit_item'             => _x( 'LPを編集','dtdsh' ),
	'new_item'              => _x( '新しいLP','dtdsh' ),
	'all_items'             => _x( 'LP','dtdsh' ),
	'view_item'             => _x( 'LPを見る','dtdsh' ),
	'search_items'          => _x( 'LPを検索','dtdsh' ),
	'not_found'             => _x( 'LPが見つかりません','dtdsh' ),
	'not_found_in_trash'    => _x( 'ゴミ箱にLPはありません','dtdsh' ),
	'parent_item_colon'     => _x( '親アイテム','dtdsh' ),
	'menu_name'             => _x( 'LP','dtdsh' ),
);
register_post_type('dtdsh-lp', array(
	'labels'                => $labels,
	'public'                => true,
	'menu_icon'             => false,
	'publicly_queryable'    => true,
	'exclude_from_search'   => true,
	'show_ui'               => true,
	'show_in_menu'          => 'edit.php',
	'show_in_nav_menus'     => false,
	'query_var'             => true,
	'rewrite'               => array(
		'slug' => 'lp'
	),
	'capability_type'       => 'post',
	'has_archive'           => false,
	'hierarchical'          => false,
	'menu_position'         => 10,
	'supports'              => array(
		'title',
		'editor',
		'thumbnail'
	)
) );
