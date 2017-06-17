<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<article <?php post_class( 'column small-12 hentry c-list_wrap' ); ?> itemscope itemtype="http://schema.org/Article" itemref="author-prof">
	<meta itemprop="description" content="<?php the_excerpt(); ?>">
	<ul class="post-info menu">
		<li class="published" itemprop="datePublished dateCreated" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php the_date(); ?></li>
		<li class="updated" itemprop="dateModified" datetime="<?php echo get_the_modified_time( 'Y-m-d' ); ?>"></li>
		<li class="author hide" itemprop="author copyrightHolder editor" itemscope itemtype="http://schema.org/Person"><span class="author" itemprop="name"><?php the_author(); ?></span></li>
		<li><?php the_category( ', ' ); ?></li>
	</ul>
	<div class="c-list row">
		<div class="column small-4 medium-3 large-2">
			<a href="<?php the_permalink(); ?>" rel="nofollow"><?php the_post_thumbnail( 'thumbnail', array( 'itemprop' => 'image', 'class' => 'thumbnail' ) ); ?></a>
		</div>
		<div class="column small-8 medium-9 large-10">
			<h2 itemprop="about headline" class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</div>
	</div>

</article>

<?php
	endwhile;endif;
