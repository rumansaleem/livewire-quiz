const mix = require('laravel-mix');
const tailwind = require('tailwindcss');
const postcssImport = require('postcss-import');
const postcssNesting = require('postcss-nesting');
require('laravel-mix-purgecss');

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

mix.postCss('resources/css/app.css', 'public/css')
    .options({
        postCss: [
            postcssImport(),
            tailwind('./tailwind.config.js'),
            postcssNesting()
        ]
    })
    .purgeCss();

if(mix.inProduction) {
    mix.version();
}
