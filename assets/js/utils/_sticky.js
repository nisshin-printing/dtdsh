import '../vendor/sticky-kit';

jQuery(document).ready($ => {
    if (window.matchMedia('(min-width: 1024px)').matches) {
        $(document.getElementById('js-service-toc')).stick_in_parent({
            parent: '#js-service-wrap',
            stickyClass: 'is-sticky'
        });
    }
    $(document.getElementById('js-pagenav')).stick_in_parent({
        parent: '#js-pagenav-wrap',
        stickyClass: 'is-sticky'
    });
});