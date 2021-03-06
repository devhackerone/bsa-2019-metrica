const HtmlWebpackPlugin = require('html-webpack-plugin');
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const script = (appUrl, trackingNumber, hash = '') => `
	<script id="metrica" async src="${appUrl}metrica.js?tracking_id=${trackingNumber}&spa=false${hash}" ></script>
	<script>
		window._metricaTrackingConfig = window._metricaTrackingConfig || [];
		function mtag() {
			_metricaTrackingConfig.push(arguments);
		}
		mtag('dateStart', new Date());
		mtag('tracking_id', '${trackingNumber}');
		mtag('spa', false);
	</script>
`;

const createPage = (name, title, hash) => new HtmlWebpackPlugin({
	filename: name + '.html',
	template: `./src/${name}.html`,
	templateParameters: {
		metricaScript: script(
			process.env.APP_URL,
			process.env.TRACKING_NUMBER,
			hash
		),
		title: title,
		headTitle: title.toUpperCase(),
	}
});

module.exports = (env) => {
	require('dotenv').config({
		path: './.env' + ((env || {}).APP_ENV || '')
	});

	return {
		context: __dirname,
		entry: './index.js',
		output: {
			path: path.resolve(__dirname, './dist'),
			filename: 'bundle.js'
		},
		module: {
			rules: [
				{ test: /\.css$/, use: [MiniCssExtractPlugin.loader, 'css-loader'] }
			]
		},
		plugins: [
			createPage('index', 'home'),
			createPage('about', 'about'),
			createPage('contact', 'contact'),
			createPage('portfolio', 'portfolio', `&hash=${Date.now()}`),
			new MiniCssExtractPlugin({ filename: 'src/main.css' })
		],
		mode: 'production'
	};
};