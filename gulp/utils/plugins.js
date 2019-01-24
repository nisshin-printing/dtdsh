/**
 * プラグイン読み込み
 * 指定したパターンのプラグインを自動的に読み込む
 */
const loader = require('gulp-load-plugins');
const browser = require('browser-sync');
const del = require('del');
const merge = require('merge-stream');

const $ = loader({
		pattern: ['gulp-*', 'gulp.*'],
		replaceString: /\bgulp[\-.]/
});

$.browser = browser;
$.del = del;
$.merge = merge;

module.exports = $;