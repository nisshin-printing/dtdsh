<?php
$service = array(
	array(
		'id' => get_page_by_path( '/service/web' ),
		'slug' => 'web',
		'isDomain' => true,
		'isFeature' => array(
			'prefix' => 'thumbnail--',
			'format' => '.jpg',
			'style' => 'width:auto;height:100%;max-width:none',
		),
		'title' => get_the_title( get_page_by_path( '/service/web' ) )
	),
	array(
		'id' => get_page_by_path( '/service/print' ),
		'slug' => 'print',
		'isDomain' => true,
		'isFeature' => array(
			'prefix' => 'thumbnail--',
			'format' => '.jpg',
			'style' => 'width:auto;height:100%;',
		),
		'title' => get_the_title( get_page_by_path( '/service/print' ) )
	),
	array(
		'id' => get_page_by_path( '/service/design' ),
		'slug' => 'design',
		'isDomain' => true,
		'isFeature' => array(
			'prefix' => 'thumbnail--',
			'format' => '.png',
			'style' => 'width:auto;height:100%;max-width:none',
		),
		'title' => get_the_title( get_page_by_path( '/service/design' ) )
	),
	array(
		'id' => get_page_by_path( '/service/web-consulting' ),
		'slug' => 'web-consulting',
		'isDomain' => true,
		'isFeature' => array(
			'prefix' => 'thumbnail--',
			'format' => '.png',
			'style' => 'width:auto;height:100%;max-width:none',
		),
		'title' => get_the_title( get_page_by_path( '/service/web-consulting' ) )
	),
	array(
		'id' => get_page_by_path( '/service/advertisement' ),
		'slug' => 'advertisement',
		'isDomain' => false,
		'isFeature' => array(
			'prefix' => '',
			'format' => '.png',
			'style' => '',
		),
		'title' => get_the_title( get_page_by_path( '/service/advertisement' ) )
	),
	array(
		'id' => get_page_by_path( '/service/management-consulting' ),
		'slug' => 'management-consulting',
		'isDomain' => true,
		'isFeature' => array(
			'prefix' => 'thumbnail--',
			'format' => '.jpg',
			'style' => 'width:auto;height:100%;max-width:none',
		),
		'title' => get_the_title( get_page_by_path( '/service/management-consulting' ) )
	),
	array(
		'id' => get_page_by_path( '/service/seo' ),
		'slug' => 'seo',
		'isDomain' => true,
		'isFeature' => array(
			'prefix' => '',
			'format' => '.png',
			'style' => '',
		),
		'title' => get_the_title( get_page_by_path( '/service/seo' ) )
	),
	array(
		'id' => get_page_by_path( '/service/variety' ),
		'slug' => 'variety',
		'isDomain' => true,
		'isFeature' => array(
			'prefix' => 'thumbnail--',
			'format' => '.jpg',
			'style' => 'width:auto;height:100%;max-width:none',
		),
		'title' => get_the_title( get_page_by_path( '/service/variety' ) )
	),
	array(
		'id' => get_page_by_path( '/service/ms-management' ),
		'slug' => 'ms-management',
		'isDomain' => true,
		'isFeature' => array(
			'prefix' => '',
			'format' => '.png',
			'style' => '',
		),
		'title' => get_the_title( get_page_by_path( '/service/ms-management' ) )
	),
	array(
		'id' => get_page_by_path( '/service/ms-lease' ),
		'slug' => 'ms-lease',
		'isDomain' => true,
		'isFeature' => false,
		'title' => get_the_title( get_page_by_path( '/service/ms-lease' ) )
	)
);
