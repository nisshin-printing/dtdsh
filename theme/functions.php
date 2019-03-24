<?php
/**
 * Theme Functions &
 * Functionality
 *
 */

require_once( get_template_directory() . '/woocommerce/add--address-book.php' );


/* =========================================
		Define
   ========================================= */
define( 'DTDSH_THEME_VERSION', '1.8' );

/* =========================================
		ACTION HOOKS & FILTERS
   ========================================= */

/**--- Actions ---**/

add_action( 'after_setup_theme', 'theme_setup' );

add_action( 'wp_enqueue_scripts', 'theme_styles' );

add_action( 'wp_enqueue_scripts', 'theme_scripts' );

add_editor_style( get_stylesheet_directory_uri() . '/assets/css/editor-style.css' );

add_filter( 'tiny_mce_before_init', 'theme_editor_styles' );

add_filter( 'mce_buttons', 'theme_editor_buttons' );

if (! preg_match( '/(local|dev)/', $_SERVER['SERVER_NAME'] ) && ! is_user_logged_in() && ! is_page( 'print' ) ) {
	add_action( 'wp_head', 'tagmanager_install' );
}

// expose php variables to js. just uncomment line
// below and see function theme_scripts_localize
// add_action( 'wp_enqueue_scripts', 'theme_scripts_localize', 20 );

/**--- Filters ---**/



/* =========================================
		HOOKED Functions
   ========================================= */

/**--- Actions ---**/


/**
 * Setup the theme
 *
 * @since 1.0
 */
if (! function_exists( 'theme_setup' )) {
    function theme_setup()
    {

        // Let wp know we want to use html5 for content
        add_theme_support( 'html5', array(
        //     'comment-list',
        //     'comment-form',
            'search-form',
        //     'gallery',
        //     'caption'
        ) );


        // Let wp know we want to use post thumbnails
        add_theme_support( 'post-thumbnails' );

        // Over WordPress 4.1
        add_theme_support( 'title-tag' );
        
        // Add Custom Logo Support.
        /*
		add_theme_support( 'custom-logo', array(
			'width'       => 181, // Example Width Size
			'height'      => 42,  // Example Height Size
			'flex-width'  => true,
		) );
		*/

        // Register navigation menus for theme
        register_nav_menus( array(
						'main'   => 'Main Menu',
						'web'       => 'S -- Web',
						'print'     => 'S -- Print',
						'design'     => 'S -- Design',
						'ads'       => 'S -- Ads',
						'manage'    => 'S -- Manage',
						'Web-cs'    => 'S -- WebCS',
						'variety'   => 'S -- Variety',
						'ms-manage' => 'S -- M/S Manage',
						'ms-lease'  => 'S -- M/S Lease',
            'about'    => 'Footer about'
        ) );


        // Let wp know we are going to handle styling galleries
        /*
		add_filter( 'use_default_gallery_style', '__return_false' );
		*/


        // Stop WP from printing emoji service on the front
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );


        // Remove toolbar for all users in front end
        // show_admin_bar( false );
        add_action( 'wp_head', 'theme_favicon' );

        add_action( 'admin_head', 'theme_favicon' );

        remove_action( 'wp_head', 'feed_links_extra', 3 );

        remove_action( 'wp_head', 'rsd_link' );

        remove_action( 'wp_head', 'wlwmanifest_link' );

        remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );

        remove_action( 'wp_head', 'wp_generator' );


        // Add Custom Image Sizes
        /* add_image_size( 'ExampleImageSize', 1200, 450, true ); // Example Image Size...
				*/
        // add_image_size( 'blog', 700, 432, false );
        


        // WPML configuration
        // disable plugin from printing styles and js
        // we are going to handle all that ourselves.
        // if (! is_admin()) {
        //     define( 'ICL_DONT_LOAD_NAVIGATION_CSS', true );
        //     define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
        //     define( 'ICL_DONT_LOAD_LANGUAGES_JS', true );
        // }


        // Contact Form 7 Configuration needs to be done
        // in wp-config.php. add the following snippet
        // under the line:
        // define( 'WP_DEBUG', false );

        //Contact Form 7 Plugin Configuration
        // define ( 'WPCF7_LOAD_JS',  false ); // Added to disable JS loading
        // define ( 'WPCF7_LOAD_CSS', false ); // Added to disable CSS loading
        // define ( 'WPCF7_AUTOP',    false ); // Added to disable adding <p> & <br> in form output



        // Register Autoloaders Loader
        $theme_dir = get_template_directory();
        include "$theme_dir/library/library-loader.php";
        include "$theme_dir/includes/includes-loader.php";
				include "$theme_dir/components/components-loader.php";


	}
}


/**
 * Register and/or Enqueue
 * Styles for the theme
 *
 * @since 1.0
 */
if (! function_exists( 'theme_styles' )) {
    function theme_styles() {
        $theme_dir = get_stylesheet_directory_uri();

				// wp_enqueue_style( 'poiret-one', '//fonts.googleapis.com/css?family=Poiret+One&text=BalanceDesign', array(), '', 'all' );
				// wp_enqueue_style( 'lato', '//fonts.googleapis.com/css?family=Lato&text=1234567890', array(), '', 'all' );

				wp_enqueue_style( 'main', "$theme_dir/assets/css/main.css", array(), null, 'all' );
    }
}

/**
 * Register and/or Enqueue
 * Scripts for the theme
 *
 * @since 1.0
 */
if (! function_exists( 'theme_scripts' )) {
    function theme_scripts() {
        $theme_dir = get_stylesheet_directory_uri();
        
				wp_deregister_script( 'jquery' );
				wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), false, true );
				
				wp_enqueue_script( 'main', "$theme_dir/assets/js/main.js", array( 'jquery' ), false, true );
				wp_enqueue_script( 'overflowNav', "$theme_dir/assets/js/overflowNav.js", array( 'jquery' ), false, true );
				wp_enqueue_script( 'lightslider', "$theme_dir/assets/js/lightslider.js", array( 'jquery' ), false, true );
				wp_enqueue_script( 'nid-accordion', "$theme_dir/assets/js/accordion.js", array( 'jquery' ), false, true );
    }
}


/**
 * Attach variables we want
 * to expose to our JS
 *
 * @since 3.12.0
 */
if (! function_exists( 'theme_scripts_localize' )) {
    function theme_scripts_localize() {
        $ajax_url_params = array();

        wp_localize_script( 'main', 'urls', array(
            'home'  => home_url(),
            'theme' => get_stylesheet_directory_uri(),
            'ajax'  => add_query_arg( $ajax_url_params, admin_url( 'admin-ajax.php' ) )
        ) );
    }
}


// Add Favicon
function theme_favicon() {
    $theme_dir = get_stylesheet_directory_uri();
    echo "<link rel=\"SHORTCUT ICON\" href=\"$theme_dir/assets/img/favicon.ico\">", "<link rel=\"apple-touch-icon\" href=\"$theme_dir/assets/img/favicon-144.png\">";
}


// Install Google Tag Manager.
function tagmanager_install() {
	if ( ! current_user_can() ) {
		echo <<< EOT
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WV7S6J');</script>
<!-- End Google Tag Manager -->
EOT;
	}
}


/**
 * ビジュアルエディターCSS
 */
function theme_editor_styles($initArray) {
    $initArray['body_class'] = 'editor-area';
    $initArray['block_formats'] = "見出し2=h2;見出し3=h3;見出し4=h4;見出し5=h5;見出し6=h6;段落=p;";

    $initArray['style_formats'] = json_encode( $style_formats );
    return $initArray;
}
