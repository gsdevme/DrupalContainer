# DrupalContainer
Add the Symfony2 Container into a Drupal 7 projects through use of a Drupal 7 module that is weighted to load before any other module.

[![Build Status](https://scrutinizer-ci.com/g/gsdevme/DrupalContainer/badges/build.png?b=develop)](https://scrutinizer-ci.com/g/gsdevme/DrupalContainer/build-status/develop)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gsdevme/DrupalContainer/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/gsdevme/DrupalContainer/?branch=develop)

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
        "bin/drupal-container composer:install"
    ],
    "post-update-cmd": [
        "bin/drupal-container composer:update"
    ]
}
```
