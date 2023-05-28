const mix = require("laravel-mix");

mix.js("resources/js/index.js", "public/js")
    .react()
    .postCss("resources/css/index.css", "public/css")
    .sourceMaps();

// Additional configuration options and asset bundling

if (mix.inProduction()) {
    mix.version();
}
