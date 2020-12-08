const mix = require('laravel-mix');
//const path = require('path');

 require('laravel-mix-purgecss');

// const webpack = require('webpack');

// require('laravel-mix-bundle-analyzer');
require('laravel-mix-workbox');


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
// If using async components, remove extract, apparently the two don't work together. Currently using extract because not sure of cache busting with async components
mix.sourceMaps().js('resources/js/app.js', 'public/js').vue()
.extract([ 'vue', 'jquery', 'bootstrap', 'moment', 'pusher-js']);
mix.sass('resources/sass/app.scss', 'public/css').styles([
        'resources/sass/app.css',
    'resources/sass/normalize.css',
    'resources/sass/skeleton.css',
    // 'https://gitcdn.link/repo/M-Media-Group/Snippet-CSS/master/css/normalize.css',
    // 'https://gitcdn.link/repo/M-Media-Group/Snippet-CSS/master/css/skeleton.css'
], 'public/css/all.css').purgeCss().injectManifest({
      swSrc: './resources/js/service-worker.js'
    });
mix.webpackConfig({
    output: {
        publicPath: '', // fixes the output bug
    },
});
if (mix.inProduction()) {
    mix.version();
    // .purgeCss()
} else {
	    // mix.bundleAnalyzer({
	    // 	analyzerPort: 8145,
	    // });
	//mix.browserSync('https://mmedia:7891');
}
// mix.webpackConfig({
// resolve: {
//     alias: {
//         'leaflet':  path.resolve(
//             __dirname,
//             'node_modules/leaflet/'
//         )
//      }
//    }
// });
// mix.webpackConfig({
//   plugins: [
//    // reduce bundle size by ignoring moment js local files
//     new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
//   ]
// });
mix.options({
	//extractVueStyles: true, // Extract .vue component styling to file, rather than inline.
//  processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
	// purifyCss: {
	//     purifyOptions: {
	//         whitelist: ['*leaflet*', '*aos*', '*tooltip*']
	//     },
	// }
//  uglify: {}, // Uglify-specific options. https://webpack.github.io/docs/list-of-plugins.html#uglifyjsplugin
//  postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
});