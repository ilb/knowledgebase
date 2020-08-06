<?php

set_include_path(
        __DIR__ . '/../classes' . PATH_SEPARATOR .
                __DIR__ . '/../libs'
                . PATH_SEPARATOR . get_include_path()
);
require_once "phplib-1/__autoload.php";

// Так лучше не делать наверное ? или вынести в отдельный файл
//define("DOMEN", "https://ilb.github.io/devmethodology");
define("DOMEN", "https://demo01.ilb.ru/devmethodology/docs");

// DEBUG 
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
