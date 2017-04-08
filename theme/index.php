<?php
/**
 * Read up on the WP Template Hierarchy for
 * when this file is used
 *
 */
?>
<?php get_header(); ?>

<div class="o-main-wrap u-background">
	<main class="o-main js-main u-background" id="main">
		<div class="o-content">
			<div class="o-container">
				<div class="o-grid">
					<div class="o-whole">
						<a href="<?php echo get_permalink( get_page_by_path( 'about' ) ); ?>" class="c-block -link o-arrow -right js-wow u-fadeInUp">
							<article class="c-block_container">
								<p class="c-block_category">会社案内</p>
								<h2>創業1928年、<?php echo (int)date( 'Y' )-1928; ?>年間。<br>それが、日進印刷の強さです。</h2>
								<span class="c-block_arrow o-arrow_wrap">→</span>
							</article>
						</a>
					</div>
					<div class="o-half"></div>
					<div class="o-half"></div>
					<div class="o-half"></div>
					<div class="o-half"></div>
					<div class="o-whole"></div>
					<div class="o-whole"></div>
					<div class="o-whole"></div>
					<div class="o-whole"></div>
					<div class="o-whole"></div>
					<div class="o-whole"></div>
					<div class="o-whole"></div>
				</div>
			</div>
		</div>
	</main>
</div>

<?php get_footer(); ?>