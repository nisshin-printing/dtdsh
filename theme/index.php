<?php
if ( empty( $_GET['_pjax'] ) ) {
		$bg = $post->post_name;
		include locate_template( './header.php' );
}
?>

<main>
		<section class="hero--wrap" style="background-image:url(//liginc.co.jp/wp-content/themes/ligtheme/assets/images/hero-web.jpg)">
			<h1 class="hero--title"><?php the_title(); ?></h1>
		</section>

		<?php NID_Crumbs::crumbs(); ?>

		<section class="content">
			<?php
				while ( have_posts() ) : the_post();
					the_content();
				endwhile;
			?>
		</section>
</main>


<?php
if ( empty( $_GET['_pjax'] ) ) {
	include locate_template( './footer.php' );
}
