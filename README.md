## Overview

[![CI](https://github.com/silverstripe/silverstripe-installer/actions/workflows/ci.yml/badge.svg)](https://github.com/silverstripe/silverstripe-installer/actions/workflows/ci.yml)
[![Silverstripe supported module](https://img.shields.io/badge/silverstripe-supported-0071C4.svg)](https://www.silverstripe.org/software/addons/silverstripe-commercially-supported-module-list/)

Base project folder for a Silverstripe ([http://silverstripe.org](http://silverstripe.org)) installation. Required modules are installed via [http://github.com/silverstripe/recipe-cms](http://github.com/silverstripe/recipe-cms). For information on how to change the dependencies in a recipe, please have a look at [https://github.com/silverstripe/recipe-plugin](https://github.com/silverstripe/recipe-plugin). In addition, installer includes [silverstripe/startup-theme](https://github.com/silverstripe/startup-theme) as a default theme.

## Installation

```sh
composer create-project silverstripe/installer my-app
```

## Instructions for Base CMS 6.1 project

1. Use your IDE file contents search-replace functionality to find these strings - remove `#` from strings:
    * pSR-4 Namespacing in composer.json`<#replace-org>\\<#replace-psr-theme>`
    * pSR-4 Namespacing in app `<#replace-org>\<#replace-psr-theme>`
    * namespacing for cache yml `<#replace-themeCache>`
    * theme references `<#replace-theme>`
    * recaptcha `<#replace-sitekey>`, `<#replace-secretkey>`
    * .env `<#replace-db-user>`, `<#replace-db-pw>`, `<#replace-db-name>`
   
2. Rename `themes/<#replace-theme>` to your desired theme name, update the theme composer.json and README as needed

3. Rename `themes/<#replace-theme>/templates/<#replace-org>/<#replace-psr-theme>` to propper name spacing
   
4. Once files and directories are updated and the project is running locally, remove the git repo in the project and set it to a new origin

5. Run your expose script(s)

6. Dev Build

## Mac user notes:

There is a build script for some vendor packages in the composer.json file. Only works on unix based machines... Sorry windows guys :(

## Sassy Compilation ##

```sh
  sass --watch themes/<replace-theme>/css/src/styles.scss:themes/<replace-theme>/css/dist/styles.min.css --style compressed
```

See [Getting Started](https://docs.silverstripe.org/en/getting_started/) for more information.

## Bugtracker

Bugs are tracked on github.com ([framework issues](https://github.com/silverstripe/silverstripe-framework/issues),
[cms issues](https://github.com/silverstripe/silverstripe-cms/issues)).
Please read our [issue reporting guidelines](https://docs.silverstripe.org/en/contributing/issues_and_bugs/).

## Development and Contribution

If you would like to make changes to the Silverstripe core codebase, we have an extensive [guide to contributing code](https://docs.silverstripe.org/en/contributing/code/).

## Links

 * [Changelogs](https://docs.silverstripe.org/en/changelogs/)
 * [Bugtracker: Framework](https://github.com/silverstripe/silverstripe-framework/issues)
 * [Bugtracker: CMS](https://github.com/silverstripe/silverstripe-cms/issues)
 * [Bugtracker: Installer](https://github.com/silverstripe/silverstripe-installer/issues)
 * [Forums](http://silverstripe.org/forums)
 * [Developer Mailinglist](https://groups.google.com/forum/#!forum/silverstripe-dev)
 * [License](./LICENSE)
