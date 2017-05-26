import '../vendor/typed';
import '../vendor/jquery-pjax';

jQuery(document).ready($ => {
    const body = $('#js-body');
    const cWrap = $(document.getElementById('js-contact'));
    const cBack = $(document.getElementById('js-contact-back'));
    const cOpen = $('.js-contact-open');
    const cMenu = $(document.getElementById('js-contact-menu'));
    const menuStep = cMenu.find('.js-contact-step');

    function timeOfDay(time) {
        if ((4 <= time) && (time < 6)) {
            return 'early';
        } else if ((6 <= time) && (time < 8)) {
            return 'earlymorning';
        } else if ((8 <= time) && (time < 11)) {
            return 'noonish';
        } else if ((11 <= time) && (time < 13)) {
            return 'lunchtime';
        } else if ((13 <= time) && (time < 16)) {
            return 'afternoon';
        } else if ((16 <= time) && (time < 19)) {
            return 'earlyevening';
        } else if ((19 <= time) && (time < 21)) {
            return 'evening';
        } else if ((21 <= time) && (time < 23)) {
            return 'night';
        } else if ((23 <= time) || (time < 4)) {
            return 'latenight';
        }
        return 'afternoon';
    }

    function greetVisitor() {
        const timeSwitch = timeOfDay(new Date().getHours());
        switch (timeSwitch) {
            case 'earlymorning':
            case 'latemorning':
                return cMenu.data('greeting-morning');
            case 'evening':
            case 'night':
                return cMenu.data('greeting-evening');
            case 'latenight':
            case 'early':
                return cMenu.data('greeting-night');
            case 'noonish':
            case 'afternoon':
            default:
                return cMenu.data('greeting-afternoon');
        }
    }

    function type(text) {
        const title = $(document.getElementById('js-contact-title'));
        if ('' === text) {
            title.text('');
        } else if (title.text().length > 0) {
            const count = title.text().length;
            let i = 0;
            const intervalTyped = setInterval(() => {
                if (count > i) {
                    const containText = title.text();
                    const downText = containText.slice(0, -1);
                    title.text(downText);
                } else {
                    title.text('');
                    clearInterval(intervalTyped);
                    setTimeout(() => {
                        title.typed({
                            strings: [text],
                            typeSpeed: 10,
                            showCursor: false
                        });
                    }, 200);
                }
                i += 1;
            }, 20);
        } else {
            setTimeout(() => {
                title.typed({
                    strings: [text],
                    contentType: 'html',
                    typeSpeed: 10,
                    showCursor: false
                });
            }, 600);
        }
    }

    function init() {
        cWrap.find('.js-contact-content').removeClass('is-active');
        cWrap.find('.js-contact-step').removeClass('is-active');
    }

    function changePage(param) {
        init();
        if ('menu' === param || 'home' === param) {
            cBack.removeClass('is-active');
        } else {
            cBack.addClass('is-active');
        }
        const content = cWrap.find(`.js-contact-content[data-param="${param}"]`);
        const step = content.find('.js-contact-step');
        let greeting = '';
        if ('menu' === param) {
            greeting = `${greetVisitor()}<br>`;
        }
        const text = greeting + content.data('text');
        type(text);
        content.addClass('is-active');
        /*
        const gRecaptcha = content.find('.js-recaptcha');
        if (gRecaptcha.length && gRecaptcha.is(':empty')) {
            const boxId = gRecaptcha.attr('id');
            const gKey = gRecaptcha.data('sitekey');
            window.grecaptcha.render(boxId, { sitekey: gKey });
        }
        content.find('input[type="submit"]').prop('disabled', true);
        */
        step.each(function(index) {
            const stepDelay = 100 * index;
            setTimeout(() => {
                $(this).addClass('is-active');
            }, stepDelay);
        });
    }

    function toggleOpen(param) {
        const scrollTop = $(window).scrollTop();
        body.toggleClass('has-contact-open');
        if (body.hasClass('has-contact-open')) {
            body.css({
                position: 'fixed',
                top: -scrollTop
            });
            // Theming.
            $('meta[name="theme-color"]').attr('content', '#1F1F1F');
            changePage(param);
        } else {
            // Theming.
            $('meta[name="theme-color"]').attr('content', '#FFFFFF');
            init();
            body.css({
                position: 'static',
                top: '0'
            });
            type('');
        }
    }

    // fab をクリックしたとき
    cOpen.click(event => {
        const dataPage = $(event.currentTarget).data('page');
        let param = 'menu';
        if (dataPage) {
            param = dataPage;
        }
        toggleOpen(param);
    });
    // stepButton をクリックしたとき
    menuStep.click(event => {
        const param = $(event.currentTarget).data('page');
        changePage(param);
    });
    // Menuへ戻る
    cBack.click(() => changePage('menu'));
    // Loading.
    $(window).on('load', () => {
        body.removeClass('is-loading');
    });
    // Pjax
    $.pjax({
        area: ['#js-main, #js-title'],
        link: 'a:not(.js-nojax)',
        ajax: { timeout: 2500 },
        wait: 500,
        rewrite: document => {
            const newBodyClass = $('#js-body', document).attr('class');
            $('#js-body').attr('class', newBodyClass);
            const newCurrentItem = $('.-current', document);
            const newCurrentLink = newCurrentItem.find('a').attr('href');
            $('#js-nav-main').find('.-current').removeClass('-current');
            $('#js-nav-main').find(`a[href="${newCurrentLink}"]`).parent('.c-nav_item').addClass('-current');
        }
    });
    $(document).on('pjax:fetch', () => {
        body.toggleClass('is-loading');
    });
    $(document).on('pjax:render', () => {
        body.removeClass('is-loading');
        body.css({
            position: 'static',
            top: '0'
        });
        dataLayer.push({ event: 'changePage' }); // eslint-disable-line no-undef
    });
    document.addEventListener('wpcf7mailsent', event => { // eslint-disable-line no-undef, no-unused-vars
        ga('send', 'event', 'Contact Form', 'submit'); // eslint-disable-line no-undef, no-unused-vars
    }, false);
});