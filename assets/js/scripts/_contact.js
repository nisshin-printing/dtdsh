import Typed from '../vendor/typed';
import '../vendor/jquery-pjax';

jQuery(document).ready($ => {
		const body = $('#js--body');
		const cWrap = $(document.getElementById('js--contact'));
		const cBack = $(document.getElementById('js--contact__back'));
		const cOpen = $('.js--contact__open');
		const cMenu = $(document.getElementById('js--contact__menu'));
		const menuStep = cMenu.find('.js--contact__step');

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

		function init() {
				cWrap.find('.js--contact__content').removeClass('is-active');
				cWrap.find('.js--contact__step').removeClass('is-active');
				$('#js--item__wrap').removeClass('end-typed');
		}

		function changePage(param) {
				init();
				if ('menu' === param || 'home' === param) {
						cBack.removeClass('is-active');
				} else {
						cBack.addClass('is-active');
				}
				const content = cWrap.find(`.js--contact__content[data-param="${param}"]`);
				let greeting = '';
				if ('menu' === param) {
						greeting = `${greetVisitor()}<br>`;
				}
				const text = greeting + content.data('text');
				type(text);
				content.addClass('is-active');
		}

		function toggleOpen(param) {
				const scrollTop = $(window).scrollTop();
				body.toggleClass('is-contact-open');
				if (body.hasClass('is-contact-open')) {
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
				$(event.currentTarget).toggleClass('u-main--turn u-main');
		});
		// stepButton をクリックしたとき
		menuStep.click(event => {
				const param = $(event.currentTarget).data('page');
				changePage(param);
		});
		// Menuへ戻る
		cBack.click(() => changePage('menu'));
		// Loading.
		$(document).on('load', () => {
				body.removeClass('is-loading');
		});
});

function type(text) {
		const title = '#js--contact__title';
		if ('' === text) {
				$(title).text('');
		} else if ($(title).text().length > 0) {
				const count = $(title).text().length;
				let i = 0;
				const intervalTyped = setInterval(() => {
						if (count > i) {
								const containText = $(title).text();
								const downText = containText.slice(0, -1);
								$(title).text(downText);
						} else {
								$(title).text('');
								clearInterval(intervalTyped);
								setTimeout(() => {
										new Typed(title, {
												strings: [text],
												typeSpeed: 10,
												showCursor: false,
												onComplete: () => {
														$('#js--item__wrap').addClass('end-typed');
												}
										});
								}, 200);
						}
						i += 1;
				}, 20);
		} else {
				setTimeout(() => {
						new Typed(title, {
								strings: [text],
								contentType: 'html',
								typeSpeed: 10,
								showCursor: false,
								onComplete: () => {
										$('#js--item__wrap').addClass('end-typed');
								}
						});
				}, 600);
		}
}