<?php
if ( is_front_page() || is_page() || is_404() ) {
	if ( empty( $_GET['_pjax'] ) ) get_header();
	get_template_part( 'loop/content-page' );
	if ( empty( $_GET['_pjax'] ) ) get_footer();

} elseif ( is_single() || is_search() || is_archive() ) {
	if ( empty( $_GET['_pjax'] ) ) get_header( 'blog' );
	get_template_part( 'loop/content-single' );
	if ( empty( $_GET['_pjax'] ) ) get_footer();
}
