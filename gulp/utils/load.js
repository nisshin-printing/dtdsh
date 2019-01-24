/**
 * 一括読み込みタスク
 * 指定されたディレクトリ以下のスクリプトをrequireする
 */
const fs = require('graceful-fs');
const path = require('path');

const files = fs.readdirSync(__dirname) || {},
		result = [];

files.forEach((file) => {
		const stats = fs.statSync(path.join(__dirname, file));
		if (stats.isFile() && path.extname(file) === '.js') {
				const name = path.basename(file, '.js');
				if (name === 'load') return;
				result[name] = require(__dirname + '/' + name);
		}
});
module.exports = result;