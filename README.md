# DrupalContainer
Add the Symfony2 Container input Drupal 7 projects through use of a Drupal 7 module that is weighted to load before any other module.

## Todo
- [ ] Symfony2 Console Application to install the Drupal Module
- [ ] Console Application to search for Drupal Install
- [ ] Lock file created with relative path of Drupal Install
- [ ] Ask the user where they want the module installed e.g. /sites/ /profiles/
- [ ] Tests :)

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
