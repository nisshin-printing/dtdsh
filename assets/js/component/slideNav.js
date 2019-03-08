jQuery(document).ready($ => {
		$('.js--nav__button').click(event => {
				$('#js--body').toggleClass('is-nav-open');
				$(event.currentTarget).toggleClass('u-main--turn u-main');
		});
});