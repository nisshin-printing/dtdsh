<div class="c-fab" data-widget="contact">
	<div class="c-fab_ripple u-background-accent"></div>
	<button class="c-fab_button u-background-accent u-foreground-accent js-contact-open" title="お問い合わせ">
		<?php NID_SVG::icon( 'envelope', array( 'class' => 'c-fab_icon -open' ) ); ?>
		<?php NID_SVG::icon( 'close', array( 'class' => 'c-fab_icon -close' ) ); ?>
	</button>
</div>

<section id="js-contact" class="c-contact u-background-accent">
	<div class="c-contact_wrap">
		<div class="row">
			<div class="column small-12 c-contact_message">
				<button id="js-contact-back" class="c-contact_back o-arrow" title="お問い合わせ目的を選び直す"><span class="o-arrow_text"><?php NID_SVG::icon( 'arrow', array( 'class' => 'o-arrow_icon' ) ); ?></span>戻る</button>
				<div class="c-contact_textbox" id="js-contact-title"></div>
			</div>
			<div class="column small-12 c-contact_content js-contact-content -loading" data-param="home" data-text="日進印刷です。<br>主に広報のサポートをしています。"></div>
			<div id="js-contact-menu" class="column small-12 c-contact_content -menu js-contact-content" data-param="menu" data-text="どのようなご用件ですか？" data-greeting-morning="おはようございます。" data-greeting-afternoon="こんにちは。" data-greeting-evening="こんばんは。" data-greeting-night="まだ寝られませんか？">
				<div class="row large-unstack">
					<div class="column"><button class="c-contact_item button large secondary js-contact-step" data-page="project">見積もり/仕事の依頼</button></div>
					<div class="column"><button class="c-contact_item button large secondary js-contact-step" data-page="recruit">求人エントリー</button></div>
					<div class="column"><button class="c-contact_item button large secondary js-contact-step" data-page="other">その他/入稿</button></div>
				</div>
			</div>
			<div class="c-contact_content js-contact-content js-contact-form text-left" data-param="project" data-text="見積もり/仕事の依頼"><?php echo do_shortcode( '[contact-form-7 id="27" title="見積もり/仕事の依頼"]' ); ?></div>
			<div class="c-contact_content js-contact-content js-contact-form text-left" data-param="recruit" data-text="求人エントリー"><?php echo do_shortcode( '[contact-form-7 id="29" title="求人エントリー"]' ); ?></div>
			<div class="c-contact_content js-contact-content js-contact-form text-left" data-param="other" data-text="その他/入稿"><?php echo do_shortcode( '[contact-form-7 id="30" title="その他/入稿"]' ); ?></div>
		</div>
	</div>
</section>
