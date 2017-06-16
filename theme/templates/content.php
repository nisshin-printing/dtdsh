<div id="js-pagenav-wrap" class="column small-12" data-sticky-container>
	<div id="js-pagenav" class="top-bar sticky" data-sticky data-anchor="js-main">
		<nav class="top-bar_left">
			<ul class="menu">
				<li><a href="#" id="js-back-archive">←</a></li>
				<li><a href="#" id="js-like-post">★</a></li>
			</ul>
		</nav>
		<nav class="top-bar_right">
			<ul class="menu">
				<li><a href="#" id="js-share">→</a></li>
				<li><a href="#" id="js-style">A</a></li>
			</ul>
		</nav>
	</div>
</div>
<div class="column small-12 o-whole">
	<div class="c-block -secondary -extended js-wow u-fadeInUp">
		<div class="row o-row">
			<div class="column small-12 o-text_body">
				<?php
					if ( have_posts() ) : while ( have_posts() ) : the_post();

						echo '<h2>', the_title(), '</h2>';
						the_post_thumbnail();
						the_content();

					endwhile;endif;
				?>
			</div>
		</div>
	</div>
</div>
