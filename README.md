# DrupalContainer
Add the Symfony2 Container input Drupal 7 projects through use of a Drupal 7 module that is weighted to load before any other module.


## Installing
You can install both the Drupal 7 module and the container via Composer. You will be prompted for the Drupal Project location and where you want to install the module to
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
