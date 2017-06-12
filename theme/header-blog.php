<?php
/**
 * Header file common to all
 * templates
 *
 */
?>
<!doctype html>
<html class="site no-js" <?php language_attributes(); ?>>
<head>
	<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
	<![endif]-->

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php // replace the no-js class with js on the html element ?>
	<script>document.documentElement.className=document.documentElement.className.replace(/\bno-js\b/,'js')</script>

	<?php // load the core js polyfills ?>
	<script async defer src="<?php echo get_template_directory_uri(), '/assets/js/core.js?ver=', DTDSH_THEME_VERSION; ?>"></script>

	<?php // Theming ?>
	<meta name="theme-color" content="#FFFFFF">

	<?php /*
	<?php // load the reCAPTCHA API ?>
	<script async defer src="//www.google.com/recaptcha/api.js"></script>
	*/ ?>
	<?php wp_head(); ?>
</head>
<body id="js-body" <?php body_class( 'o-main u-background is-loading' ); ?>>
<?php // <body> closes in footer.php ?>



<?php // common header content goes here ?>
