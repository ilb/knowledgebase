<?php
/**
 * Description Меняет ссылку документа
 */

use config\Config;
use repository\Repository;
use serialize\Serialize;
use usecase\catalog\GetCatalog;

require_once '../config/bootstrap.php';

// Нужно переделать БД чтобы ссылка на документ менялась с сылкой на ресурс
$repository = new Repository(Config::getInstance()->connection);
$documentList = new GetCatalog(\config\Config::getInstance()->filespath);
$documentList->setRepository($repository);
$catalog = $documentList->execute();
$serialize = new Serialize();
$xml = $serialize->objToXMLandXSL($catalog, "stylesheets/ChangeDocument/ChangeDocument.xsl");
XML_Output::tryHTML($xml,TRUE);
