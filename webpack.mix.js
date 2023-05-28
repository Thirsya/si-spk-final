const mix = require('laravel-mix');

mix.js('resources/js/app.jsx', 'public/js')
   .react()
   .postCss('resources/css/app.css', 'public/css')
   .sourceMaps();

// Additional configuration options and asset bundling

if (mix.inProduction()) {
   mix.version();
}