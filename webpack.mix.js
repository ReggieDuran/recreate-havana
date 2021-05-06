const mix = require('laravel-mix');

mix.sass('src/styles/scss/style.scss', 'dist/styles/style.min.css')
    .options({
        processCssUrls: false,
        autoprefixer: {
            options: {
                browsers: [
                    'last 6 versions',
                ]
            }
        }
    });
mix.js('src/js/scripts.js', 'dist/js/main.min.js').autoload({ jquery: ['$', 'window.jQuery', 'jQuery'] });



