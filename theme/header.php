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
	<script async defer src="<?php echo get_template_directory_uri(); ?>/assets/js/core.js"></script>

	<?php wp_head(); ?>
</head>
<body <?php body_class( 'u-foreground' ); ?>>
<?php // <body> closes in footer.php ?>



<?php // common header content goes here ?>
	<header class="c-header-main">
		<div class="c-header-main_background u-main_background"></div>
		<div class="c-header-main_container">
			<h1 id="nav-front" class="c-header-main_logo"><a href="<?php bloginfo( 'site_url' ); ?>">日進印刷株式会社</a></h1>
			<div class="c-header-main_nav-button js-nav-main-button"><button class="c-header-main_nav-button_button" type="button" title="Browse navigation">
					<span class="c-header-main_nav-button_lines"></span>
					<svg class="c-header-main_nav-button_path" role="img">
						<use xlink:href="https://locomotive.ca/assets/locomotive/images/svgs.svg#menu-path"></use>
					</svg>
				</button>
			</div>
			<div class="c-nav-wrap -main u-background o-container js-nav-main-wrap">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container' => 'nav',
						'container_id' => 'nav-main',
						'container_class' => 'c-nav -main js-nav-main js-headroom',
						'menu_class' => 'c-nav_list',
						'items_wrap' => '<ul class="%2$s">%3$s</ul>',
						'walker' => new NID_Walker_Nav_Menu
					) );
				?>
			</div>
			<div class="c-social -fixed -nav">
				<ul class="c-social_list">
					<li class="c-social_item">
						<a href="https://www.facebook.com/nisshin.dtdsh" class="c-social_link" target="_blank">
							<svg class="c-social_icon" role="img" title="Facebook">
								<use xlink:href="https://locomotive.ca/assets/locomotive/images/svgs.svg#social-facebook"></use>
							</svg>
						</a>
					</li>
					<li class="c-social_item">
						<a href="https://plus.google.com/+%E6%97%A5%E9%80%B2%E5%8D%B0%E5%88%B7%E6%A0%AA%E5%BC%8F%E4%BC%9A%E7%A4%BE%E8%A5%BF%E5%8C%BA" class="c-social_link" target="_blank">
							<svg class="c-social_icon" role="img" title="Google+">
								<use xlink:href="https://locomotive.ca/assets/locomotive/images/svgs.svg#social-facebook"></use>
							</svg>
						</a>
					</li>
					<li class="c-social_item">
						<a href="https://twitter.com/nisshin_inc" class="c-social_link" target="_blank">
							<svg class="c-social_icon" role="img" title="Twitter">
								<use xlink:href="https://locomotive.ca/assets/locomotive/images/svgs.svg#social-twitter"></use>
							</svg>
						</a>
					</li>
						<li class="c-social_item">
						<a href="https://www.instagram.com/nisshin_inc/" class="c-social_link" target="_blank">
							<svg class="c-social_icon" role="img" title="Instagram">
								<use xlink:href="https://locomotive.ca/assets/locomotive/images/svgs.svg#social-instagram"></use>
							</svg>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="c-nav-overlay js-nav-main-button"></div>
	</header>