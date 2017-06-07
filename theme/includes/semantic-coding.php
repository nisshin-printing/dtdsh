<?php
add_action( 'wp_head', function() {
	$theme_dir = get_template_directory();
	$logo = "$theme_dir/assets/img/favicon-144.png";
	if ( is_front_page() ) {
		echo '
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "WebSite",
	"url": "', home_url( '/' ), '",
	"potentialAction": {
		"@type": "SearchAction",
		"target": "', home_url( '/' ), '?s={search_term_string}",
		"query-input": "required name=search_term_string"
	}
}
</script>
';
	}
	echo '
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "LocalBusiness",
	"name": "', bloginfo( 'name' ), '",
	"telephone": "082-237-1611",
	"email": "info@dtdsh.com",
	"description": "創業1928年、', date('Y')-1928, '年間。それが、日進印刷の強さです。",
	"openingHours": "Mo-Fr 09:00-17:00",
	"url": "', home_url( '/' ), '",
	"image": "', $logo, '",
	"sameAs": [
		"https://www.facebook.com/nisshin.dtdsh/",
		"https://plus.google.com/+%E6%97%A5%E9%80%B2%E5%8D%B0%E5%88%B7%E6%A0%AA%E5%BC%8F%E4%BC%9A%E7%A4%BE%E8%A5%BF%E5%8C%BA",
		"https://www.youtube.com/channel/UCAvo9rI_LB46WbQ9_Gc9ibw",
		"https://www.instagram.com/nisshin_inc",
		"https://twitter.com/nisshin_inc",
		"https://minne.com/@mimicchii"
	]
}
</script>
';
});
