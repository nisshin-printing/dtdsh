<?php
 if ( is_single() ) {
?>
<div id="js-pagenav-wrap" class="column small-12" data-sticky-container>
	<div id="js-pagenav" class="top-bar sticky" data-sticky data-options="anchor:js-main;stickyOn:small;marginTop:0">
		<div class="row o-row">
			<nav class="column small-6">
				<ul class="menu">
					<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="nofolow" class="o-tooltip -right" data-tooltip="Facebookでシェア"><?php NID_SVG::icon( 'facebook' ); ?></a></li>
					<li><a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=「<?php the_title(); ?>」&via=nisshin_inc&hashtags=日進&related=nisshin_inc" target="_blank" rel="nofolow" class="o-tooltip" data-tooltip="Twitterでシェア"><?php NID_SVG::icon( 'twitter' ); ?></a></li>
					<li><a href="http://b.hatena.ne.jp/entry/<?php the_permalink(); ?>" target="_blank" rel="nofolow" class="o-tooltip" data-tooltip="はてブに追加"><?php NID_SVG::icon( 'hatebu' ); ?></a></li>
					<li><a href="https://getpocket.com/edit?url=<?php the_permalink(); ?>" target="_blank" rel="nofolow" class="o-tooltip" data-tooltip="Pocketに保存"><?php NID_SVG::icon( 'pocket' ); ?></a></li>
					<li><a href="http://cloud.feedly.com/#subscription%2Ffeed%2F<?php echo home_url(); ?>" target="_blank" rel="nofolow" class="o-tooltip" data-tooltip="Feedlyで登録"><?php NID_SVG::icon( 'feedly' ); ?></a></li>
					<li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" rel="nofolow" class="o-tooltip" data-tooltip="Google+でシェア"><?php NID_SVG::icon( 'google-plus' ); ?></a></li>
				</ul>
			</nav>
		</div>
	</div>
</div>
<?php
	}
?>
<div class="column small-12 o-whole main-container">
	<div class="c-block -secondary -extended js-wow u-fadeInUp">
		<div class="row o-row">
			<?php
				if ( is_single() ) {
					get_template_part( 'templates/content-single' );
				} elseif ( is_home() || is_search() || is_archive() ) {
					get_template_part( 'templates/content-list' );
				}
			?>
		</div>
	</div>
</div>
