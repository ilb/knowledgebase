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
$data = $defineMimeType->execute();
header("Content-type: " . $data["mime_type"]);

$documentPrFactory = new DocumentPresenterFactory($data["mime_type"]);
$documentPresent = $documentPrFactory->getDocumentPresenter();
$documentPresent->present($data["content"]);
// если использовать это ломаются скрипты oooxhtml
//XML_Output::tryHTML($docContext,TRUE);
