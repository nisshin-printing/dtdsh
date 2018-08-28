var path = require('path');
var webpack = require('webpack-stream').webpack;
var BowerWebpackPlugin = require('bower-webpack-plugin');
var UglifyJsPlugin = require('uglifyjs-webpack-plugin');
var LodashModuleReplacementPlugin = require('lodash-webpack-plugin');

// utils
var deepMerge = require('../utils/deepMerge');

// config
var overrides = require('../../config/scripts');
var assets = require('./common').paths.assets;

let = definePlugin = new webpack.DefinePlugin({
		__DEV__: JSON.stringify(JSON.parse(process.env.BUILD_DEV || 'true'))
});

/**
 * Script Building
 * Configuration
 * Object
 *
 * @type {{}}
 */
module.exports = deepMerge({
		paths: {
				watch: assets.src + '/js/**/*.js',
				src: [
						assets.src + '/js/*.js',
						'!' + assets.src + '/js/**/_*'
				],
				dest: assets.dest + '/js',
				clean: assets.dest + '/js/**/*.{js,map}'
		},

		options: {
				webpack: {

						// merged with defaults
						// for :watch task
						watch: {
								watch: true,
								cache: true
						},


						// merged with defaults
						// for :dev task
						dev: {
								mode: 'development',
								devtool: true,
								cache: true
						},


						// merged with defaults
						// for :prod task
						prod: {
								mode: 'production',
								devtool: false,
								optimization: {
										minimizer: [
												new UglifyJsPlugin({
														uglifyOptions: {
																compress: {
																		drop_console: true
																},
																cache: false,
																parallel: true,
																sourceMap: false,
																minify: {}
														}
												})
										]
								}
						},

						defaults: {
								mode: 'development',

								resolve: {
										extensions: ['.js', '.jsx']
								},
								output: {
										chunkFilename: 'chunk-[name].js'
								},
								module: {
										rules: [{
														test: /\.jsx?$/,
														exclude: [
																/bower_components/,
																/vendor/,
																/polyfills/,
																/node_modules/
														],
														use: [{
																loader: 'babel-loader',
																options: {
																		presets: [
																				['env', { modules: false }]
																		]
																}
														}]
												},
												{
														enforce: 'pre',
														test: /\.jsx?$/,
														exclude: [
																/bower_components/,
																/vendor/,
																/polyfills/,
																/node_modules/
														],
														loader: 'eslint-loader',
												}
										]
								},
								plugins: [
										new LodashModuleReplacementPlugin,
										definePlugin
								]
						}

				}
		}
}, overrides);