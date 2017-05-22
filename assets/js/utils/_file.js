jQuery(document).ready($ => {
    $(document.getElementById('js-contact')).find('.js-file').on('change', event => {
        const fileName = $(event.currentTarget)[0].files[0].name;
        $(event.currentTarget).parent().parent().find('.js-file-name').text(fileName); // eslint-disable-line newline-per-chained-call
    });
    $(document.getElementById('js-contact')).find('.js-file-clear').on('click', event => {
        $(event.currentTarget).parent().find('.js-file').val('');
        $(event.currentTarget).parent().find('.js-file-name').text('');
    });
});