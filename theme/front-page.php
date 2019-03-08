<?php
if ( empty( $_GET['_pjax'] ) ) {
		$bg = basename(get_permalink());
		include locate_template( './header.php' );
}
?>

<main>
	<section class="slider--wrap">
		<ul id="slider">
			<li class="slider--item row collapse expanded align-middle">
				<div class="column small-12 large-6">
					<div class="slider--image__wrap">
						<img class="slider--image" src="<?php echo get_template_directory_uri(), '/assets/img/slider--001.png'; ?>" alt="創業<?php echo (int)date( 'Y' ) - 1928;?>年の広島最古の日進印刷株式会社">
					</div>
				</div>
				<div class="column small-12 large-6">
					<div class="slider--content">
						<h2 class="slider--title">創業から<?php echo (int)date( 'Y' ) - 1928; ?>年間。<strong class="u-underline fs--big">10年後廃業率95％</strong>を<strong class="u-underline fs--big"><?php echo ( (int)date( 'Y' ) - 1928 ) / 10; ?></strong>回乗り越えてきた広島最古の印刷会社です。</h2>
						<p class="slider--desc"><a href="#service" class="button">サービス一覧を見る</a></p>
					</div>
				</div>
			</li>
			<li class="slider--item row collapse expanded align-middle">
				<div class="column small-12 large-6">
					<div class="slider--content">
						<h2 class="slider--title"><strong class="u-underline fs--big">広島No.1のWebコンサルティング</strong></h2>
						<p class="slider--desc"><a href="<?php echo get_page_link( get_page_by_path( '/service/web-consulting' ) ); ?>" class="button">Webコンサルティングについて詳しく</a></p>
					</div>
				</div>
				<div class="column small-12 large-6">
					<div class="slider--image__wrap" style="background:linear-gradient(45deg, #8E44AD, #E4A972)">
						<img class="slider--image" src="<?php echo get_template_directory_uri(), '/assets/img/slider--002.png'; ?>" alt="創業<?php echo (int)date( 'Y' ) - 1928;?>年の広島最古の日進印刷株式会社" style="width:50%;height:auto">
					</div>
				</div>
			</li>
		</ul>

		<div class="slider--loading is-loading">
			<div class="slider--loading__bars"><span></span></div>
		</div>

		<a href="#service" class="slider--cta">
			<div class="slider--cta__arrow angle--down"></div>
			<div class="slider--cta__arrow angle--down"></div>
			<div class="slider--cta__arrow angle--down"></div>
			<p class="slider--cta__text">サービスを探す</p>
		</a>
	</section>


	<section class="news--wrap 	">
		<div class="row">
			<div class="column">
				<h2 class="news--title">TOPICS</h2>
				<article class="news--article">
					<p class="news--article__category">お知らせ</p>
					<p>2019/02/18</p>
					<p class="news--article__title">ホームページをリニューアルしました。</p>
				</article>
			</div>
			<a href="#topics" class="news--link"><?php NID_SVG::icon( 'list', array( 'class' => 'news--link__icon' ), 'リストへのリンク' ); ?></a>
		</div>
	</section>


	<section class="next--wrap"><a href="<?php echo get_page_link( get_page_by_path( '/about' ) ); ?>" class="next--link">クライアントの真の目的を達成する</a><div class="angle--right next--link__icon"></div></section>



	<section id="service" class="">
		<h2 class="border--bottom">事業領域</h2>
		<div class="row">
			<?php
				require_once( get_template_directory() . '/elements/service.php' );
				foreach ( $service as $item ) :
					if ( $item['isDomain'] ) :
			?>
				<div class="column small-6 medium-4 domain--item">
					<a class="domain--wrap u-<?php echo $item['slug']; ?>--turn" href="<?php echo get_page_link( $item['id'] ); ?>">
						<h3 class="domain--title"><?php echo $item['title']; ?></h3>
						<img data-src="<?php echo get_template_directory_uri(), '/assets/img/', $item['slug'], '.png'; ?>" alt="<?php echo $item['title']; ?>" class="domain--image lazyload">
					</a>
				</div>
				<?php endif;endforeach; ?>
		</div>
	</section>


	<section class="next--wrap"><a href="<?php echo get_page_link( get_page_by_path( '/about' ) ); ?>" class="next--link">100年続く企業を目指して</a><div class="angle--right next--link__icon"></div></section>



	<section id="feature" class="">
		<h2 class="border--bottom">こだわり</h2>
		<div class="row">
			<?php
				foreach ( $service as $item ) :
					if ( $item['isFeature'] ) :
			?>
			<div class="column small-6 medium-4 domain--item feature--item">
				<a class="domain--wrap feature--wrap" href="<?php echo get_page_link( $item['id'] ), '#feature'; ?>">
					<h3 class="feature--title u-<?php echo $item['slug']; ?>--turn"><?php echo $item['title']; ?></h3>
					<img data-src="<?php echo get_template_directory_uri(), '/assets/img/', $item['isFeature']['prefix'], $item['slug'], $item['isFeature']['format']; ?>" alt="<?php echo $item['title']; ?>" class="feature--image lazyload" style="<?php echo $item['isFeature']['style']; ?>">
				</a>
			</div>
			<?php endif;endforeach; ?>
		</div>
	</section>


