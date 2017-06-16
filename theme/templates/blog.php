<?php
 if ( is_single() ) {
?>
<div id="js-pagenav-wrap" class="column small-12" data-sticky-container>
	<div id="js-pagenav" class="top-bar sticky" data-sticky data-options="anchor:js-main;stickyOn:small;marginTop:0">
		<div class="row o-row">
			<nav class="column small-6">
				<ul class="menu">
					<li><a href="#" id="js-back-archive">←</a></li>
					<li><a href="#" id="js-like-post">★</a></li>
				</ul>
			</nav>
			<nav class="column small-6">
				<ul class="menu align-right">
					<li><a href="#" id="js-style">A</a></li>
				</ul>
			</nav>
		</div>
	</div>
</div>
<?php
	}
?>
<div class="column small-12 o-whole">
	<div class="c-block -secondary -extended js-wow u-fadeInUp">
		<div class="row o-row">
			<?php
				if ( is_page() || is_single() ) {
					get_template_part( 'templates/content-single' );
				} elseif ( is_search() || is_archive() ) {
					get_template_part( 'templates/content-list' );
				}
			?>
		</div>
	</div>
</div>
