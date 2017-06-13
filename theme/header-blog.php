<?php
/**
 * Header file common to all
 * templates
 *
 */
?>
<!doctype html>
<html class="site no-js" <?php language_attributes(); ?>>
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
	<script async defer src="<?php echo get_template_directory_uri(), '/assets/js/core.js?ver=', DTDSH_THEME_VERSION; ?>"></script>

	<?php // Theming ?>
	<meta name="theme-color" content="#FFFFFF">

	<?php /*
	<?php // load the reCAPTCHA API ?>
	<script async defer src="//www.google.com/recaptcha/api.js"></script>
	*/ ?>
	<?php wp_head(); ?>
</head>
<body id="js-body" <?php body_class( 'o-main u-background is-loading' ); ?>>
<?php // <body> closes in footer.php ?>



<?php // common header content goes here ?>
	<div class="c-loader u-background"></div>
	<div class="progress" role="progressbar" tabindex="0" aria-valuenow="10" aria-valuemin="10" aria-valuemax="100">
		<div class="progress-meter" style="width:10%"></div>
	</div>
	<header class="c-header-main" id="js-header-main">
		<nav class="top-bar">
			<div class="top-bar_queue_divider"></div>
			<div class="top-bar-title">
				<h1>日進</h1>
			</div>
			<div class="top-bar-left">
				<ul class="top-bar-left menu">
					<li><button class="c-header-main_nav-button_button js-nav-main-button" type="button" title="Browse navigation">
						<span class="c-header-main_nav-button_lines"></span><?php NID_SVG::icon( 'menu-path', array( 'class' => 'c-header-main_nav-button_path' ), 'Menu Path' ); ?>
					</button></li>
					<li><a href="<?php echo home_url(); ?>">ホーム</a></li>
					<li><a href="<?php echo get_permalink( get_page_by_path( 'blog' ) ); ?>">ブログ</a></li>
					<li><a href="<?php echo get_permalink( get_page_by_path( 'recommended' ) ); ?>">おすすめ</a></li>
				</ul>
			</div>
			<div class="top-bar-right">
				<ul class="menu">
					<li class="pagenav_tel"><a href="0822371611" title="電話する"><?php NID_SVG::icon( 'phone', array(), '日進印刷へ電話する' ); ?></a></li>
					<li class="pagenav_contact">
						<button type="button" data-toggle="contact_list"><?php NID_SVG::icon( 'envelope', array(), '日進印刷へ電話する' ); ?></button>
						<div class="dropdown-pane text-center" id="contact_list" data-dropdown>
							<p>お問い合わせ</p>
							<p><a href="" class="button expanded js-contact-open" data-page="project">見積もり/仕事の依頼</a></p>
							<p><a href="" class="button expanded js-contact-open" data-page="recruit">求人エントリー</a></p>
							<p><a href="" class="button expanded js-contact-open" data-page="other">その他/データ入稿</a></p>
						</div>
					</li>
				</ul>
			</div>
		</nav>
		<div class="c-nav-wrap -main">
			<nav id="js-nav-main" class="c-nav">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container' => false,
						'menu_class' => 'menu vertical',
						'items_wrap' => '<ul class="%2$s" role="menu">%3$s</ul>',
						'walker' => new NID_Walker_Nav_Menu
					) );
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container' => false,
						'menu_class' => 'js-dropdown dropdown menu vertical',
						'items_wrap' => '<ul class="%2$s" data-dropdown-menu data-closing-time="100" role="menu">%3$s</ul>',
						'walker' => new NID_Walker_Nav_Menu
					) );
				?>
			</nav>
			<div class="c-social">
				<ul class="c-social_list">
					<li class="c-social_item">
						<a href="https://www.facebook.com/nisshin.dtdsh" class="c-social_link" target="_blank"><?php NID_SVG::icon( 'facebook', array( 'class' => 'facebook' ), 'Facebook' ); ?></a>
					</li>
					<li class="c-social_item">
						<a href="https://plus.google.com/+%E6%97%A5%E9%80%B2%E5%8D%B0%E5%88%B7%E6%A0%AA%E5%BC%8F%E4%BC%9A%E7%A4%BE%E8%A5%BF%E5%8C%BA" class="c-social_link" target="_blank"><?php NID_SVG::icon( 'google-plus', array( 'class' => 'google-plus' ), 'Google+' ); ?></a>
					</li>
					<li class="c-social_item">
						<a href="https://twitter.com/nisshin_inc" class="c-social_link" target="_blank"><?php NID_SVG::icon( 'twitter', array( 'class' => 'twitter'), 'Twitter' ); ?></a>
					</li>
						<li class="c-social_item">
						<a href="https://www.instagram.com/nisshin_inc/" class="c-social_link" target="_blank"><?php NID_SVG::icon( 'instagram', array( 'class' => 'instagram' ), 'Instagram' ); ?></a>
					</li>
				</ul>
				<div class="c-social_proof"><img src="<?php echo get_template_directory_uri(), '/assets/img/google-partner.png'; ?>" alt="日進印刷はGoogle Partnerです。" class="c-social_proof-image" width="180" height="100"></div>
			</div>
		</div>
		<div class="c-nav-overlay js-nav-main-button"></div>
	</header>
