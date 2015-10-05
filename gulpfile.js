process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.sass('style.scss');

    mix.scripts([
        'plugins/*.js',
        'controllers/*.js',
        'factories/*.js',
        'directives/*.js',
        'filters/*.js',
    ], 'public/js/all.js');

    mix.stylesIn('resources/assets/css', 'public/css/plugins.css');
});
