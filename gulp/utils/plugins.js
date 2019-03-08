/**
 * プラグイン読み込み
 * 指定したパターンのプラグインを自動的に読み込む
 */
const loader = require('gulp-load-plugins');
const browser = require('browser-sync');
const merge = require('merge-stream');
const del = require('del');

const $ = loader({
		pattern: ['gulp-*', 'gulp.*'],
		replaceString: /\bgulp[\-.]/
});

$.browser = browser;
$.merge = merge;
$.del = del;

module.exports = $;