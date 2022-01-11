const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js("resources/js/ckeditor-classic.js", "public/dist/js")
    .js("resources/js/ckeditor-inline.js", "public/dist/js")
    .js("resources/js/ckeditor-balloon.js", "public/dist/js")
    .js("resources/js/ckeditor-balloon-block.js", "public/dist/js")
    .js("resources/js/ckeditor-document.js", "public/dist/js")
    .js('node_modules/chart.js/dist/chart.min.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [
            require("tailwindcss"),
            tailwindcss("./tailwind.config.js")
        ],
    })
    .autoload({
        "cash-dom": ["cash"],
    })
    .copyDirectory("resources/fonts", "public/dist/fonts")
    .copyDirectory("resources/images", "public/dist/images")
    .browserSync({
        proxy: "dlpay-system.test",
        files: ["resources/**/*.*"],
    });

if (mix.inProduction()) {
    mix.version();
}
