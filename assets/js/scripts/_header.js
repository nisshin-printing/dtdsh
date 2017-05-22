jQuery(document).ready($ => {
    const navButton = $(document.getElementById('js-header-main')).find('.js-nav-main-button');
    const body = $('#js-body');
    navButton.click(() => {
        const scrollTop = $(window).scrollTop;
        body.toggleClass('has-nav-open');
        if (body.hasClass('has-nav-open')) {
            body.css({
                position: 'fixed',
                top: -scrollTop
            });
        } else {
            body.css({
                position: 'static',
                top: '0'
            });
        }
    });
    $(window).on('resize', () => {
        if (window.matchMedia('(min-width: 1024px)').matches) {
            if (body.hasClass('has-nav-open')) {
                body.removeClass('has-nav-open');
                body.css({
                    position: 'static',
                    top: '0'
                });
            }
        }
    });
});