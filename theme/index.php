<?php
/**
 * Read up on the WP Template Hierarchy for
 * when this file is used
 *
 */
?>
<?php
	if ( empty( $_GET['_pjax'] ) ) get_header();
?>

<main id="js-main">
	<div class="o-container">
		<div class="row expanded o-content">
			<div class="column small-12">
				<div class="row expanded o-grid">
					<?php
						if ( is_front_page() ) {
							get_template_part( 'templates/front' );
						} else {
							NID_Crumbs::crumbs();
							if ( is_page( 'service' ) ) {
								get_template_part( 'templates/service' );
							} elseif ( is_page( 'price' ) ) {
								get_template_part( 'templates/price' );
							} elseif ( is_page( 'about' ) ) {
								get_template_part( 'templates/about' );
							} elseif ( is_page( 'recruit' ) ) {
								get_template_part( 'templates/recruit' );
							} elseif ( is_page( 'contact' ) ) {
								get_template_part( 'templates/contact' );
							} else {
								get_template_part( 'templates/404' );
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php
	if ( empty( $_GET['_pjax'] ) ) get_footer();
?>
