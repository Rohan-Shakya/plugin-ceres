const { merge } = require("webpack-merge");
const ClientConfig = require("./tools/webpack/client.config");
const ServerConfig = require("./tools/webpack/server.config");
const StyleConfig = require("./tools/webpack/styles.config");

module.exports = [
    // Build scripts to be used in web clients
    merge(
        ClientConfig("production"),
        {
            name: "scripts",
            entry: {
                base: "./resources/js/src/base.js",
                checkout: "./resources/js/src/checkout.js",
                client: "./resources/js/src/entry-client.js"
            },
            performance: {
                hints: false,
                maxEntrypointSize: 512000,
                maxAssetSize: 512000
            }
        }
    ),
    merge(
        ClientConfig("development"),
        {
            name: "scripts",
            entry: {
                base: "./resources/js/src/base.js",
                checkout: "./resources/js/src/checkout.js",
                client: "./resources/js/src/entry-client.js"
            }
        }
    ),

    // Build scripts for serverside rendering
    merge(
        ServerConfig("production"),
        {
            name: "server",
            entry: "./resources/js/src/entry-server.js",
        },
    ),
    merge(
        ServerConfig("development"),
        {
            name: "server",
            entry: "./resources/js/src/entry-server.js"
        }
    ),

    // Build styles
    merge(
        StyleConfig("production"),
        {
            name: "styles",
            entry: {
                base: "./resources/scss/base.scss",
                checkout: "./resources/scss/checkout.scss",
                icons: "./resources/scss/icons.scss",
                shopbuilder: "./resources/scss/shopbuilder.scss",
            },
            performance: {
                hints: false,
                maxEntrypointSize: 512000,
                maxAssetSize: 512000
            }
        }
    ),
    merge(
        StyleConfig("development"),
        {
            name: "styles",
            entry: {
                base: "./resources/scss/base.scss",
                checkout: "./resources/scss/checkout.scss",
                icons: "./resources/scss/icons.scss",
                shopbuilder: "./resources/scss/shopbuilder.scss"
            },

        }
    )
];

module.exports.parallelism = 1;
