# DrupalContainer

## Authors
```
Brian Ward - https://github.com/briward/
Gavin Staniforth - https://github.com/gsdevme
```

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