<section class="next--wrap"><a href="<?php echo get_page_link( get_page_by_path( '/about' ) ); ?>" class="next--link"><?php echo floor((date('Ymd')-19920813)/10000); ?>歳の社長を見る</a><div class="angle--right next--link__icon"></div></section>



<?php
	$posts = new WP_Query(
		array(
			'post_type' => 'post',
			'posts_per_page' => 9,
			'post_status' => 'publish'
		)
	);
	if ( $posts->have_posts() ) : 
?>
<section id="works" class="text-center">
	<h2 class="border--bottom">実績</h2>
	<p class="subtitle"><?php echo (int)date( 'Y' ) - 1928; ?>年も続いている広島最古で唯一の印刷会社です。<br>技術力、経営力、ノウハウ、経験、ほんの一部ですが紹介いたします。</p>
	<div class="row">
	<?php while( $posts->have_posts() ) : the_post(); ?>
		<div class="column small-6 medium-4 domain--item works--item u-main--turn">
			<a class="domain--wrap feature--wrap" href="<?php the_permalink( $post ); ?>">
				<h3 class="feature--title"><?php the_title( $post ); ?></h3>
				<img data-src="<?php echo get_template_directory_uri(), '/assets/img/ms-lease.png'; ?>" alt="<?php the_title( $post ); ?>" class="feature--image lazyload">
			</a>
		</div>
		<?php endwhile; ?>
		<div class="column small-12"><a href="" class="button">てっとり早く価格を見る</a></div>
	</div>
</section>
<?php endif; ?>



