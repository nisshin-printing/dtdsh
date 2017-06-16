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
			<?php
				if ( have_posts() ) : while ( have_posts() ) : the_post();
			?>

			<article <?php post_class( 'column small-12 o-text_body hentry' ); ?> itemscope itemtype="http://schema.org/Article" itemref="author-prof">
				<meta itemprop="description" content="<?php the_excerpt(); ?>">
				<ul class="post-info menu">
					<li class="published" itemprop="datePublished dateCreated" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php the_date(); ?></li>
					<li class="updated" itemprop="dateModified" datetime="<?php echo get_the_modified_time( 'Y-m-d' ); ?>"></li>
					<li class="author hide" itemprop="author copyrightHolder editor" itemscope itemtype="http://schema.org/Person"><span class="author" itemprop="name"><?php the_author(); ?></span></li>
					<li><?php the_category( ', ' ); ?></li>
				</ul>
				<h2 itemprop="about headline" class="entry-title"><?php the_title(); ?></h2>
				<?php the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) ); ?>
				<div itemprop="articleBody" class="entry-content"><?php the_content(); ?></div>

			</article>

			<?php
				endwhile;endif;
			?>
		</div>
	</div>
</div>
