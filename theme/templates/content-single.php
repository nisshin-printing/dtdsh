<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<article <?php post_class( 'column small-12 o-text_body -serif hentry' ); ?> itemscope itemtype="http://schema.org/Article" itemref="author-prof">
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

	<p>カテゴリー：　<?php the_category( ', ' ); ?></p>

</article>

<?php
	endwhile;endif;
