module: {
		rules: [{
						test: /\.js$/,
						// ローダーの処理対象から外すディレクトリ
						exclude: /node_modules/,
						use: [{
								// 利用するローダー
								loader: 'babel-loader',
								// ローダーのオプション
								// 今回はbabel-loaderを利用しているため
								// babelのオプションを指定しているという認識で問題ない
								options: {
										presets: [
												['env', { modules: false }]
										]
								}
						}]
				},
				{
						// enforce: 'pre'を指定することによって
						// enforce: 'pre'がついていないローダーより早く処理が実行される
						// 今回はbabel-loaderで変換する前にコードを検証したいため、指定が必要
						enforce: 'pre',
						test: /\.js$/,
						exclude: /node_modules/,
						loader: 'eslint-loader'
				}
		]
}