<?php

use config\Config;
use usecase\document\DocumentView;

require_once '../config/bootstrap.php';


if (!isset($_SERVER["PATH_INFO"])) {
    header("Location: DocumentList.php");
}

$allName = trim($_SERVER["PATH_INFO"], "/");

$doc = explode("#", $allName)[0];
$login = Config::getInstance()->login;

preg_match_all("/[a-z]+.*[a-z]+/", $doc, $mathes);
$path = Config::getInstance()->filespath . "/" . $mathes[0][0];

$usecase = new DocumentView($path);
$documentPresentData = $usecase->execute();

header("Content-type: " . $documentPresentData["contentType"]);
echo $documentPresentData["content"]->present($path);
