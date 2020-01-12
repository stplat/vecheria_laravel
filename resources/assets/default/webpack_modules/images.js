module.exports = function() {
  return {
    module: {
      rules: [
        {
          test: /\.(jpg|png|svg|gif|webp)$/,
          loader: 'file-loader',
          options: {
            name: '/images/[name].[ext]',
          },
        },
      ],
    },
  };
};