module.exports = {
  entry: './src/index',
  output: { path: "./dist", filename: "bundle.js" },
  externals: {
    "jquery": "jQuery"
  },
  module: {
    loaders: [
      {
        test: /.js?$/,
        loader: "babel-loader",
        query: {
          presets: ["es2015"]
        }
      }
    ]
  },
};
