let mix = require('laravel-mix');
var path = require('path');
const WebpackShellPlugin = require('webpack-shell-plugin');

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

mix.less('resources/assets/less/app.less', 'public/css')
   .js('resources/assets/js/app.js', 'public/js')
   .webpackConfig({
        plugins: [
            new WebpackShellPlugin({onBuildStart:['php artisan lang:js public/js/lang.dist.js --quiet'], onBuildEnd:[]})
        ],
        resolve: {
            modules: [
                path.resolve(__dirname, 'vendor/laravel/spark/resources/assets/js'),
                'node_modules'
            ],
            alias: {
                'vue$': 'vue/dist/vue.js',
                'vuejs-datatable': 'vuejs-datatable/dist/vuejs-datatable.esm.js'
            }
        }
   });

mix.options({
    uglify: false,
});
mix.extract(['vue','jquery','vue-instantsearch','vue2-notify','vue-session','vue-pagination-2','vue2-datatable-component','bootstrap-vue','vue-moment','@riophae/vue-treeselect','vue-select','vuetify','axios-progress-bar','vue-multiselect','vue-count-to','vue-script2','plotly.js']);
mix.sass('public/css/dashboard/user-admin.scss', 'public/css/dashboard/user-admin.css');


/*
* mix.extract(['vue','jquery','vue-instantsearch','vue2-notify','vue-session','vue-pagination-2','vue2-datatable-component','bootstrap-vue','vue-moment','@riophae/vue-treeselect','vue-select','vuetify','axios-progress-bar','vue-multiselect','vue-count-to','vue-script2']);
* */