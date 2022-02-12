const path = require("path");
const AntdDayjsWebpackPlugin = require("antd-dayjs-webpack-plugin");

module.exports = {
  resolve: {
    alias: {
      "@": path.resolve("resources/js"),
    },
  },
  module: {
    rules: [
      {
        test: /\.(?:le|c)ss$/,
        use: [
          {
            loader: require.resolve("less-loader"),
            options: {
              lessOptions: {
                javascriptEnabled: true,
                // modifyVars: {
                //   "primary-color": "#da251c",
                //   "border-radius-base": "7px",
                // },
              },
            },
          },
        ],
      },
    ],
  },
  plugins: [new AntdDayjsWebpackPlugin()],
};
