<?php
	if (! $bg ) {
		$bg = 'main';
	}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
	<![endif]-->

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php // replace the no-js class with js on the html element ?>
	<script>document.documentElement.className=document.documentElement.className.replace(/\bno-js\b/,'js')</script>

	<?php // load the core js polyfills ?>
	<script async src="<?php echo get_template_directory_uri(), '/assets/js/lazysizes.js'; ?>"></script>
	<script async src="//www.google.com/recaptcha/api.js?render=6Lfw5YwUAAAAAGnn7ZLvj1bQKjdFFNsyGmwJ4bia"></script>

	<?php wp_head(); ?>
</head>
<body id="js--body" class="is-loading <?php echo "u-$bg"; ?>">



	<div class="loader"><span class="loader--bars"><span></span></span></div>
	<header class="header--main <?php echo "u-$bg--turn"; ?>" id="js--header">
		<h1 class="header--logo"><a href="<?php bloginfo( 'url' ); ?>">日進印刷<span class="show-for-medium">グループ</span></a></h1>
		<?php
			wp_nav_menu( array(
				'theme_location' => $bg,
				'container' => 'nav',
				'container_id' => 'js--overflow',
				'container_class' => "overflow",
				'menu_class' => 'overflow--list',
				'items_wrap' => '<ul class="%2$s" role="menu">%3$s</ul>',
				'walker' => new NID_Walker_Nav_Menu
			) );
		?>
		<nav class="nav--sub">
			<ul class="nav--list">
				<li class="nav--item"><a href="<?php echo get_page_link( get_page_by_path( 'about' ) ); ?>" class="nav--link show-for-medium">会社案内</a></li>
				<li class="header--cta nav--item u-main show-for-medium"><a href="<?php echo get_page_link( get_page_by_path( 'contact' ) ); ?>" class="header--cta__link"><?php NID_SVG::icon( 'contact', array( 'class' => 'header--cta__icon' ), 'お問い合わせ' ); ?></a></li>
				<li class="header--cta nav--item u-main hide-for-medium"><a href="tel:0822371611" class="header--cta__link"><?php NID_SVG::icon( 'phone', array( 'class' => 'header--cta__icon' ), 'お問い合わせ' ); ?></a></li>
			</ul>
		</nav>
		<?php
			wp_nav_menu( array(
				'theme_location' => $bg,
				'container' => 'nav',
				'container_id' => 'js--nav',
				'container_class' => 'nav--main',
				'menu_class' => 'nav--list',
				'items_wrap' => '<ul class="%2$s" role="menu">%3$s</ul>',
				'walker' => new NID_Walker_Nav_Menu
			) );
		?>
	</header>
