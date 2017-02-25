var components = {
    "packages": [
        {
            "name": "qunit",
            "main": "qunit-built.js"
        },
        {
            "name": "ekko-lightbox",
            "main": "ekko-lightbox-built.js"
        },
        {
            "name": "holder",
            "main": "holder-built.js"
        },
        {
            "name": "bootstrap-switch",
            "main": "bootstrap-switch-built.js"
        }
    ],
    "shim": {
        "qunit": {
            "exports": "QUnit"
        },
        "bootstrap-switch": {
            "exports": "BootstrapSwitch"
        }
    },
    "baseUrl": "components"
};
if (typeof require !== "undefined" && require.config) {
    require.config(components);
} else {
    var require = components;
}
if (typeof exports !== "undefined" && typeof module !== "undefined") {
    module.exports = components;
}