const mix = require('laravel-mix');

// admin layout
mix.sass('resources/assets/sass/admin.scss', 'public/dist/admin/css').options({
    processCssUrls: false
});

// web layout
mix.sass('resources/assets/sass/web.scss', 'public/dist/web/css').options({
    processCssUrls: false
});

// admin css vendor
mix.styles([
    './node_modules/bootstrap-select/dist/css/bootstrap-select.css',
    './node_modules/node-waves/dist/waves.css',
    './node_modules/toastr/build/toastr.css',
    './node_modules/animate.css/animate.css',
    ], 'public/dist/admin/css/vendor.css');

// web css vendor
mix.styles([
    './node_modules/bootstrap-select/dist/css/bootstrap-select.css',
    './node_modules/node-waves/dist/waves.css',
    './node_modules/toastr/build/toastr.css',
    './node_modules/animate.css/animate.css',
    './node_modules/@fancyapps/fancybox/dist/jquery.fancybox.css',
    ], 'public/dist/web/css/vendor.css');

// admin javascript
mix.combine([
    'resources/assets/js/global/*.js',
    'resources/assets/js/admin/*.js',
    ], 'public/dist/admin/js/app.js');

// web javascript
mix.combine([
    'resources/assets/js/global/*.js',
    'resources/assets/js/web/*.js',
    ], 'public/dist/web/js/app.js');

// admin javascript vendor
mix.combine([
    './node_modules/jquery/dist/jquery.js',
    './node_modules/popper.js/dist/umd/popper.js',
    './node_modules/bootstrap/dist/js/bootstrap.min.js',
    './node_modules/bootstrap-select/dist/js/bootstrap-select.js',
    './node_modules/node-waves/dist/waves.js',
    './node_modules/toastr/build/toastr.min.js',
    './node_modules/js-cookie/src/js.cookie.js',
    ], 'public/dist/admin/js/vendor.js');

// web javascript vendor
mix.combine([
    './node_modules/jquery/dist/jquery.js',
    './node_modules/popper.js/dist/umd/popper.js',
    './node_modules/bootstrap/dist/js/bootstrap.min.js',
    './node_modules/bootstrap-select/dist/js/bootstrap-select.js',
    './node_modules/node-waves/dist/waves.js',
    './node_modules/toastr/build/toastr.min.js',
    './node_modules/js-cookie/src/js.cookie.js',
    './node_modules/@fancyapps/fancybox/dist/jquery.fancybox.js',
    ], 'public/dist/web/js/vendor.js');

mix.copyDirectory('./node_modules/@fortawesome/fontawesome-free/webfonts', 'public/dist/fonts/fontawesome');
mix.copyDirectory('resources/assets/js/tinymce', 'public/dist/admin/tinymce');
