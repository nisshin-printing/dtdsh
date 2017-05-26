<?php
	if ( is_page() ) :
?>
<div id="bd-product" class="column small-12">
	<div class="row">
	<?php
		$args = array(
			'post_type' => 'post',
			'category_name' => 'item',
			'posts_per_page' => '-1',
			'post_status' => 'publish'
		);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();
	?>
		<div class="column c-item">
			<figure class="c-item_main">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="c-item_link"><?php the_post_thumbnail(); ?></a>
			</figure>
			<div class="c-item_desc-wrap">
				<h3 class="c-item_title"><?php the_title(); ?></h3>
				<p class="c-item_price">400円</p>
				<div class="storesjp-button c-item_buy-button" data-storesjp-item="5923d6b1f22a5b04c80007a7" data-storesjp-variation="5923d9313210d52ff2001398" data-storesjp-name="balance-design" data-storesjp-layout="layout_c" data-storesjp-lang="ja"></div><script>(function(d,s,id){var st=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return;}var nst=d.createElement(s);nst.id=id;nst.src="//btn.stores.jp/button.js";nst.charset="UTF-8";st.parentNode.insertBefore(nst,st);})(document, "script", "storesjp-button");</script>
			</div>
		</div>
	<?php
		endwhile;endif;
	?>
	</div>
</div>
<?php
 endif;
