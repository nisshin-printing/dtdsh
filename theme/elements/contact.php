<div class="fab" data-widget="contact">
	<div class="fab--ripple"></div>
	<button class="fab--button u-main--turn contact--button js--contact__open" title="お問い合わせ">
		<?php NID_SVG::icon( 'envelope', array( 'class' => 'fab--icon contact--icon__open' ) ); ?>
		<?php NID_SVG::icon( 'close', array( 'class' => 'fab--icon contact--icon__close' ) ); ?>
	</button>
	<button class="fab--button u-main nav--button js--nav__button" type="button" title="Browse navigation">
		<span class="nav--button__lines"></span><?php NID_SVG::icon( 'menu-path', array( 'class' => 'nav--button__path' ), 'Menu Path' ); ?>
	</button>
</div>

<section id="js--contact" class="contact--wrap u-main--turn">
	<div class="row">
		<div class="column small-12 c-contact_message">
			<button id="js--contact__back" class="contact--back" title="お問い合わせ目的を選び直す">
				<?php NID_SVG::icon( 'curve-arrow', array( 'class' => 'contact--back__icon' ), 'back button' ); ?>
				<span class="contact--back__text">戻る</span>
			</button>
			<div class="c-contact_textbox" id="js--contact__title"></div>
		</div>
		<div class="column small-12 contact--content js--contact__content -loading" data-param="home" data-text="日進印刷です。<br>主にWeb・印刷で販促のサポートをしています。"></div>
		<div id="js--contact__menu" class="column small-12 contact--content -menu js--contact__content" data-param="menu" data-text="どのようなご用件ですか？" data-greeting-morning="おはようございます。" data-greeting-afternoon="こんにちは。" data-greeting-evening="こんばんは。" data-greeting-night="まだ寝られませんか？">
			<div id="js--item__wrap" class="row large-unstack">
				<div class="column"><button class="contact--item button turn js--contact__step" data-page="project">見積もり/仕事の依頼</button></div>
				<div class="column"><button class="contact--item button turn js--contact__step" data-page="recruit">求人エントリー</button></div>
				<div class="column"><button class="contact--item button turn js--contact__step" data-page="other">その他/入稿</button></div>
			</div>
		</div>
		<div class="contact--content js--contact__content js--contact__form text-left" data-param="project" data-text="見積もり/仕事の依頼"><?php echo do_shortcode( '[contact-form-7 id="27" title="見積もり/仕事の依頼"]' ); ?></div>
		<div class="contact--content js--contact__content js--contact__form text-left" data-param="recruit" data-text="求人エントリー"><?php echo do_shortcode( '[contact-form-7 id="29" title="求人エントリー"]' ); ?></div>
		<div class="contact--content js--contact__content js--contact__form text-left" data-param="other" data-text="その他/入稿"><?php echo do_shortcode( '[contact-form-7 id="30" title="その他/入稿"]' ); ?></div>
	</div>
</section>
