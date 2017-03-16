module.exports = function(filename, definitions) {

    var preservedDefs = (
        definitions && definitions.length ?
        ' * ' + definitions.join('\n * ') + '\n *' :
        ' *'
    );
    // Windows Backslash replace slash.
    var filename = filename.replace(/\\/g, '/');

    return [
        '<?php',
        '/**',
        preservedDefs,
        ' * DEVELOPMENT MODE ONLY',
        ' *',
        ' * Includes and Runs php files directly',
        ' * from the dev theme to enable debugging',
        ' * php from within the dev theme!',
        ' *',
        ' * Run "gulp build" to generate the theme',
        ' * for production before deploying!',
        ' *',
        ' */',
        'include get_template_directory() . DIRECTORY_SEPARATOR . \'' + filename + '\';'
    ].join('\n');
};