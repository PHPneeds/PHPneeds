![PHPneeds Logo](https://raw.githubusercontent.com/PHPneeds/PHPneeds/main/public/assets/images/logo_256x50.png)

PHPneeds is a lightweight non-MVC PHP library for quickly start a project.

[![Latest Stable Version](https://poser.pugx.org/phpneeds/phpneeds/v)](https://packagist.org/packages/phpneeds/phpneeds)
[![PHP Version Require](https://poser.pugx.org/phpneeds/phpneeds/require/php)](https://packagist.org/packages/phpneeds/phpneeds)
[![Latest Unstable Version](https://poser.pugx.org/phpneeds/phpneeds/v/unstable)](https://packagist.org/packages/phpneeds/phpneeds)
[![License](https://poser.pugx.org/phpneeds/phpneeds/license)](https://packagist.org/packages/phpneeds/phpneeds)
[![Total Downloads](https://poser.pugx.org/phpneeds/phpneeds/downloads)](https://packagist.org/packages/phpneeds/phpneeds)
![Total Downloads](https://img.shields.io/badge/developer-Friendly-brightgreen)

----

### About
PHPneeds is an attempt to show that it's not necessary to use MVC and FRAMEWORK in every project, it can be done also old-school way without spaghetti.

----

### Installation
"**--keep-vcs**" is important for upgrade the prject from git.
```
composer create-project phpneeds/phpneeds {your_project_name} --keep-vcs
```
----

### NGINX Rewrite Rules
#### for image.php
```
rewrite "^/assets/images/(.*)-w=([0-9]{1,4})-h=([0-9]{1,4})-q=([0-9]{1,4})-c=([0-1]{1,4}).jpg$" /assets/images/image.php?f=$1&w=$2&h=$3&q=$4&c=$5;
```

### Upgrade
Composer cannot upgrade packages of type "**project**". You can upgrade this project files with "**git**".

**important: Directory structure may change after upgrade via git**
```
git pull origin tags/v{version}
```
Classes will be upgrade via Composer. Because, "**Libs**" separated from base project
```
composer update
```

----

### Author
- [Mertcan Ayhan](mailto:mertowitch@gmail.com) ([LinkedIn](https://www.linkedin.com/in/mertcan-ayhan/))

----

### License
The code for PHPneeds is distributed under the terms of the MIT license (see [LICENSE](LICENSE)).
