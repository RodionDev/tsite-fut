let mix = require('laravel-mix');
mix
    .scripts(
        [
            'node_modules/materialize-css/dist/js/materialize.min.js',
            'resources/assets/js/app.js',
            'resources/assets/js/components/main-menu.js',
        ], 
        'public/js/app.js'
    )
   .sass('resources/assets/sass/app.scss', 'public/css')
   .scripts(
       ['resources/assets/js/components/pool-classification.js'],
       'public/js/pages/tournament.js'
   )
   .sass('resources/assets/sass/pages/tournament.scss', 'public/css/pages')
   .scripts(
       ['resources/assets/js/pages/cud-tournament.js'],
       'public/js/pages/cud-tournament.js'
    )
   .sass('resources/assets/sass/pages/teams.scss', 'public/css/pages')
   .scripts(
       ['resources/assets/js/pages/new-team-form.js'],
       'public/js/pages/new-team.js'
    );