<section id="trust" class="">
	<h2 class="border--bottom">安心の信頼性</h2>
	<div class="row trust--item">
		<div class="column">
			<h3 class="border--bottom__left">常に最高のサービスを。</h3>
			<p class="trust--desc">広島最古の印刷会社として。広島No.1のWebコンサルティング企業として。<br>日進印刷では、定期的に業務フロー・雇用契約・能力・サービス、もちもん経営者の能力も、見直し改善し<strong class="u-underline">最高のサービスを提供し続け</strong>ています。</p>
		</div>
	</div>
	<div class="row trust--item">
		<div class="column">
			<h3 class="border--bottom__left">常に最高の品質を。</h3>
			<p class="trust--desc">他社が見逃す一文字。例えば「弊」と「幣」。<br>絶対に間違えられない<strong class="u-underline">官公庁 / 士業 / 教育機関 / 医療機関 御用達の品質</strong>を提供し続けています。</p>
		</div>
	</div>
	<div class="row trust--item align-middle">
		<div class="column small-2"><img data-src="<?php echo get_template_directory_uri(), '/assets/img/gaiq.png'; ?>" alt="Google社認定のGAIQを弊社アナリストは全員保有中！" class="lazyload"></div>
		<div class="column small-10">
			<h3 class="border--bottom__left">全員がGoogle社認定アナリスト</h3>
			<p class="trust--desc">日進印刷のアナリストは全員がGAIQ所有者。Googleアナリティクスの習熟度を<strong class="u-underline">Google社から認定</strong>されており、現在まで全員が更新し続けています。</p>
		</div>
	</div>
	<div class="row trust--item align-middle">
		<div class="column small-10">
			<h3 class="border--bottom__left">セキュリティ</h3>
			<p class="trust--desc">情報セキュリティのためのISO 27001。<strong class="u-underline">メールや入稿データ・顧客データなど全てのデータ</strong>が定期監査を受けているサーバで管理・保管されます。</p>
		</div>
		<div class="column small-2"><img data-src="<?php echo get_template_directory_uri(), '/assets/img/iso-27001.png'; ?>" alt="日進印刷のデータはすべてISO 27001を取得したサーバで保管・管理します。" class="lazyload"></div>
	</div>
	<div class="row trust--item has-children align-middle">
		<div class="column small-12 medium-4">
			<div class="trust--item">
				<h3 class="text-center"><span class="fs--big"><span class="fs--big">4.7</span>/5</span><br>顧客満足度</h3>
			</div>
		</div>
		<div class="column small-12 medium-4">
			<div class="trust--item">
				<h3 class="start">創業<span class="fs--big"><?php echo (int)date( 'Y' ) - 1928; ?></span><span>年</span></h3>
			</div>
		</div>
		<div class="column small-12 medium-4">
			<div class="trust--item">
				<img data-src="<?php echo get_template_directory_uri(), '/assets/img/google-partner.png'; ?>" alt="日進印刷はWeb広告のうち、検索広告・モバイル広告のGoogleパートナーです。" class="lazyload"></div>
			</div>
	</div>
</section>



<section class="text-center service--wrap">
	<h2 class="border--bottom">サービス</h2>
	<h3 class="subtitle">顧客も日進印刷も、<span>100年続く企業</span>を目指して。</h3>
	<div class="carousel--wrap">
		<div id="carousel" class="service--carousel">
		<?php
			foreach ( $service as $item ) :
		?>
			<div class="domain--item service--item">
				<a class="domain--wrap service--link u-<?php echo $item['slug']; ?>--turn" href="<?php echo get_page_link( $item['id'] ); ?>">
					<h3 class="domain--title"><?php echo $item['title']; ?></h3>
					<img data-src="<?php echo get_template_directory_uri(), '/assets/img/', $item['slug'], '.png'; ?>" alt="<?php echo $item['title']; ?>" class="domain--image lazyload">
				</a>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="slider--loading is-loading">
			<div class="slider--loading__bars"><span></span></div>
		</div>
	</div>
</section>


<section id="topics" class="topics--wrap">
	<div class="row">
		<div class="column small-4">
			<h2 class="topics--wrap__title border--bottom__left">NEWS & TOPICS</h2>
		</div>
		<div class="column small-8">
			<article class="topics--item">
				<p class="topics--category">お知らせ</p>
				<p class="topics--date">2019/02/27</p>
				<p class="topics--title">ホームページをリニューアルしました。</p>
			</article>
			<article class="topics--item">
				<p class="topics--category">お知らせ</p>
				<p class="topics--date">2019/02/27</p>
				<p class="topics--title">ホームページをリニューアルしました。</p>
			</article>
			<article class="topics--item">
				<p class="topics--category">お知らせ</p>
				<p class="topics--date">2019/02/27</p>
				<p class="topics--title">ホームページをリニューアルしました。</p>
			</article>
			<article class="topics--item">
				<p class="topics--category">お知らせ</p>
				<p class="topics--date">2019/02/27</p>
				<p class="topics--title">ホームページをリニューアルしました。</p>
			</article>
			<article class="topics--item">
				<p class="topics--category">お知らせ</p>
				<p class="topics--date">2019/02/27</p>
				<p class="topics--title">ホームページをリニューアルしました。</p>
			</article>
		</div>
	</div>
</section>

<?php
if ( empty( $_GET['_pjax'] ) ) {
		include locate_template( './footer.php' );
}
?>
