const ImageMinimizerPlugin = require("image-minimizer-webpack-plugin");

module.exports = {
  // Other Webpack configurations (entry, output, etc.)
  module: {
    rules: [
      {
        test: /\.(jpe?g|png|gif)$/i, // Target image formats
        type: "asset",
      },
    ],
  },
  optimization: {
    minimize: true,
    minimizer: [
      new ImageMinimizerPlugin({
        minimizer: {
          implementation: ImageMinimizerPlugin.imageminGenerate,
          options: {
            plugins: [
              ["imagemin-mozjpeg", { quality: 75 }], // Optimize JPEGs
              ["imagemin-pngquant", { quality: [0.6, 0.8] }], // Optimize PNGs
              ["imagemin-webp", { quality: 75 }], // Generate WebP images
            ],
          },
        },
      }),
    ],
  },
};
