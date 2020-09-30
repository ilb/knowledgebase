<?php

set_include_path(
                __DIR__ . '/../generated'
                .  PATH_SEPARATOR . __DIR__ . '/../classes'
                . PATH_SEPARATOR . __DIR__ . '/../libs'
                . PATH_SEPARATOR . "phplib-1"
                . PATH_SEPARATOR . "happymeal-1"
                . PATH_SEPARATOR . get_include_path()
);
require_once "phplib-1/__autoload.php";
require_once "Config.php";
Config_Resources::load(__DIR__ . "/web.xml");

// Так лучше не делать наверное ? или вынести в отдельный файл
//define("DOMEN", "https://ilb.github.io/devmethodology");
define("DOMEN", "https://demo01.ilb.ru/devmethodology/docs");
