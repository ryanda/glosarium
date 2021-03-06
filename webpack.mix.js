const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.disableNotifications();

mix.webpackConfig({
    output: {
    	/**
    	 * Base path for async components
    	 * @link http://router.vuejs.org/en/advanced/lazy-loading.html
    	 */ 
        publicPath: "/"
    }
});

// bootstrap
mix.less('node_modules/bootstrap/less/bootstrap.less', 'public/css/bootstrap.css');
mix.js('node_modules/bootstrap/dist/js/npm.js', 'public/js/bootstrap.js');

// font awesome
mix.less('node_modules/font-awesome/less/font-awesome.less', 'css/font-awesome.css');

// theme css
mix.less('resources/assets/less/theme.less', 'public/css/theme.css');
mix.styles([
	'timeline.css'
], 'public/css/timeline.css');

// magnific-popup
mix.copy('node_modules/magnific-popup/dist/magnific-popup.css', 'public/css/magnific-popup.css');
mix.copy('node_modules/magnific-popup/dist/jquery.magnific-popup.min.js', 'public/js/magnific-popup.js');

// highlight js
mix.copy('node_modules/highlight.js/styles/monokai.css', 'public/css/');

// jquery.easing
mix.scripts('node_modules/jquery.easing/jquery.easing.min.js', 'public/js/jquery.easing.js');

// theme script
mix.js('resources/assets/js/theme.js', 'public/js/theme.js');
mix.js('resources/assets/js/app.js', 'public/js/app.js');