<?php

set_include_path(
        __DIR__ . '/../classes' . PATH_SEPARATOR .
                __DIR__ . '/../libs' . PATH_SEPARATOR .
                __DIR__ . "/../"
);

require_once '__autoload.php';

// Так лучше не делать наверное ? или вынести в отдельный файл
define("DOMEN", "https://ilb.github.io/devmethodology");

// DEBUG 
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
