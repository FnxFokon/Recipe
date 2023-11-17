const path = require('path');

module.exports = {
    // 1 Point d'entrée de l'application
    entry: path.resolve(__dirname, './src/index.js'),
    module:{
        rules: [
            {
                // 4 on utilise babel-loader pour transpiler les fichiers JS
                test: /\.js$/,
                exclude: /node_modules/,
                use: ['babel-loader']
            },
            {
                // 6 On utilise css-loader et style-loader pour importer les fichiers CSS
                test: /\.(css)$/,
                use: ['style-loader', 'css-loader']
            },
            {
                // 7 On utilise
                test: /\.(scss|sass)$/,
                use: ['style-loader', 'css-loader', 'sass-loader']
            }
        ]
    },
    resolve: {
        // 5 on ajoute l'extension .js pour importer des fichiers JS
        extensions: ['*', '.js']
    },
    // 2 point de sortie de l'application
    output: {
        path: path.resolve(__dirname, '.dist'),
        filename: 'bundle.js',
    },
    // 3 dossier /dist sera utilisé pour servir notre application au navigateur
    devServer:{
        static: path.resolve(__dirname, './dist'),
    }
};