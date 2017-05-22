<?php
/**
 * Footer file common to all
 * templates
 *
 */
?>


<?php // common footer content goes here ?>
<footer class="c-footer-main">
	<div class="c-footer-main_container">
		<nav class="c-footer-main_nav row align-middle align-center -flex small-up-1 large-up-3">
			<div class="column o-button_wrap">
				<a href="tel:0822371611" class="c-footer-main_nav-item o-button -secondary" title="電話する"><span><?php NID_SVG::icon( 'phone', array( 'class' => 'c-footer-main_nav-icon' ), '日進印刷へ電話する' ); ?>（082）237-1611</span></a>
			</div>
			<div class="column o-button_wrap">
				<a href="<?php echo get_permalink( get_page_by_path( 'contact' ) ); ?>" class="c-footer-main_nav-item o-button -secondary" title="お問い合わせフォームへ行く"><span style="letter-spacing:5px"><?php NID_SVG::icon( 'envelope', array( 'class' => 'c-footer-main_nav-icon' ), 'メールでお問い合わせ' ); ?>お問い合わせ</span></a>
			</div>
			<div class="column o-button_wrap">
				<a href="https://www.chatwork.com/nisshin-dtdsh" class="c-footer-main_nav-item o-button -secondary" target="_blank" title="ChatWorkで連絡する"><span><?php NID_SVG::icon( 'chatwork', array( 'class' => 'c-footer-main_nav-image' ), 'ChatWorkで社長へダイレクトに連絡する' ); ?></span></a>
			</div>
		</nav>
		<p class="c-footer-main_copy">©日進印刷株式会社</p>
	</div>
</footer>
<?php get_template_part( 'elements/contact' ); ?>

<?php wp_footer(); ?>
<?php // </body> opens in header.php ?>
</body>
</html>
