// config
const project = require('../../project.config');

/**
 * Common config
 * for all tasks
 *
 */
module.exports = {
		paths: {
				theme: {
						src: 'theme',
						dest: '../' + project.name
				},
				assets: {
						src: 'assets',
						dest: '../' + project.name + '/assets'
				}
		}
};