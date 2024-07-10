var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .autoProvidejQuery()
    .autoProvideVariables({
        "window.Bloodhound": require.resolve('bloodhound-js'),
        "jQuery.tagsinput": "bootstrap-tagsinput"
    })
    .enableSassLoader(options => {
        options.implementation = require('sass');
    })
    .enableVersioning()
    .splitEntryChunks()
    .addEntry('js/app', './assets/app.js')
    .addStyleEntry('css/app', ['./assets/app.scss'])
    .enableSingleRuntimeChunk();

module.exports = Encore.getWebpackConfig();
