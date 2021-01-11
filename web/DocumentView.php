<?php

use config\Config;
use documentpresenter\DocumentPresenterFactory;
use usecase\mime\GetMimeType;

require_once '../config/bootstrap.php';

if (!isset($_SERVER["PATH_INFO"])) {
    header("Location: DocumentList.php");
}

$allName = trim($_SERVER["PATH_INFO"], "/");

$doc = explode("#", $allName)[0];
$login = Config::getInstance()->login;

preg_match_all("/[a-z]+.*[a-z]+/", $doc, $mathes);
$path = Config::getInstance()->filespath . "/" . $mathes[0][0];

$defineMimeType = new GetMimeType($path);
$mimeType = $defineMimeType->execute();
header("Content-type: $mimeType");

$documentPrFactory = new DocumentPresenterFactory($mimeType);
$documentPresent = $documentPrFactory->getDocumentPresenter();
$documentPresent->present($path);
// если использовать это ломаются скрипты oooxhtml
//XML_Output::tryHTML($docContext,TRUE);
