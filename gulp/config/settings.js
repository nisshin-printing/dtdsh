// config
const paths = require('./common').paths;
/**
 * タスク設定ファイル
 */
module.exports = {
		browserSync: {
				proxy: "dtdsh.local",
				logSnippet: true,
				ghostMode: true,
				open: "local"
		},
		font: {
				watch: paths.assets.src + '/fonts/**/*.{eot,otf,ttf,woff,woff2,svg}',
				src: paths.assets.src + '/fonts/**/*.{eot,otf,ttf,woff,woff2,svg}',
				dest: paths.assets.dest + '/fonts',
				clean: paths.assets.dest + '/fonts/**/*.{eot,otf,ttf,woff,woff2,svg}',
		},
		images: {
				watch: [
						paths.assets.src + '/img/**/*.{gif,ico,jpg,jpeg,png,webp}',
						'!' + paths.assets.src + '/img/sprite'
				],
				src: [
						paths.assets.src + '/img/**/*.{gif,ico,jpg,jpeg,png,webp}',
						'!' + paths.assets.src + '/img/sprite'
				],
				dest: paths.assets.dest + '/img',
				clean: paths.assets.dest + '/img/**/*.{gif,ico,jpg,jpeg,png,webp}',
		},
		scripts: {
				watch: paths.assets.src + '/js/**/*.js',
				src: [
						paths.assets.src + '/js/*.js',
						'!' + paths.assets.src + '/js/**/_*'
				],
				dest: paths.assets.dest + '/js',
				clean: paths.assets.dest + '/js/**/*.{js,map}',
		},
		styles: {
				watch: [
						paths.assets.src + '/sass/**/*.scss',
						'!' + paths.assets.src + '/sass/**/*_tmp\\d+.scss',
				],
				src: [
						paths.assets.src + '/sass/**/*.scss',
						'!' + paths.assets.src + '/sass/**/_*.scss',
				],
				dest: paths.assets.dest + '/css',
				clean: paths.assets.dest + '/css/**/*.{css,map}',
				sass: {
						includePaths: [
								'assets/sass/',
								'node_modules/foundation-sites/scss'
						]
				},
				autoprefixer: {
						browsers: ['last 3 version']
				},
				minify: {
						autoprefixer: false,
						discardComments: { removeAll: true }
				}
		},
		sprite: {
				watch: paths.assets.src + '/svg/sprite/**/*.svg',
				src: paths.assets.src + '/svg/sprite/**/*.svg',
				dest: paths.assets.dest + '/svg',
				clean: paths.assets.dest + '/svg/sprite.svg',
				name: 'sprite.svg',
				geneartor: 'icon-%s'
		},
		svg: {
				watch: [
						paths.assets.src + '/svg/**/*.svg',
						'!' + paths.assets.src + '/svg/sprite/**/*.svg',
				],
				src: [
						paths.assets.src + '/svg/**/*.svg',
						'!' + paths.assets.src + '/svg/sprite/**/*.svg',
				],
				dest: paths.assets.dest + '/svg',
				clean: [
						paths.assets.dest + '/svg/**/*.svg',
						'!' + paths.assets.dest + '/svg/sprite.svg',
				],
		},
		theme: {
				watch: paths.theme.src + '/**/*.{json,php,png,jpg}',
				src: paths.theme.src + '/**/*.{json,php,png,jpg}',
				dest: paths.theme.dest,
				clean: [
						paths.theme.dest + '/*.{css,json,php,png}',
						'!' + paths.assets.dest + '/**/*',
				]
		},
}