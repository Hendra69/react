const mix = require("laravel-mix");

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

require("laravel-mix-eslint");

mix
  .js("resources/js/app.js", "public/js")
  .react()
  // .less("resources/css/app.less", "public/css")
  .less("resources/assets/less/yoda-theme.less", "public/css")
  .postCss("resources/assets/icons/remixicon.css", "public/css")
  .webpackConfig(require("./webpack.config"));

mix.disableNotifications();

if (mix.inProduction()) {
  mix.version();
}
