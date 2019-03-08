jQuery(document).ready($ => {
		$('.accordion--title').click(event => {
				$(event.currentTarget).parent().toggleClass('is-open');
		});
});