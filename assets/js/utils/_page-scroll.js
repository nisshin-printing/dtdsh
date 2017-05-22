jQuery(document).ready($ => {
    $('a[href^="#"]').click(function() {
        const body = $('html, body');
        const speed = 'fast';
        const href = $(this).attr('href');
        const target = $(href === '#' ? 'html' : href);
        const position = target.offset().top;
        body.animate({
            scrollTop: position
        }, speed, 'swing');
    });
});