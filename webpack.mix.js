let mix = require('laravel-mix');
mix
    .scripts(
        [
            'node_modules/materialize-css/dist/js/materialize.min.js',
            'resources/assets/js/app.js',
            'resources/assets/js/components/main-menu.js',
            'resources/assets/js/components/sponsors.js'
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
   .sass('resources/assets/sass/pages/tournament.scss', 'public/css/pages')
   .sass('resources/assets/sass/pages/teams.scss', 'public/css/pages');
