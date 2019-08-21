PHP, JS and CSS Minifier
====================

## Description
This plugin is a modified version of PHP, JS and CSS Minifier by promatik, with this plugin, you can minify you js's and css's via PHP, it will create a file with .min, example: css/style.css => css/style.min.css.
This plugin uses an online service provided by Andy Chilton, http://chilts.org/

## Download
* [Master branch](https://github.com/misteregis/php-js-css-minifier/archive/master.zip)

## How to use the plugin:
* Use with Array

```php

    $array = array(
        "js/application.js",
        "css/application.css"
    );

    minify($array);
```


* Use with Object Class

```php

    $object = new stdClass();
    $object->file1 = 'js/application.js';
    $object->file2 = 'css/application.css';

    minify($object);
```


* Use with Parameters

```php

    minify("js/main.js", "css/main.css");
```


* Or use with all options

```php

    // Array
    $array = array(
        "js/application.js",
        "css/application.css"
    );

    // Object Class
    $object = new stdClass();
    $object->file1 = 'js/application.js';
    $object->file2 = 'css/application.css';

    // Object Array
    $arrayObject = (object) array(
        "css/main.css",
        "js/main.js"
    );

    minify($array, $object, $arrayObject, "js/main.js", "css/main.css");
```

## Features
* **Instantly compress all your JS's and CSS's**  
  This allows you to add js and css files to a list, that you can minify at any time.

## Requirements
* PHP Webserver

## License
Released under the [MIT license](http://www.opensource.org/licenses/MIT).
