let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .copy('node_modules/jquery/dist/jquery.min.js', 'public/js/jquery.min.js')
    .copy('node_modules/materialize-css/dist/css/materialize.min.css', 'public/css/materialize.min.css')
    .copy('node_modules/materialize-css/dist/fonts/roboto', 'public/fonts/roboto')
    .copy('node_modules/materialize-css/dist/js/materialize.js', 'public/js/materialize.min.js')
    .copy('node_modules/corejs-typeahead/dist/typeahead.bundle.min.js', 'public/js/typeahead.bundle.min.js')
    .copy('node_modules/materialize-tags/dist/js/materialize-tags.min.js', 'public/js/materialize-tags.min.js')
    .copy('node_modules/materialize-tags/dist/js/materialize-tags.min.js.map', 'public/js/materialize-tags.min.js.map')
    .copy('node_modules/materialize-tags/dist/css/materialize-tags.min.css', 'public/css/materialize-tags.min.css')
    .copy('node_modules/simplemde/dist/simplemde.min.js', 'public/js/simplemde.min.js')
    .copy('node_modules/simplemde/dist/simplemde.min.css', 'public/css/simplemde.min.css')
    .styles(['resources/assets/css/libraries/prism.css'], 'public/css/prism.min.css')
    .js('resources/assets/js/libraries/prism.js', 'public/js/prism.min.js')
    .sass('resources/assets/sass/app.scss', 'public/css');
