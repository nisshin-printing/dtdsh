/**
 * Override the Default
 * Core Styles
 * Config
 *
 */
module.exports = {
    options: {
        sass: {
            outputStyle: 'compressed',
            sourcemap: true,
            souceComments: 'normal',
            includePaths: [
                'assets/sass/',
                'node_modules/foundation-sites/scss'
            ]
        },
        autoprefixer: {
            browsers: [
                'last 2 version',
                'ie 10',
                'IOS >= 9',
                'Android 4.2'
            ]
        },
        minify: {
            autoprefixer: true,
            discardComments: { removeAll: true }
        }
    }
};