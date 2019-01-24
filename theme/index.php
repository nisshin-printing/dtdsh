<?php
if ( empty( $_GET['_pjax'] ) ) {
    get_header();
}
?>


<?php
    $is_single = ( is_single() ) ? ' itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog"' : '';
?>
<main id="js-main" role="main"<?php echo $is_single; ?>>
    <div class="o-container">
        <div class="row expanded o-content">
            <div class="column small-12">
                <div class="row expanded o-grid">
                    <?php
                        NID_Crumbs::crumbs();
                    if (is_front_page()) {
                        get_template_part( 'templates/front' );
                    } else if (is_page( 'service' )) {
                        get_template_part( 'templates/service' );
                    } else if (is_page( 'service/balance-design' )) {
                        get_template_part( 'templates/service/item' );
                    } else if (is_page( 'service/web-consulting' )) {
                        get_template_part( 'templates/service/web-consulting' );
                    } else if (is_page( 'price' )) {
                        get_template_part( 'templates/price' );
                    } else if (is_page( 'about' )) {
                        get_template_part( 'templates/about' );
                    } else if (is_page( 'recruit' )) {
                        get_template_part( 'templates/recruit' );
                    } else if (is_page( 'contact' )) {
                        get_template_part( 'templates/contact' );
                    } else if (is_404()) {
                        get_template_part( 'templates/404' );
                    } else if (is_single() || is_search() || is_archive() || is_home() || is_page() ) {
                        get_template_part( 'templates/blog' );
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>


<?php
if ( empty( $_GET['_pjax'] ) ) {
    get_footer();
}
