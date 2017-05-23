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

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-WV7S6J');</script>
	<!-- End Google Tag Manager -->

	<?php // replace the no-js class with js on the html element ?>
	<script>document.documentElement.className=document.documentElement.className.replace(/\bno-js\b/,'js')</script>

	<?php // load the core js polyfills ?>
	<script async defer src="<?php echo get_template_directory_uri(), '/assets/js/core.js'; ?>"></script>

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
	<div class="c-loader u-background-accent"><span class="c-loader_bars"><span></span></span></div>
	<header class="c-header-main" id="js-header-main">
		<h1 id="nav-front" class="c-header-main_logo"><a href="<?php bloginfo( 'url' ); ?>">日進印刷株式会社</a></h1>
		<div class="c-header-main_nav-button">
			<button class="c-header-main_nav-button_button js-nav-main-button" type="button" title="Browse navigation">
				<span class="c-header-main_nav-button_lines"></span><?php NID_SVG::icon( 'menu-path', array( 'class' => 'c-header-main_nav-button_path' ), 'Menu Path' ); ?>
			</button>
			<p class="c-header-main_nav-button_label">Menu</p>
		</div>
		<div class="c-nav-wrap -main">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container' => 'nav',
					'container_id' => 'js-nav-main',
					'container_class' => 'c-nav -main',
					'menu_class' => 'c-nav_list js-dropdown dropdown menu',
					'items_wrap' => '<ul class="%2$s" data-dropdown-menu data-closing-time="100" role="menu">%3$s</ul>',
					'walker' => new NID_Walker_Nav_Menu
				) );
			?>
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
		<?php
			$header_copy = '';
			$header_desc = '';
			$header_link = '';
			$now_Y = (int)date( 'Y' )-1928;
			if ( is_front_page() ) {
				$header_copy = '創業1928年、' . $now_Y . '年間。<br>それが、日進印刷の強さです。';
				$header_link = '<div class="c-cover_link o-button_wrap"><a href="' . get_permalink( get_page_by_path( 'about' ) ) . '" class="o-button js-wow u-fadeInUp"><span>会社案内を見る</span></a></div>';
			} elseif ( is_page( 'service' ) ) {
				$header_copy = 'あらゆる課題に<br>お応えできます。';
				$header_desc = '<ul><li>' . $now_Y . '年間蓄え続けたマーケティング知識と経験</li><li>制作会社/印刷会社が頼る“速さ”</li><li>Google アナリティクスの認定資格GAIQ保有率100%</li></ul><p>提供するサービスすべてが一流です。</p>';
			} elseif ( is_page( 'price' ) ) {
				$header_copy = '低価格のサービスも<br>高価格のサービスも<br>費用対効果を評価してください。';
			} elseif ( is_page( 'about' ) ) {
				$header_copy = '<img src="' . get_template_directory_uri() . '/assets/img/slogan-black.png" alt="Your Success is Our Business.">';
			} elseif ( is_page( 'recruit' ) ) {
				$header_copy = '採用情報';
				$header_desc = '<p>こんにちは。日進印刷株式会社は、デザインやウェブ開発、印刷、広告などクライアントとエンドユーザーとを繋ぐコミュニケーションツールを提供する会社です。弊社は常に最高の人材を募集しています。</p>';
			} elseif ( is_page( 'contact' ) ) {
				$header_copy = 'お話しましょう。';
			} elseif ( is_404() ) {
				$header_copy = '404 - ページが見つかりません...';
			}
		?>
			<div class="c-cover_wrap -main">
				<div class="c-block row -flex align-middle -title -extended js-wow u-fadeInUp">
					<div id="js-title" class="column">
						<h1 id="copy-header" class="c-block_title"><?php echo $header_copy; ?></h1>
						<?php if ( $header_desc ) echo $header_desc; ?>
						<?php if ( $header_link ) echo $header_link; ?>
					</div>
				</div>
			</div>
	</header>
