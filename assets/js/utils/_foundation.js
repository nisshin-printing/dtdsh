import '../vendor/foundation.core';
import '../vendor/foundation.util.mediaQuery';
import '../vendor/foundation.util.keyboard';
import '../vendor/foundation.util.motion';
import '../vendor/foundation.util.box';
import '../vendor/foundation.util.nest';
import '../vendor/foundation.util.triggers';
import '../vendor/foundation.magellan';
import '../vendor/foundation.dropdownMenu';
import '../vendor/foundation.accordion';

$(document).foundation();

jQuery(document).ready($ => {
    $('a[href="#all"]').click(() => {
        const allItem = $(document.getElementById('all'));
        if (!allItem.hasClass('is-active')) {
            allItem.parent().foundation('toggle', allItem.find('.js-accordion-content'), true);
        }
    });
});