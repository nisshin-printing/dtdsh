import 'foundation-sites/js/foundation.core';
import 'foundation-sites/js/foundation.util.mediaQuery';
import 'foundation-sites/js/foundation.util.keyboard';
import 'foundation-sites/js/foundation.util.motion';
import 'foundation-sites/js/foundation.accordion';
import 'foundation-sites/js/foundation.magellan';

jQuery(document).ready($ => {
    // Accordion - In Recruit.
    const accordion = new Foundation.Accordion($(document.getElementById('js-accordion')), { // eslint-disable-line no-unused-vars, no-undef
        slideSpeed: 500,
        multiExpand: true,
        allowAllClosed: true
    });
    $('[href="#all"]').click(() => {
        const allItem = $(document.getElementById('all'));
        if (!allItem.hasClass('is-active')) {
            allItem.parent().foundation('toggle', allItem.find('.js-accordion-content'), true);
        }
    });
    // Magelan Menu In Service.
    const toc = $(document.getElementById('js-service-toc'));
    if (toc.length) {
        const magellanToc = new Foundation.Magellan(toc, { // eslint-disable-line no-unused-vars, no-undef, max-len
            animationEasing: 'swing',
            activeClass: 'is-active'
        });
    }
});