var webpack = require('webpack');

var webpackEnv = new webpack.DefinePlugin({
    'process.env': {
        NODE_ENV: JSON.stringify('development')
    }
});

var uglify = new webpack.optimize.UglifyJsPlugin();

module.exports = {
  entry: './public/js/script.js',
  output: {
        filename: './public/js/bundle.js'       
  },
  plugins: [
        webpackEnv
  ],
  module: {
        loaders: [
            { 
                test: /\.js$/, 
                exclude: /node_modules/, 
                loader: 'babel-loader',
                query: {
                    presets: ['env','react','es2015']
                } 
            }
        ]
    }
};
