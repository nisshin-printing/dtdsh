<?php
	if (! $bg ) {
		$bg = 'main';
	}
?>
<section class="next--wrap sns--wrap">
	<p class="sns--title">日進印刷のSNSを見る</p>
	<ul class="sns--list">
	<?php
		require_once( get_template_directory() . '/elements/sns.php');
		foreach( $sns as $item ) :
	?>
		<li class="sns--item"><a href="<?php echo $item['url']; ?>" target="_blank" class="sns--link hover--<?php echo $item['name']; ?>"><?php NID_SVG::icon($item['name'], array( 'class' => 'sns--icon' ), '日進印刷の' . $item['name'] ) ?></a></li>
	<?php endforeach; ?>
	</ul>
</section>


<footer class="footer--main u-main--turn">
	<div class="row align-middle footer--cta <?php echo "u-$bg"; ?> show-for-large">
		<div class="column large-4 footer--cta__item"><p class="footer--cta__title <?php echo "u-$bg--turn"; ?>">お見積りなど<br>お気軽にご相談ください。</p><div class="allow--right"></div></div>
		<div class="column large-4 footer--cta__item">
			<p class="footer--cta__item-title"><img data-src="<?php echo get_template_directory_uri(), '/assets/img/icon--form.png'; ?>" class="lazyload">フォームでのお問い合わせ</p>
			<a href="<?php echo get_page_link( get_page_by_path( 'contact' ) ); ?>" class="footer--cta__link <?php echo "u-$bg--turn"; ?>">お問い合わせフォーム</a>
		</div>
		<div class="column large-4 footer--cta__item">
				<p class="footer--cta__item-title"><img data-src="<?php echo get_template_directory_uri(), '/assets/img/icon--tel.png'; ?>" class="lazyload">お電話でのお問い合わせ</p>
				<a href="tel:0822371611" class="footer--cta__tel">082-237-1611</a>
		</div>
	</div>
	<div class="row">
		<div class="column small-12 medium-4">
			<h2 class="footer--nav__title">サービス</h2>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'main',
					'container' => false,
					'menu_class' => 'footer--list',
					'items_wrap' => '<ul class="%2$s" role="menu">%3$s</ul>',
					'walker' => new NID_Walker_Nav_Menu
				) );
			?>
		</div>
		<div class="column small-12 medium-4">
			<h2 class="footer--nav__title">会社案内</h2>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'about',
					'container' => false,
					'menu_class' => 'footer--list',
					'items_wrap' => '<ul class="%2$s" role="menu">%3$s</ul>',
					'walker' => new NID_Walker_Nav_Menu
				) );
			?>
		</div>
	</div>
	<p class="footer--copy">© 日進印刷株式会社</p>
</footer>
</main>



<?php // common footer content goes here ?>
<?php get_template_part( 'elements/contact' ); ?>

<?php wp_footer(); ?>
<?php // </body> opens in header.php ?>
</body>
</html>
