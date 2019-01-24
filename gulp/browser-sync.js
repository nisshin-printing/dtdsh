// config
const { task } = require('gulp');
const config = require('./config/settings');

// utils
const $ = require('./utils/plugins');

/**
 * サーバ起動タスク
 */
task('browser:sync', done => {
		$.browser(config.browserSync);
		done();
});