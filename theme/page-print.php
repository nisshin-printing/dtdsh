<?php
if ( empty( $_GET['_pjax'] ) ) {
		$bg = 'print';
		include locate_template( './header.php' );
}
?>

<main class="u-main">
	<section class="hero--wrap" style="background-image:url(//liginc.co.jp/wp-content/themes/ligtheme/assets/images/hero-web.jpg)">
		<h1 class="hero--title"><?php the_title(); ?></h1>
	</section>

	<?php NID_Crumbs::crumbs(); ?>


	<section class="thumblist thumblist--web">
		<div class="row">
			<div class="column">
				<h2 class="border--bottom"><strong class="fs--big">印刷物</strong>から見つける</h2>
				<?php
					require_once( get_template_directory() . '/elements/service--print.php' );
					foreach ( $lineup as $item ) :
				?>
				<article class="thumblist--item row align-middle">
					<div class="column small-2"><img class="lazyload thumblist--image" data-src="" alt="" style="width:150px;height:150px;background:#DDD"></div>
					<div class="column small-10">
						<h3 class="border--bottom__left thumblist--title"><?php echo $item['title']; ?></h3>
						<p class="thumblist--desc"><?php echo $item['desc']; ?></p>
					</div>
				</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section id="feature" class="thumblist thumblist--feature">
		<div class="row">
			<div class="column">
				<h2 class="border--bottom">特徴とこだわり</h2>
				<h3 class="text-center">日進印刷は「Webサイト」という枠組みを超え、<br><strong>「成果」の仕組みを作ります。</strong></h3>
				<?php
					require_once( get_template_directory() . '/elements/feature--web.php' );
					$i = 0;
					foreach ( $feature as $item ) :
					$i++; 
					$i = sprintf('%02d', $i);
				?>
				<article class="thumblist--item row align-middle">
					<div class="column small-10">
						<h3 class="border--bottom__left thumblist--title"><?php echo $item['title']; ?></h3>
						<?php if ( $item['subtitle'] ) { echo '<h4>', $item['subtitle'], '</h4>'; } ?>
						<p class="thumblist--desc"><?php echo $item['desc']; ?></p>
					</div>
					<div class="column small-2"><img class="lazyload thumblist--image" data-src="<?php echo get_template_directory_uri(), "/assets/img/feature--$i.png"; ?>" alt="日進印刷の特徴とこだわり" style="width:150px"></div>
				</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="price">
		<div class="row">
			<div class="column">
				<h2 class="border--bottom">プラン</h2>
				<p class="text-center">プランとは、オススメの構成です。不要なサポートや機能は、以下の価格表から削減できます。</p>
				<div class="table-scroll">
					<table class="hover price--table">
						<thead>
							<tr>
								<th>機能・サポート＼プラン</th>
								<th>ライト</th>
								<th>スタンダード</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>初期費用</th>
								<td>50万円（税別）</td>
								<td>100万円（税別）</td>
							</tr>
							<tr>
								<th>月額料金<br>※必要サポートによって変動</th>
								<td>38,000円程度（税別）</td>
								<td>78,000円程度（税別）</td>
							</tr>
							<tr>
								<th>外部サービス連携</th>
								<td>◎</td>
								<td>◎</td>
							</tr>
							<tr>
								<th>独自ドメイン</th>
								<td>◎</td>
								<td>◎</td>
							</tr>
							<tr>
								<th>納品後デザイン修正<br>※契約時のみ選択可能</th>
								<td>◎</td>
								<td>◎</td>
							</tr>
							<tr>
								<th>操作サポート体制</th>
								<td>◎</td>
								<td>◎</td>
							</tr>
							<tr>
								<th>月間PV数</th>
								<td>1万PV～10万PVを想定</td>
								<td>10万PV～を想定</td>
							</tr>
							<tr>
								<th><span class="show-for-medium">Google社認定GAIQ保有アナリストによる</span>分析レポート</th>
								<td>3ヶ月に1回</td>
								<td>毎月</td>
							</tr>
						</tbody>
					</table>
				</div>
				<h2 class="border--bottom">プランの内訳</h2>
				<p class="text-center">プランに含まれる項目から必要な機能・サポートを取捨選択できます。また、プラン表の金額は、以下項目料金を合計したものです。</p>
				<?php
					require_once( get_template_directory() . '/elements/price--web.php' );
					foreach ( $price as $cost ) :
						echo '<div class="accordion"><h3 class="accordion--title">', $cost['title'], '<span class="accordion--icon"></span></h3>';
						foreach ( $cost['plan'] as $plan) :
							if ( isset( $plan['name'] ) ) {
								echo '<div class="accordion--content__wrap"><div class="accordion--content"><h4 class="border--bottom__left">', $plan['name'], '</h4>';
							} else {
								echo '<div class="accordion--content__wrap"><div class="accordion--content">';
							}
							if ( isset( $plan['desc'] ) ) {
								echo '<p>', $plan['desc'], '</p>';
							}
							echo '<div class="table-scroll"><table class="hover price--table__breakdown u-table__web">';
							echo '<thead><tr>';
							foreach ( $plan['table']['header'] as $title ) {
								echo "<th>$title</th>";
							}
							echo '</tr></thead>';
							foreach ( $plan['table']['body'] as $body ) :
								if ( isset( $body['isBreakdown'] ) ) :
									echo '<tr class="table--item__target"><th colspan="3">', $body['item'], '</th></tr>';
									foreach ( $body['isBreakdown'] as $breakdown ) :
										echo '<tr class="table--item__breakdown"><th>', $breakdown['item'], '</th><td class="table--item__desc">', $breakdown['desc'], '</td><td class="table--item__price">', $breakdown['price'], '</td></tr>';
									endforeach;
								else :
									echo '<tr class="table--item__target"><th>', $body['item'], '</th><td class="table--item__desc">', $body['desc'], '</td><td class="table--item__price">', $body['price'], '</td></tr>';
								endif;
							endforeach;
							echo '</table></div></div></div>';
						endforeach;
						echo '</div>';
					endforeach;
				?>
			</div>
		</div>
	</section>


	<section class="cta--wrap u-web--turn">
		<h2 class="border--bottom">お問い合わせ</h2>
		<div class="row">
			<div class="column"><?php echo do_shortcode( '[contact-form-7 id="27" title="見積もり/仕事の依頼"]' ); ?></div>
		</div>
	</section>
</main>


<?php
if ( empty( $_GET['_pjax'] ) ) {
	include locate_template( './footer.php' );
}
