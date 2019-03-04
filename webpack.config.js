var Encore = require('@symfony/webpack-encore');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */
    .addEntry('css/bootstrap', './assets/vendor/bootstrap/css/bootstrap.min.css')
    .addEntry('css/font-awesome', './assets/vendor/font-awesome/css/font-awesome.min.css')
    .addEntry('css/jquery', './assets/vendor/jquery/css/jquery.css')
    .addEntry('css/offcanvas', './assets/vendor/offcanvas.css')
    .addEntry('css/flags', './assets/vendor/flags/flags.css')
    .addEntry('css/navbar', './assets/css/navbar.scss')
    .addEntry('css/estilos-generales', './assets/css/estilosGenerales.scss')


    .addEntry('js/bootstrap', './assets/vendor/bootstrap/js/bootstrap.min.js')
    .addEntry('js/pantallaCargando', './assets/js/pantallaCargando.js')


    .addEntry('js/_images', './assets/js/_images.js')

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())
    .configureFilenames({
        images: '[path][name].[hash:8].[ext]',
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you're having problems with a jQuery plugin
    // .autoProvidejQuery()

    // uncomment if you use API Platform Admin (composer req api-admin)
    //.enableReactPreset()
    //.addEntry('admin', './assets/js/admin.js')
;

module.exports = Encore.getWebpackConfig();
