const mix = require('laravel-mix');
//const path = require('path');

 require('laravel-mix-purgecss');
// const webpack = require('webpack');
// require('laravel-mix-bundle-analyzer');

require('laravel-mix-workbox');


mix.sourceMaps().js('resources/js/app.js', 'public/js').vue()
.extract([ 'vue', 'jquery', 'bootstrap', 'moment', 'pusher-js'])
.sass('resources/sass/app.scss', 'public/css')
.styles([
    'resources/sass/app.css',
    'resources/sass/normalize.css',
    'resources/sass/skeleton.css',
    // 'https://gitcdn.link/repo/M-Media-Group/Snippet-CSS/master/css/normalize.css',
    // 'https://gitcdn.link/repo/M-Media-Group/Snippet-CSS/master/css/skeleton.css'
], 'public/css/all.css')
.purgeCss({
       extend: {
           safelist: { deep: [/swiper-/] },
       },
   })
.injectManifest({
    modifyURLPrefix: {
        '//': '/',
    },
    swSrc: './resources/js/service-worker.js'
});
if (mix.inProduction()) {
    mix.version();
} else {
	    // mix.bundleAnalyzer({
	    // 	analyzerPort: 8145,
	    // });
	//mix.browserSync('https://mmedia:7891');
}
