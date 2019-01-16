<?php

use trivial\controllers\App;

const DIR_SEP = DIRECTORY_SEPARATOR;
const ROOT_DIR = __DIR__ . DIR_SEP . '..';

(@include ROOT_DIR . DIR_SEP . 'vendor' . DIR_SEP . 'autoload.php') 
        or die("Can't find vendor/autoload. Run Composer.");
spl_autoload_register(function ($class) {
    if ( substr($class,0,4) === "app\\" ) {
        $filename = str_replace('\\',DIR_SEP,substr($class,4)) . '.php';
        if (file_exists(ROOT_DIR . DIR_SEP . $filename)) {
            include ROOT_DIR . DIR_SEP . $filename;
        }
    }
});

if (App::params('displayErrors')) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

new trivial\controllers\UrlController();
