let mix = require('laravel-mix');
mix
    .scripts(
        [
            'node_modules/materialize-css/dist/js/materialize.min.js',
            'resources/assets/js/app.js',
            'resources/assets/js/components/banner.js'
        ], 
        'public/js/app.js'
    )
   .sass('resources/assets/sass/app.scss', 'public/css')
   .scripts(
       [
            'resources/assets/js/components/pool-classification.js'
       ],
       'public/js/pages/tournament.js'
   )
   .sass('resources/assets/sass/pages/tournament.scss', 'public/css/pages');
