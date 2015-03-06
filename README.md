# DrupalContainer

## Install
```
"require": {
        "gsdevme/drupalcontainer": "dev-master"
},
"scripts": {
    "post-install-cmd": [
        "DrupalContainer\\Composer::postInstall"
    ],
    "post-update-cmd": [
        "DrupalContainer\\Composer::postUpdate"
    ]
}
```
