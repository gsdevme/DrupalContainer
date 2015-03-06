# DrupalContainer
Add the Symfony2 Container input Drupal 7 projects through use of a Drupal 7 module that is weighted to load before any other module.

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
