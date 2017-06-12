<?php
if ( is_front_page() || is_page() ) {
	get_template_part( 'loop/content-page' );
} else {
	get_template_part( 'loop/content-single' );
}
